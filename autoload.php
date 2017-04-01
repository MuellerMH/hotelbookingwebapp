<?php
// dummy at the moment
spl_autoload_register(function ($name) {
    if ( file_exists(str_replace('\\','/',$name).'.class.php')) {
        require str_replace('\\', '/', $name) . '.class.php';
    } else if ( file_exists(str_replace('\\','/',$name).'.interface.php') ) {
        require str_replace('\\', '/', $name) . '.interface.php';
    } else if (file_exists(str_replace('\\','/',$name).'.abstract.php')) {
        require str_replace('\\', '/', strtolower($name)) . '.abstract.php';
    }
});

 ?>