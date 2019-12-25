<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	 function __construct() {
        parent::__construct();
        $this->load->model('loginModel');
    }

	public function index()
	{
		$this->load->view('include/headerscript');
		$this->load->view('v_login');
		$this->load->view('include/footerscript');
	}

	
	public function signUp() {

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

    public function login() {
        
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
     
    public function resetPassword() {

        $formData = $this->input->post('resetPassformData');
        $data = json_decode($formData, TRUE);
        
        foreach ($data as $key => $value) {

            $values[] = $data[$key]['value'];
            $keys[] = $data[$key]['name'];
        }
        
        $data = array_combine($keys, $values);
        echo $res = $this->loginModel->resetPassword($data);
    }

    public function logout() {

        $this->session->sess_destroy();
        redirect('login');
    }

}
