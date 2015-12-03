<?php
require_once '../dao/InsertDeviceSensorsValueDAO.php';
class InsertDeviceSensorsValue
{
    public $pm2;
    public $co2;			
	public $no2;
	public $humidity;
	public $co;
    public $tempreture;
	public $pm10;
	public $noise;
	
	public $device_serial_no;
	public $time;
    
	public function setPm2($pm2) {
        $this->pm2 = $pm2;
    }
    public function getPm2() {
        return $this->pm2;
    }
	
    public function setCo2($co2) {
        $this->co2 = $co2;
    }
    public function getCo2() {
        return $this->co2;
    }
	
    public function setNo2($no2) {
        $this->no2 = $no2;
    }
    public function getNo2() {
        return $this->no2;
    }
	
	public function setHumidity($humidity) {
        $this->humidity = $humidity;
    }
    public function getHumidity() {
        return $this->humidity;
    }	
	
    public function setCo($co) {
        $this->co = $co;
    }    
    public function getCo() {
        return $this->co;
    }	
	
    public function setTempreture($tempreture) {
        $this->tempreture = $tempreture;
    }    
    public function getTempreture() {
        return $this->tempreture;
    }
	
    public function setPm10($pm10) {
        $this->pm10 = $pm10;
    }    
    public function getPm10() {
        return $this->pm10;
    }	
	
	public function setNoise($noise) {
        $this->noise = $noise;
    }    
    public function getNoise() {
        return $this->noise;
    }
	
	public function setDevice_serial_no($device_serial_no) {
        $this->device_serial_no = $device_serial_no;
    }    
    public function getDevice_serial_no() {
        return $this->device_serial_no;    
	}
	
	public function setTime($time) {
        $this->time = $time;
    }    
    public function getTime() {
        return $this->time;    
	}
	
    public function insertValuesOfSensorAsPerRoomno($pm2, $co2, $no2, $humidity, $co, $tempreture, $pm10,$noise,$device_serial_no,$time) {
        $this->setPm2($pm2);
        $this->setCo2($co2);
		$this->setNo2($no2);
		$this->setHumidity($humidity);
		$this->setCo($co);
        $this->setTempreture($tempreture);
		$this->setPm10($pm10);
		$this->setNoise($noise);
		$this->setTime($time);
		$this->setDevice_serial_no($device_serial_no);
        $showSensorDetailsDAO = new InsertDeviceSensorsValueDAO();
        $showSensorDetailsDAO->InsertSensorsVaues($this);
    }
}
?>