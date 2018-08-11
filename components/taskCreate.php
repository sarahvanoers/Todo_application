<?php
    include_once("classes/Task.class.php");


    if (!empty($_POST) ) {
        $title = $_POST['title'];
        $working_hours = $_POST['workingHours'];
        $date = $_POST['dateOfTheDeadline'];
        //$user_id =$_POST['user_id'];
        $list_id =$_POST['list_id'];
        //$status =$_POST['status'];
        
        $task = new Task();
        $task->setTitle($title);
        $task->setWorking_hours($working_hours);
        $task->setDate($date);
        //$task->setUser_id($user_id);
        $task->setList_id($list_id);
        //$task->setStatus($status);

        $task->create();
    }
    
?><form method="POST" class="form" id="popUp_task">
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
                    </div>
                    <div class="form-group">
                        <label for="exampleInput">add to personal list</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="list_id">
                           
                           <?php  
                            foreach($result as $key => $r) {
                                echo ' <option value= "' . $r["id"] . ' ">' . $r["title"]  . ' </option>';
                            }
                            ?>
                           
                        </select>
                    </div>
                </div>   
                <div class="modal-footer">
                    <input type="submit" class="btn btn-secondary taskBtn" value="Add Task"></input>
                    <input type="submit"  class="btn btn-secondary" data-dismiss="modal" value="Close"></input>
                </div>
            </div>
        </div>
    </div>
</form>
