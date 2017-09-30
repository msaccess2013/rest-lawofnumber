<?php
session_start();
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');

require 'vendor/autoload.php';
require './config/config.php';
require './config/instance.php';


$app = new Slim\App(["settings" => $config]);
$container = $app->getContainer();
$container['view'] = new \Slim\Views\PhpRenderer('./views');
$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->exec("set names utf8");
    return $pdo;
};


require_once './app/routes.php';

$app->run();