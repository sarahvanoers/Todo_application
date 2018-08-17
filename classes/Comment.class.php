<?php 
    include_once ("Db.class.php");

    class Comment {
        private $id;
        private $user_id;
        private $task_id;
        private $comment;

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

        public function getComment()
        {
                return $this->comment;
        }
        public function setComment($comment)
        {
                $this->comment = $comment;

                return $this;
        }
        /* CRUD CREATE */
        public function createComment($userid, $taskid, $comment) {
            $conn = Db::getInstance();
            
            $statement = $conn->prepare("insert into comment(user_id, task_id, comment) values (:user_id, :task_id, :comment)");
            $statement->bindParam(":user_id", $userid);
            $statement->bindParam(":task_id", $taskid);
            $statement->bindParam(":comment", $comment);
            
            $result = $statement->execute();

         //Als het geslaagd is -> $result = true, anders false
        if($result){
        //het is geslaagd want $result = true
            $obj = [
                'result'=>$result,
                'commentid'=>$conn->lastInsertId()
                //ik geef mee aan mijn object dat de message toegevoegd is, en welk id deze heeft
            ];
            }else{
                $obj = [
                    'result'=>$result,
                    'commentid'=>null
                    //er ging iets mis, er is geen message toegevoegd, mijn id bestaat niet
                ];                           
            }
    
        return $obj;
        }
        public function getComments($id)
        {
            $conn = Db::getInstance();
            // hier koppel ik de comment, de user en de taak aan elkaar
            $statement = $conn->prepare("select comment.comment, users.firstname, users.lastname from comment inner join users on comment.user_id = users.id inner join task on comment.task_id = task.id where task.id = :id order by comment.id DESC");
            $statement->bindParam(":id", $id);
           
            $statement->execute();
           
            $comments = $statement->fetchAll();
           
            return $comments;
        }
    }
?>