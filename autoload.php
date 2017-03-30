<?php
// dummy at the moment
spl_autoload_register(function ($name) {
    echo "Try to load $name : ";
    if ( file_exists(str_replace('\\','/',$name).'.class.php')) {
        require str_replace('\\', '/', $name) . '.class.php';
        echo "... done\n";
    } else if ( file_exists(str_replace('\\','/',$name).'.interface.php') ) {
        require str_replace('\\', '/', $name) . '.interface.php';
        echo "... done\n";
    } else if (file_exists(str_replace('\\','/',$name).'.abstract.php')) {
        require str_replace('\\', '/', strtolower($name)) . '.abstract.php';
        echo "... done\n";
    } else {
        echo "Can not load $name\n";
    }
});

 ?>