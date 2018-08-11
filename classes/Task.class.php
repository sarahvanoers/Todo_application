<?php
    include_once("Db.class.php");

    class Task {
        private $title;
        private $working_hours;
        private $date;
        private $user_id;
        private $list_id;
        private $status;
        
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

        public function getStatus()
        {
                return $this->status;
        }
        public function setStatus($status)
        {
                $this->status = $status;

                return $this;
        }
        public function create() {
            $conn = Db::GetInstance();
        
            $statement = $conn->prepare("insert into task(title, working_hours, date) values (:title, :working_hours, :date)");
            $statement->bindParam(":title", $this->title);
            $statement->bindParam(":working_hours", $this->working_hours);
            $statement->bindParam(":date", $this->date);
            //$statement->bindParam(":user_id", $this->user_id);
            //$statement->bindParam(":list_id", $this->list_id);
            //$statement->bindParam(":status", $this->status);
            $statement->execute();

            return $statement;
        }
    }
?> 