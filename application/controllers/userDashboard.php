<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserDashboard extends CI_Controller {

	 function __construct() {
        parent::__construct();
        $this->userdata['userdata'] = $this->session->userdata('userdata');
        $this->load->model('dashboardModel','dashb');
        if (!$this->session->userdata('is_logged_in')) {
            redirect('Login');
        }
    }

    /**
     * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
     * @date : 28/12/2019
     * @Desc : Default view to show the all details on users dashbard
     * @param : null
     * @return : encoded json
     */
	public function index()
	{ 
        $data['userdata'] = $this->userdata['userdata'];
        $data['attendence'] = $this->dashb->getAttendence($data['userdata']->userid);
		$this->load->view('include/headerscript');
		$this->load->view('v_userDashboard',$data);
		$this->load->view('include/footerscript');
        $this->load->view('include/dashboardscript');
	}

    /**
     * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
     * @date : 28/12/2019
     * @Desc : Get the all user details
     * @param : array
     * @return : encoded json
     */
    public function getUsersDetails()
    {

        $data = array(
            'state' => $this->input->post('state'), 
            'column' => $this->input->post('column')
        );
        $res = $this->dashb->getUsersDetails($data);
        echo $res;
    }

    /**
     * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
     * @date : 28/12/2019
     * @Desc : Download the reports based on users conditions
     * @param : $where : string,int, $column : string
     * @return : encoded json
     */
    function downloadCsv($where = null, $column = null)
    {
        
        $column = ($column == 'reg') ? 'p.active' : 'p.gender';
        $group_by = ($column == 'reg') ? 'p.active' : 'p.gender';
        $whereClasue = array($column => $where, 'a.present' => 1);
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        
        $this->db->select('p.userid,p.user_name,p.user_email,p.active,p.status,p.gender,p.date_of_birth,p.created_on,COUNT(a.present) AS attendenceCount');
        $this->db->from('user_profile p');
        $this->db->join('user_attendence a', 'a.user_id = p.userid'); 
        $this->db->where($whereClasue);
        $this->db->group_by($group_by); 
        $query = $this->db->get();
        $delimiter = ",";
        $newline = "\r\n";
        $data = $this->dbutil->csv_from_result($query, $delimiter, $newline);
        force_download('CSV_Report.csv', $data);
    }

}
