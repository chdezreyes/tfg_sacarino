<?php

class ControllerMenusFile{
    
    static public function ctrCreateFile($menuName, $menuDescription)
    {
        $fileContent = "
        
        <!-- ROW MAIN CONTENT  -->
        <div class='row full-height ml-2 mt-4'>
            <!-- MAIN COLUMN -->
            <div class='col mt-3 mr-3 w-100'>
                <div class='card card-secondary card-outline panel-height' id='panel-content'>
                    <!-- Main Header -->
                    <div class='card-header car-header-double d-flex align-items-center' id='cardMainHeader'>
                        <div class='row justify-content-between w-100'>
                            <div>
                                <h5 class='mt-2 ml-2'><b>".strtoupper($menuName)."</b></h5>
                            </div>
                            <div class='pr-3'>
                                <button type='button' class='btn btn-block btn-outline-primary btn-sm mt-1 buttonAdd' data-toggle='modal' data-target='#menusModalCreate' menuType=0>
                                    Añadir Empresa
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Main Body -->
                    <div>
                        <h5 class='p-4'>".$menuDescription."</h5>
                    </div>
        
                </div>
            </div>
        </div>
        <!-- END ROW MAIN CONTENT  -->";

        return $fileContent;
        
    }

    static public function ctrCreateController($controllerName){

        $controllerName = str_replace(".php", "", $controllerName);

        $fileContent ="
        
            <?php

                class ". $controllerName ."{

                }

            ?>

        ";

        return $fileContent;

    }

    static public function ctrCreateModel($modelName){

        $modelName = str_replace(".php", "", $modelName);

        $fileContent ="
        
            <?php

                class ". $modelName ."{

                }

            ?>

        ";

        return $fileContent;

    }


}