<?php

class ControllerMenusCrud
{

  static public function ctrCreateMenuItem(){
    if (isset($_POST['itemName'])) {

      $menuType = $_POST['menuType'];
      $menuName = $_POST['itemName'];
      $menuDescription = $_POST['itemDescription'];
      $fatherItem = $_POST['fatherItem'];
      $menuIcon = $_POST['itemIcon'];
      $menuOrder = $_POST['itemOrder'];

      $father = ControllerMenus::ctrGetMenuItemFromId($fatherItem);
      $menuPath = "";
      $menuFile = "";

      if ($menuType == 0) {
        $menuPath = $father['menu_path'];
        $menuFile = "profile_" . strtolower(str_replace(' ', '_', $menuName)) . ".php";
      } else if ($menuType == 1) {
        $menuPath = $father['menu_path'] . strtolower($menuName) . "/";
        $menuFile = "app_" . strtolower(str_replace(' ', '_', $menuName)) . ".php";
      } else {
        $menuPath = $father['menu_path'] . "view/";
        $menuFile = str_replace("app_", "", str_replace(".php", "", $father['menu_file'])) . '_' . strtolower(str_replace(' ', '_', $menuName)) . ".php";
      }

      $menuEnv = $father['menu_env'];
      $menuItemAbove = $father['id'];
      $menuCreatedBy = $_SESSION['userId'];

      $data = [
        'menu_name' => $menuName,
        'menu_icon' => $menuIcon,
        'menu_path' => $menuPath,
        'menu_file' => $menuFile,
        'menu_env' => $menuEnv,
        'menu_type' => $menuType+1,
        'menu_item_above' => $menuItemAbove,
        'menu_order' => $menuOrder,
        'menu_description' => $menuDescription,
        'menu_status' => 1,
        'menu_created_by' => $menuCreatedBy
      ];

      $table = 'main_menus';
      $answer = ModelMenus::mdlCreateMenu($table, $data);
      
      if ($answer === 1) {
        $menuTypeIncremented = $menuType + 1;
        if ($menuTypeIncremented == 3) {
            $filePath = $menuPath . $menuFile;
            $fileContent = ControllerMenusFile::ctrCreateFile($menuName, $menuDescription);
            file_put_contents($filePath, $fileContent);
        } else if ($menuTypeIncremented == 2) {
            mkdir($menuPath."view", 0755, true);
            chown($menuPath, 'www-data');
        }else if ($menuTypeIncremented == 1) {
            mkdir($menuPath, 0755, true);
            chown($menuPath, 'www-data');
        }
    }
    
    }
  }
}


?>