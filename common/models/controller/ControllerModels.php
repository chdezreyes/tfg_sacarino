<?php

    class ControllerModels{

        static public function ctrGetModels($item = null, $value = null){
            $table = 'main_models';
            $answer = ModelModels::mdlGetModels($table, $item, $value);
            return $answer;
        }

        static public function ctrCreateModelItem(){

            if(isset($_POST['itemName'])){
                $modelName = $_POST['itemName'];
                $modelDescription = $_POST['itemDescription'];
                $modelApp = $_POST['fatherItem'];
                $table ='main_models';
    
                //Get the path from the app selected
                $path = ControllerMenus::ctrGetMenuItemFromId($modelApp);
                $path = $path['menu_path'].'model/';
    
                echo'<script>console.log('.json_encode($path).')</script>';
    
                $answer = ModelModels::mdlCreateModel($table, $modelName, $modelDescription, $modelApp, $path);
    
                if($answer == "ok"){
                    if (!file_exists($path)) {
                        mkdir($path, 0755, true);
                        chown($path, 'www-data');
                    }
                    $filePath = $path . $modelName;
                    $fileContent = ControllerMenusFile::ctrCreateModel($modelName);
                    file_put_contents($filePath, $fileContent);
                }
    
            }
    
        }

        static public function ctrGetAutoloadModels($item = null, $value = null){
            $table = 'main_models';
            $answer = ModelModels::mdlGetAutoloadModels($table, $item, $value);
            return $answer;
        }

    }



?>