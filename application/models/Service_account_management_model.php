<?php


class Service_account_management_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function register($client_id, $client_ip, $postData)
    {
        if ($this->db->get_where('tbl_service_account', array('client_id'=>$client_id, 'is_last'=>1))->num_rows()>0)
        {
            return 'already';
        }

        $arr = $postData;
        $arr['client_id'] = $client_id;
        $arr['client_ip'] = $client_ip;
        $arr['is_last'] = 1;
        $arr['register_time'] = date('Y-m-d H:i:s');

        if ($this->db->insert('tbl_service_account', $arr))
        {
            return 'success';
        }

        return 'fail';
    }

    public function update($client_id, $client_ip, $postData)
    {
        $arr = $postData;
        $arr['register_time'] = date('Y-m-d H:i:s');
        $arr['client_ip'] = $client_ip;

        $this->db->where('client_id', $client_id);
        $this->db->where('is_last', 1);
        if ($this->db->update('tbl_service_account', $arr))
        {
            return 'success';
        }

        return 'fail';
    }

    public function existApplication($client_id)
    {
        if ($this->db->get_where('tbl_service_account', array('client_id'=>$client_id, 'is_last'=>1))->num_rows()>0)
        {
            return true;
        }

        return false;
    }

    public function getAccountInfo($client_id)
    {
        return $this->db->get_where('tbl_service_account', array('client_id'=>$client_id, 'is_last'=>1))->row_array();
    }

    public function getBeforeAccountInfo($client_id)
    {
        $this->db->where('client_id', $client_id);
        $this->db->where('is_last !=', 1);
        $this->db->order_by('id', 'DESC')->limit(1);
        return $this->db->get('tbl_service_account')->row_array();
    }

}
