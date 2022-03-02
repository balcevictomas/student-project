<?php


class deleteClass extends database
{
    public $id;
    public function __construct($id)
    {
        $query = "DELETE FROM projects WHERE id={$id}";
        $stmt=$this->connect()->prepare($query);

        $stmt->execute();
    }
}


?>