<?php
    include_once("Db.class.php");

    class Lists {
   
    private $id;
    private $title;
    private $user_id;
    public $results;
 
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getResults()
    {
        return $this->results;
    }
    public function setResults($results)
    {
        $this->results = $results;

        return $this;
    }
    
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

        $statement = $conn->prepare("insert into list(title, user_id) values (:title, :user_id)");
        $statement->bindParam(":title", $this->title);
        $statement->bindParam(":user_id", $_SESSION['user']['id']);

        $statement->execute();

        return $statement;
    }
    public function result(){
        $conn = Db::GetInstance();
        $statement = $conn->prepare("select * from list");
        $statement->execute();
        $results = $statement->fetchAll();

        return $results;
    }

    // delete to databank CRUD CREATE

    public function delete($id) {
        $conn = Db::GetInstance();
        
        $statement = $conn->prepare("delete from list where id = :id");
        $statement->bindParam(":id", $id);

        $result = $statement->execute();
        return $result;
    }
}
?>