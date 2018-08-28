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
        if( empty($title) ){
            throw new Exception("List title cannot be empty.");
        }
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

    public function create($title, $userid) {
        $conn = Db::GetInstance();

        $statement = $conn->prepare("insert into list(title, user_id) values (:title, :user_id)");
        $statement->bindValue(":title", $title);
        $statement->bindValue(":user_id", $userid);

        $result = $statement->execute();
        
        //Als het geslaagd is -> $result = true, anders false
        if($result){
            //het is geslaagd want $result = true
        $obj = [
            'result'=>$result,
            'listid'=>$conn->lastInsertId()
            //ik geef mee aan mijn object dat de lijst toegevoegd is, en welk id deze heeft
        ];
        }else{
            $obj = [
                'result'=>$result,
                'listid'=>null
                //er ging iets mis, er is geen lijst toegevoegd, mijn id bestaat niet
            ];                           
        }

        return $obj;
        //stuur object terug naar ajax/listCreate.php
    }
    public function result(){
        $conn = Db::GetInstance();
        $statement = $conn->prepare("select * from list");
        $statement->execute();
        
        $results = $statement->fetchAll();

        return $results;
    }

    // delete to databank CRUD 

    public function delete($id) {
        $conn = Db::GetInstance();
        
        $statement = $conn->prepare("delete from list where id = :id");
        $statement->bindParam(":id", $id);

        $result = $statement->execute();

        

        return $result;
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
}
?>