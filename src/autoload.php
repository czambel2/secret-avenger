<?php

function autoload($className)
{
    $filename = 'src/' . $className . '.php';

    if(file_exists($filename))
	{
		require_once($filename);
	}
}

spl_autoload_register('autoload');