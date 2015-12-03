<?php
require_once '../dao/SensorsInRoomDAO.php';
class SensorsInRoom
{
    public $roomno;
    public $email;
	public $valueOfSensor;
    public $nameOfSensor;
   
    public function setRoomno($roomno) {
        $this->roomno = $roomno;
    }
    
    public function getRoomno() {
        return $this->roomno;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function getEmail() {
        return $this->email;
    }
	 public function setValueOfSensor($valueOfSensor) {
        $this->valueOfSensor = $valueOfSensor;
    }
    
    public function getValueOfSensor() {
        return $this->valueOfSensor;
    }
	 public function setNameOfSensor($nameOfSensor) {
        $this->nameOfSensor = $nameOfSensor;
    }
    
    public function getNameOfSensor() {
        return $this->nameOfSensor;
    }
    
    public function showingSensorDetailsAsPerRoom($roomno, $email) {
        $this->setRoomno($roomno);
         $this->setEmail($email);
        $showSensorDetailsDAO = new SensorsInRoomDAO();
        $returnShowSensorPointDetails = $showSensorDetailsDAO->showSensors($this);
        return $returnShowSensorPointDetails;
    }
	public function showingSuggessionDetailsAsPerRoom($roomno, $email) {
        $this->setRoomno($roomno);
         $this->setEmail($email);
        $showSensorDetailsDAO = new SensorsInRoomDAO();
        $returnShowSensorPointDetails = $showSensorDetailsDAO->showSuggessionss($this);
        return $returnShowSensorPointDetails;
    }
	
	public function showingSensorStatusAsPerRoom($valueOfSensor, $nameOfSensor) {
        $this->setValueOfSensor($valueOfSensor);
         $this->setNameOfSensor($nameOfSensor);
        $showSensorDetailsDAO = new SensorsInRoomDAO();
        $returnShowSensorPointDetails = $showSensorDetailsDAO->showSensorsStatus($this);
        return $returnShowSensorPointDetails;
    }
}
?>