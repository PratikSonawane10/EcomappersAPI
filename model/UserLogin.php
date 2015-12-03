<?php
require_once '../dao/UserLoginDAO.php';
class UserLogin
{
    private $username;
    private $password;
    
    public function setUserName($username){
        $this->username = $username;
    }
    public function getUserName(){
        return $this->username;
    }
    public function setPassword($password){
        $this->password = $password;
    }
    public function getPassword(){
        return $this->password;
    }
    
    public function mapIncomingLoginParams($username, $password){
        $this->setUserName($username);
        $this->setPassword($password);
    }
    
    public function userLoginDetails() {
        $adminLoginDetailsDAO = new UserLoginDAO();
        $returnLoginSuccessMessage = $adminLoginDetailsDAO->login($this);
        return $returnLoginSuccessMessage;
    }
}          
?>