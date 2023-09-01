<?php

class Router{

    static public function ctrGetRoute($route){

        $table = "main_menus";
        $item  = "menu_file";
        $value = $route.".php";
        $answer = ModelMenus::mdlGetMenu($table, $item, $value);
        $menuType = $answer['menu_type'];

        if($menuType == 0 || $menuType == 3) {
            $route = "/var/www/html/".$answer["menu_path"].$answer["menu_file"];
        }else if($menuType == 1) {
            $answer = self::ctrGetMenuItemFirstChild($answer['id']);
            $answer = self::ctrGetMenuItemFirstChild($answer['id']);
            $route = "/var/www/html/".$answer["menu_path"].$answer["menu_file"];

        }else if($menuType == 2) {
            $answer = self::ctrGetMenuItemFirstChild($answer['id']);
            $route = "/var/www/html/".$answer["menu_path"].$answer["menu_file"];
        }else{
            $route = "/var/www/html/".$answer["menu_path"].$answer["menu_file"];
        }
        return $route;
    }

    static public function ctrGetRouteEnviroment($route){

        $table = "main_menus";
        $item  = "menu_file";
        $value = $route.".php";
        $answer = ModelMenus::mdlGetMenu($table, $item, $value);
        return $answer['menu_env'];
    }

    static public function ctrGetMenuItemFirstChild($menuId){

        $table = "main_menus";
        $firstChild = ModelMenus::mdlGetMenuItemFirstChild($table, $menuId);
        return $firstChild;
    }

}

