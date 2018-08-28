<?php
    include_once("classes/User.class.php");
    
    if (!empty($_POST) ) {
        try { 
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = new User();
            $user->setEmail(htmlspecialchars($email));
            $user->setPassword(htmlspecialchars($password));

            if ($user->canILogin() ) {
                $user->login();
            }
            else {
				$error = "<strong>Holy guacamole!</strong> You should check in on some of those fields below.";
			}
        }
        catch(Exception $e) {
            $error = $e->getMessage();
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
    <title>Login | ToDo</title>
</head>
<body>
<div class="backgroundLogin">
    <div id="whiteBgLogin" .shadow-* >
    <div class="container">
    <form method="POST">
    <h1 class="tekstRegister">Hello you, <br> Welcome back! Sign in.</h1>
        <div class="form-group">
            <label for="exampleInputEmail1"></label>
            <input type="email" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" placeholder="Enter email" name="email">
        </div>
            <label for="exampleInputPassword1"></label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
        <div class="form-group">
            <input type="submit" class="btn btn-primary" id="register" value="Let's get started!"><br>
            <a class="loginLink" href="register.php">I'm new here, sign me in!</a>
        </div>
        <?php if(isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
            <?php endif; ?>
            </div>
    </form>
    </div>
    </div>
    </div>
</body>
</html>