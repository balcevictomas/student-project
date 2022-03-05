<?php
include "db.php";

class myClass extends database
{
    public $id;

    public function __construct()
    {

    }

    public function fetchProjects()  // fetches all existing projects
    {
        $stmt = $this->connect()->prepare("SELECT * FROM projects");
        $stmt->execute();


        return $stmt;
    }

    public function insertProjects() // creates new projects
    {
        //$stmt=$this->connect()->prepare("")
        if (isset($_POST['submit_reg'])) {
            if (isset($_POST['projectName']) && isset($_POST['numberGroups']) && isset($_POST['studentsPerGroup'])) {
                $projectName = $_POST['projectName'];
                $numberGroups = $_POST['numberGroups'];
                $studentsPerGroup = $_POST['studentsPerGroup'];
                $query = "INSERT INTO projects (name, nog, spg) VALUES ('$projectName', '$numberGroups', '$studentsPerGroup')";
                $stmt = $this->connect()->prepare($query);

                $stmt->execute();

                $id = $this->conn->lastInsertId();
                header("Location: project.php?id=" . $id);
            }
        }
    }

    public function readProjects() // reads individual project
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //echo $id;
            $query = "SELECT * FROM projects where id = {$id}";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            return $stmt;
        } else {
            echo "Projects wasn`t selected";
        }
    }

   /* public function readProject($id)
    {
        if (isset($_GET['id']) and $id == $_GET['id']) {

            //echo $id;
            $query = "SELECT * FROM projects where id = {$id}";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            return $stmt;
        } else {
            echo "Nepasirinktas projektas";
        }
    }*/

    public function readStudents()  // read all students by project id
    {


        if (isset($_GET['id']) or isset($_GET['project-id'])) {
            if (isset($_GET['id'])):
                $id = $_GET['id'];
            elseif (isset($_GET['project-id'])):
                $id = $_GET['project-id'];
            endif;
            $query = "SELECT * FROM students where project={$id}";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            return $stmt;
        }

    }

    public function fetchStudentsGroup($s_id) // fetch students by project id and their group in project
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = "SELECT * FROM students where project={$id} and s_group={$s_id}";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            return $stmt;
        }

    }

    public function fetchStudentWithoutGroup() // fetch students by project id without group
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = "SELECT * FROM students where project={$id} and s_group=0";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            return $stmt;
        }

    }



    public function getStudentsInProject($id) // later by nog and spg, we will check how much students are allowed to be in the project
    {
        $query = "SELECT nog, spg FROM projects where id={$id}";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function addStudent($id) // add students
    {

        if (isset($_GET['project-id']) and $_GET['project-id'] == $id):
            $checkAllowedStudents = $this->getStudentsInProject($id);
            $studentsAllowed = 0;
            foreach ($checkAllowedStudents->fetchAll(PDO::FETCH_ASSOC) as $studAllowed) {
                $studentsAllowed = intval($studAllowed['nog']) * intval($studAllowed['spg']); // number of groups in project and students per group multication
            }

            $checkStudent = $this->readStudents()->rowCount();

            if ($studentsAllowed > $checkStudent):
                $query = "INSERT INTO students (namesurname, project) VALUES ('{$_POST['studentNameSurname']}', '{$id}')";
                $stmt = $this->connect()->prepare($query);
                $stmt->execute();
            header('Location: project.php?id='.$id.'');
            else:
                echo '<script type="text/javascript">
                        alert("You can`t add new students to this project");
                        </script>';
            endif;
        endif;
    }
    public function editableStudent() // get info about editable student
    {
        if (isset($_GET['id']) AND isset($_GET['edit-stud']))
        {
            $project_id = $_GET['id'];
            $student_id = $_GET['edit-stud'];
            $query = "SELECT * FROM students where project={$project_id} and id = {$student_id}";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            return $stmt;
        }
    }
    public function updateStudent() // update students info
    {
        if (isset($_GET['id']) AND isset($_GET['edit-stud']))
        {
            $project_id = $_GET['id'];
            $student_id = $_GET['edit-stud'];
            $newNameSurname = $_POST['studentNameSurname'];
            $newGroup = $_POST['group'];
            if (empty($newNameSurname) AND empty($newGroup))
            {
                echo '<script type="text/javascript">
                        alert("Field is empty");
                        </script>';
            }
            else
            {
                $query = "UPDATE students SET namesurname='{$newNameSurname}', s_group={$newGroup} where project={$project_id} and id={$student_id}";
                $stmt = $this->connect()->prepare($query);
                $stmt->execute();
                header('Location: project.php?id='.$project_id.'');
            }

        }
    }

}

?>
