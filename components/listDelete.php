<?php
include_once("../classes/Lists.class.php");
if (!empty($_POST) ) {
    $id = $_POST['id'];
    $lists = new Lists();
    $lists->setId($id);
    $lists->delete();
} 
?>