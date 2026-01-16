<?php
require_once '../config/config.php';

// Autoloader for Core libraries
spl_autoload_register(function($className){
    if(file_exists('../app/core/' . $className . '.php')){
        require_once '../app/core/' . $className . '.php';
    } else if(file_exists('../app/controllers/' . $className . '.php')){
        require_once '../app/controllers/' . $className . '.php';
    } else if(file_exists('../app/models/' . $className . '.php')){
        require_once '../app/models/' . $className . '.php';
    }
});

// Load Helpers
require_once '../app/helpers/session_helper.php';

// Init Core Library
$init = new App();
