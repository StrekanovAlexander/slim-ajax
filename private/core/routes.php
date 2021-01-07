<?php

$app->get('/', function($req, $res) {

    $titles = $this->db->query('SELECT * FROM titles ORDER BY id DESC LIMIT 5')->fetchAll(PDO::FETCH_OBJ);

    return $this->view->render($res, 'index.twig', [
        'titles' => $titles,
    ]);

})->setName('index');

$app->post('/ajax', function($req, $res) {
    $start =  $req->getParam('start');
    $titles = $this->db->query("SELECT * FROM titles ORDER BY id DESC LIMIT {$start}, 5")->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($titles);
});
  
$app->get('/data', function($req, $res) {
    return $this->view->render($res, 'data.twig');
})->setName('data');