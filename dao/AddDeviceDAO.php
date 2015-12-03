<?php

require_once 'BaseDAO.php';
class AddDeviceDAO
{
    
    private $con;
    private $msg;
    private $data;
    
    // Attempts to initialize the database connection using the supplied info.
    public function AddDeviceDAO() {
        $baseDAO = new BaseDAO();
        $this->con = $baseDAO->getConnection();
    }
    
    public function insertDetails($DeviceDetails) {
        try {
                $sql1 = "INSERT INTO device_details(device_serial_no,user_room_no)
                        VALUES ('".$DeviceDetails->getSerialno()."', '".$DeviceDetails->getRoomno()."')";
        
                $isInserted = mysqli_query($this->con, $sql1);
                if ($isInserted) {
                    $sql2 = "INSERT INTO junction_user_device(device_serial_no,email)
                        VALUES ('".$DeviceDetails->getSerialno()."', '".$DeviceDetails->getEmail()."')";
						 $isInserted2 = mysqli_query($this->con, $sql2);
						 if ($isInserted2) {
							$this->data = "DETAILS_ADDED_IN_JUNCTION";
						} else {
							$this->data = "JUNCTION_ERROR";
						}
                } else {
                    $this->data = "ERROR";
                }
        } catch(Exception $e) {
            echo 'SQL Exception: ' .$e->getMessage();
        }
        return $this->data;
    }
	
	 public function updateDetails($DeviceDetails) {
        try {
                $sql = "UPDATE device_details
                        SET user_room_no='".$DeviceDetails->getRoomno()."' WHERE device_serial_no='".$DeviceDetails->getSelectedDeviceEdit()."'";
        
                $isUpdated= mysqli_query($this->con, $sql);
                if ($isUpdated) {
                    $this->data = "SUCCESSFULLY_UPDATED";
						
                } else {
                    $this->data = "ERROR_WHILE_UPDATINGING";
                }
        } catch(Exception $e) {
            echo 'SQL Exception: ' .$e->getMessage();
        }
        return $this->data;
    }
	
	public function removeDevice($DeviceDetails) {
        try {
                $sql = "DELETE  FROM device_details WHERE device_serial_no='".$DeviceDetails->getSelectedDeviceRemove()."'";
        
                $isRemoved = mysqli_query($this->con, $sql);
                if ($isRemoved) {
                    $this->data = "SUCCESSFULLY_REMOVED";
						
                } else {
                    $this->data = "ERROR_WHILE_REMOVING";
                }
        } catch(Exception $e) {
            echo 'SQL Exception: ' .$e->getMessage();
        }
        return $this->data;
    }
	
	public function loadDevice($email){
        $sql="SELECT d.device_serial_no 
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