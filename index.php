<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Form  CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

    <title>Login form | To Do</title>
</head>
<body>
<div class="backgroundLogin">
    <div id="whiteBgLogin" .shadow-* >
    <div class="container">
    <form method="POST">
    <h1 class="tekstRegister">Hello you, <br> Welcome back! Sign in.</h1>
        <div class="form-group">
            <label for="exampleInputEmail1"></label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
        </div>
            <label for="exampleInputPassword1"></label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
        <?php if( isset($error) ): ?>
            <div class="form-group">
                <p>
                    Sorry, we can't log you in with that email address and password. Can you try again?
                </p>
            </div>
        <?php endif;?>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" id="register" value="Let's get started!"><br>
            <a class="loginLink" href="register.php">I'm new here, sign me in!</a>
        </div>
    </form>
    </div>
    </div>
    </div>
</body>
</html>