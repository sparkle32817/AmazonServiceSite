<?php


class Service_bigdata_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	//Big Data
    public function isExistAlready($client_id, $postData)
    {
        $returnVal['status'] = 'NO';
        $service = $this->getServiceInfo($postData['service']);
        $service_id = $service['id'];

        $data = array_diff($postData, array($postData['service']));

        $query1 = $this->db->where($data)->order_by('id', 'DESC')->get($service['alias']);
        if ($query1->num_rows()>0)
        {
            $result1 = $query1->row_array();

            $query2= $this->db->get_where('tbl_view_all_task', array('client_id'=>$client_id, 'service_id'=>$service_id, 'related_task_id'=>$result1['id']));
            if ($query2->num_rows()>0)
            {
                $result2 = $query2->row_array();

                $returnVal['status'] = $result2['status'];
                $returnVal['task_id'] = $result2['id'];
            }
        }

        return $returnVal;
    }

	public function startSearch($client_id, $postData)
	{
		$service = $this->getServiceInfo($postData['service']);
		$service_id = $service['id'];

        $data = array_diff($postData, array($postData['service']));
		if ($this->db->insert($service['alias'], $data))
		{
			$service_task_id = $this->db->insert_id();
			$this->db->query("INSERT INTO `tbl_task` (`id`, `client_id`, `service_id`, `status`, `request_time`, `employee_id`, `start_time`, `end_time`, `related_task_id`, `market_id`) VALUES (NULL, '".$client_id."', '".$service_id."', 'pending', '".date('Y-m-d H:i:s')."', NULL, NULL, NULL, '".$service_task_id."', ".$postData['market_id'].");");

			return 'success';
		}

		return 'fail';
	}

	public function getDataInfo($id, $service_data_table)
	{
	    $query_select = 'a.*, c.name as market_place';
        if ($service_data_table != 'tbl_service_keyword_data')
	        $query_select = 'a.*, b.category_name as category, c.name as market_place';

		$this->db->select($query_select);
		$this->db->from($service_data_table.' as a');

        if ($service_data_table != 'tbl_service_keyword_data')
		    $this->db->join('tbl_service_market_category as b', 'a.category_id = b.id', 'left');

		$this->db->join('tbl_market as c', 'a.market_id = c.id');
		$this->db->where('a.id', $id);
		return $this->db->get()->row_array();
	}

	public function getCompletionData($task_id, $service_complete_table)
	{
		$this->db->select('*');
		$this->db->from($service_complete_table);
		$this->db->where('task_id', $task_id);

		return $this->db->get()->result_array();
	}

	public function getTotalCount($task_id, $service_complete_table)
	{
		$this->db->select('Count(id) as count');
		$this->db->from($service_complete_table);
		$this->db->where('task_id', $task_id);

		$result = $this->db->get()->row_array();

		return $result['count'];
	}

	public function getHistory($client_name, $service)
	{
	    $service_info = $this->getServiceInfo($service);

		$str_part_query = '';
		if ($service == 'Big Data-Product' || $service == 'Big Data-Advertising')
			$str_part_query = ', b.asin';
		$str_query = 'SELECT a.market_place, a.id, b.category_id, a.request_time, a.status'.$str_part_query.'
						FROM tbl_view_all_task a
						JOIN `'.$service_info['alias'].'` b ON b.id = a.`related_task_id`
						WHERE a.client_name = \''.$client_name.'\' AND a.service = \''.$service.'\'';

		return $this->db->query($str_query)->result_array();
	}

	public function getAdvertisingHistory($client_name)
	{
		$str_query = 'SELECT a.market_place, a.id, COALESCE(c.`category_name`, \'\') AS category, a.request_time, a.status, b.asin
						FROM tbl_view_all_task a
						JOIN `tbl_service_advertising_data` b ON b.id = a.`related_task_id`
						LEFT JOIN `tbl_service_market_category` c ON c.id = b.`category_id`
						WHERE a.client_name = \''.$client_name.'\' AND a.service = \'Big Data-Advertising\'';

		return $this->db->query($str_query)->result_array();
	}

	public function deleteBigDataHistory($task_id, $data_table, $complete_table)
	{
        $related_id = $this->getRelatedTaskID($task_id);

        $this->db->delete($data_table, array('id'=>$related_id));
		$this->db->delete($complete_table, array('task_id'=>$task_id));
		$this->db->delete('tbl_task', array('id'=>$task_id));

		return 'success';
	}

	public function getServiceInfo($service_name)
	{
		$this->db->select('*');
		$this->db->where('name', $service_name);
		return $this->db->get('tbl_service')->row_array();
	}

	public function insertCompleteData($complete_table, $arr)
	{
		$this->db->insert($complete_table, $arr);
	}

	public function getRelatedTaskID($task_id)
	{
		$str_query = 'SELECT related_task_id FROM tbl_view_all_task WHERE id = \''.$task_id.'\'';

		$query = $this->db->query($str_query);

		$result = $query->row_array();
		return $result['related_task_id'];
	}

    public function getStatus($task_id)
    {
        $str_query = 'SELECT status FROM tbl_task WHERE id = \''.$task_id.'\'';

        $query = $this->db->query($str_query);

        $result = $query->row_array();
        return $result['status'];
    }

	public function getMarketCategory($market_id)
	{
		$this->db->select('id as value, category_name as label');
		$this->db->where('market_id', $market_id);
		$result = $this->db->get('tbl_service_market_category');

		if ($result->num_rows()>0)
			return $result->result_array();

		return false;
	}

	public function getMarketName($task_id)
	{
		$str_qeury = 'SELECT b.name 
						FROM `tbl_task` a
						JOIN `tbl_market` b ON a.market_id = b.id
						WHERE a.id = '.$task_id;

		$result = $this->db->query($str_qeury)->row_array();
		return $result['name'];
	}

	public function getCategory($category_id)
    {
        $result = $this->db->where('id', $category_id)->get('tbl_service_market_category')->row_array();

        return $result['category_name'];
    }

    public function checkCategory($data_id, $category)
    {
        $result = $this->db->where('id', $data_id)->get('tbl_service_keyword_data')->row_array();

        $arr = array();

        foreach (explode(",", $result['category_id']) as $category1)
        {
            array_push($arr, $this->getCategory($category1));
        }

        if (in_array($category, $arr))
        {
            return true;
        }

        return false;
    }

	public function setVisit($task_id)
	{
		$this->db->select('status');
		$this->db->where('id', $task_id);
		$result = $this->db->get('tbl_task')->row_array();

		if ($result['status'] == 'complete')
		{
			$this->db->where('id', $task_id);
			$this->db->update('tbl_task', array('is_visited' => 1));
		}
	}

}
