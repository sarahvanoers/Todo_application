<?php
    include_once("classes/User.class.php");

$user = new User();
$allNormalUsers = $user->getNormalUsers();
$getAdmins = $user->getAdmins();
    if(!empty($_POST)){
        if(!empty($_POST['createAdmin'])){
            $user = (int)$_POST['createAdmin'];
            $admin = new User();
            $admin->createAdmin($user);
        }else if(!empty($_POST['deleteAdmin'])){
            $user = (int)$_POST['deleteAdmin'];
            $admin = new User();
            $admin->deleteAdmin($user);
        }

    }
    
    
?><form method="POST" class="form" id="popUp_task">
 <div class="modal fade" id="exampleModalCenter4" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <input type="hidden" name="user" value="true">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">create Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInput">Create admin</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="createAdmin">
                           
                           <?php  
                            foreach($allNormalUsers as $key => $r) {
                                echo ' <option value= "' . $r["id"] . ' ">' . $r["firstname"].' '.$r['lastname']  . ' </option>';
                            }
                            ?>
                           
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInput">Delete admin</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="deleteAdmin">
                           
                           <?php  
                            foreach($getAdmins as $k => $j) {
                                echo ' <option value= "' . $j["id"] . ' ">' . $j["firstname"].' '.$j['lastname']  . ' </option>';
                            }
                            ?>
                           
                        </select>
                    </div>
                </div>   
                <div class="modal-footer">
                    <input type="submit" class="btn btn-secondary" value="Update admin">
                    <input type="submit"  class="btn btn-secondary" data-dismiss="modal" value="Close">
                </div>
            </div>
        </div>
    </div>
</form>
