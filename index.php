<?php
require __DIR__ . '/App/autoload.php';

use App\Exceptions\DbException;
use App\Exceptions\Error404;
use \App\Components\Logger;

$uri = $_SERVER['REQUEST_URI'];
$parts = explode('/', $uri);

$module = !empty($parts[1]) ? ucfirst($parts[1]) : 'Index';
$controller = !empty($parts[2]) ? ucfirst($parts[2]) : null;

if ('Admin' === $module) {
    $action = !empty($parts[3]) ? ucfirst($parts[3]) : null;
    $ctrlName = '\App\Controllers\\' . $module . '\\' . $controller . '\\' . $action;
} elseif ('Index' === $module) {
    $ctrlName = '\App\Controllers\Index';
} else {
    $ctrlName = '\App\Controllers\\' . $module . '\\' . $controller;
}

try {
    if (!class_exists($ctrlName)) {
        throw new Error404('Ошибка! Страница не найдена!', 404);
    }
} catch (\Exception $e) {
    $error = new \App\Controllers\Error($e);
    $error();
    die();
}

try {
    $ctrl = new $ctrlName();
    $ctrl();
} catch (DbException | Error404 | \Exception $e) {
    $log = new Logger($e);
    $log->saveLog();

    $error = new \App\Controllers\Error($e);
    $error();
}
