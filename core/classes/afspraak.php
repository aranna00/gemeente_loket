<?php
date_default_timezone_set("Europe/Amsterdam");
class afspraak{
 
	private $db;

	/**
	 * @param \PDO $database
	 */
	public function __construct(PDO $database) {
	    $this->db = $database;
	}

	/**
	 * @param $username
	 * @param $id
	 * @param $role
	 *
	 * @return array|bool|string
	 */
	public function checkAfspraak($username,$id, $role){
		if($role==="user") {
			$query = $this->db->prepare("SELECT COUNT(`id`) FROM `afspraken` WHERE `USER`=? AND `USER_ID`=?");
			$query->bindValue(1, $username);
			$query->bindValue(2, $id);

			try {
				$query->execute();
				$rows = $query->fetchColumn();

				if ($rows >= 1) {
					$query_2 = $this->db->prepare("SELECT `ID`, `USER`, `REDEN`, `DATUM` FROM `afspraken` WHERE `USER`=? AND `USER_ID`=?");
					$query_2->bindValue(1, $username);
					$query_2->bindValue(2, $id);

					try {
						$query_2->execute();
						$data = $query_2->fetchAll();

						return $data;
					}
					catch (PDOException $e) {
						return $e->getMessage();
					}
				} else {
					return false;
				}
			}
			catch (PDOException $e) {
				return $e->getMessage();
			}
		}
		elseif($role ==="admin"){
			$query = $this->db->prepare('SELECT `ID`, `USER`, `REDEN`, `DATUM` FROM `afspraken`');
			try{
				$query->execute();
				return $data = $query->fetchAll();
			}
			catch(PDOException $e)
			{
				return $e;
			}
		}
		else{
			return false;
		}
	}

	/**
	 * @param $id
	 * @param $username
	 * @param $reden
	 *
	 * @return bool
	 */
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
		}
	}
}