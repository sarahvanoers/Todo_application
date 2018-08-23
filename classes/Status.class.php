<?php
    include_once ("Db.class.php");

    class Status {
        private $id;
        private $user_id;
        private $task_id;
        private $todo_done;
        
        public function getId()
        {
                return $this->id;
        }
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        public function getUser_id()
        {
                return $this->user_id;
        }
        public function setUser_id($user_id)
        {
                $this->user_id = $user_id;

                return $this;
        }
 
        public function getTask_id()
        {
                return $this->task_id;
        }

        public function setTask_id($task_id)
        {
                $this->task_id = $task_id;

                return $this;
        }

        public function getTodo_done()
        {
                return $this->todo_done;
        }
        public function setTodo_done($todo_done)
        {
                $this->todo_done = $todo_done;

                return $this;
        }
         // CRUD CREATE
        public function createStatus($taskid) {
                session_start();
                $conn = Db::GetInstance();
                $userid = $_SESSION['user']['id'];
                $isDone = $this->checkIfDone($userid,$taskid);
                
                if(!$isDone){
                $done = true;
                $statement = $conn->prepare("insert into todoDone(user_id, task_id, todo_done) values(:user_id, :task_id, :todo_done)");
                $statement->bindParam(":user_id", $userid);
                $statement->bindParam(":task_id", $taskid);
                $statement->bindParam(":todo_done", $done);
               
                $result = $statement->execute();
     
                //Als het geslaagd is -> $result = true, anders false
                if($result){
                //het is geslaagd want $result = true
                $obj = [
                    'result'=>$result,
                    'statusid'=>$conn->lastInsertId()
                    //ik geef mee aan mijn object dat de lijst toegevoegd is, en welk id deze heeft
                ];
                }else{
                   $obj = [
                            'result'=>$result,
                            'statusid'=>null
                            //er ging iets mis, er is geen lijst toegevoegd, mijn id bestaat niet
                   ];                          
                }
     
                return $obj;
                //stuur object terug naar ajax/statusCreate.php
                }
     
            }
     
        public function checkIfDone($userid,$taskid){
                $conn = Db::GetInstance();
                $done = true;
                $statement = $conn->prepare("select * from todoDone where user_id = :user_id and task_id = :task_id and todo_done = 1");
                $statement->bindParam(":user_id", $userid);
                $statement->bindParam(":task_id", $taskid);
               
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);
     
                if($result){
                    return true;
                }else{
                    return false;
                }
        }
}
?>
