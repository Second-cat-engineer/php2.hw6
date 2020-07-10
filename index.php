<?php
require __DIR__ . '/App/autoload.php';

use App\Exceptions\DbException;
use App\Exceptions\Error404;
use \App\Components\Logger;

$uri = $_SERVER['REQUEST_URI'];
$parts = explode('/', $uri);

$moduleName = !empty($parts[1]) ? ucfirst($parts[1]) : 'Index';
$controllerName = !empty($parts[2]) ? ucfirst($parts[2]) : null;

if ('Admin' === $moduleName) {
    $action = !empty($parts[3]) ? ucfirst($parts[3]) : null;
    $ctrlName = '\App\Modules\\' . $controllerName . '\Controllers\Admin\\' . $action;
} elseif ('Index' === $moduleName) {
    $ctrlName = '\App\Modules\Index\Controllers\Index';
} else {
    $ctrlName = '\App\Modules\\' . $moduleName . '\Controllers\\' . $controllerName;
    echo $ctrlName;
}

try {
    if (!class_exists($ctrlName)) {
        echo 'there';
        var_dump($ctrlName);
        throw new Error404('Ошибка! Страница не найдена!', 404);
    }
} catch (\Exception $e) {
    $error = new \App\Controllers\Error($e);
    $error();
    die();
}

var_dump($ctrlName);

try {
    $ctrl = new $ctrlName();
    $ctrl();
} catch (DbException | Error404 | \Exception $e) {
    $log = new Logger($e);
    $log->saveLog();

    $error = new \App\Controllers\Error($e);
    $error();
}
