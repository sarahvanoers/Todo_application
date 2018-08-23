<?php
    session_start();
    if(empty($_SESSION)){
        header('Location: index.php');
    };
    include_once("classes/User.class.php");
    include_once("classes/Lists.class.php");
    include_once("classes/Task.class.php");
    include_once("classes/Date.class.php");
    include_once("classes/Comment.class.php");

    $tasks_lists = new Lists();
    $result = $tasks_lists->result();

    $task = new Task();
    $resultTask = $task->result();
    //print_r( $resultTask);

    //var_dump($_SESSION['user']['id']);
   
    
    include_once("components/listCreate.php"); 
    include_once("components/taskCreate.php");

 ?><html lang="en">
<head>
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

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
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
    <div class="row">
      
            <div class="col-4 left">
                <h1 class=username>Hi, <?php echo($_SESSION['user']['firstname'].' '.$_SESSION['user']['lastname']);?></h1>
                <h2 class="listOverview">List overview</h2>
                <a class="nav-item nav-link" href="listCreate.php" data-toggle="modal" data-target="#exampleModalCenter2">Add list &plus; </a>
                <!-- ADD LIST -->
                <ul class="list-group list-group-flush list appendList">
               
                <?php foreach($result as $key => $r) {
                  
                   echo '<a>'.'<li class="list-group-item">' . $r["title"] . '<span class="listAlign"><input type="submit" href="listDelete.php" class="deleteList" data-list_id="'.$r["id"].'" value="&times;"></span></li>';
               
                }          
                ?>
                </a>
                </ul>   
            </div>
            
            <div class="col-8 right border-left">
            <?php foreach($resultTask as $key => $r) { ?>
            <div class="comment-wrapper">
            <div class="panel panel-info">
                <ul class="media-list">
                        <li class="media">
                        
                            <div class="media-body">
                            
                            <div class="statusBtn">
                                <button type="submit" class="btn todo_button" href="#" value=""  data-todo_id=" <?php $r["id"] ?>">ToDo</button>
                                <button type="submit" class="btn done_button" href="#" value="" data-done_id=" <?php $r["id"] ?>">Done</button>
                            </div>
                            <strong class="nameUser"><?php echo $r["firstname"] . " " . $r["lastname"] ?></strong>
                            <span class="text-muted pull-right">
                                <?php 
                                    $date = new Date();
                                    $timestring = $date->getTimestring($r['date']);
                                ;?>
                                <small class="text-muted"><?php echo $timestring;?></small>
                                <input type="submit" href="taskDelete.php" class="deleteTask" data-task_id=" <?php $r["id"] ?>" value="&times;">
                            </span>
                            
                            <input type="submit" class="btn btn-outline-primary tagList" value="<?php echo $r["list_title"] ?>">

                            <p class="titleTask"> 
                                
                              <span class="textTask">Title task:</span> <?php echo htmlspecialchars($r["title"]); ?> <br>
                              <span class="textTask">Working hours:</span> <?php echo htmlspecialchars($r["working_hours"]); ?>
                            </p>
                            <div class="setComment">
                            <div class="commentSection">
                                <?php
                                    //deze functie haalt alle comments van een task op, $r['id'] is in dit geval de id van een task
                                    $comment = new Comment();
                                    $comments = $comment->getComments($r['id']);
                                    //in deze foreach worden alle comments uitgelezen, elke comment heeft een tekst, een firstname en een lastname van de user die ze heeft gepost
                                    foreach($comments as $k => $c) {
                                ?>
                                <h6 class="nameUserComment">
                                    <?php echo htmlspecialchars($c["firstname"].' '.$c["lastname"]); ?>
                                </h6>
                               
                                <p class="textComment">
                                    <?php echo htmlspecialchars($c['comment']);?>
                                </p>
                                <?php } ?>
                            </div>
                            <div class="vakComment">
                                <input type="hidden" class="userid" value="<?php echo $_SESSION['user']['id'];?>">
                                <input type="hidden" class="taskid" value="<?php echo $r['id'];?>">
                                <!-- Hier heb ik 2 inputvelden toegevoegd, alleen maar om ze in javascript te kunnen gebruiken -->
                                <input type="hidden" class="firstnameComment" value="<?php echo $_SESSION['user']['firstname'];?>">
                                <input type="hidden" class="lastnameComment" value="<?php echo $_SESSION['user']['lastname'];?>">
                            </div>
                                <textarea class="form-control commentPost" placeholder="write a comment..." rows="1"></textarea>
                                <input type="submit" class="btn btn-secondary postBtn commentBtn" value="Post">
                            </div> <!-- commentSection-->
                            </div> <!--  media-body -->
                            <br>
                        </li>
                        <hr>
                    </ul>
            </div> <!-- panel panel-info -->
        </div> <!-- comment-wrapper -->
        <?php  } ?>
            </div> <!--col-8 right border-left -->
    </div><!-- row -->
</body>

</html>