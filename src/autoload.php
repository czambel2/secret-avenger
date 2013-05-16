<?php

function autoload($className)
{
    $directories = array('src/', 'src/entity/');

    foreach($directories as $directory)
    {
        $filename = $directory . $className . '.php';

        if(file_exists($filename))
        {
            require_once($filename);
        }
    }
}

spl_autoload_register('autoload');