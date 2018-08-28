<?php
header('Content-Type: application/json');
include_once('../classes/Task.class.php');
if (!empty($_POST) ) {
    $id = $_POST['id'];
    $tasks = new Task();
    $result = $tasks->delete($id);
    //als de todo verwijderd is maak ik een object met een juiste code (200), anders toon ik een error
    if($result){
        //GELUKT
        $response = [
            'code' => 200,
            'id' => $id,
            'message' => "task is deleted"
        ];
    }else{
        //NIET VERWIJDERD
        $response = [
            'code' => 500,
            'id' => null,
            'message' => "something went wrong"
        ];
    };
    echo json_encode($response);
} 
?>