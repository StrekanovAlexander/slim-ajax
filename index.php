<?php

require 'vendor/autoload.php';

$app = new \Slim\App();

$app->get('/', function(){
  echo 'page';
});

$app->get('/db', function(){
  echo 'db';
});

$app->run();