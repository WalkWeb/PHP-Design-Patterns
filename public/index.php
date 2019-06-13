<?php

include_once __DIR__ . '/../vendor/autoload.php';

use Patterns\DIContainer\DIContainer;
use Patterns\DIContainer\Model;

$application = new DIContainer();

try {
    $model = $application->Model;
    var_dump($model instanceof Model); // true
} catch (Exception $e) {
    echo $e->getMessage();
}

