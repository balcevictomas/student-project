<?php
include "db.php";

  class myClass extends database
{


  public function __construct()
  {

  }
  public function fetchProjects()
  {
    $stmt=$this->connect()->prepare("SELECT * FROM projects");
    $stmt->execute();


    return $stmt;
  }
  public function insertProjects()
  {
    //$stmt=$this->connect()->prepare("")
    if (isset($_POST['submit_reg']))
    {
      if (isset($_POST['projectName']) && isset($_POST['numberGroups']) && isset($_POST['studentsPerGroup']))
      {
        $projectName = $_POST['projectName'];
        $numberGroups = $_POST['numberGroups'];
        $studentsPerGroup = $_POST['studentsPerGroup'];
        $query = "INSERT INTO projects (name, nog, spg) VALUES ('$projectName', '$numberGroups', '$studentsPerGroup')";
        $stmt=$this->connect()->prepare($query);

        $stmt->execute();

        $id = $this->conn->lastInsertId();
        header("Location: edit_project.php?id=".$id);
      }
    }
  }
  public function readProjects()
  {
    if (isset($_GET['id']))
    {
      $id = $_GET['id'];
      //echo $id;
      $query = "SELECT * FROM projects where id = {$id}";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute();
      return $stmt;
    }
    else
    {
      echo "Nepasirinktas projektas";
    }
  }
  public function readStudents()
  {
    if (isset($_GET['id']))
    {
      $id = $_GET['id'];
      $query = "SELECT * FROM students where project={$id}";
      $stmt = $this->connect()->prepare($query);
      $stmt->execute();
      return $stmt;
    }

  }

}

?>
