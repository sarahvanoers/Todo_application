<?php
    include_once("classes/Task.class.php");

    if(!empty($_POST)){
        if(!empty($_POST['updateTask'])){
            $taskId = $_POST['taskId'];
            $changeTitle = $_POST['change_title'];
            $change_working_hours = $_POST['change_working_hours'];
            $change_date = $_POST['change_dateOfTheDeadline'];
            $list_id =$_POST['list_id'];
           
    
           
                $task = new Task();
                $task->setTitle($changeTitle);
                $task->setWorking_hours($change_working_hours);
                $task->setDate($change_date);
                $task->setList_id($list_id);
                
                $task = $task->update($taskId);

        }
    }
    
    
?><form method="POST" class="form" id="popUp_task">
 <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <input type="hidden" name="updateTask" value="true">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" class="taskId" name="taskId" value=""/>
                        <label for="exampleInput">Change title</label>
                        <input type="text" class="form-control" id="exampleInput1"  name="change_title"/>
                        
                        <label for="exampleInput">Change working hours</label>
                        <input type="text" class="form-control" id="exampleInput2"  name="change_working_hours"/>

                        <label for="exampleInput">Change date of the deadline</label>
                        <input type="date" class="form-control" id="exampleInput3"  name="change_dateOfTheDeadline"/>
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
                    <input type="submit" class="btn btn-secondary taskBtn" value="Change Task">
                    <input type="submit"  class="btn btn-secondary" data-dismiss="modal" value="Close">
                </div>
            </div>
        </div>
    </div>
</form>
