<?php


class Service_keyword_checker_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	//Keyword Index Checker
    public function isExistAlready($client_id, $service_name, $postData)
    {
        $returnVal['status'] = 'NO';
        $service = $this->getServiceInfo($service_name);
        $service_id = $service['id'];

        $arr = array(
            'asin' => $postData['asin'],
            'client_id' => $client_id,
            'market_id' => $postData['market_id'],
            'seller_id' => $postData['seller_id']
        );

        $query1 = $this->db->where($arr)->order_by('id', 'DESC')->get($service['alias']);
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

    public function startCheckKeyword($client_id, $service_name, $postData)
	{
		$service = $this->getServiceInfo($service_name);
		$service_id = $service['id'];

		$arr = array(
			'asin' => $postData['asin'],
			'client_id' => $client_id,
			'market_id' => $postData['market_id'],
			'seller_id' => $postData['seller_id'],
            'keywords' => implode(',', $postData['keywords'])
		);

		$this->db->insert('tbl_service_key_check_asin_data', $arr);
		$asin_id = $this->db->insert_id();
//
//		foreach ($postData['keywords'] as  $keyword)
//		{
//			$keyword = trim($keyword);
//
//			if (!empty($keyword))
//			{
//				$arr = array(
//					'asin_id'=>$asin_id,
//					'keyword'=>$keyword,
//					'index1' => '',
//					'index2' => '',
//					'index3' => '',
//					'cumulative' => ''
//				);
//
//				$this->db->insert('tbl_service_key_check_data', $arr);
//			}
//		}

		$this->db->query("INSERT INTO `tbl_task` (`id`, `client_id`, `service_id`, `status`, `request_time`, `employee_id`, `start_time`, `end_time`, `related_task_id`, `market_id`) VALUES (NULL, '".$client_id."', '".$service_id."', 'pending', '".date('Y-m-d H:i:s')."', NULL, NULL, NULL, '".$asin_id."', ".$postData['market_id'].");");

		return 'success';
	}

	public function getDataInfo($id)
	{
		$this->db->select('a.asin, a.seller_id, a.keywords, b.name as market_place');
		$this->db->from('tbl_service_key_check_asin_data a');
		$this->db->join('tbl_market b', 'a.market_id = b.id');
		$this->db->where('a.id', $id);
		return $this->db->get()->row_array();
	}

	public function getKeywords($id)
	{
		$this->db->select('keyword');
		$this->db->from('tbl_service_key_check_data');
		$this->db->where('asin_id', $id);
		return $this->db->get()->result_array();
	}

	public function getKeywordDetailInfo($asin_id)
	{
		$str_query = 'SELECT @n := @n + 1 num, `keyword`, `index1`, `index2`, `index3`, `cumulative`
						FROM tbl_service_key_check_data, (SELECT @n := 0) m
						WHERE asin_id = '.$asin_id;
		return $this->db->query($str_query)->result_array();
	}

	public function getHistory($client_name)
	{
		$str_query = 'SELECT a.id, a.market_place, b.asin, a.status, a.request_time
						FROM tbl_view_all_task a
						JOIN `tbl_service_key_check_asin_data` b ON b.id = a.`related_task_id` 
						WHERE a.client_name = \''.$client_name.'\' AND a.service_id = 12
						ORDER BY a.id ASC';

		return $this->db->query($str_query)->result_array();
	}

	public function deleteHistory($task_id)
	{
		$related_id = $this->getRelatedTaskID($task_id);

		$this->db->delete('tbl_service_key_check_asin_data', array('id'=>$related_id));
		$this->db->delete('tbl_service_key_check_data', array('asin_id'=>$related_id));
		$this->db->delete('tbl_task', array('id'=>$task_id));

		return 'success';
	}

	public function getRelatedTaskID($task_id)
	{
		$str_query = 'SELECT related_task_id FROM tbl_view_all_task WHERE id = \''.$task_id.'\'';

		$query = $this->db->query($str_query);

		$result = $query->row_array();
		return $result['related_task_id'];
	}

	public function getServiceInfo($service_name)
	{
		$this->db->select('*');
		$this->db->where('name', $service_name);
		return $this->db->get('tbl_service')->row_array();
	}

	public function insertCompleteData($arr)
	{
	    $this->db->insert('tbl_service_key_check_data', $arr);
	}

	public function checkKeyword($asin_id, $keyword)
	{
	    $result = $this->getDataInfo($asin_id);

	    if (in_array($keyword, explode(',', $result['keywords'])))
        {
            return true;
        }

		return false;
	}

	public function getSellerID($id)
	{
		$this->db->where('id', $id);
		$result = $this->db->get('tbl_service_key_check_asin_data')->row_array();

		return $result['seller_id'];
	}

    public function getStatus($task_id)
    {
        $str_query = 'SELECT status FROM tbl_task WHERE id = \''.$task_id.'\'';

        $query = $this->db->query($str_query);

        $result = $query->row_array();
        return $result['status'];
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
