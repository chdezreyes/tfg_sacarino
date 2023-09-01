<li class="nav-item dropdown user user-menu">
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <span class="user-name text-light">
            <?php echo $_SESSION['userName'];
                  echo '<input type="hidden" id="loginUser" value="'.$_SESSION["userName"].'">'
            ?>
        </span>
    </a>
<!-- INI -- DropDown Menu -->
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" aria-expanded="true">
        <a class="dropdown-item" href="#">Usuario</a>
        <a class="dropdown-item" href="404">404</a>
        <a class="dropdown-item" href="page_template">Page Template</a>
        <?php
                //GET URL
                $pathFileName = pathinfo(str_replace("/","", $_SERVER['REQUEST_URI']), PATHINFO_FILENAME);
                if($pathFileName != "control_panel" && $_SESSION["userRole"] == 1){
                   echo'<a class="dropdown-item" href="control_panel">Panel de Control</a>';
                }
        ?>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="salir">Cerrar Sesión</a>
    </ul>
<!-- FIN -- DropDown Menu -->
</li>
