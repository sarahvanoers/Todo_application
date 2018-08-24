<?php
    include_once("Db.class.php");

class Task {
        private $title;
        private $working_hours;
        private $date;
        private $user_id;
        private $list_id;
        public $results;
        
        public function getTitle()
        {
                return $this->title;
        }
        public function setTitle($title)
        {
                $this->title = $title;

                return $this;
        }

        public function getWorking_hours()
        {
                return $this->working_hours;
        }
        public function setWorking_hours($working_hours)
        {
                $this->working_hours = $working_hours;

                return $this;
        }

        public function getDate()
        {
                return $this->date;
        }
        public function setDate($date)
        {
                $this->date = $date;

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

        public function getList_id()
        {
                return $this->list_id;
        }
        public function setList_id($list_id)
        {
                $this->list_id = $list_id;

                return $this;
        }
        // CRUD CREATE
        public function create() {
            $conn = Db::GetInstance();
            // this --> omdat ik eerst setters gebruikt heb ga ik nu de instantie ophalen (get)
            $statement = $conn->prepare("insert into task(title, working_hours, date, list_id, user_id) values (:title, :working_hours, :date, :list_id, :user_id)");
            $statement->bindParam(":title", $this->title);
            $statement->bindParam(":working_hours", $this->working_hours);
            $statement->bindParam(":date", $this->date);
            $statement->bindParam(":user_id", $_SESSION['user']['id']);
            $statement->bindParam(":list_id", $this->list_id);
            //$statement->bindParam(":status", $this->status);
            $statement->execute();

            return $statement;
        }
        public function result(){
                $conn = Db::GetInstance();
                //deze query haalt tegelijk alle taken op samen met hun lijst en de gebruiker die ze heeft gemaakt
                $statement = $conn->prepare("select task.*, users.firstname, users.lastname, list.title as list_title from task inner join list on task.list_id = list.id inner join users on task.user_id = users.id order by task.date");
                $statement->execute();
                $results = $statement->fetchAll();
        
                return $results;
        }
        
        // delete to databank CRUD 

        public function delete($id) {
                $conn = Db::GetInstance();
        
                $statement = $conn->prepare("delete from task where id = :id");
                $statement->bindParam(":id", $id);

                $result = $statement->execute();

        

                return $result;
        }
    // update task CRUD
        public function update(){

                $conn = db::getInstance();
                $statement = $conn->prepare("update task set title = :title, working_hours = :working_hours , date = :date, list_id = :list_id WHERE  user_id = :user_id");
                $statement->bindParam(':title', $this->title);
                $statement->bindParam(':working_hours', $this->working_hours);
                $statement->bindParam(':date', $this->date);
                $statement->bindParam(":user_id", $_SESSION['user']['id']);
                $statement->bindParam(":list_id", $this->list_id);
                $result = $statement->execute();
        
        
                return $result;
        }
}
?> 