<div class="float-center">
    <span class="float-right">© Sacarino Application - 2023</span>

    <!-- /***CONTROL SIDEBAR */ -->

    <div class="wrapper">
        <aside class="control-sidebar control-sidebar-dark" style="display: block;">
            <div class="p-3">
                <h5>Perfiles</h5>

                <?php
                    $enviroment = 1;
                    $menuItemAbove = 1;
                    if(isset($_GET['route'])){
                        $enviroment = Router::ctrGetRouteEnviroment($_GET["route"]);
                       if($enviroment == 0){
                        $menuItemAbove = 2;
                       }
                    }

                    $profileElements = ControllerMenus::ctrGetProfileElements($enviroment, $menuItemAbove);
                    foreach ($profileElements as $key => $value) {
                        echo '<div class="mb-0 align-items-center">';
                        echo '  <a  class="nav-link" href="'.pathinfo($value["menu_file"],PATHINFO_FILENAME).'">';
                        echo '      <div class="row  align-items-center"><span class="material-symbols-outlined pt-0 mr-3" style="color:white">'.$value['menu_icon'].'</span>';
                        echo '      <span>'.$value["menu_name"].'</span> </div>';
                        echo '  </a>';
                        echo '</div>';
                    }
                ?>

            </div>
        </aside>
    <div>
</div>