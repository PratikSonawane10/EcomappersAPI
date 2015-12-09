<?php
require_once '../dao/SensorForGraphDAO.php';
class SensorForGraph
{
    public $fromDate;
    public $toDate;
	public $sensName;
	public $email;
	public $roomno;
    
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
	
    public function setSensName($sensName) {
        $this->sensName = $sensName;
    }    
    public function getSensName() {
        return $this->sensName;
    }
		
	public function setEmail($email) {
        $this->email = $email;
    }    
    public function getEmail() {
        return $this->email;
    }
	
	 public function setRoomno($roomno) {
        $this->roomno = $roomno;
    }
    
    public function getRoomno() {
        return $this->roomno;
    
	}
	
	public function showingSensorGraphDetails($sensName, $email, $roomno) {
		$this->setSensName($sensName);
		$this->setEmail($email);
		$this->setRoomno($roomno);
        $showSensorDetailsDAO = new SensorForGraphDAO();
        $returnShowSensorPointDetails = $showSensorDetailsDAO->showGraph($this);
        return $returnShowSensorPointDetails;
    }
    
	public function showingPointRangeForYAxis($sensName) {
		$this->setSensName($sensName);
        $showSensorDetailsDAO = new SensorForGraphDAO();
        $returnShowSensorPointDetails = $showSensorDetailsDAO->showPoints($this);
        return $returnShowSensorPointDetails;
    }
    
    public function showingSensorPointForGraph($fromDate, $toDate, $sensName, $email, $roomno) {
        $this->setFromDate($fromDate);
        $this->setToDate($toDate);
		$this->setSensName($sensName);
		$this->setEmail($email);
		$this->setRoomno($roomno);
        $showSensorDetailsDAO = new SensorForGraphDAO();
        $returnShowSensorPointDetails = $showSensorDetailsDAO->showSensorPoints($this);
        return $returnShowSensorPointDetails;
    }
}
?>