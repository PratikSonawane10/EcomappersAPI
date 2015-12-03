<?php
require_once '../dao/PollutionSensorDAO.php';
class PollutionSensor
{
    public $fromDate;
    public $toDate;
    
    public function setFromDate($fromDate) {
        $this->fromDate = $fromDate;
    }
    
    public function getFromDate() {
        return $this->fromDate;
    }
    
    public function setToDate($toDate) {
        $this->toDate = $toDate;
    }
    
    public function getToDate() {
        return $this->toDate;
    }
    
    public function showingPollutionSensorDetails() {
        $showSensorDetailsDAO = new PollutionSensorDAO();
        $returnShowSensorPointDetails = $showSensorDetailsDAO->showDetail();
        return $returnShowSensorPointDetails;
    }
    
    public function showingPollutionSensorDetailsAsPerDateRange($fromDate, $toDate) {
        $this->setFromDate($fromDate);
        $this->setToDate($toDate);
        $showSensorDetailsDAO = new PollutionSensorDAO();
        $returnShowSensorPointDetails = $showSensorDetailsDAO->showDetailAsPerDateRange($this);
        return $returnShowSensorPointDetails;
    }
}
?>