<?php
include "header.php";

$myclass = new myClass();
$fetchprojects = $myclass->readProjects();
$num_projects = $fetchprojects->rowCount();
$fetchstudents = $myclass->readStudents();
$num_students = $fetchstudents->rowCount();
$students = 0;
$left = 0;


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
                                    <?php if ($result['s_group'] == 0)
                                        echo '<td>-</td>';
                                    else
                                    {
                                    echo '<td>'.$result['s_group'].'</td>';
                                    }
                                    ?>


                                    <td><a href="#">Delete</a></td>


                                </tr>
                                <?php
                            }
                            ?>


                        </table>
                    </div>
                    <h2>Groups</h2>
                    <div class="s-table">

                        <?php for ($i = 1; $i <= $project['nog']; $i++) {
                            $fetchStudentsPerGroup = $myclass->fetchStudentsGruop($i);
                            $num_students_group = $fetchStudentsPerGroup->rowCount();
                            ?>
                            <table>
                                <tr class="display-block">
                                    <th>Group # <?php echo $i; ?></th>
                                </tr>


                                <?php

                                if ($num_students_group > 0) {
                                    foreach ($fetchStudentsPerGroup->fetchAll(PDO::FETCH_ASSOC) as $result) {

                                        echo '<tr><td>' . $result['name-and-surname'] . '</td></tr>';
                                        $students++;


                                    }
                                    $left = $project['spg'] - $students;
                                    for ($j = 1; $j <= $left; $j++) {
                                        echo '<tr><td>
                                                <select>
                                                    <option value="" selected="selected" hidden="hidden">Choose here</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                    <option value="4">Four</option>
                                                    <option value="5">Five</option>
                                                </select>
                                            </td> </tr>';
                                    }
                                    $left = 0;
                                    $students = 0;

                                } else {
                                    ?>
                                    <tr>
                                        <td>
                                            <select>
                                                <option value="" selected="selected" hidden="hidden">Choose here
                                                </option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                                <option value="4">Four</option>
                                                <option value="5">Five</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select>
                                                <option value="" selected="selected" hidden="hidden">Choose here
                                                </option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                                <option value="4">Four</option>
                                                <option value="5">Five</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <?php
                                }


                                ?>

                                </tr>

                            </table>
                            <?php
                        }
                        ?>


                    </div>


                    <?php
                } else {
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

