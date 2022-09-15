<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Author.php';

$database = new Database();
$db = $database->connect();
$author = new Author($db);
$result = $author->list();
$num = $result->rowCount();

if($num > 0)
{
    $auth_arr = array();
    $auth_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);
        $auth_item = array('id' => $id, 'surname' => $surname, 'name' => $name, 'patronymic' => $patronymic);
        array_push($auth_arr['data'], $auth_item);
    }
    echo json_encode($auth_arr);
}
else
{
    echo json_encode(array('message' => 'Authors not found'));
}
