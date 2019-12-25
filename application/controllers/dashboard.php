<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	 function __construct() {
        parent::__construct();
        $this->userdata['userdata'] = $this->session->userdata('userdata');
        $this->load->model('dashboardModel','dashb');
        if (!$this->session->userdata('is_logged_in')) {
            redirect('Login');
        }
    }

	public function index()
	{ 
        $data['userdata'] = $this->userdata['userdata'];
        $data['userCount'] = $this->dashb->getUserCount();
        $data['AttCount'] = $this->dashb->getAllAttendeceCount();
		$this->load->view('include/headerscript');
		$this->load->view('v_dashboard',$data);
		$this->load->view('include/footerscript');
        $this->load->view('include/dashboardscript');
	}

    public function markAttendence(){

        $data['user_id'] = $this->session->userdata('userdata')->userid;
        echo $res = $this->dashb->markAttendence($data);

    }

    public function getDashboardData(){
        $data['user_id'] = $this->session->userdata('userdata')->userid;
        echo $res = $this->dashb->getDashboardData($data);
    }

    public function activateUser(){
        $data['user_id'] = $this->input->post('user_id');
        echo $res = $this->dashb->activateUser($data);
    }

}
