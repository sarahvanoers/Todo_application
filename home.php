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
                <a class="nav-item nav-link" href="task.php" data-toggle="modal" data-target="#exampleModalCenter">Add Task</a>
                <a class="nav-item nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <!-- POPUP ADD TASK -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">New task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInput">Title</label>
                        <input type="text" class="form-control" id="exampleInput"  name="title">

                        <label for="exampleInput">Working hours</label>
                        <input type="text" class="form-control" id="exampleInput"  name="workingHours">

                        <label for="exampleInput">Date of the deadline</label>
                        <input type="date" class="form-control" id="exampleInput"  name="dateOfTheDeadline">

                        <label for="exampleInput">add to personal list</label>
                       
                    </div>
                </div>   
                <div class="modal-footer">
                    <input type="submit" class="btn btn-secondary taskBtn" value="Add Task"></input>
                    <input type="submit"  class="btn btn-secondary" data-dismiss="modal" value="Close"></input>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
      
            <div class="col-4 left">
                <h1 class=username>Hi, Sarah Van Oers</h1>
                <input type="submit" class="btn btn-secondary ListBtn" value="Add List"></input>
                <ul class="list-group list-group-flush list">
                    <li class="list-group-item">Php <span class="listAlign"><input type="submit" class="deleteList" value="&times;"></span></li>
                    <li class="list-group-item">Productlab <span class="listAlign"><input type="submit" class="deleteList" value="&times;"></span></li>
                    <li class="list-group-item">Interaction Design <span class="listAlign"><input type="submit" class="deleteList" value="&times;"></span></li> 
                </ul>
                
                
            </div>
            <div class="col-8 right border-left">
                
                </div>
        </div>



</body>

</html>