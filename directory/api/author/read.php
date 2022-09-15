<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Author.php';

$database = new Database();
$db = $database->connect();
$author = new Author($db);
$author->id = isset($_GET['id']) ? $_GET['id'] : die();
$author->read();

$author_arr = array(
    'id' => $author->id,
    'surname' => $author->surname,
    'name' => $author->name,
    'patronymic' => $author->patronymic
);

print_r(json_encode($author_arr));
