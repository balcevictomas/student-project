<?php
include "header.php";
$myClass = new myClass();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $readProject = $myClass->readProject($_GET['id']);
    foreach ($readProject->fetchAll(PDO::FETCH_ASSOC) as $result) {
        $project['name'] = $result['name'];

    }
    ?>
    <div class="flex-container">

        <div class="text-center">
            <h2>Are you sure you want to delete <?= $project['name'] ?> project?</h2>
            <form method=POST>
                <input class="button" type="submit" name="delete" value="Delete">
                <input class="button" type="submit" name="back" value="Back to main page">
            </form>
        </div>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {


        if (isset($_POST['delete'])) {

            $delete = new deleteClass();
            $deleteProject=$delete->deleteProject($id);
            header("Location: index.php");

        } else {
            header("Location: index.php");
        }
    }
} else {
    echo "Wrong page";
}


?>