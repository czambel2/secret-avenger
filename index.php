<?php

require_once 'src/autoload.php';

Layout::getInstance();

$page = array_key_exists('page', $_GET) ? $_GET['page'] : 'home';

switch($page)
{
    case 'home':
    case 'superhero':
        require_once('src/page/' . $page . '.php');
        exit;
        break;
    default:
        //404
}