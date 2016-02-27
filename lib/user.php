<?php
/*
** File: lib/user.php
** Creation: 27/02/2016 17:24 CET
** Authors: David "ReyJamonico" Álvarez.
** Description: Provides API for authentication and user data.
** License: http://www.gnu.org/licenses/gpl-3.0.txt. LICENSE.txt provided as reference.
** Project: "The Game"
** Contact: dave96@dtecno.com
*/

// We need the DB class.
require_once("db.php");

class User {
	private $username, $ulevel, $dbhandle, $logged;
	protected $debug;
	
	public function __construct($db = new DB(), $debug = false) {
		// We can decide when calling the user class if it is in debug mode, and for it to share a DB object with more classes.
		$this->dbhandle = $db;
		$this->debug = $debug;
		$this->logged = false;
	}
	
	private function parseSession() {
		if(!session_start() && $this->debug) error_log("Session_start() error.");
		if(isset($_SESSION['user'])) {
			// We need to do some security checks. Not a perfect solution, but better than nothing.
			if(($_SESSION['REMOTE_ADDR'] != sha1($_SERVER['REMOTE_ADDR'])) || ($_SESSION['HTTP_USER_AGENT'] != sha1($_SERVER['HTTP_USER_AGENT']))) {
				// Session poisoning/exploiting.
				session_destroy();
				$this->logged = false;
				if ($this->debug) error_log("Session Poisoning - ".$_SESSION['user']);
			} else {
				// Legit user.
				$this->logged = true;
				$this->username = $_SESSION['user'];
				// Ask the DB for the level of the game.
				$this->requestLevel();
			}
		}
	}
	
	private function requestLevel() {
	}
	
	public function getLevel() {
		if($this->logged) return $this->ulevel;
		// If user not logged in, error.
		return -1;
	}
	
	public function getName() {
		if($this->logged) return $this->username;
		// If user not logged in, error.
		return -1;
	}
	
	public function register($uname, $password) {
		
	}
	
	public function login($uname, $password) {
	}
}



 ?>
 