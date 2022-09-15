<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Magazine.php';

$database = new Database();
$db = $database->connect();
$magazine = new Magazine($db);

$data = json_decode(file_get_contents("php://input"));
$magazine->id = $data->id;
$magazine->name = $data->name;
$magazine->description = $data->description;
$magazine->picture = $data->picture;
$magazine->authors = $data->authors;
$magazine->date = $data->date;

if($magazine->update())
{
    echo json_encode(array('message' => 'Magazine updated'));
}
else
{
    echo json_encode(array('message' => 'Magazine not updated'));
}
