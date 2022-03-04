<?php
include "db.php";

class myClass extends database
{
    public $id;

    public function __construct()
    {

    }

    public function fetchProjects()
    {
        $stmt = $this->connect()->prepare("SELECT * FROM projects");
        $stmt->execute();


        return $stmt;
    }

    public function insertProjects()
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

    public function readProjects()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //echo $id;
            $query = "SELECT * FROM projects where id = {$id}";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            return $stmt;
        } else {
            echo "Nepasirinktas projektas";
        }
    }

    public function readProject($id)
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
    }

    public function readStudents()
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

    public function fetchStudentsGroup($s_id)
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = "SELECT * FROM students where project={$id} and s_group={$s_id}";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            return $stmt;
        }

    }

    public function fetchStudentWithoutGroup()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = "SELECT * FROM students where project={$id} and s_group=0";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            return $stmt;
        }

    }

    public function fetchStudentWithoutGroup1()
    {
        if (isset($_GET['id']) or isset($_GET['project-id'])) {
            $id = $_GET['id'];
            $query = "SELECT * FROM students where project={$id} and s_group=0";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute();
            return $stmt;
        }

    }

    public function getStudentsInProject($id)
    {
        $query = "SELECT nog, spg FROM projects where id={$id}";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function addStudent($id)
    {

        if (isset($_GET['project-id']) and $_GET['project-id'] == $id):
            $checkAllowedStudents = $this->getStudentsInProject($id);
            $studentsAllowed = 0;
            foreach ($checkAllowedStudents->fetchAll(PDO::FETCH_ASSOC) as $studAllowed) {
                $studentsAllowed = intval($studAllowed['nog']) * intval($studAllowed['spg']);
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

}

?>
