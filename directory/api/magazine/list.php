<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Magazine.php';

$database = new Database();
$db = $database->connect();
$magazine = new Magazine($db);
$result = $magazine->list();
$num = $result->rowCount();

if($num > 0)
{
    $mag_arr = array();
    $mag_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);
        $mag_item = array('id' => $id, 'name' => $name, 'description' => $description, 'picture' => $picture, 'authors' => $authors, 'date' => $date);
        array_push($mag_arr['data'], $mag_item);
    }
    echo json_encode($mag_arr);
}
else
{
    echo json_encode(array('message' => 'Magazines not found'));
}
