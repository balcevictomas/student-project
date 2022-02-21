<?php
class database
{
   protected function connect()
   {
       $db_host = "localhost";
       $db_user = "root";
       $db_name = "stud_proj";
       try {

         $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, '');
         // set the PDO error mode to exception
         $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         echo "Prisijugimas pavyko ";

       } catch (PDOException $e) {
           echo "Nepavyko prisijungti prie DB " . $e->getMessage();
       }

   }

}

?>
