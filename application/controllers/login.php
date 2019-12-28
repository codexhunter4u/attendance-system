<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	 function __construct() {
        parent::__construct();
        $this->load->model('loginModel');
    }

    /**
     * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
     * @date : 28/12/2019
     * @Desc : Default login view page
     * @param : null
     * @return : html
     */
	public function index()
	{
		$this->load->view('include/headerscript');
		$this->load->view('v_login');
		$this->load->view('include/footerscript');
	}

	/**
     * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
     * @date : 28/12/2019
     * @Desc : Sign up in Stallion club
     * @param : Array
     * @return : encoded json
     */
	public function signUp() 
    {

        $formData = $this->input->post('formData');
        $data = json_decode($formData, TRUE);
        
        foreach ($data as $key => $value) {

            $values[] = $data[$key]['value'];
            $keys[] = $data[$key]['name'];
        }
        
        $data = array_combine($keys, $values);
        unset($data['user_confirmpassword']);
        echo $res = $this->loginModel->signUp($data);
    }

    /**
     * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
     * @date : 28/12/2019
     * @Desc : Login with Admin/All user in Stallion club
     * @param : array
     * @return : encoded json
     */
    public function login() 
    {
        
        $formData = $this->input->post('formData');
        $rememberMe = $this->input->post('rememberMe');
        $data = json_decode($formData, TRUE);
        
        foreach ($data as $key => $value) {

            $values[] = $data[$key]['value'];
            $keys[] = $data[$key]['name'];
        }

        $data = array_combine($keys, $values);
        $result = $this->loginModel->login($data, $rememberMe);
    	
        if ($result['responseCode'] === '1') {
            
            if ($result['is_admin'] === '1') {
                $result['redirect_url'] = 'dashboard';
            }else{
                $result['redirect_url'] = 'userDashboard';
            }

        }
        echo (json_encode($result));
    }
     
    /**
     * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
     * @date : 28/12/2019
     * @Desc : Reset user password
     * @param : null
     * @return : encoded json
     */ 
    public function resetPassword() 
    {

        $formData = $this->input->post('resetPassformData');
        $data = json_decode($formData, TRUE);
        
        foreach ($data as $key => $value) {

            $values[] = $data[$key]['value'];
            $keys[] = $data[$key]['name'];
        }
        
        $data = array_combine($keys, $values);
        echo $res = $this->loginModel->resetPassword($data);
    }

    /**
     * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
     * @date : 28/12/2019
     * @Desc : Logout from system
     * @param : null
     * @return : null
     */ 
    public function logout() 
    {

        $this->session->sess_destroy();
        redirect('login');
    }

}
