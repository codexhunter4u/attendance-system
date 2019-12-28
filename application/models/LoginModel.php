<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {

    function __construct()
    {
        
        parent::__construct();
        $this->load->library('session');
    }

    /**
     * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
     * @date : 28/12/2019
     * @Desc : Sign up Stallion Club
     * @param : array
     * @return : encoded json
     */ 
    public function signUp($request)
    {
        
        $request['created_on'] = date("Y-m-d h:i:s");
        $request['modified_on'] = date("Y-m-d h:i:s");
        $request['password'] = hash_hmac('sha512','salt'.trim($request['password']),AUTH_KEY);
		$request['date_of_birth'] = date("Y-m-d", strtotime($request['date_of_birth']));
        
        if($this->db->insert('user_profile',$request)){

            $response = array('responseCode' => '1','responseMessage' => 'Registration successfully done...!');

        }else{
            
            $response = array('responseCode' => '-1','responseMessage' => $this->db->_error_message());

        }

        return json_encode($response);
    }

    /**
     * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
     * @date : 28/12/2019
     * @Desc : Sign in Stallion Club
     * @param : array
     * @return : encoded json
     */ 
    public function login($request,$cookie)
    {

        $db = get_instance()->db->conn_id;
        $username = mysqli_real_escape_string($db,$request['user_name']);
        $query = $this->db->query("SELECT * FROM user_profile u
        WHERE u.user_email = ? ",array($username));
        $result = $query->row();
        $password = hash_hmac('sha512','salt'.trim($request['password']),AUTH_KEY);
        
        if ($query->num_rows() > 0 && $result->active == 1) {
          
           if(trim($result->password) == trim($password)){
                $this->session->set_userdata(array(
                    'userdata'  => $result,
                    'is_logged_in'   => TRUE
                ));

                setcookie ("rememberMe",TRUE,time()+ (10 * 365 * 24 * 60 * 60));
                $response = array('responseCode' => '1','is_admin' => $result->is_admin, 'userData' => $result);

           }else{
                $response = array('responseCode' => '-1','responseMessage' => 'Username or password not valid');
           }

        } else {
          
            $response = array('responseCode' => '-1','responseMessage' => 'Ohh..! User is not activated.');

        }
        return $response;

    }

    /**
     * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
     * @date : 28/12/2019
     * @Desc : Reset user password
     * @param : array
     * @return : encoded json
     */ 
    public function resetPassword($request)
    {
    
        $query = $this->db->query("SELECT userid,active FROM user_profile
        WHERE user_email = ? ",array(trim($request['useremail'])));
        $result = $query->row();
        
        if ($query->num_rows() > 0 && $result->active == 1) {
            
            $newPassword = hash_hmac('sha512','salt'.trim($request['usernewpassword']),AUTH_KEY);
        
            $data = array(
                'password' => $newPassword,
                'modified_on' => date("Y-m-d h:i:s")
            );

           
            $update = $this->db->update('user_profile', $data, array('userid' => $result->userid));

            if($update){

                $response = array('responseCode' => '1','responseMessage' => 'Password changed successfully...!');
            }else{
                
                $response = array('responseCode' => '-1','responseMessage' => $this->db->_error_message());
            }

        }else{
            
            $response = array('responseCode' => '-1','responseMessage' => 'Ohh..! This user is not active.');
        }
        
        return json_encode($response);
    }

}

?>