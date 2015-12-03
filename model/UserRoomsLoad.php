<?php
require_once '../dao/UserRoomsLoadDAO.php';
class UserRoomsLoad
{
	private $email;

    
	public function setEmail($email) {
		$this->email=$email;
	}
    
	public function getEmail() {
		return $this->email;
	}

	public function loadUserRooms($email){
		$this->setEmail($email);
		$LoadRoomsDAO=new UserRoomsLoadDAO();
		$returnLoadRoomsSuccessMessage =$LoadRoomsDAO->loadRooms($this);
		return $returnLoadRoomsSuccessMessage;
	}
}          
?>