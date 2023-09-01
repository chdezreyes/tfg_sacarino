<?php

spl_autoload_register(function($classname){

    //CONTROLLERS
    if(file_exists("common/".$classname.".php"))                        {require_once "common/".$classname.".php";}
    if(file_exists("common/alert/controller/".$classname.".php"))       {require_once "common/alert/controller/".$classname.".php";}
    if(file_exists("common/users/controller/".$classname.".php"))       {require_once "common/users/controller/".$classname.".php";}
    if(file_exists("common/menus/controller/".$classname.".php"))       {require_once "common/menus/controller/".$classname.".php";}
    if(file_exists("common/controllers/controller/".$classname.".php")) {require_once "common/controllers/controller/".$classname.".php";}
    if(file_exists("common/models/controller/".$classname.".php"))      {require_once "common/models/controller/".$classname.".php";}
    
    //MODELS
    if(file_exists("common/alert/model/".$classname.".php"))            {require_once "common/alert/model/".$classname.".php";}
    if(file_exists("common/users/model/".$classname.".php"))            {require_once "common/users/model/".$classname.".php";}
    if(file_exists("common/menus/model/".$classname.".php"))            {require_once "common/menus/model/".$classname.".php";}
    if(file_exists("common/controllers/model/".$classname.".php"))      {require_once "common/controllers/model/".$classname.".php";}
    if(file_exists("common/models/model/".$classname.".php"))           {require_once "common/models/model/".$classname.".php";}

    //AJAX
    if(file_exists("common/menus/ajax/".$classname.".php"))             {require_once "common/menus/ajax/".$classname.".php";}

});