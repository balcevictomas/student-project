<?php
include "header.php";
$myclass = new myClass();
if(!isset($_GET['project-id'])):
    echo "Wrong page";
    die();
endif;
$id = $_GET['project-id'];
if(isset($_POST['add-student'])):

    $myclass->addStudent($id);

endif;

?>

<div class="form-group center">
    <form method="post" class="form-container form1">
        <h1>New project</h1>
        <label for="projectName"><b>Name and surname</b></label>
        <input type="text" placeholder="Student`s name and surname" name="studentNameSurname" required>
   <button name="add-student" type="submit" class="btn">Add student</button>

    </form>
</div>
