<?php
    //config
    require_once 'config/Config.php';

    //helper
    require_once 'helpers/url_helper.php';

    //autoload core libraries

    spl_autoload_register(function($className){
        $className = str_replace('\\', '/', $className);
        require_once 'libraries/' . $className . '.php';
    });