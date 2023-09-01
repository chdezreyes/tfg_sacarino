<?php

require_once 'common/Config.php';
require_once 'vendor/autoload.php';

spl_autoload_register(function($classname){

    //CONTROLLERS
    $controllers = ControllerControllers::ctrGetAutoloadControllers();
    // echo '<script>console.log('.json_encode($controllers).')</script>';
    foreach ($controllers as $key => $value) {
        if(file_exists($value['controller_path'].$classname.".php")) {require_once $value['controller_path'].$classname.".php";}
    }

    //MODELS
    $models = ControllerModels::ctrGetAutoloadModels();
    // echo '<script>console.log('.json_encode($models).')</script>';
    foreach ($models as $key => $value) {
        if(file_exists($value['model_path'].$classname.".php")) {require_once $value['model_path'].$classname.".php";}
    }
    
    //AJAX

});

