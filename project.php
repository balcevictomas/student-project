<?php
ob_start();
include "header.php";

$myclass = new myClass();
$fetchprojects = $myclass->readProjects();
$num_projects = $fetchprojects->rowCount();
$fetchstudents = $myclass->readStudents();
$num_students = $fetchstudents->rowCount();
$fetchStudentsWithoutGroup = $myclass->fetchStudentWithoutGroup();
$n_s_w_g = $fetchStudentsWithoutGroup->rowCount(); // num students without group
$students = 0;
$left = 0;

foreach ($fetchStudentsWithoutGroup->fetchAll(PDO::FETCH_ASSOC) as $key => $stud) {
    $student_0[$key]['namesurname'] = $stud['namesurname'];
    $student_0[$key]['id'] = $stud['id'];

}

$project = ['id' => '', 'name' => '', 'nog' => '', 'spg' => ''];

if ($num_projects == 1) {
    foreach ($fetchprojects->fetchAll(PDO::FETCH_ASSOC) as $result) {
        $project['id'] = $result['id'];
        $project['name'] = $result['name'];
        $project['nog'] = $result['nog'];
        $project['spg'] = $result['spg'];
    }
    ?>
    <div class="flex-container">
        <div>
            <h2>Status page mockup</h2>
            <div class="break">
                <p>Project: <?= $project['name']; ?></p>
                <br>
                <p>Number of groups: <?= $project['nog']; ?></p>
                <br>
                <p>Students per group: <?= $project['spg']; ?></p>
                <h1>Students</h1>
                <?php if ($num_students > 0) {  // check if there are ant students?>
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
                                    <td><?= $result['namesurname'] ?></td>
                                    <?php if ($result['s_group'] == 0)
                                        echo '<td>-</td>';
                                    else {
                                        echo '<td>' . $result['s_group'] . '</td>';
                                    }
                                    ?>
                                    <td>
                                        <a href="project.php?id=<?=$project['id']?>&delete-stud=<?=$result['id']?>">Delete</a>
                                    </td>


                                </tr>
                                <?php
                            }


                            ?>


                        </table>
                    </div>
                    <a href="add-student.php?project-id=<?= $project['id'] ?>" class="button">Add student</a>
                    <h2>Groups</h2>
                    <div style="display: flex;">

                        <?php for ($i = 1; $i <= $project['nog']; $i++)  // numbers of groups
                        {
                            $fetchStudentsPerGroup = $myclass->fetchStudentsGroup($i);
                            $num_students_group = $fetchStudentsPerGroup->rowCount();
                            ?>
                            <table>
                                <tr>
                                    <th>Group # <?= $i; ?></th>
                                </tr>

                                <?php
                                if ($num_students_group > 0) {   // check if students are in group exists
                                    foreach ($fetchStudentsPerGroup->fetchAll(PDO::FETCH_ASSOC) as $result) {

                                        echo '<tr><td>' . $result['namesurname'] . '</td></tr>';
                                        $students++;


                                    }
                                    $left = $project['spg'] - $students;
                                    for ($j = 1; $j <= $left; $j++) { ?>

                                        <tr>
                                            <td>
                                                <form method="post" action="">
                                                <select>
                                                    <?php
                                                    if ($n_s_w_g > 0): ?>

                                                        <option value="" selected="selected" hidden="hidden">Choose
                                                            here
                                                        </option>

                                                    <?php else: ?>
                                                        <option value="" selected="selected" hidden="hidden">No students
                                                            to add
                                                        </option>
                                                    <?php endif ?>

                                                    <?php
                                                    foreach ($student_0 as $stud_0) {
                                                        echo '<option value="1">' . $stud_0['namesurname'] . '</option>';
                                                    }
                                                    ?>

                                                </select>
                                                    <input type="submit" value="Submit the form"/>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php }
                                    $left = 0;
                                    $students = 0;
                                } else {
                                    for ($k = 1; $k <= $project['spg']; $k++) {
                                        ?>
                                        <tr>
                                            <td>
                                                <form method="post" action="">
                                                <select>
                                                    <?php if ($n_s_w_g > 0): ?>
                                                        <option value="" selected="selected" hidden="hidden">Choose
                                                            here
                                                        </option>

                                                    <?php else: ?>
                                                        <option value="" selected="selected" hidden="hidden">No students
                                                            to add
                                                        </option>
                                                    <?php endif ?>
                                                    </option>
                                                    <?php

                                                    foreach ($student_0 as $stud_0) {
                                                        echo '<option value="1">' . $stud_0['namesurname'] . '</option>';
                                                    }
                                                    ?>
                                                </select>

                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                }

                                ?>

                            </table>
                            <?php
                        }
                        ?>


                    </div>
                    <input type="submit" value="Asign student"/>
                    </form>

                    <?php
                } else {
                    echo "No students are attached to this project";
                    ?>
                    <a href="add-student.php?project-id=<?= $project['id'] ?>" class="button">Add student</a>
                    <?php
                }

                ?>

            </div>

        </div>


    </div>
    <?php
} else {
    echo "No project";
}
if (isset($_GET['delete-stud'])):
$deleteclass = new deleteClass();
$deleteclass -> deleteStudent($project['id'], $_GET['delete-stud']);

endif;

ob_end_flush();
?>
