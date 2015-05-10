<?php

define('ELOC_INDEX', true);

include 'global.php';


$app = new \Slim\Slim();

$apiDir = realpath('./api') . '/';
foreach (scandir($apiDir) as $file) {
    if ('.' == $file) {
        continue;
    }

    if ('..' == $file) {
        continue;
    }

    require_once $apiDir . $file;
}

$app->run();
