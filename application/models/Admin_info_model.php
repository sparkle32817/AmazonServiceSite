<?php


class Admin_info_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function loginCheck($values)
    {
        $username = $values['lgin_username'];
        $password = $values['lgin_password'];

        $this->db->select('*');
        $this->db->where('name', $username);
        $result = $this->db->get('tbl_employee_info');

        if ($result->num_rows()==0)
        {
            return "no_user";
        }

        $this->db->select('*');
        $this->db->where('name', $username);
        $this->db->where('enable_status', '0');
        $result = $this->db->get('tbl_employee_info');

        if ($result->num_rows() > 0)
        {
            return "disabled_user";
        }

        $this->db->select('*');
        $this->db->where('name', $username);
        $this->db->where('password', $password);
        $result = $this->db->get('tbl_employee_info');

        if ($result->num_rows()==0)
        {
            return "wrong_password";
        }

        $res = $result->row_array();
        if ($res['permission']==0)
            return "employee";
        else
            return "admin";
    }

    public function password_update($postData)
    {
        $this->db->where('permission', '1');
        $this->db->where('password', $postData['old_password']);
        $this->db->update('tbl_employee_info', array('password' =>$postData['password']));

        if ($this->db->affected_rows()>0)
            return "ok";
        else
            return "fail";

    }

}