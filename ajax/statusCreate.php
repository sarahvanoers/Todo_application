<?php
    header('Content-Type: application/json');
    include_once('../classes/Status.class.php');
    if (!empty($_POST) ) {
            $userid = $_POST['userid'];
            $taskid = $_POST['taskid'];
            $todo_done = $_POST['todo_done'];
            $status = new Status();
            //voer functie uit in Lists.class.php (create())
            $response = $status->createStatus($userid,$taskid,$todo_done);

            //$result = $obj van de create functie
            //HIERONDER MAAK IK EEN ANTWOORD VOOR JQUERY KLAAR
            if($response['result']){
                //GELUKT want $result['result'] = true
                $response = [
                    'code' => 200,
                    'userid' => $userid,
                    'taskid' => $taskid,
                    'todo_done' => $todo_done,
                    'message' => "status has been added"
                ];
            }else{
                //NIET VERWIJDERD
                $response = [
                    'code' => 500,
                    'userid' => null,
                    'taskid' => null,
                    'todo_done' => null,
                    'message' => "something went wrong"
                ];
            };
            echo json_encode($response);
    }
?>