<?php
include "header.php";
$myclass = new myClass();
$fetch = $myclass->fetchProjects();
$num = $fetch->rowCount();

?>
<div class="flex-container">

    <div class="text-center">
        <table class="border">
            <tr>
                <th></th>
                <th>Name</th>
                <th>Number of groups</th>
                <th>Students per group</th>

            </tr>
        <?php

        if ($num > 0)
        {
            echo '<p>Existing projects:</p>';
            $count = 1;
            $row = $fetch->fetchAll(PDO::FETCH_ASSOC);
            foreach ($row as $result)
            {
                ?>
                <tr>
                    <td><?php echo $count.'.'; ?></td>
                    <td><?php echo $result['name']; ?></td>
                    <td><?php echo $result['nog']; ?></td>
                    <td><?php echo $result['spg']; ?></td>
                    <td><a href="project.php?id=<?php echo $result['id']; ?>">Edit</a></td>
                    <td><a href="delete.php?id=<?php echo $result['id']; ?>">Delete</a></td>

                </tr>
            <?php
            $count++;
            }
        }


        ?>
        </table>

    </div>
    <div class="break"></div>
    <div class="text-center">
        <a href="create-project.php" class="button">Create new project</a>
    </div>


</div>
