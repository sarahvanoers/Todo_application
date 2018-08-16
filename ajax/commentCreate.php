<?php
    header('Content-Type: application/json');
    include_once('../classes/Comment.class.php');
   
    if (!empty($_POST) ) {
      $userid = $_POST['userid'];
      $taskid = $_POST['taskid'];
      $comment = $_POST['comment'];
      $comments = new Comment();
      //voer functie uit in Comment.class.php (createComment($userid, $taskid, $comment))
      $response = $comments->createComment($userid, $taskid, $comment);
 
 
      //$result = $obj van de create functie
      //HIERONDER MAAK IK EEN ANTWOORD VOOR JQUERY KLAAR
      if($response['result']){
      //GELUKT want $result['result'] = true
        $feedback = [
          'code' => 200,
          'userid' => $userid,
          'taskid' => $taskid,
          'comment' => $comment,
          'message' => "list has been added"
        ];
      }else{
      //NIET VERWIJDERD
        $feedback = [
        'code' => 500,
        'userid' => null,
        'taskid' => null,
        'comment' => null,
        'message' => "something went wrong"
        ];
      };
    echo json_encode($feedback);      
    }
?>