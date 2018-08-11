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
            $_SESSION['user'] = $this->email;
            
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
  
    }
?>