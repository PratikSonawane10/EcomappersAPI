<?php
require_once '../dao/AddDeviceDAO.php';
class AddDevice
{
    private $serialno;
    private $roomno;
	private $email;
	private $selectedDeviceEdit;
	private $selectedDeviceRemove;
    
    public function setSerialno($serialno){
        $this->serialno = $serialno;
    }
    public function getSerialno(){
        return $this->serialno;
    }
    public function setRoomno($roomno){
        $this->roomno = $roomno;
    }
    public function getRoomno(){
        return $this->roomno;
    }
	
	public function setEmail($email){
        $this->email = $email;
    }
    public function getEmail(){
        return $this->email;
    }
	public function setSelectedDeviceEdit($selectedDeviceEdit){
        $this->selectedDeviceEdit = $selectedDeviceEdit;
    }
    public function getSelectedDeviceEdit(){
        return $this->selectedDeviceEdit;
    }
	public function setSelectedDeviceRemove($selectedDeviceRemove){
        $this->selectedDeviceRemove = $selectedDeviceRemove;
    }
    public function getSelectedDeviceRemove(){
        return $this->selectedDeviceRemove;
    }
    
    public function mapIncomingLoginParams($serialno, $roomno,$email){
        $this->setSerialno($serialno);
        $this->setRoomno($roomno);
		$this->setEmail($email);		
		
    }
	 public function mapIncomingLoginParamsUpdate($roomno,$selectedDeviceEdit){       
        $this->setRoomno($roomno);		
		$this->setSelectedDeviceEdit($selectedDeviceEdit);		
		
    }
	 public function mapIncomingLoginParamsRemove($selectedDeviceRemove){		
		$this->setSelectedDeviceRemove($selectedDeviceRemove);
		
    }
    
    public function addingDeviceDetails() {
        $deviceAddDetailsDAO = new AddDeviceDAO();
        $returnDeviceAddSuccessMessage = $deviceAddDetailsDAO->insertDetails($this);
        return $returnDeviceAddSuccessMessage;
    }
	
	 public function updatingDeviceDetails() {
        $deviceUpdateDetailsDAO = new AddDeviceDAO();
        $returnDeviceUpdateSuccessMessage = $deviceUpdateDetailsDAO->updateDetails($this);
        return $returnDeviceUpdateSuccessMessage;
    }
	
	 public function removingDeviceDetails() {
        $deviceRemoveDAO = new AddDeviceDAO();
        $returnDeviceRemoveSuccessMessage = $deviceRemoveDAO->removeDevice($this);
        return $returnDeviceRemoveSuccessMessage;
    }
	
	public function loadDevice($email ){
		$LoadDeviceDetailsDAO=new AddDeviceDAO();
		$this->setEmail($email);
		$returnLoadDeviceSuccessMessage =$LoadDeviceDetailsDAO -> loadDevice($this);
		return $returnLoadDeviceSuccessMessage;
	}
}          
?>