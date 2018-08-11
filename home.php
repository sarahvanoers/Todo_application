
<?php
    //session_start();

 ?>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    
    <title>Home | ToDo</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="brand" id="navLogo" href="home.php">Todo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon">
    <i class="fa fa-navicon"></i>
</span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav navbar-right">
                <a class="nav-item nav-link" href="taskCreate.php" data-toggle="modal" data-target="#exampleModalCenter">Add Task</a>
                <a class="nav-item nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>
    <?php 
    include_once("classes/Lists.class.php");

    // include_once("components/listCreate.php"); 
    // include_once("components/taskCreate.php");
   
   $tasks_lists = new Lists();
   $tasks_lists->result();
   print_r($tasks_lists); 
    ?>
    <div class="row">
      
            <div class="col-4 left">
                <h1 class=username>Hi, Sarah Van Oers</h1>
                <h2>List overview</h2>
                <a class="nav-item nav-link" href="listCreate.php" data-toggle="modal" data-target="#exampleModalCenter2">Add list &plus; </a>
                
                <ul class="list-group list-group-flush list">
                    <li class="list-group-item">Php <span class="listAlign"><input type="submit" class="deleteList" value="&times;"></span></li>
                    <li class="list-group-item">Productlab <span class="listAlign"><input type="submit" class="deleteList" value="&times;"></span></li>
                    <li class="list-group-item">Interaction Design <span class="listAlign"><input type="submit" class="deleteList" value="&times;"></span></li> 
                </ul>   
            </div>
            <div class="col-8 right border-left">
            <div class="comment-wrapper">
            <div class="panel panel-info">
                <ul class="media-list">
                        <li class="media">
                            <div class="media-body">
                            <strong class="nameUser">Sarah Van Oers</strong>
                            <span class="text-muted pull-right">
                                <small class="text-muted">3 days left</small>
                            </span>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                    Lorem ipsum dolor sit amet.
                                </p>
                                <input type="submit"class="btn btn-outline-primary tagList" value="List"></input>
                            </div>
                            </div>
                            <textarea class="form-control commentPost" placeholder="write a comment..." rows="3"></textarea>
                            <br>
                            <input type="submit" class="btn btn-secondary postBtn" value="Post"></input>
                        </li>
                        <hr>
                    </ul>
                </div>
            </div>
        </div>
            </div>
    </div>
</body>

</html>