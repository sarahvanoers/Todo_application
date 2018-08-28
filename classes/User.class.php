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
            if( empty($firstname) ){
                throw new Exception("Firstname cannot be empty.");
            }
                $this->firstname = $firstname;

                return $this;
        }

        public function getLastname()
        {
                return $this->lastname;
        }
        public function setLastname($lastname)
        {
            if( empty($lastname) ){
                throw new Exception("Lastname cannot be empty.");
            }
                $this->lastname = $lastname;

                return $this;
        }

        public function getEmail()
        {
                return $this->email;
        }
        public function setEmail($email)
        {
            if( empty($email) ){
                throw new Exception("Email cannot be empty.");
            }
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
        //https://www.w3schools.com/php/php_form_validation.asp
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }
  
    }

    /*
    Cross-site scripting (XSS) is een type kwetsbaarheid 
    voor computerbeveiliging die meestal wordt aangetroffen in webtoepassingen. 
    XSS stelt aanvallers in staat client-side script te injecteren 
    in webpagina's die door andere gebruikers worden bekeken.

    function test input vermijd dat er geen kwaadaardige javascript code kan geschreven worden.

    betekent dat gebruikers hun eigen code in de HTML kunnen injecteren. 
    Dat kan ertoe leiden dat er bijvoorbeeld cookies van administrators, 
    die belangrijke informatie bevatten, uitgelezen kunnen worden. 
    Dat is natuurlijk iets wat je wilt voorkomen.

    Dat is erg simpel, je gebruikt gewoon de htmlspecialchars functie van PHP. 
    Deze zet "vreemde" tekens om naar tekens die ongevaarlijk zijn voor de broncode.
    */


    /*
    SQL INJECTION PDO 
    Om de input van de user te beveiligen gebruiken we PDO
    Zo kunnen ze u databank niet hacken

    Zodra u input begint te verwerken van gebruikers is enige voorzichtigheid op zijn plaats.
    Een groot gevaar bij het rechtstreeks verwerken van gebruikersdata is SQL injectie4.

    SELECT * FROM tblUsers WHERE login = 'Jansen' AND paswoord = 'test' OR 'a' = 'a';
    “a”=”a” is altijd waar en we zouden deze gebruiker zomaar toegang verschaffen 
    tot onze applictie, zonder dat de gebruiker hiervoor 
    een geldige login en wachtwoord combinatie heeft. --> onbeveiligde query met PDO niet mogelijk

    stel dat een gebruiker geen toegang wenst te verschaffen tot uw applicatie, 
    maar dat hij of zij uw ganse applicatie wil plat leggen. 
    Dan zou een slimme hacker commando’s als “drop database xxx” kunnen toevoegen aan uw queries.
    
    Als u gebruik maakt van PDO of prepared statements 
    dan dient u zich geen zorgen te maken over SQL Injection. 
    PDO zorgt er bovendien voor dat we onze applicatie kunnen schrijven, 
    onafhankelijk van het onderliggende databank systeem.

    waardoor het mogelijk wordt om met één en dezelfde schrijfwijze 
    meer dan 10 verschillende databanksoorten aan te spreken. 
    Onder meer MS SQL Server, PostgreSQL, Oracle en SQLite worden naast MySQL ondersteund.

    */


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