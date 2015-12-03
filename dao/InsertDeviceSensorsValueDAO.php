<?php

require_once 'BaseDAO.php';
class InsertDeviceSensorsValueDAO
{
    
    private $con;
    private $msg;
    private $data;
    
    // Attempts to initialize the database connection using the supplied info.
    public function InsertDeviceSensorsValueDAO() {
        $baseDAO = new BaseDAO();
        $this->con = $baseDAO->getConnection();
    }
    
    public function InsertSensorsVaues($SensorsDetail) {
        try {
                $sql = "INSERT INTO trial_pollution(temperature,pm2,pm10,noise,co,co2,no2,humidity,sen_time,device_serial_no)
                        VALUES ('".$SensorsDetail->getTempreture()."','".$SensorsDetail->getPm2()."','".$SensorsDetail->getPm10()."','".$SensorsDetail->getNoise()."','".$SensorsDetail->getCo()."','".$SensorsDetail->getCo2()."','".$SensorsDetail->getNo2()."','".$SensorsDetail->getHumidity()."', '".$SensorsDetail->getTime()."','".$SensorsDetail->getDevice_serial_no()."')";
        
                $isInserted = mysqli_query($this->con, $sql);
                if ($isInserted) {
                    echo "SENSORS_DETAILS_SAVED";
                } else {
                    echo"ERROR";
                }
        } catch(Exception $e) {
            echo 'SQL Exception: ' .$e->getMessage();
        }  
    }
   
}
?>