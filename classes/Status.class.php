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
        public function createStatus() {
            $conn = Db::GetInstance();
            $statement = $conn->prepare("insert into todoDone(user_id, task_id, todo_done) values(:user_id, :task_id, :todo_done)");
            $statement->bindParam(":user_id", $userid);
            $statement->bindParam(":task_id", $taskid);
            $statement->bindParam(":todo_done", $todo_done);
            
            $statement->execute();

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
                //stuur object terug naar ajax/listCreate.php
        }
        
            // CRUD DELETE
        public function delete($id) {
            $conn = Db::GetInstance();
            
            $statement = $conn->prepare("delete from todoDone where id = :id");
            $statement->bindParam(":id", $id);
    
            $result = $statement->execute();
    
            
    
            return $result;
        }
    }
?>