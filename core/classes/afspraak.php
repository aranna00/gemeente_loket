<?php
date_default_timezone_set("Europe/Amsterdam");
class afspraak{
 
	private $db;
 
	public function __construct($database) {
	    $this->db = $database;
	}

	public function checkAfspraak($username,$id){
		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `afspraken` WHERE `USER`=? and `USER_ID`=?");
		$query->bindValue(1,$username);
		$query->bindValue(2,$id);

		try{
			$query->execute();
			$rows = $query->fetchColumn();

			if($rows>=1){
				$query_2 = $this->db->prepare("SELECT `ID`, `USER`, `REDEN`, `DATUM` FROM `afspraken` WHERE `USER`=? AND `USER_ID`=?");
				$query_2->bindValue(1,$username);
				$query_2->bindValue(2,$id);

				try{
					$query_2->execute();
					$data = $query_2->fetchAll();
					return $data;
				}
				catch(PDOException $e){
					return $e->getMessage();
				}
			}
		}
		catch(PDOException $e){
			return $e->getMessage();
		}
	}

	public function aanvragen($id,$username,$reden){

		$query = $this->db->prepare("INSERT INTO `afspraken` (`USER`, `USER_ID`, `REDEN`,DATUM) VALUES (?,?,?,?)");

		$query->bindValue(1,$username);
		$query->bindValue(2,$id);
		$query->bindValue(3,$reden);
		$query->bindValue(4,microtime());

		try{
			$query->execute();
			return true;
		}
		catch(PDOException $e){
			return false;
			die($e->getMessage());
		}
	}
}