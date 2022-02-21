<?php
include "header.php";

?>

<div class="form-group center" >
    <form method="post" class="form-container form1">
        <h1>New project</h1>
        <label for="projectName"><b>Project name</b></label>
        <input type="text" placeholder="Project name" name="projectName" required >
        <label for="text"><b>Number of groups</b></label>
        <input type="text" placeholder="Number of groups" name="numberGropups" required >
        <label for="number"><b>Students per group</b></label>
        <input type="number" placeholder="Students per group" name="studentsPerGroup" required >

        <button name="submit_reg" type="submit" class="btn">Create</button>

    </form>
</div>
