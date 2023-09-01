<?php

class ControllerControllers {

    static public function ctrGetControllers($item = null, $value = null){
        $table = 'main_controllers';
        $answer = ModelControllers::mdlGetControllers($table, $item, $value);
        return $answer;
    }

    static public function ctrCreateControllerItem(){

        if(isset($_POST['itemName'])){
            $controllerName = $_POST['itemName'];
            $controllerDescription = $_POST['itemDescription'];
            $controllerApp = $_POST['fatherItem'];
            $table ='main_controllers';

            //Get the path from the app selected
            $path = ControllerMenus::ctrGetMenuItemFromId($controllerApp);
            $path = $path['menu_path'].'controller/';

            echo'<script>console.log('.json_encode($path).')</script>';

            $answer = ModelControllers::mdlCreateController($table, $controllerName, $controllerDescription, $controllerApp, $path);

            if($answer == "ok"){
                mkdir($path, 0755, true);
                chown($path, 'www-data');
                $filePath = $path . $controllerName;
                $fileContent = ControllerMenusFile::ctrCreateController($controllerName);
                file_put_contents($filePath, $fileContent);
            }

        }

    }

    static public function ctrGetAutoloadControllers($item = null, $value = null){
        $table = 'main_controllers';
        $answer = ModelControllers::mdlGetAutoloadControllers($table, $item, $value);
        return $answer;
    }


}