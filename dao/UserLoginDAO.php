<?php
require_once 'BaseDAO.php';
class UserLoginDAO 
{
    
    private $con;
    private $msg;
    
    // Attempts to initialize the database connection using the supplied info.
    public function UserLoginDAO() {
        $baseDAO = new BaseDAO();
        $this->con = $baseDAO->getConnection();
    }
    
    public function login($checkLogin){
    	
	$this->con->options(MYSQLI_OPT_CONNECT_TIMEOUT, 500);		
        $sql="SELECT * FROM user_login WHERE email='".$checkLogin->getUserName()."' and password='".$checkLogin->getPassword()."'";
        try{
            $login=mysqli_query($this->con,$sql);
            $count=mysqli_num_rows($login);
            if($count==1) {
                $this->msg = "LOGGED_IN";
            }
            else {
                $this->msg = "LOGIN_FAILED";
            }
        }
        catch (Exception $e){
            echo'SQL Exception:'.$e->getMessage();
        }
        return $this->msg;
    }
}
?>