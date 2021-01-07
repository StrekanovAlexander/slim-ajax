<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App([
  'settings' => [
    'displayErrorDetails' => true
  ]
]);

$c = $app->getContainer();

$c['db'] = function() {
  return new PDO('mysql:host=localhost;dbname=simple_db', 'root', 'root');
};

$c['view'] = function($c) {
  
  $view = new \Slim\Views\Twig(__DIR__ . '/../private/views', [
    'cashe' => false
  ]);
  
  $view->addExtension(new \Slim\Views\TwigExtension(
    $c->router,
    $c->request->getUri()
  ));

  return $view;
}; 

require __DIR__ . '/../private/core/routes.php';

$app->run();