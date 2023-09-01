<?php

    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Shared\Date;

    class ControllerCierreReadFile{

        protected $batchSize;
        protected $controlValue = false;
    
        public function __construct($batchSize = 25000)
        {
            $this->batchSize = $batchSize;
        }

        public function ctrLoadFile(){

            // Start the timer
            $startTime = microtime(true);
            $empresa    = '';
            $loggedUser = '';

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['archivo_excel'])) {
                $nombre_archivo = $_FILES['archivo_excel']['name'];
                $ruta_temporal = $_FILES['archivo_excel']['tmp_name'];
                $ejercicio = $_POST["ejericicoDatos"];
                $apertura = $_POST['asientoApertura'];
                $empresa = $_POST['idEmpresaAddEjercicioData'];
                $loggedUser = $_POST['loggedUser'];

                //Empty previous data from same ejercicio
                ModelCierreStoreFile::mdlDeleteData($ejercicio);
    
                // Move the loaded file to a temporary location
                move_uploaded_file($ruta_temporal, 'assets/temp/'.$nombre_archivo);
    
                // Full path to file
                $inputFileName = 'assets/temp/'.$nombre_archivo;
    
                // Load the spreadsheet file
                $spreadsheet = IOFactory::load($inputFileName);
              
                foreach ($spreadsheet->getSheetNames() as $sheetName) {
                    $sheet = $spreadsheet->getSheetByName($sheetName);
                    $highestRow = $sheet->getHighestRow()-1;
                    $headerRow = 7;
                    
                    // Skip header rows
                    $row = $headerRow + 1;
                    $previousRowData = null; // Store the previous row's data
                    $data = [];

                    while ($row <= $highestRow) {
                        
                        // Read a batch of rows
                        for ($i = 0; $i < $this->batchSize && $row <= $highestRow; $i++) {
                            $rowData = $sheet->rangeToArray('A' . $row . ':' . $sheet->getHighestColumn() . $row, null, true, false);

                            // Convert Excel date value to MySQL datetime format
                            $dateValue = $rowData[0][1]; // Assuming the date is in the second column

                            // Check if the cell has a date format
                            $cell = $sheet->getCellByColumnAndRow(2, $row); // Assuming the date is in the second column (index 1)
                            if (Date::isDateTime($cell)) {
                                $formattedDate = Date::excelToDateTimeObject($cell->getValue())->format('Y-m-d H:i:s'); // Format the date as per MySQL datetime format

                                // Replace the Excel date value with the converted MySQL datetime value
                                $rowData[0][1] = $formattedDate;
                            }

                            // Check if any cell is null or empty in the first three columns
                            if (empty($rowData[0][0]) || empty($rowData[0][1]) || empty($rowData[0][2])) {
                                // Copy previous row's data for the empty/null columns
                                if ($previousRowData !== null) {
                                    foreach ([0, 1, 2] as $columnIndex) {
                                        if (empty($rowData[0][$columnIndex])) {
                                            $rowData[0][$columnIndex] = $previousRowData[$columnIndex];
                                        }
                                    }
                                }
                            }

                            // Check if $rowData[0][2] equals $apertura
                            if ($rowData[0][2] == $apertura) {
                                $rowData[0][] = '00'; // Add 00 at the end of $rowData[0]
                            } else {
                                $month = date('m', strtotime($rowData[0][1])); // Extract the month from the date
                                $rowData[0][] = $month; // Add the month at the end of $rowData[0]
                            }

                            $data[] = $rowData[0];
                            $previousRowData = $rowData[0];
                            $row++;
                        }
                                               
                        // Process and store the batch of data
                        $this->storeData($ejercicio, $data);
                        $data = []; // Clear the data array for the next batch

                    }
                }
            }

            // Stop the timer
            $endTime = microtime(true);

            // Calculate the execution time
            $executionTime = (int) $endTime - (int) $startTime;
            $minutes = (int) floor($executionTime / 60);
            $seconds = (int) ($executionTime % 60);
            $executionTime = "$minutes minutos y $seconds segundos.";

            
            if($this->controlValue == true){
                //Update on Ejercicios table
                $updateEjercicio = ControllerEjercicios::ctrUpdateEjercicio($loggedUser, $ejercicio, $empresa);
                
                $url = 'cierre_empresas';

                if($updateEjercicio == "ok"){
                    $type = 'success';
                    $message = 'El ejercicio se ha creado correctamente';
                    $html = 'Tiempo de carga de datos: '. $executionTime ;                    
                }else{
                    $type = 'error';
                    $message = 'Los datos no se han podido cargar';
                }

                ControllerAlerts::ctrAlert($type, $message, $url, $html);
            }
        }

        protected function storeData($ejercicio,$data){
            // Use your model class ExcelFileStorer to store the data in the database
            $storer = new ModelCierreStoreFile();
            $storer->mdlStoreData($ejercicio, $data);

            if($storer == true){
                $this->controlValue = true;
            }else{
                $this->controlValue = false;
            }
                            
            // Release the memory used by the batch data
            unset($data);
        }

    }
?>