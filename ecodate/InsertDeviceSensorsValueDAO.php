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
                $sql = "INSERT INTO trial_pollution(poll_sen1,poll_sen2,poll_sen3,poll_sen4,poll_sen5,poll_sen6,poll_sen7,poll_sen8,sen_time,device_serial_no)
                        VALUES ('".$SensorsDetail->getDust()."','".$SensorsDetail->getCo2()."','".$SensorsDetail->getNo2()."','".$SensorsDetail->getHumidity()."','".$SensorsDetail->getCo()."','".$SensorsDetail->getTempreture()."','".$SensorsDetail->getPm10()."','".$SensorsDetail->getNoise()."', '".$SensorsDetail->getTime()."','".$SensorsDetail->getDevice_serial_no()."')";
        
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