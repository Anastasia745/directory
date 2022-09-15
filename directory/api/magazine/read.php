<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Magazine.php';

$database = new Database();
$db = $database->connect();
$magazine = new Magazine($db);
$magazine->id = isset($_GET['id']) ? $_GET['id'] : die();
$magazine->read();

$magazine_arr = array(
  'id' => $magazine->id,
  'name' => $magazine->name,
  'description' => $magazine->description,
  'picture' => $magazine->picture,
  'authors' => $magazine->authors,
  'date' => $magazine->date
);

print_r(json_encode($magazine_arr));
