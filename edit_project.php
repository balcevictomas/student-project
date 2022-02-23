<?php
include "header.php";

$myclass = new myClass();
$fetchprojects = $myclass->readProjects();
$num_projects = $fetchprojects->rowCount();
$fetchstudents = $myclass->readStudents();
$num_students = $fetchstudents->rowCount();
$project = ['name' => '', 'nog' => '', 'spg' => ''];
if ($num_projects == 1) {
    foreach ($fetchprojects->fetchAll(PDO::FETCH_ASSOC) as $result) {
        $project['name'] = $result['name'];
        $project['nog'] = $result['nog'];
        $project['spg'] = $result['spg'];
    }
    ?>
    <div class="flex-container">
        <div>
            <h2>Status page mockup</h2>
            <div class="break">
                <p>Project: <?php echo $project['name']; ?></p>
                <br>
                <p>Number of groups: <?php echo $project['nog']; ?></p>
                <br>
                <p>Students per group: <?php echo $project['spg']; ?></p>
                <h1>Students</h1>
                <?php if ($num_students > 0) { ?>
                    <div class="students">
                        <table>
                            <tr>
                                <th>Student</th>
                                <th>Group</th>
                                <th>Actions</th>
                            </tr>
                            <?php
                            foreach ($fetchstudents->fetchAll(PDO::FETCH_ASSOC) as $result) {
                                ?>
                                <tr>
                                    <td><?php echo $result['name-and-surname'] ?></td>
                                    <td><?php echo $result['s_group'] ?></td>
                                    <td><a href="#">Delete</a></td>


                                </tr>
                                <?php
                            }
                            ?>


                        </table>
                    </div>
                    <h2>Groups</h2>
                    <div style="display: flex;">

                        <?php for($i=1; $i<=$project['nog']; $i++)
                        {
                            ?>
                            <table>
                                <tr><td>Group # <?php echo $i; ?></td></tr>
                                <tr>
                                    <td>as</td>
                                </tr>

                            </table>
                        <?php
                        }
                            ?>



                    </div>


                    <?php
                }
                else
                    {
                        echo "No students are attached to this project";
                    }

                ?>

            </div>
        </div>


    </div>
    <?php
} else {
    echo "No project";
}
?>

