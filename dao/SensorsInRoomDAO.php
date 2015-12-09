<?php
ini_set('memory_limit','16M');
require_once 'BaseDAO.php';
require_once '../model/SensorSepration.php';

class SensorsInRoomDAO
{
    
    private $con;
    private $msg;
    private $data;
    
    // Attempts to initialize the database connection using the supplied info.
    public function SensorsInRoomDAO() {
        $baseDAO = new BaseDAO();
        $this->con = $baseDAO->getConnection();
    }
 
    
    public function showSensors($sensorInRoom) {
		$this->con->options(MYSQLI_OPT_CONNECT_TIMEOUT, 500);
        $sql = "SELECT s.temperature,s.pm2,s.pm10,s.noise,s.co,s.co2,s.no2,s.humidity,s.device_serial_no
				FROM trial_pollution s
				INNER JOIN device_details d
					ON s.device_serial_no = d.device_serial_no
				INNER JOIN junction_user_device jt
					ON d.device_serial_no = jt.device_serial_no
				INNER JOIN user_login u 
					ON jt.email = u.email
				WHERE d.user_room_no = '".$sensorInRoom->getRoomno()."' AND u.email= '".$sensorInRoom->getEmail()."' order by poll_id desc limit 1";
        
        try {
                $select= mysqli_query($this->con,$sql);
                $sensorArray=array();
                while($rowdata=mysqli_fetch_assoc($select)){
                    $sensorArray[]=$rowdata;         
                }
				reset($sensorArray[0]);
				$statusArray=array();
				while(list($key, $value)= each($sensorArray[0])){
					//echo "$key => $value";
					$sensorName=$key;
					$sensorValue=$value;
                    if($sensorName!="device_serial_no"){
					$queryOfStatus ="SELECT status,sensor_name,$sensorValue as value
										FROM sensor_range 
										WHERE  $sensorValue BETWEEN coalesce(`starting_point`,$sensorValue) AND coalesce(`Ending_point`,$sensorValue)
										and sensor_name='$sensorName' ";																							 
					$statusOutput = mysqli_query($this->con,$queryOfStatus);
					while($rowdata=mysqli_fetch_assoc($statusOutput)){
						$statusArray[]=$rowdata;         
					}			
				}else{
				  break;
				}
				}               				
        } catch (Exception $e){
            echo'SQL Exception:'.$e->getMessage();
        }
        return $statusArray;
    }	
	
	public function showSuggessionss($sensorInRoom) {
		$this->con->options(MYSQLI_OPT_CONNECT_TIMEOUT, 500);
        $sql = "SELECT 
				( SELECT pm2 FROM sensorAverage WHERE device_serial_no=sAvg.device_serial_no AND pm2 IS TRUE ORDER BY id DESC LIMIT 1) AS pm2,						   
				( SELECT pm10 FROM sensorAverage WHERE device_serial_no=sAvg.device_serial_no AND pm10 IS TRUE ORDER BY id DESC LIMIT 1) AS pm10,						   
				( SELECT co FROM sensorAverage WHERE device_serial_no=sAvg.device_serial_no AND co IS TRUE ORDER BY id DESC  LIMIT 1) AS co,
				( SELECT no2 FROM sensorAverage WHERE device_serial_no=sAvg.device_serial_no AND no2 IS TRUE ORDER BY id DESC LIMIT 1) AS no2					   
				FROM (SELECT distinct device_serial_no FROM sensorAverage) AS sAvg
				INNER JOIN device_details d ON sAvg.device_serial_no=d.device_serial_no
				INNER JOIN junction_user_device jt ON d.device_serial_no=jt.device_serial_no
				INNER JOIN user_login u ON jt.email=u.email
				WHERE d.user_room_no='".$sensorInRoom->getRoomno()."' AND u.email='".$sensorInRoom->getEmail()."' ";
						
        try {
                 $select= mysqli_query($this->con,$sql);
				$sensorAvgValue=array();
				while($rowdata = mysqli_fetch_assoc($select)){
					$sensorAvgValue[]=$rowdata;
				}
				reset($sensorAvgValue[0]);
				$suggessionArray=array();
				while(list($key, $value)= each($sensorAvgValue[0])){
					//echo "$key => $value";
					$sensorName=$key;
					$sensorValue=$value;
					$queryOfSuggessions = "SELECT sensor_name,sug1_sensitive_groups,sug2_health_effects,sug3_cautionary
											FROM sensor_range 
											WHERE  $sensorValue BETWEEN coalesce(`starting_point`, $sensorValue) AND coalesce(`Ending_point`, $sensorValue)
											AND sensor_name='$sensorName' ";
													 
					$suggessionOutput= mysqli_query($this->con,$queryOfSuggessions);
					while($rowdata=mysqli_fetch_assoc($suggessionOutput)){
						$suggessionArray[]=$rowdata;         
					}			
				}							
        } catch (Exception $e){
            echo'SQL Exception:'.$e->getMessage();
        }
        return $suggessionArray;
    }
}
?>