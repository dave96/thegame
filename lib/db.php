<?php
/*
** File: lib/db.php
** Creation: 27/02/2016 17:24 CET
** Authors: David "ReyJamonico" Álvarez.
** Description: Provides API with DataBase.
** License: http://www.gnu.org/licenses/gpl-3.0.txt. LICENSE.txt provided as reference.
** Project: "The Game"
** Contact: dave96@dtecno.com
*/

/*
** This is a fairly simple class. It enables me to change the DB password, user
** and even application (PostgreSQL to MySQL, etc) without having to change
** the rest of the classes. For this it may seem a little "overkill" and pointless
** to have a class just for that. But this allows for easier future expansion.
*/

class DB {
   private $db = array('user' => 'your_user', 'password' => 'your_password', 'dsn' => 'mysql:dbname=your_db_name;host=your_host');
   private $connected;
   protected $dbhandle;

   public function __construct() {
      $this->connected = false;
   }

   public function connect() {
      if($this->connected) return true;
      try {
         $this->dbhandle = new PDO($this->db['dsn'], $this->db['user'], $this->db['password']);
      } catch (PDOException $e) {
         error_log("Can't connect to Database.");
         return false;
      }
      this->connected = true;
      return true;
   }

   public function getHandle() {
      // If I can't connect, there's nothing to do.
      if(!$this->connected and !$this->connect()) return NULL;
      return $this->dbhandle;
   }
}


 ?>
