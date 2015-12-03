
<?php

require_once 'BaseDAO.php';
class SensorForGraphDAO
{
    
    private $con;
    private $msg;
    private $data;
    
    // Attempts to initialize the database connection using the supplied info.
    public function SensorForGraphDAO() {
        $baseDAO = new BaseDAO();
        $this->con = $baseDAO->getConnection();
    }
	 public function showGraph($defaultGraph) {
        date_default_timezone_set('Asia/Calcutta');
        $currentDateAndTime = date('Y-m-d H:i:s');
        $todaysdateandtimeatstartofday = date('Y-m-d 00:00:01');
        $sql = "SELECT s.".$defaultGraph->getSensName().",s.sen_time 
				FROM trial_pollution s
				INNER JOIN device_details d
					ON s.device_serial_no = d.device_serial_no
				INNER JOIN junction_user_device jt
					ON d.device_serial_no = jt.device_serial_no
				INNER JOIN user_login u 
					ON jt.email = u.email
				WHERE s.sen_time BETWEEN '$todaysdateandtimeatstartofday' AND '$currentDateAndTime' AND u.email='".$defaultGraph->getEmail()."' AND d.user_room_no = '".$defaultGraph->getRoomno()."' 
				ORDER BY s.sen_time ASC";
        
        try {
            $select = mysqli_query($this->con, $sql);
            $this->data=array();
            while ($rowdata = mysqli_fetch_assoc($select)) {
                $this->data[]=$rowdata;
            }
        } catch(Exception $e) {
            echo 'SQL Exception: ' .$e->getMessage();
        }
        return $this->data;
    }
    
    public function showSensorPoints($dateAndTime) {
        date_default_timezone_set('Asia/Calcutta');
        $dateOfFrom = strtotime($dateAndTime->getFromDate());
        $fromDate = date('Y-m-d H:i:s', $dateOfFrom);
        $dateOfTo = strtotime($dateAndTime->getToDate());
        $toDate = date('Y-m-d H:i:s', $dateOfTo);
        $sql = "SELECT s.".$dateAndTime->getSensName()." ,s.sen_time FROM trial_pollution s
				INNER JOIN device_details d
					ON s.device_serial_no = d.device_serial_no
				INNER JOIN junction_user_device jt
					ON d.device_serial_no = jt.device_serial_no
				INNER JOIN user_login u 
					ON jt.email = u.email
				WHERE s.sen_time BETWEEN '$fromDate' AND '$toDate' AND u.email='".$dateAndTime->getEmail()."' AND d.user_room_no = '".$dateAndTime->getRoomno()."' 
				ORDER BY sen_time ASC";
        
        try {
            $select = mysqli_query($this->con, $sql);
            $this->data=array();
            while ($rowdata = mysqli_fetch_assoc($select)) {
                $this->data[]=$rowdata;
            }
        } catch(Exception $e) {
            echo 'SQL Exception: ' .$e->getMessage();
        }
        return $this->data;
    }
}
?>