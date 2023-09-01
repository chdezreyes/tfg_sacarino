<!-- INI -- NAVBAR -->

  <!-- INI -- MENU ELEMENTS IN NAVBAR -->
    <ul class="navbar-nav align-items-center">
      <li class="nav-item">
        <a class="nav-link text-white v-center mt-1 pt-2" data-widget="pushmenu" data-enable-remember="false" href="#" role="button">
          <span class="material-symbols-outlined">menu</span>
        </a>
      </li>

        <?php
           $menuId = null;
           if(isset($_GET['route'])){

            $menuElement = ControllerMenus::ctrGetMenu($_GET["route"]);
            $menuId = ControllerMenus::ctrGetFirstModule($menuElement);
            if($menuId){
              $menuId = $menuId['id'];
            }else{
              $menuId =null;
            }
           }

           if ($menuId) {
            $appElements = ControllerMenus::ctrGetMenuItemChildren($menuId);
            
            
            foreach ($appElements as $key => $value) {
                $fileName = pathinfo($value['menu_file'], PATHINFO_FILENAME);
           
                echo '<li class="nav-item d-none d-sm-inline-block pt-1">';
                echo '  <div >';
                echo '    <a href="'.$fileName.'" class="nav-link text-white mb-0">'.$value["menu_name"].'</a>';
                echo '  </div>';
                echo '</li>';
            }
          }
        ?>
    </ul>
  <!-- FIN -- MENU ELEMENTS IN NAVBAR -->

  <!-- INI -- Right navbar links -->
    <ul class="navbar-nav ml-auto align-items-center">
        <?php
            include_once "usermenu.php";
        ?>
      <li class="nav-item">
        <a class="nav-link mt-1 pt-2" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <span class="material-symbols-outlined" style="color:white">apps</span>
        </a>
      </li>
    </ul>
  <!-- FIN -- Right navbar links -->

<!-- FIN -- NAVBAR -->