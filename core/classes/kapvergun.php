<?php 
date_default_timezone_set("Europe/Amsterdam");
class kapvergun{
 
	private $db;

	/**
	 * @param $database
	 */
	public function __construct(PDO $database) {
	    $this->db = $database;
	}

	/**
	 * @param $username
	 * @param $id
	 *
	 * @return string
	 */
	public function checkForKap($username,$id) {
		$query = $this->db->prepare("SELECT COUNT(`id`) FROM `kapvergunning` WHERE `USER` = ? AND `USER_ID`= ?");
		$query->bindValue(1,$username);
		$query->bindValue(2,$id);

		try{
			$query->execute();
			$rows = $query->fetchColumn();

			if($rows>=1){
				$query_2 = $this->db->prepare("SELECT `ID`, `USER`, `CONFIRMED`, `ACCEPTED`, `COMMENT` FROM `kapvergunning` WHERE `USER` = ? AND `USER_ID` = ?");

				$query_2->bindValue(1,$username);
				$query_2->bindValue(2,$id);

				try{
					$query_2->execute();
					$data 			=$query_2->fetchAll();
					return $data;

				}
				catch(PDOException $e){
					return $e->getMessage();
				}
			}
			else{
				return false;
			}
		}

		catch(PDOException $e){
			return $e->getMessage();
		}
	}

	/**
	 * @param $id
	 * @param $username
	 * @param $COMMENT
	 * @param $spoed
	 *
	 * @return bool
	 */
	public function aanvragen($id,$username,$COMMENT,$spoed){
		if($spoed==""){
			$query = $this->db->prepare("INSERT INTO `kapvergunning` (`USER`, `USER_ID`, `COMMENT`) VALUES (?,?,?)");
		}
		else{
			$query = $this->db->prepare("INSERT INTO `kapvergunning` (`USER`, `USER_ID`, `COMMENT`, `SPOED`) VALUES (?,?,?,?)");
		}
		
		$query->bindValue(1,$username);
		$query->bindValue(2,$id);
		$query->bindValue(3,$COMMENT);
		if($spoed!==""){$query->bindValue(4,$spoed);}

		try{
			$query->execute();
			return true;
		}
		catch(PDOException $e){
			return false;
		}
	}
}