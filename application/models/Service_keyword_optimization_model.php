<?php


class Service_keyword_optimization_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getHistory($client_name)
    {
        $str_query = 'SELECT a.id, a.market_place, b.asin, a.status, a.request_time
						FROM tbl_view_all_task a
						JOIN `tbl_service_optimization_asin_data` b ON b.id = a.`related_task_id` 
						WHERE a.client_name = \''.$client_name.'\' AND a.service_id = 13
						ORDER BY a.id ASC';

        return $this->db->query($str_query)->result_array();
    }

    public function isExistAlready($client_id, $service_name, $postData)
    {
        $returnVal['status'] = 'NO';
        $service = $this->getServiceInfo($service_name);
        $service_id = $service['id'];

        $arr_keywords = array();

        foreach ($postData['keywords'] as  $keyword)
        {
            $keyword = trim($keyword);

            if (!empty($keyword))
            {
                array_push($arr_keywords, $keyword);
            }
        }

        $arr = array(
            'market_id' => $postData['market_id'],
            'asin' => $postData['asin'],
            'client_id' => $client_id,
            'keywords' => implode(",", $arr_keywords),
            'search_type' => $postData['search_type']
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

    public function startFindKeyword($client_id, $service, $postData)
    {
        $service = $this->getServiceInfo($service);
        $service_id = $service['id'];

        $arr_keywords = array();

        foreach ($postData['keywords'] as  $keyword)
        {
            $keyword = trim($keyword);

            if (!empty($keyword))
            {
                array_push($arr_keywords, $keyword);
            }
        }

        $arr = array(
            'market_id' => $postData['market_id'],
            'asin' => $postData['asin'],
            'client_id' => $client_id,
            'keywords' => implode(",", $arr_keywords),
            'search_type' => $postData['search_type']
        );

        $this->db->insert('tbl_service_optimization_asin_data', $arr);
        $asin_id = $this->db->insert_id();

        $this->db->query("INSERT INTO `tbl_task` (`id`, `client_id`, `service_id`, `status`, `request_time`, `employee_id`, `start_time`, `end_time`, `related_task_id`, `market_id`) VALUES (NULL, '".$client_id."', '".$service_id."', 'pending', '".date('Y-m-d H:i:s')."', NULL, NULL, NULL, '".$asin_id."', ".$postData['market_id'].");");

        return 'success';
    }

    public function getInputData($task_id)
    {
        $str_query = 'SELECT b.market_place as market, a.asin, a.keywords, a.search_type
						FROM `tbl_service_optimization_asin_data` a
						JOIN `tbl_view_all_task` b ON b.related_task_id=a.id
						WHERE b.id = '.$task_id;

        $result = $this->db->query($str_query)->row_array();

        return $result;
    }

    public function getSearchedData($task_id)
    {
        $related_task_id = $this->getRelatedTaskID($task_id);

        $str_query = 'SELECT b.*, a.search_type
						FROM `tbl_service_optimization_asin_data` a
						JOIN `tbl_service_optimization_data` b ON b.asin_id=a.id
						WHERE a.id = '.$related_task_id;

        $result = $this->db->query($str_query)->row_array();

        return $result;
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

    public function getStatus($task_id)
    {
        $str_query = 'SELECT status FROM tbl_task WHERE id = \''.$task_id.'\'';

        $query = $this->db->query($str_query);

        $result = $query->row_array();
        return $result['status'];
    }

    //Employee Side
    public function completeTask($postData)
    {
        $id = $this->getRelatedTaskID($postData['task_id']);

        $arr_keywords = array();

        foreach ($_POST['keywords'] as  $keyword)
        {
            $keyword = trim($keyword);

            if (!empty($keyword))
            {
                array_push($arr_keywords, $keyword);
            }
        }

        $arr = array(
            'asin_id'=> $id,
            'search_term' => $postData['search_term'],
            'subject1' => $postData['subject1'],
            'subject2' => $postData['subject2'],
            'subject3' => $postData['subject3'],
            'subject4' => $postData['subject4'],
            'subject5' => $postData['subject5'],
            'keywords' => implode(',', $arr_keywords)
        );

        if ($this->db->insert('tbl_service_optimization_data', $arr))
            return 'success';

        return 'fail';
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
