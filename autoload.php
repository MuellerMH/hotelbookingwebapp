<?php
// dummy at the moment
spl_autoload_register(function ($name) {
    $ClassParams = explode('\\',$name);
    $ClassName = array_pop($ClassParams);
    $ClassPath =  __DIR__ .'/'. implode(DIRECTORY_SEPARATOR,$ClassParams);
    //echo $ClassName ."\n";
    //echo $ClassPath ."\n";
    if ( file_exists($ClassPath  . '/' . ucfirst($ClassName).'.class.php')) {
        require  $ClassPath  . '/' . ucfirst($ClassName).'.class.php';
        //echo '.class.php'. " ...done\n";
    } else if ( file_exists($ClassPath  . '/' . ucfirst($ClassName).'.abstract.php' )) {
        require  $ClassPath  . '/' . ucfirst($ClassName). '.abstract.php';
        //echo  '.interface.php' . " ...done\n";
    } else if (file_exists($ClassPath  . '/' . ucfirst($ClassName).'.interface.php')) {
        require  $ClassPath  . '/' . ucfirst($ClassName). '.interface.php';
        //echo '.abstract.php'. " ...done\n";
    } else {
        //echo " ...failed\n";
    }
});
?>