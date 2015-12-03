<?php

require_once 'BaseDAO.php';
class PollutionSensorDAO
{
    
    private $con;
    private $msg;
    private $data;
    
    // Attempts to initialize the database connection using the supplied info.
    public function PollutionSensorDAO() {
        $baseDAO = new BaseDAO();
        $this->con = $baseDAO->getConnection();
    }
    
    public function showDetail() {
        date_default_timezone_set('Asia/Calcutta');
        $currentDateAndTime = date('Y-m-d H:i:s');
        $todaysdateandtimeatstartofday = date('Y-m-d 00:00:01');
        $sql = "SELECT * FROM trial_pollution WHERE sen_time BETWEEN '$todaysdateandtimeatstartofday' AND '$currentDateAndTime' ORDER BY sen_time ASC";
        
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
    
    public function showDetailAsPerDateRange($dateAndTime) {
        date_default_timezone_set('Asia/Calcutta');
        $dateOfFrom = strtotime($dateAndTime->getFromDate());
        $fromDate = date('Y-m-d H:i:s', $dateOfFrom);
        $dateOfTo = strtotime($dateAndTime->getToDate());
        $toDate = date('Y-m-d H:i:s', $dateOfTo);
        $sql = "SELECT * FROM trial_pollution WHERE sen_time BETWEEN '$fromDate' AND '$toDate' ORDER BY sen_time ASC";
        
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