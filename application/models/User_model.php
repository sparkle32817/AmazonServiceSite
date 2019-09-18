<?php


class User_model extends CI_Model
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

        $this->db->where('user_name', $username);
        $result = $this->db->get('tbl_client');

        if ($result->num_rows()==0)
        {
            return "no_user";
        }

        $this->db->select('allow_status');
        $this->db->where('user_name', $username);
        $this->db->where('password', $password);
        $result = $this->db->get('tbl_client');

        if ($result->num_rows()==0)
        {
            return "wrong_password";
        }

        $status = $result->row_array();
        if ($status['allow_status']==0)
            return "wait";

        return "ok";
    }

    public function register($postData)
    {
        $reg_data = array(
            'user_name' => $postData['username'],
            'email' => $postData['email'],
            'full_name'=> $postData['fullname'],
            'password' => $postData['password'],
            'phone_number' => $postData['phone_number'],
            'market_id' => $postData['market_place'],
            'amazon_id' => $postData['amazon_id'],
            'invitation_code' => $postData['invitation_code'],
            'qq' => $postData['qq'],
            'other_service' => $postData['other_service'],
            'reg_date' => date("M d, Y"),
            'member_update_date' => date("Y-m-d")
        );

        $this->db->select('*');
        $this->db->from('tbl_client');
        $this->db->where('user_name', $postData['username']);
        $query = $this->db->get();

        if ($query->num_rows()>0)
        {
            return "already";
        }

        $this->db->insert('tbl_client', $reg_data);

        if ($this->db->affected_rows())
            return "ok";
        else
            return "fail";
    }

    public function updateUserInfo($postData)
    {
        $update_data = array(
            'email' => $postData['email'],
            'full_name'=> $postData['full_name'],
            'phone_number' => $postData['phone_number'],
            'address' => $postData['address'],
            'market_id' => $postData['market_id'],
            'amazon_id' => $postData['amazon_id'],
            'invitation_code' => $postData['invitation_code'],
            'qq' => $postData['qq'],
            'other_service' => $postData['other_service']
        );
        $result = $this->db->get_where('tbl_client', $update_data);
        if ($result->num_rows()>0)
            return "already";

        $this->db->where('user_name', $postData['user_name']);
        $this->db->update('tbl_client', $update_data);

        if ($this->db->affected_rows()>0)
            return "ok";

        return "fail";
    }

    public function updateUserInfoByAdmin($postData)
    {

        $result = $this->db->get_where('tbl_client', $postData);
        if ($result->num_rows()>0)
            return "already";

        $this->db->where('id', $postData['id']);
        $this->db->update('tbl_client', $postData);

        if ($this->db->affected_rows()>0)
            return "success";

        return "fail";
    }

    public function updateUserMembership($user_name, $member_id){
        $arr = array('membership_id'=> $member_id, 'member_update_date'=> date("Y-m-d") );
        $user_id = $this->getUserId($user_name);
        $this->db->where('id', $user_id);
        $this->db->update('tbl_client', $arr);
    }

    public function password_update($user_name, $postData)
    {
        $this->db->where('user_name', $user_name);
        $this->db->where('password', $postData['old_password']);
        $this->db->update('tbl_client', array('password' =>$postData['password']));

        if ($this->db->affected_rows()>0)
            return "ok";
        else
            return "fail";

    }

    public function getUserInfo($id)
    {
        $this->db->select('u.*, m.name AS membership')
            ->from('tbl_client as u')
            ->where('u.id', $id)
            ->join('tbl_membership as m', 'u.membership_id=m.id');
        $result = $this->db->get();

//        print_r($id);exit;
        return $result->row_array();
    }

    public function getAllUserInfo($postData='')
    {
        $start_time = date('Y-m', strtotime('last month')).date('-d 00:00:00', strtotime('next day'));
        $end_time = date('Y-m-d 23:59:59');

        if ($postData!='')
        {
            $start_time = $postData['start_time'];
            $end_time = $postData['end_time'];
        }

        $str_query = 'SELECT u.*, m.name AS membership, k.name AS market_place, b.part_amount '.
                        'FROM tbl_client AS u '.
                        'LEFT JOIN tbl_membership AS m '.
                           'ON u.membership_id=m.id '.
                        'LEFT JOIN tbl_market AS k '.
                            'ON u.market_id=k.id '.
                        'LEFT JOIN ( '.
                            'SELECT user_id, ROUND(SUM(amount), 2) AS part_amount '.
                            'FROM tbl_history_billing '.
                            'WHERE date_time >= \''.$start_time.'\' AND date_time <= \''.$end_time.'\' '.
                            ') AS b '.
                        'ON u.id = b.user_id';

        $result = $this->db->query($str_query);

        if ($result->num_rows()>0)
        {
            return $result->result_array();
        }

        return false;
    }

    public function getUserId($user_name)
    {
        $this->db->select("id");
        $this->db->where('user_name', $user_name);
        $result = $this->db->get('tbl_client');
        $result = $result->row_array();

        return $result['id'];
    }

    public function getUserAvatar($username)
    {
        $this->db->select('user_avatar');
        $this->db->where('user_name', $username);
        $result = $this->db->get('tbl_client');

        if ($result->num_rows()>0)
        {
            return $result->row_array();
        }

        return false;
    }

    public function getMarkets()
    {
        $this->db->select('*');
        $result = $this->db->get('tbl_market');

        return $result->result_array();
    }

    public function setSession($user_name, $ip, $country)
    {

        $arr = array(
            'user_id' => $this->getUserId($user_name),
            'time' => date('Y-m-d H:i:s'),
            'ip' => $ip,
            'country' => $country
        );

        $this->db->insert('tbl_session_client', $arr);

    }

    public function getSessions($user_name)
    {
        $user_id = $this->getUserId($user_name);

        $this->db->select('*');
        $this->db->where('user_id', $user_id);
        $result2 = $this->db->get('tbl_session_client');

        if ($result2->num_rows()==0)
        {
            return false;
        }
        return $result2->result_array();
    }

    public function getMemberStatus($user_id)
    {
        $this->db->select('membership_id, member_update_date as reg_date');
        $this->db->where('id', $user_id);
        $result = $this->db->get('tbl_client');

        return $result->row_array();
    }

    public function changeUserAvatar($username, $postData)
    {
        $this->db->where('user_name', $username);
        $this->db->update('tbl_client', array('user_avatar'=> $postData['image']));
    }

    public function delete($postData)
    {
        $id = $postData['id'];

        $this->db->where('id', $id);
        $this->db->delete('tbl_client');

        if ($this->db->affected_rows()>0)
            return 'success';

        return 'fail';
    }

    public function submit_task($client_name, $postData)
    {

        $this->db->query("INSERT INTO `tbl_task` (`id`, `client_id`, `service_id`, `status`, `request_time`, `employee_id`, `start_time`, `end_time`, related_task_id) VALUES (NULL, '".$this->getUserId($client_name)."', '".$postData['service_id']."', 'pending', '".date('Y-m-d H:i:s')."', NULL, NULL, NULL, '".$postData['content']."');");

        if ($this->db->affected_rows()>0)
            return "success";
        else
            return "fail";
    }

}
