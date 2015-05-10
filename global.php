<?php

defined('ELOC_INDEX') or die();

define('ELOC_GLOBAL', true);


set_include_path(get_include_path() . PATH_SEPARATOR .
                 realpath('./classes/'));

function __autoload($clsClass) {
    require_once str_replace('\\', DIRECTORY_SEPARATOR, $clsClass) . '.php';
}

require_once 'funcs/React.functions.php';
