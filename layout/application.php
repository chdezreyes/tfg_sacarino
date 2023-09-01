<?php
    session_start();
    require_once '/var/www/html/autoload.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sacarino</title>
        <!-- STYLESHEETS LINKS -->

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

        <!-- Bootstrap 4.6 -->
        <link rel="stylesheet" href="../resources/css/bootstrap/bootstrap-reboot.css">
        <link rel="stylesheet" href="../resources/css/bootstrap/bootstrap.css">
        <link rel="stylesheet" href="../resources/css/bootstrap/bootstrap-grid.css">

        <!-- iCheck -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css">

        <!-- AdminLTE 3.0 -->
        <link rel="stylesheet" href="../resources/css/adminlte/adminlte.css">

        <!-- Material icons -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

        <!-- DataTable -->
        <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"/>
        <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">

        <!-- Slick - Carousel -->
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

        <!-- Cropper JS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.css">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="../resources/css/custom.css">
        <link rel="stylesheet" href="../resources/css/sizes.css">
        <link rel="stylesheet" href="../resources/css/backgrounds.css">

</head>
<body>

    <?php

        if(isset($_SESSION["userSession"]) && $_SESSION["userSession"] == "ok"){
            echo '<body class="hold-transition sidebar-collapse sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed vsc-initialized overflow-hidden" cz-shortcut-listen="true" style="height:full">';

          //* WRAPPER
                    echo '  <div class="wrapper ml-0">';

          //* HEADER

                    if(isset($_GET['route'])){
                        $routeType = Router::ctrGetRouteEnviroment($_GET["route"]);
                        if ($routeType == 0){
                            echo '  <nav class="main-header navbar navbar-expand bg-secondary">';
                        }else{
                            echo '  <nav class="main-header navbar navbar-expand bg-primary">';
                        }
                        include_once "navbar.php";
                        echo        '</nav>';
                    }else{
                        echo ' <nav class="main-header navbar navbar-expand bg-primary">';
                        include_once "navbar.php";
                        echo        '</nav>';
                    }

          //* SIDEBAR
                    if(isset($_GET['route'])){
                        if ($routeType == 0){
                            echo '  <aside class="main-sidebar sidebar-dark-primary back-sidebar">';
                        }else{
                            echo '  <aside class="main-sidebar sidebar-dark-primary front-sidebar">';
                        }
                        include_once "sidebar.php";
                        echo '      </aside>';
                    }else{
                        echo '  <aside class="main-sidebar sidebar-dark-primary front-sidebar">';
                        include_once "sidebar.php";
                        echo '      </aside>';
                    }

          //* MAIN CONTENT
                    echo '      <div class="content-wrapper full-height">';

                    if(isset($_GET["route"]) && $_GET['route'] != "index"){
                            $route = Router::ctrGetRoute($_GET["route"]);
                            include_once $route;
                        }else{
                            include_once "main_content.php";
                        }
                    echo '      </div>';

          //* FOOTER

                echo '      <footer class="main-footer">';
                                include_once "footer.php";
                echo '      </footer>';

            echo    '</div>';
            echo '</body>';

        }else{
            echo '<body class="sidebar-mini layout-navbar-fixed vsc-initialized login-page" cz-shortcut-listen="true" style="height:full">';
            include "/var/www/html/common/users/view/login.php";
        }



    ?>
    <!-- JAVASCRIPT LOADS -->
    <!-- JQuery 3.7.0 -->
    <script type="text/javascript" src="../resources/js/jquery/jquery-3.7.0.min.js"></script>
    <!-- Bootstrap 4.6 -->
    <script type="text/javascript" src="../resources/js/bootstrap/bootstrap.js"></script>
    <!-- AdminLTE 3.0 -->
    <script type="text/javascript" src="../resources/js/adminlte/adminlte.js"></script>
    <!-- SweetAlert 2 -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- PdfMake -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <!-- DataTable -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <!-- Cropper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <!-- Slick - Carousel -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <!-- Charts JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.3/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>  

    <!-- Main JavasCript functions -->
    <script src="../resources/js/main.js"></script>
    <script src="../resources/js/main_functions.js"></script>

  

    


</body>
</html>
