<?php
    include_once("Db.class.php");

    class Lists {
   
    private $title;
    private $user_id;
    public $results;

 /**
     * Get the value of results
     */ 
    public function getResults()
    {
        return $this->results;
    }

    /**
     * Set the value of results
     *
     * @return  self
     */ 
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

        $statement = $conn->prepare("insert into list(title) values (:title)");
        $statement->bindParam(":title", $this->title);
       // $statement->bindParam(":user_id", $user_id);

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

    public function delete() {
        $conn = Db::GetInstance();
        
        $statement = $conn->prepare("delete from list where id = :id)");
        $statement->bindValue(':id',$this->id());

        $statement->execute();
        $results = $statement->fetchAll();

        return $results;
    }


}
?>