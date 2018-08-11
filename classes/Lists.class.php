<?php
    include_once("Db.class.php");

    class Lists {
   
    private $title;
    private $user_id;


    public function getTitle()
    {
            return $this->title;
    }
    public function setTitle($title)
    {
            $this->title = $title;

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

    // save to databank CRUD CREATE

    public function create() {
        $conn = Db::GetInstance();

        $statement = $conn->prepare("insert into list(title) values (:title)");
        $statement->bindParam(":title", $this->title);
       // $statement->bindParam(":user_id", $user_id);

        $statement->execute();

        return $statement;
    }
}
?>