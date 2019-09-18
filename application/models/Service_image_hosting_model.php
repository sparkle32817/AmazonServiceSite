<?php


class Service_image_hosting_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function register($client_name)
    {
        $arr = array(
                'client_id'=>$this->getClientId($client_name),
                'market_id'=>$_POST['market_id'],
                'sku'=>$_POST['sku']
        );

        if ($this->db->get_where('tbl_service_image_hosting', $arr)->num_rows()>0)
        {
            $this->db->where($arr);
            $this->db->update('tbl_service_image_hosting', array('searched_date'=>date('Y-m-d H:i:s')));

            return 'success';
        }

        $arr['searched_date'] = date('Y-m-d H:i:s');
        if($this->db->insert('tbl_service_image_hosting', $arr))
            return 'success';

        return 'fail';
    }

    public function getClientId($client_name)
    {
        $this->db->select("id");
        $this->db->where('user_name', $client_name);
        $result = $this->db->get('tbl_client');
        $result = $result->row_array();

        return $result['id'];
    }

    public function getSku($task_id)
    {
        $this->db->select('sku');
        $this->db->where('id', $task_id);
        $result = $this->db->get('tbl_service_image_hosting');
        $result = $result->row_array();

        return $result['sku'];
    }

    public function getHistory($client_name)
    {
        $client_id = $this->getClientId($client_name);

        $str_query = 'SELECT b.name as market, a.searched_date, a.sku, a.id FROM tbl_service_image_hosting a JOIN tbl_market b ON b.id=a.market_id WHERE a.client_id='.$client_id;

        return $this->db->query($str_query)->result_array();
    }

}
