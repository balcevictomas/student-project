<?php


class deleteClass extends database
{
    public $id;
    /*public function __construct($id)
    {
        $query = "DELETE FROM projects WHERE id={$id}";
        $stmt=$this->connect()->prepare($query);

        $stmt->execute();
    }*/
    public function deleteStudent($project_id, $student_id)
    {
        $query = "DELETE from students WHERE id={$student_id}";
        $stmt=$this->connect()->prepare($query);

        $stmt->execute();
        header("Location: project.php?id={$project_id}");

    }
        public function deleteProject($id)
   {
       $query = "DELETE FROM projects WHERE id={$id}";
       $stmt=$this->connect()->prepare($query);

       $stmt->execute();
   }

}


?>