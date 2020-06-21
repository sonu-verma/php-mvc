<?php 
    // If there must be multiple autoload functions, spl_autoload_register() allows for this.
    spl_autoload_register(function($className){
        include "classes/$className.php";
    });

    $route = new route;
?>