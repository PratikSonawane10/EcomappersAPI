<?php

require_once 'BaseDAO.php';
class ForgotPasswordDAO
{
    
    private $con;
    private $msg;
    private $data;
    
    // Attempts to initialize the database connection using the supplied info.
    public function ForgotPasswordDAO() {
        $baseDAO = new BaseDAO();
        $this->con = $baseDAO->getConnection();
    }
   /* public function loginDetail($LoginDetails) {
        $sql = "SELECT * FROM user_login; WHERE email='".$LoginDetails->getEmail()."' AND password='".$LoginDetails->getPassword()."'";        
			try{
				$login=mysqli_query($this->con,$sql);
				$count=mysqli_num_rows($login);
				if($count==1) {
					$this->msg = "LOGGED_IN";
				}
				else {
					$this->msg = "LOGIN_FAILED";
				}
        
			} catch(Exception $e) {
				echo 'SQL Exception: ' .$e->getMessage();
			}
        return $this->data;
    }*/
    
    public function emailDetail($LoginDetails) {
           try {
                $this->con->options(MYSQLI_OPT_CONNECT_TIMEOUT, 500);
                $sql = "SELECT * FROM user_login WHERE email='".$LoginDetails->getEmail()."'";        
                $isValidating = mysqli_query($this->con, $sql);
                $count=mysqli_num_rows($isValidating);
                if($count==1) {
                    //$this->data = "VALID_EMAIL";
                    $resetPassword = new ForgotPassword();
                    $this->data=$resetPassword -> GenarateRandomNo($LoginDetails->getEmail());
                } else {
                    $this->data = "INVALID_EMAIL"; 
                } 
                
        } catch(Exception $e) {
            echo 'SQL Exception: ' .$e->getMessage();
        }
        return $this->data;
    }
    public function savingRandomNo($LoginDetails) {
        try {              
                    $sql = "UPDATE user_login SET activationcode='".$LoginDetails->getRandomNoForUser()."' WHERE email='".$LoginDetails->getEmail()."'";                     
                    $isUpdate = mysqli_query($this->con, $sql);
                    if ($isUpdate) {
                    //$count = mysqli_affected_rows($this->con);
                    //if ($count==1) {
                        $this->data = "RANDOM_NO_SUCCESSFULLY_UPDATED";
                    } else {
                        $this->data = "RANDOM_NO_NOT_UPDATED";
                    }  
        } catch(Exception $e) {
            echo 'SQL Exception: ' .$e->getMessage();
        }
        return $this->data;
    }
   
    public function setNewPassword($LoginDetails) {  
        try {
                $sql = "UPDATE user_login SET password='".$LoginDetails->getNewPassword()."' WHERE email='".$LoginDetails->getEmail()."' AND activationcode='".$LoginDetails->getActivationCode()."' ";
                //$isUpdate = mysqli_query($this->con, $sql);
                  mysqli_query($this->con, $sql);  
                    if (mysqli_affected_rows($this->con) >= 1) {
                        $this->data = "NEW_PASSWORD_SUCCESSFULLY_SET";
                    } else {
                        $this->data = "ENTER_VALID_ACTIVATION_CODE";
                    }  
        } catch(Exception $e) {
            echo 'SQL Exception: '.$e->getMessage();
        }
        return $this->data;
    }
                
}

?>