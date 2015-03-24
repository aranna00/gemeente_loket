<?php 
date_default_timezone_set("Europe/Amsterdam");
class Users{
 
	private $db;
 
	public function __construct($database) {
	    $this->db = $database;
	}
 




	public function user_exists($username){
		$query= $this->db->prepare("SELECT COUNT(`id`) FROM `users` WHERE `username`=?");
		$query->bindValue(1,$username);

		try{
			$query->execute();
			$rows=$query->fetchColumn();

			if($rows == 1){
				return true;
			}
			else{
				return false;
			}
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
	}




	public function email_exists($email){
		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `users` WHERE `email`=?");
		$query->bindValue(1,$email);

		try{
			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1){
				return true;
			}
			else{
				return false;
			}
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
	}



	public function register($username, $password, $email){
		$time		= time();
		$ip			= $_SERVER["REMOTE_ADDR"];
		$email_code	= sha1($username + microtime());
		$password	= hash(sha512 , $password.$email_code.$time, false);

		$query = $this->db->prepare("INSERT INTO `users` (`username`, `password`, `email`, `email_code`, `time`, `ip`, `role`, `confirmed`) VALUES (?,?,?,?,?,?,?,?)");

		$query->bindValue(1,$username);
		$query->bindValue(2,$password);
		$query->bindValue(3,$email);
		$query->bindValue(4,$email_code);
		$query->bindValue(5,$time);
		$query->bindValue(6,$ip);
		$query->bindValue(7,"user");
		$query->bindValue(8,1);

		try{
			$query->execute();

			mail($email, 'Please activate your account', "Hello " . $username. ",\r\nThank you for registering with us. Please visit the link below so we can activate your account:\r\n\r\nlocalhost:8080/activate.php?email=" . $email . "&email_code=" . $email_code . "\r\n\r\n-- Example team");
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
	}




	public function activate($email, $email_code){
		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `users` WHERE `email` = ? AND `email_code` = ? AND `confirmed` = ?");
		$query->bindValue(1, $email);
		$query->bindValue(2, $email_code);
		$query->bindValue(3, 0);
		
		try{
			$query->execute();
			$rows = $query->fetchColumn();

			if($rows == 1){
				$query_2 = $this->db->prepare("UPDATE `users` SET `confirmed` = ? WHERE `email` = ? ");

				$query_2->bindValue(1, 1);
				$query_2->bindValue(2, $email);

				$query_2->execute();
				return true;
			}
			else{
				return false;
			}
		}
		catch(PDOException $E){
			die($e->getMessage());
		}
	}




	public function login($username, $password){
		$query = $this->db->prepare("SELECT `password`, `id`, `email_code`, time FROM `users` WHERE `username`= ?");
		$query->bindValue(1, $username);

		try{
			$query->execute();
			$data				= $query->fetch();
			$stored_password	= $data["password"];
			$id					= $data["id"];
			$email_code 		= $data["email_code"];
			$time 				= $data["time"];

			if($stored_password === hash("sha512" , $password.$email_code.$time,false)){
				return $id;
			}
			else{
				return false;
			}

		}
		catch(PDOException $e){
			die($e->getMessage());
		}
		
	}




	public function email_confirmed($username){
		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `users` WHERE `username`=? AND `confirmed`=?");
		$query->bindValue(1, $username);
		$query->bindValue(2, 1);

		try{
			$query->execute();
			$rows=$query->fetchColumn();

			if($rows == 1){
				return true;
			}
			else{
				return false;
			}
		}
		catch(PDOException $e){
			die($e->getMessage());
		}

	}




	public function userdata($id){
		$query = $this->db->prepare("SELECT * FROM `users` WHERE `id`=?");
		$query->bindValue(1,$id);

		try{
			$query->execute();

			return $query->fetch();
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
	}



	public function get_users(){
		$query = $this->db->prepare("select * FROM `users` ORDER BY `time` DESC");

		try{
			$query->execute();
		}
		catch(PDOException $e){
			die($e->getMessage());
		}

		return $query->fetchAll();
	}




	public function role_check($username,$id){
		$query = $this->db->prepare("SELECT `role` FROM `users` WHERE `username` = '?' AND `id` = ?");
		$query->bindValue(1,$username);
		$query->bindValue(2,$id);

		try{
			$query->execute();
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
		return $query->fetchAll();
	}



	public function getID($username){
		$query = $this->db->prepare("SELECT `id` FROM `users` WHERE `username` = '?'");
		$query->bindValue(1,$username);

		try{
			$query->execute();
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
		return $query->fetchAll();
	}





	function esc_url($url) {

	    if ('' == $url) {
	        return $url;
	    }

	    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
	    
	    $strip = array('%0d', '%0a', '%0D', '%0A');
	    $url = (string) $url;
	    
	    $count = 1;
	    while ($count) {
	        $url = str_replace($strip, '', $url, $count);
	    }
	    
	    $url = str_replace(';//', '://', $url);

	    $url = htmlentities($url);
	    
	    $url = str_replace('&amp;', '&#038;', $url);
	    $url = str_replace("'", '&#039;', $url);

	    if ($url[0] !== '/') {
	        return '';
	    } else {
	        return $url;
	    }
	}
}
?>