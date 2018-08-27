<?php
    include_once("classes/User.class.php");

    $error = "";

    if ( !empty($_POST) ) {
        $error = "";
        $email = $_POST['email'];

        if (User::checkUser($email) == true) {

        // als de twee ww overéén komen wordt er een nieuwe user aangemaakt.
        if ($_POST['password'] == $_POST['passwordRepeat'] ) {

            $user = new User();
            $user->setFirstname(htmlspecialchars($_POST['firstname']));
            $user->setLastName(htmlspecialchars($_POST['lastname']));
            $user->setEmail(htmlspecialchars($email));
            $user->setPassword(htmlspecialchars($_POST['password']));

            if (empty ($_POST['firstname']) ) {
                $error = "Give your firstname please.";
            }
            else if (empty ($_POST['lastname']) ) {
                $error = "Give your lastname please.";
            }
            else {
                if($user->register() ) {
                    $user->login();
                } 
                else {
                    $error = "That emailadress is already being used.";
                }
            }
        }      
        }
    }
?><html lang="en">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap core CSS -->
    <!-- <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Form  CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
    <title>Register | ToDo</title>
</head>
<body>
    <div class="backgroundLogin">
    <div id="whiteBg">
    <div class="container">
        <form method="POST" class="form">
            <h2 class="tekstRegister">Hello you,<br> Sign up.</h2>
            
            <div class="form-group">
                <label for="exampleInput"></label>
                <input type="text" class="form-control" id="exampleInput" placeholder="Your first name" name="firstname">

                <label for="exampleInput"></label>
                <input type="text" class="form-control" id="exampleInput" placeholder="Your last name" name="lastname">

                <label for="exampleInputEmail1"></label>
                <input type="email" class="form-control" id="exampleInput" placeholder="Your email" name="email">

                <label for="exampleInputPassword1"></label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Your password" name ="password">

                <label for="exampleInputPasswordConfirmation1"></label>
                <input type="password" class="form-control" id="exampleInputPasswordConfirmation1" placeholder="Repeat password" name ="passwordRepeat">
            </div>
            <div class="form-group error">
                <p>
                   <php echo $error; ?>
                </p>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" id="register" value="Let's get started!"> <br>
                <a class="registerLink" href="index.php">Oh, I already have one!</a>
            </div>
        </form>
    </div>
    </div>
    </div>
</body>
</html>