<?php

/**
 * Controlador para el manejo de elementos de menú
 */
class ControllerMenus
{

  static public function ctrGetMenu($menuFileName)
  {
    $table = 'main_menus';
    $item = 'menu_file';
    $value = $menuFileName . '.php';
    $answer = ModelMenus::mdlGetMenu($table, $item, $value);
    return $answer;
  }

  static public function ctrGetMenuItemFromId($menuId)
  {
    $table = 'main_menus';
    $item = 'id';
    $answer = ModelMenus::mdlGetMenu($table, $item, $menuId);
    return $answer;

  }

  static public function ctrGetMenus($item, $value)
  {
    $table = 'main_menus';
    $answer = ModelMenus::mdlGetMenus($table, $item, $value);
    return $answer;
  }

  static public function ctrGetProfileElements($enviroment, $menuItemAbove)
  {
    $table = 'main_menus';
    $answer = ModelMenus::mdlGetProfileElements($table, $enviroment, $menuItemAbove);
    return $answer;
  }

  static public function ctrGetFirstApp($menuElement)
  {
    $table = 'main_menus';

    if ($menuElement['menu_type'] == 1) {
      $answer = $menuElement;
    } else if ($menuElement['menu_type'] == 2) {
      $answer = ModelMenus::mdlGetMenuItemFather($table, $menuElement['menu_item_above']);
    } else if ($menuElement['menu_type'] == 3) {
      $answer = ModelMenus::mdlGetMenuItemFather($table, $menuElement['menu_item_above']);
      $answer = ModelMenus::mdlGetMenuItemFather($table, $answer['menu_item_above']);
    } else {
      $answer = null;
    }
    return $answer;
  }

  static public function ctrGetFirstModule($menuElement)
  {
    $table = 'main_menus';

    if ($menuElement['menu_type'] == 1) {
      $answer = ModelMenus::mdlGetMenuItemFirstChild($table, $menuElement['id']);
    } else if ($menuElement['menu_type'] == 2) {
      $answer = $menuElement;
    } else if ($menuElement['menu_type'] == 3) {
      $answer = ModelMenus::mdlGetMenuItemFather($table, $menuElement['id']);
      $answer = ModelMenus::mdlGetMenuItemFather($table, $menuElement['menu_item_above']);
    } else {
      $answer = null;
    }
    return $answer;
  }

  static public function ctrGetMenuItemChildren($menuId)
  {
    $table = 'main_menus';
    $answer = ModelMenus::mdlGetMenuItemChildren($table, $menuId);
    return $answer;
  }

}