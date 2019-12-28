<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardModel extends CI_Model {

    function __construct()
    {
        
        parent::__construct();
        $this->load->library('session');
    }

    /**
     * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
     * @date : 28/12/2019
     * @Desc : Update the attendence in system
     * @param : $request : array
     * @return : encoded json
     */
    public function markAttendence($request)
    {
        
        $request['present'] = 1;
        $request['attended_on'] = date("Y-m-d h:i:sa");
        if($this->db->insert('user_attendence',$request)){

            $response = array('responseCode' => '1','responseMessage' => 'Attendence marked successfully...!');

        }else{
            
            $response = array('responseCode' => '-1','responseMessage' => $this->db->_error_message());

        }

        return json_encode($response);
    }

    /**
     * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
     * @date : 28/12/2019
     * @Desc : Get user details to show on dashboard
     * @param : $request : array
     * @return : encoded json
     */
    public function getDashboardData($request)
    {

        $this->db->select('userid,user_name,user_email,active,status,gender,date_of_birth');
        $this->db->from('user_profile');
        $query = $this->db->get();
        $result['userdetails'] = $query->result();
        return json_encode($result);
    }

    /**
     * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
     * @date : 28/12/2019
     * @Desc : Update user profile for activate the user
     * @param : $request : array
     * @return : encoded json
     */
    public function activateUser($request)
    {
        
        $data = array( 
            'active'  => 1 , 
            'status'  => 1
        );

        $this->db->where('userid', $request['user_id']);

        if($this->db->update('user_profile', $data)){

            $response = array('responseCode' => '1','responseMessage' => 'User activation done...!');

        }else{
            
            $response = array('responseCode' => '-1','responseMessage' => $this->db->_error_message());

        }

        return json_encode($response);
    }

    /**
     * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
     * @date : 28/12/2019
     * @Desc : Get the all users attendence
     * @param : $request : array
     * @return : array
     */
    public function getAttendence($request)
    {

        $this->db->select('attended_on');
        $this->db->from('user_attendence');
        $query = $this->db->get();
        $result = $query->result_array();
        $no_sat = 52; // Number of Saturday in year
        return array(
            'present' => count($result),
            'absent' => $no_sat - count($result)
        );

    }

    /**
     * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
     * @date : 28/12/2019
     * @Desc : Get the total count of users exist in system
     * @param : null
     * @return : array
     */
    public function getUserCount()
    {

        $registered = $this->db->where('active','1')->from("user_profile")->count_all_results();
        $nonregistered = $this->db->where('active','0')->from("user_profile")->count_all_results();
        $male = $this->db->where('gender','Male')->from("user_profile")->count_all_results();
        $female = $this->db->where('gender','Female')->from("user_profile")->count_all_results();

        return array(
            'registered' => $registered,
            'nonregistered' => $nonregistered,
            'male' => $male,
            'female' => $female,
        );

    }

    /**
     * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
     * @date : 28/12/2019
     * @Desc : Get the user details along with attendece in % and count
     * @param : $request : array
     * @return : encoded json
     */
    public function getUsersDetails($request)
    {


        $column = ($request['column'] == 'reg') ? 'p.active' : 'p.gender';
        $whereClasue = array($column => $request['state'], 'a.present' => 1);

        $this->db->select('p.userid,p.user_name,p.user_email,p.active,p.status,p.gender,p.date_of_birth,p.created_on,COUNT(a.present) AS attendenceCount');
        $this->db->from('user_profile p');
        $this->db->join('user_attendence a', 'a.user_id = p.userid'); 
        $this->db->where($whereClasue);
        $this->db->group_by('a.user_id'); 
        $query = $this->db->get();
        $result = $query->result();

        for($i=0;$i<count($result);$i++)
        {
            $days = $this->getTotalStaturday(date('Y-m-d', strtotime($result[$i]->created_on)));
            $result[$i]->attendence = round(($result[$i]->attendenceCount * 100 / $days));
        }

        return json_encode($result);

    }

    /**
     * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
     * @date : 28/12/2019
     * @Desc : Get the total attendece of all users
     * @param : null
     * @return : encoded json
     */
    public function totalAttendance()
    {

        $this->db->select('p.*,COUNT(a.present) AS totalAttendece');
        $this->db->from('user_profile p');
        $this->db->join('user_attendence a', 'a.user_id = p.userid'); 
        $query = $this->db->get();

        return json_encode($query->result());

    }

    /**
     * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
     * @date : 28/12/2019
     * @Desc : Get all attendence count
     * @param : null
     * @return : array
     */
    public function getAllAttendeceCount()
    {


        $reg_query= $this->db->query("SELECT COUNT(a.id) as att_count FROM user_attendence a
        JOIN user_profile p ON p.userid = a.user_id
        WHERE a.present=1 AND p.active='1' GROUP BY p.active");
        $registered = $reg_query->result_array();
        
        $non_reg= $this->db->query("SELECT COUNT(a.id) as att_count FROM user_attendence a
        JOIN user_profile p ON p.userid = a.user_id
        WHERE a.present=1 AND p.active='0' GROUP BY p.active");
        $nonReg = $non_reg->result_array();

        $maleQry= $this->db->query("SELECT COUNT(a.id) as att_count FROM user_attendence a
        JOIN user_profile p ON p.userid = a.user_id
        WHERE a.present=1 AND p.gender='Male' GROUP BY p.gender");
        $male = $maleQry->result_array();

        $femaleQry= $this->db->query("SELECT COUNT(a.id) as att_count FROM user_attendence a
        JOIN user_profile p ON p.userid = a.user_id
        WHERE a.present=1 AND p.gender='Female' GROUP BY p.gender");
        $female = $femaleQry->result_array();
        

        $result = array(
            'registered' => $registered[0],
            'nonregistered' => $nonReg[0],
            'male' => $male[0],
            'female' => $female[0]
        );
        
        $days = 52; // Number Saturdays in year (2019)

        $result['registered']['per'] = round( $registered[0]['att_count'] * 100 / $days);
        $result['nonregistered']['per'] = round($nonReg[0]['att_count'] * 100 / $days);
        $result['male']['per'] = round($male[0]['att_count'] * 100 / $days);
        $result['female']['per'] = round($female[0]['att_count'] * 100 / $days);

        return $result;
    }

    /**
     * @author : Mohan Jadhav<mohan212jadhav@gmail.com>
     * @date : 28/12/2019
     * @Desc : Calcukate total number of Saturday's in calender year
     * @param : $startdate : string
     * @return : int
     */
    public function getTotalStaturday($startdate)
    {
        
        $date = date('Y-m-d', strtotime('-1 day', strtotime($startdate)));
        $start_date=strtotime($date);
        $count = 0;
        $end_date=strtotime(date('Y-m-d'));
        while(1){
          $start_date=strtotime('next saturday', $start_date);
          if($start_date>$end_date)
              break;
            $count++;
        }
        return $count;
    }

}

?>