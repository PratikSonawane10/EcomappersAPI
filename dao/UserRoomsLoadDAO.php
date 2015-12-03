<?php

require_once 'BaseDAO.php';
class UserRoomsLoadDAO 
{
	private $con;
    private $msg;
    private $data;
    
    // Attempts to initialize the database connection using the supplied info.
    public function UserRoomsLoadDAO() {
        $baseDAO = new BaseDAO();
        $this->con = $baseDAO->getConnection();
    }
	public function loadRooms($email){
		$sql="SELECT d.user_room_no
				FROM junction_user_device jt
				JOIN user_login u ON u.email = jt.email
				JOIN device_details d ON d.device_serial_no = jt.device_serial_no WHERE u.email='".$email->getemail()."' ";
		try{
			$select= mysqli_query($this->con,$sql);
            $this->data=array();
            while($rowdata=mysqli_fetch_assoc($select)){
                $this->data[]=$rowdata;         
            }
        }
        catch (Exception $e){
            echo'SQL Exception:'.$e->getMessage();
        }
        return $this->data;
    }
}
?>