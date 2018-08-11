<?php
    include_once("classes/Lists.class.php");

    //echo $_SESSION['user_id'];

    if (!empty($_POST) ) {
        $title = $_POST['title'];
        $lists = new Lists();
        $lists->setTitle($title);
       // $task->setUser_id($_SESSION['user_id']);
        $lists->create();

    }
    
?>
<form method="POST" class="form" id="popUp_list">
 <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">New List</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInput">Title</label>
                        <input type="text" class="form-control" id="exampleInput"  name="title">        
                    </div>
                </div>   
                <div class="modal-footer">
                    <input type="submit" class="btn btn-secondary taskBtn" value="Add List"></input>
                    <input type="submit"  class="btn btn-secondary" data-dismiss="modal" value="Close"></input>
                </div>
            </div>
        </div>
    </div>
</form>