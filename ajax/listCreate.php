<?php

    header('Content-Type: application/json');
    include_once('../classes/Lists.class.php');
    if (!empty($_POST) ) {
            $title = $_POST['title'];
            $userid = $_POST['userid'];
            $lists = new Lists();
            //voer functie uit in Lists.class.php (create())
            $response = $lists->create($title,$userid);

            //$result = $obj van de create functie
            //HIERONDER MAAK IK EEN ANTWOORD VOOR JQUERY KLAAR
            if($response['result']){
                //GELUKT want $result['result'] = true
                $response = [
                    'code' => 200,
                    'title' => $title,
                    'listid' => $response['listid'],
                    'message' => "lijst is toegevoegd"
                ];
            }else{
                //NIET VERWIJDERD
                $response = [
                    'code' => 500,
                    'title' => null,
                    'listid' => null,
                    'message' => "something went wrong"
                ];
            };
            echo json_encode($response);
    }
    
?>