<?php

$app->get('/phpinfo', function($req, $res){
    echo phpinfo();
});

$app->get('/hello', 'App\Managers\Page:index');
$app->get('/numbers', 'App\Managers\Page:numbers');


$app->get('/pairs/{phoneNumber}', 'App\Managers\TelephoneController:mainTelephone');
