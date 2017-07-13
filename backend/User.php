<?php 
/**
 * defind class to execute task.
 */
class User extends Config{
	private $username;
	private $password;
	
	public function __construct(){
		Config::connect();
	}

	public function setUsername($username){
		$this->username = $username;
	}

	public function setPassword($password){
		$this->password = $password;
	}

	public function check_login(){
		$sql = "SELECT * FROM users WHERE username = '".$this->username."' AND password = '".$this->password."'";
		$result = mysqli_query($this->__connect, $sql);
		if (mysqli_num_rows($result) > 0) {
			return true;
		}
		return false;
	}

}
?>