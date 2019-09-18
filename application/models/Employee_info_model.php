<?php


class Employee_info_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAllEmployeeInfo($postData='')
    {
        $start_time = date('Y-m', strtotime('last month')).date('-d 00:00:00', strtotime('next day'));
        $end_time = date('Y-m-d 23:59:59');

        if ($postData!='')
        {
            $start_time = $postData['start_time'];
            $end_time = $postData['end_time'];
        }

        $str_query = "SELECT e.*, av.completion_avg_time, av.completion_count ".
                        "FROM tbl_employee_info AS e ".
                        "LEFT JOIN ( ".
                            "SELECT t.employee_id AS id, SEC_TO_TIME(AVG(TIME_TO_SEC((SELECT TIMEDIFF(`t`.`end_time`,`t`.`start_time`) LIMIT 1)))) AS `completion_avg_time`, ".
                            "COUNT((SELECT TIMEDIFF(`t`.`end_time`,`t`.`start_time`) LIMIT 1)) AS `completion_count` FROM tbl_task AS t ".
                            "WHERE t.start_time >= '".$start_time."' AND t.end_time <= '".$end_time."' ".
                            "GROUP BY t.employee_id ".
                        ") AS av ".
                        "ON e.id = av.id".
                        " WHERE e.permission=0";
//        return $str_query;

        $result = $this->db->query($str_query);

        if ($result->num_rows()>0)
            return $result->result_array();

        return false;
    }

    public function getEmployeeInfos()
    {
        $this->db->select('*');
        $this->db->where('permission', '0');
        $result = $this->db->get('tbl_employee_info');

        if ($result->num_rows()>0)
            return $result->result_array();

        return false;
    }

    public function getEmployeeInfo($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $result = $this->db->get('tbl_view_completed_status');

        if ($result->num_rows()>0)
            return $result->row_array();

        return false;
    }

    public function updateEmployeeInfoByAdmin($postData)
    {
        // print_r($postData) ;exit;
        $this->db->where($postData);
        $result = $this->db->get('tbl_employee_info');
        
        if ($result->num_rows()>0)
            return "already";

        $this->db->where('id', $postData['id']);
        $this->db->update('tbl_employee_info', $postData);

        if ($this->db->affected_rows()>0)
            return "success";

        return "fail";
    }

    public function getEmployeeSession()
    {
//        $employee_id = $this->getEmployeeID($name);

        $this->db->select('s.*, i.name as name')->from('tbl_session_employee as s')->join('tbl_employee_info as i', 'i.id = s.employee_id');
//        $this->db->where('employee_id', $employee_id);
        $this->db->order_by('id', 'ASC');
        $result = $this->db->get();

        if ($result->num_rows()>0)
            return $result->result_array();

        return false;
    }

    public function getEmployeeID($name)
    {
        $this->db->select('*');
        $this->db->where('name', $name);
        $result = $this->db->get('tbl_employee_info')->row_array();

        return $result['id'];
    }

    public function delete($postData)
    {
        $id = $postData['id'];

        $arr = array('employee_id' => '',
            'start_time' => '',
            'status' => 'pending');

        $this->db->where('employee_id', $id);
        $this->db->where('status !=', 'complete');
        $this->db->update('tbl_task', $arr);

        $this->db->where('id', $id);
        $this->db->delete('tbl_employee_info');

        if ($this->db->affected_rows()>0)
            return 'success';

        return 'fail';
    }

    public function create($postData)
    {
        $id = $postData['id'];
        $name = $postData['name'];
        $pass = $postData['password'];

        if ($id=='0')
        {
            $this->db->select('*');
            $this->db->where('name', $name);
            $result = $this->db->get('tbl_employee_info');

            if ($result->num_rows()>0)
                return 'already';

            if ($this->db->insert('tbl_employee_info', array('name'=>$name, 'password'=> $pass)))
                return 'ok_create';
            return 'fail';
        }

        $this->db->where('id', $id);
        if ($this->db->update('tbl_employee_info', array('name'=>$name, 'password'=> $pass)))
            return 'ok_update';

        return 'fail';
    }

    public function change_enable_status($postData)
    {
        $id = $postData['id'];
        $status = $postData['status'];

        $this->db->where('id', $id);
        $this->db->update('tbl_employee_info', array('enable_status'=>$status));

        if ($this->db->affected_rows()>0)
            return 'success';

        print_r($postData) ;
    }

    public function password_update($emp_name, $postData)
    {
        $this->db->where('permission', '0');
        $this->db->where('name', $emp_name);
        $this->db->where('password', $postData['old_password']);
        $this->db->update('tbl_employee_info', array('password' =>$postData['password']));

        if ($this->db->affected_rows()>0)
            return "ok";
        else
            return "fail";

    }

    public function setIpCountry($name, $ip, $country)
    {
        $this->db->where('name', $name);
        $this->db->update('tbl_employee_info', array('last_ip'=>$ip, 'last_country'=>$country));
    }

    public function getServiceName()
    {
        $this->db->select('name');
        return $this->db->get('tbl_service')->result_array();
    }

}
