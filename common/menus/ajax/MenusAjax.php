<?php
    require_once "../controller/ControllerMenus.php";
    require_once "../model/ModelMenus.php";
    require_once "../../Connection.php";

    class MenusAjax{

        /********MOSTRAR CLIENTES */

        public $menuType;
        public function ajaxGetMenuElements(){

            $item = 'menu_type';
            $value = $this->menuType;
            $answer = ControllerMenus::ctrGetMenus($item, $value);

            echo json_encode($answer);
        }

    }

    if(isset($_POST['menuType'])){
        $menuType = new MenusAjax();
        $menuType -> menuType = $_POST['menuType'];
        $menuType -> ajaxGetMenuElements();
    }

?>