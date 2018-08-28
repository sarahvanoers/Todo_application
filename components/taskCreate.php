<?php
    include_once("classes/Task.class.php");


    if (!empty($_POST) ) {
        try { 
        if(!empty($_POST['createTask'])){
            $title = $_POST['title'];
            $working_hours = $_POST['working_hours'];
            $date = $_POST['dateOfTheDeadline'];
            //$user_id =$_POST['user_id'];
            $list_id =$_POST['list_id'];
            //$status =$_POST['status'];
            
            $task = new Task();
            $task->setTitle(test_input($title));
            $task->setWorking_hours(test_input($working_hours));
            $task->setDate(test_input($date));
            //$task->setUser_id($user_id);
            $task->setList_id(test_input($list_id));
            //$task->setStatus($status);

            $task->create();
        }
    }
    catch(Exception $e) {
        $error = $e->getMessage();
    }  
    }
    
?><form method="POST" class="form" id="popUp_task">
 <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <input type="hidden" name="createTask" value="true">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">New task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInput">Title</label>
                        <input type="text" class="form-control" id="exampleInput1"  name="title"/>

                        <label for="exampleInput">Working hours</label>
                        <input type="text" class="form-control" id="exampleInput2"  name="working_hours"/>

                        <label for="exampleInput">Date of the deadline</label>
                        <input type="date" class="form-control" id="exampleInput3"  name="dateOfTheDeadline"/>
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
                <?php if(isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
                <?php endif; ?>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-secondary taskBtn" value="Add Task">
                    <input type="submit"  class="btn btn-secondary" data-dismiss="modal" value="Close">
                </div>
            </div>
        </div>
    </div>
</form>
