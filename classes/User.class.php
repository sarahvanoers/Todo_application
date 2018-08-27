<?php
    include_once ("Db.class.php");

    class User{
        private $firstname;
        private $lastname;
        private $email;
        private $password;

        public function getFirstname()
        {
                return $this->firstname;
        }
        public function setFirstname($firstname)
        {
                $this->firstname = $firstname;

                return $this;
        }

        public function getLastname()
        {
                return $this->lastname;
        }
        public function setLastname($lastname)
        {
                $this->lastname = $lastname;

                return $this;
        }

        public function getEmail()
        {
                return $this->email;
        }
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        public function getPassword()
        {
                return $this->password;
        }
        public function setPassword($password)
        {
            if (strlen($password) < 5) {
                throw new Exception ("Password must be at least 5 characters long.");
            }
            else { 
                $this->password = $password;
            }
                return $this;
        }
        // -----------------------------------
        // ------- REGISTER ------------------
        // -----------------------------------
        public function register() {
            $conn = Db::GetInstance();

            $statement = $conn->prepare("insert into users (firstname,lastname,email,password) values (:firstname, :lastname, :email, :password)");
            // --------------------------------------
            // HASHING PASSWORD BCRIPT 
            // --------------------------------------

            $hash = password_hash($this->password, PASSWORD_DEFAULT);
            
            $statement->bindParam(':firstname', $this->firstname);
            $statement->bindParam(':lastname', $this->lastname);
            $statement->bindParam(':email', $this->email);
            $statement->bindParam(":password", $hash);

            $statement->execute();

            return $statement;
        }

        public static function checkUser($email) {
            $conn = Db::GetInstance();
            
            $statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $statement->bindValue(":email", $email);

            $statement->execute();
            
            if($statement->rowCount()>=1) {
                return false;
            }
            else {
                return true;   
            }
            
        }
        // -----------------------------------
        // ------- LOGIN ---------------------
        // -----------------------------------
       
        public function login() {
            session_start();
            $_SESSION['loggedin'] = true;
            $user = $this->getUser($this->email);
            //var_dump($user);
            $_SESSION['user'] = $user;
            
            header('Location: home.php');
        }
        
        public function canILogin() {
            $conn = Db::GetInstance();
            
            $statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $statement->bindParam(':email', $this->email);

            $statement->execute();

            $user = $statement->fetch(PDO::FETCH_ASSOC);

            // --------------------------------------
            // PASSWORD VERIFY
            // --------------------------------------
            $hash = $user['password'];
            $password = $this->getPassword();
            if (password_verify($password, $hash) ) {
                $_SESSION['user_id'] = $user['id'];
                return true;
                }
            else {
                return false;
                }
        }
        public function getUser($email) {
            $conn= Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM users WHERE email=:email");
            $statement->bindParam(':email', $email);
        
            $statement->execute();

            $user = $statement->fetch(PDO::FETCH_ASSOC);

            return $user;
        }

        public function getNormalUsers(){
            $conn= Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM users WHERE isAdmin=0");
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }

        public function createAdmin($id){
            $conn= Db::getInstance();
            $statement = $conn->prepare("UPDATE users set isAdmin = 1 WHERE id = :id");
            $statement->bindParam(':id', $id);
            $statement->execute();
        }
        public function getAdmins() {
            $conn= Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM users WHERE isAdmin=1 and id != :id");
            $statement->bindParam(':id',$_SESSION['user']['id']);
            $statement->execute();
            $result = $statement->fetchAll();
            return $result;
        }

        public function deleteAdmin($id){
            $conn= Db::getInstance();
            $statement = $conn->prepare("UPDATE users set isAdmin = 0 WHERE id = :id");
            $statement->bindParam(':id', $id);
            $statement->execute();
        }


  
    }
    // via databank ervoor gezorgt dat er geen taak meer kan zijn als de user is verwijderd
    // als de lijst is verwijdert gaat de taak ook verwijderd worden
    // lijst --> taak = 1 op meer relatie 
    // https://stackoverflow.com/questions/13105019/how-to-add-on-delete-cascade-and-on-update-restrict-using-phpmyadmin

    // cursus basics php sql injection etc
    // https://www.linkedin.com/learning/php-with-mysql-essential-training-1-the-basics/


    // cursus OOP met database
    // https://www.linkedin.com/learning/php-object-oriented-programming-with-databases/
    // cursus OOP 
    // https://www.linkedin.com/learning/php-object-oriented-programming-2/
?>