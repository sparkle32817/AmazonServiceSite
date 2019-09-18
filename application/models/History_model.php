<?php


class History_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getHistoryInfo($client_id, $order)
    {
        $this->db->select('h.*, s.name as service')->from('tbl_history as h')->join('tbl_service as s', 'h.service_id=s.id');
        $this->db->where('user_id', $client_id);
        $this->db->order_by('id', $order);
        $result = $this->db->get();

        if ($result->num_rows()>0)
        {
            return $result->result_array();
        }

        return array();
    }

    public function getPendingHistoryTemp($client_id)
    {
        $this->db->distinct();
        $this->db->select('t.*, s.name as service')
            ->from('tbl_task as t')
            ->join('tbl_service as s', 't.service_id=s.id')
            ->where('t.client_id', $client_id);
        $this->db->order_by('id', 'ASC');
        $result = $this->db->get('tbl_task');

        if ($result->num_rows()>0)
            return $result->result_array();

        return array();
    }

    public function getPendingHistory($client_id)
    {
        $this->db->distinct();
        $this->db->select('t.*, s.name as service')
            ->from('tbl_task as t')
            ->join('tbl_service as s', 't.service_id=s.id')
            ->where('t.client_id', $client_id)
            ->where('t.status !=', 'complete')
            /*->or_where('t.is_approved_task', 0)*/;
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_task');

        if ($result->num_rows()>0)
            return $result->result_array();

        return array();
    }

    public function getCompleteHistory($client_id, $visited)
    {
        $this->db->distinct();
        $this->db->select('t.*, s.name as service')->from('tbl_task as t')->join('tbl_service as s', 't.service_id=s.id');
        $this->db->where('t.client_id', $client_id);
        $this->db->where('t.status', 'complete');
        $this->db->where('t.is_visited', $visited);
        $this->db->where('t.is_approved_task', 1);
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_task');

        if ($result->num_rows()>0)
            return $result->result_array();

        return array();
    }

    public function getAsin($service, $related_task_id){

    	if ($service == 'Big Data-Category')
    		return '';

		$this->db->select('alias');
		$this->db->where('name', $service);
		$result = $this->db->get('tbl_service')->row_array();

		if (!isset($result['alias']))
			return '';

		$fields = $this->db->list_fields($result['alias']);

		if (!in_array('asin', $fields))
			return '';

		$this->db->select('asin');
		$this->db->where('id', $related_task_id);
		$res = $this->db->get($result['alias'])->row_array();

		return $res['asin'];
	}
}
