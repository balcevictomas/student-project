<?php
class database
{
  private $db_host = "localhost";
  private $db_user = "root";
  private $db_name = "stud_proj";
  public $conn;


   public function connect()
   {
       $this->conn = null;
       try {

         $this->conn = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, '');
         // set the PDO error mode to exception
         $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       //  echo "Prisijugimas pavyko ";

       } catch (PDOException $e) {
           echo "Nepavyko prisijungti prie DB " . $e->getMessage();
       }
       return $this->conn;
   }

}

?>
