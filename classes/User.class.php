<?php
    include_once ('Db.class.php');

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
                $this->password = $password;

                return $this;
        }
        // -----------------------------------
        // ------- REGISTER ------------------
        // -----------------------------------
        public function register() {
            $conn = Db::GetInstance();

            $statement = $conn->prepare("INSERT INTO users(firstname,lastname,email,password) VALUES (:firstname, :lastname, :email, :password)");
            $statement->bindParam(':firstname', $this->firstname);
            $statement->bindParam(':lastname', $this->lastname);
            $statement->bindParam(':email', $this->email);
            $statement->bindParam(':password', $this->password);

            $result = $statement->execute();

            return $result;
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
        // ------- LOGIN ------------------
        // -----------------------------------
        public function login() {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $this->email;
            
            header('Location: home.php');
        }
        public static function canILogin($email, $password) {
            $conn = Db::GetInstance();
            
            $statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $statement->bindParam(':email', $this->email);

            $result = $statement->execute();

            $user = $result->fetch(PDO::FETCH_ASSOC);
            // --------------------------------------
            // PASSWORD VERIFY
            // --------------------------------------
            $hash = $user['password'];
            if (password_verify($password, $hash)) {
                    return true;
                }
                else {
                    return false;
                }
        }
    }
?>