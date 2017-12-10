<?php
function __autoload($class_name){
    $directories = [
        '/classes/',
        '/models/',
        '/components/'
    ];
    foreach ($directories as $dir){
        $file = ROOT . $dir . $class_name . '.php';
        if (is_file($file)){
            include_once $file;
        }
    }

}
?>