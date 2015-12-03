<?php
class SensorSepration {
	
	public function SensorsDetailsSeparation($sensorArray) {
		$array_keys = array_keys($sensorArray);
        $array_values = array_values($sensorArray);
        
        foreach($sensorArray as $value){
        echo $value."<br />";
}
      
    }
    
  
}
?>