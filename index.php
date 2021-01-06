<?php

require 'vendor/autoload.php';

$app = new \Slim\App([
  'settings' => [
    'displayErrorDetails' => true
  ]
]);

$c = $app->getContainer();

$c['view'] = function($c) {
  
  $view = new \Slim\Views\Twig(__DIR__ . '/views', [
    'cashe' => false
  ]);
  
  $view->addExtension(new \Slim\Views\TwigExtension(
    $c->router,
    $c->request->getUri()
  ));

  return $view;
}; 

$app->get('/', function($req, $res) {
  return $this->view->render($res, 'index.twig');
})->setName('index');

$app->get('/data', function($req, $res) {
  return $this->view->render($res, 'data.twig');
})->setName('data');

$app->run();