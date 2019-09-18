<?php


class Service_reserve_search_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //used
    public function isExistAlready($client_id, $service_name, $postData)
    {
        $returnVal['status'] = 'NO';
        $service = $this->getServiceInfo($service_name);
        $service_id = $service['id'];

        $arr = array(
            'market_id' => $postData['market_id'],
            'client_id' => $client_id,
            'asin' => $postData['asin']
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

    public function startSearchKeyword($client_id, $service_name, $postData)
    {
        $service = $this->getServiceInfo($service_name);
        $service_id = $service['id'];

        $arr = array(
            'market_id' => $postData['market_id'],
            'client_id' => $client_id,
            'asin' => $postData['asin']
        );

        $this->db->insert('tbl_service_reverse_search_data', $arr);
        $related_task_id = $this->db->insert_id();

        $this->db->query("INSERT INTO `tbl_task` (`id`, `client_id`, `service_id`, `status`, `request_time`, `employee_id`, `start_time`, `end_time`, `related_task_id`, `market_id`) VALUES (NULL, '".$client_id."', '".$service_id."', 'pending', '".date('Y-m-d H:i:s')."', NULL, NULL, NULL, '".$related_task_id."', ".$postData['market_id'].");");

        return 'success';
    }

    public function insertCompleteData($arr)
    {
        $this->db->insert('tbl_service_reverse_search_complete', $arr);

        return $this->db->last_query();
    }

    //used
    public function getDataInfo($id)
    {
        $related_task_id = $this->getRelatedTaskID($id);

        $str_query = 'SELECT *
						FROM `tbl_service_reverse_search_complete`
						WHERE (task_id, phrase) IN (
							SELECT id, keyword
							FROM `tbl_service_reverse_search_data`
							WHERE id = ' .$related_task_id.'
						)';

        return $this->db->query($str_query)->row_array();
    }

    public function getReverseDataInfo($id)
    {
        $str_query = 'SELECT a.asin, b.name AS market
                        FROM tbl_service_reverse_search_data a
                        JOIN tbl_market b ON b.id=a.market_id
                        WHERE a.id='.$id;

        return $this->db->query($str_query)->row_array();
    }

    //used
    public function getData($id)
    {
        $related_task_id = $this->getRelatedTaskID($id);

        $str_query = 'SELECT a.asin, b.name as market
						FROM `tbl_service_reverse_search_data` a
						JOIN tbl_market b ON a.market_id=b.id
						WHERE a.id = '.$related_task_id;

        return $this->db->query($str_query)->row_array();
    }

    //used
    public function getKeywordSum($id)
    {
        $task_id = $this->getRelatedTaskID($id);

        $str_query = 'SELECT COALESCE(COUNT(a.id), 0) AS cnt_phrase, COALESCE(b.sponsored, 0) AS sum_sponsored, COALESCE(c.organic, 0) AS sum_organic, COALESCE(d.amz_recommended, 0) AS sum_amz_recommended
                        FROM tbl_service_reverse_search_complete a
                        LEFT JOIN(
                            SELECT task_id, COUNT(id) AS sponsored
                            FROM tbl_service_reverse_search_complete
                            WHERE sponsored=1
                            GROUP BY task_id
                        ) b ON a.task_id=b.task_id
                        LEFT JOIN(
                            SELECT task_id, COUNT(id) AS organic
                            FROM tbl_service_reverse_search_complete
                            WHERE organic=1
                            GROUP BY task_id
                        ) c ON a.task_id=c.task_id
                        LEFT JOIN(
                            SELECT task_id, COUNT(id) AS amz_recommended
                            FROM tbl_service_reverse_search_complete
                            WHERE amz_recommended=1
                            GROUP BY task_id
                        ) d ON a.task_id=d.task_id
                        WHERE a.task_id='.$task_id;

        return $this->db->query($str_query)->row_array();
    }

    //used
    public function getKeywordDetailInfo($postData)
    {
        $this->db->select('*');
        $this->db->where('task_id', $postData['keyword_id']);

        if (!empty($postData['search_min']))
            $this->db->where('search_volume>=', $postData['search_min']);

        if (!empty($postData['search_max']))
            $this->db->where('search_volume<=', $postData['search_max']);

        if (!empty($postData['pro_min']))
            $this->db->where('competing_product>=', $postData['pro_min']);

        if (!empty($postData['pro_max']))
            $this->db->where('competing_product<=', $postData['pro_max']);

        if (!empty($postData['score_min']))
            $this->db->where('iq_score>=', $postData['score_min']);

        if (!empty($postData['score_max']))
            $this->db->where('iq_score<=', $postData['score_max']);

        if (!empty($postData['organic_min']))
            $this->db->where('organic_rank>=', $postData['organic_min']);

        if (!empty($postData['organic_max']))
            $this->db->where('organic_rank<=', $postData['organic_max']);

        if (!empty($postData['amz_min']))
            $this->db->where('amz_recommended_rank>=', $postData['amz_min']);

        if (!empty($postData['amz_max']))
            $this->db->where('amz_recommended_rank<=', $postData['amz_max']);

        if (!empty($postData['sponsored_min']))
            $this->db->where('sponsored_rank>=', $postData['sponsored_min']);

        if (!empty($postData['sponsored_max']))
            $this->db->where('sponsored_rank<=', $postData['sponsored_max']);

        if (!empty($postData['in_keys']))
        {
            $arr = explode(',' ,$postData['in_keys']);
            $arr = array_map(function($val) { return trim($val); }, $arr);
            $arr = array_diff($arr, array(''));

            $this->db->group_start();
            for ($i=0; $i<count($arr); $i++)
            {
                $this->db->or_group_start();
                $this->db->like('phrase', $arr[$i].' ', 'after');
                $this->db->or_like('phrase', ' '.$arr[$i].' ', 'both');
                $this->db->or_like('phrase', ' '.$arr[$i], 'before');
                $this->db->or_like('phrase', $arr[$i], 'none');
                $this->db->group_end();
            }
            $this->db->group_end();
        }

        if (!empty($postData['ex_keys']))
        {
            $arr = explode(',' ,$postData['ex_keys']);
            $arr = array_map(function($val) { return trim($val); }, $arr);
            $arr = array_diff($arr, array(''));

            $this->db->group_start();
            for ($i=0; $i<count($arr); $i++)
            {
                $this->db->group_start();
                $this->db->not_like('phrase', $arr[$i].' ', 'after');
                $this->db->not_like('phrase', ' '.$arr[$i].' ', 'both');
                $this->db->not_like('phrase', ' '.$arr[$i], 'before');
                $this->db->not_like('phrase', $arr[$i], 'none');
                $this->db->group_end();
            }
            $this->db->group_end();
        }

        if (!empty($postData['match_type']))
        {
            if (strpos($postData['match_type'],'Organic Keyword')!== false)
                $this->db->where('organic', 1);

            if (strpos($postData['match_type'],'Sponsored Keyword')!== false)
                $this->db->where('sponsored', 1);

            if (strpos($postData['match_type'],'Amazon Recommended keywords')!== false)
                $this->db->where('amz_recommended', 1);
        }

        return $this->db->get('tbl_service_reverse_search_complete')->result_array();
    }

    //used
    public function getHistory($client_name)
    {
        $service = $this->getServiceInfo('Reverse ASIN Search');
        $service_id = $service['id'];

        $str_query = 'SELECT a.id, a.market_place, b.asin, a.status, a.request_time
						FROM tbl_view_all_task a
						JOIN tbl_service_reverse_search_data b ON b.id = a.`related_task_id` 
						WHERE a.client_name = \''.$client_name.'\' AND a.service_id = '.$service_id.'
						ORDER BY a.id ASC';

        return $this->db->query($str_query)->result_array();
    }

    //used
    public function deleteHistory($task_id)
    {
        $related_id = $this->getRelatedTaskID($task_id);

        $this->db->delete('tbl_service_reverse_search_data', array('id'=>$related_id));
        $this->db->delete('tbl_service_reverse_search_complete', array('asin_id'=>$related_id));
        $this->db->delete('tbl_task', array('id'=>$task_id));

        return 'success';
    }

    //used
    public function getRelatedTaskID($task_id)
    {
        $str_query = 'SELECT related_task_id FROM tbl_view_all_task WHERE id = \''.$task_id.'\'';

        $query = $this->db->query($str_query);

        $result = $query->row_array();
        return $result['related_task_id'];
    }

    //used
    public function getServiceInfo($service_name)
    {
        $this->db->select('*');
        $this->db->where('name', $service_name);
        return $this->db->get('tbl_service')->row_array();
    }

    //used
    public function getMarketName($key_id)
    {
        $str_query = 'SELECT b.name 
						FROM tbl_service_reverse_search_data a
						JOIN tbl_market b ON a.market_id = b.id
						WHERE a.id = '.$key_id;

        $result = $this->db->query($str_query)->row_array();
        return $result['name'];
    }

    //used
    public function getAsin($key_id)
    {
        $str_query = 'SELECT asin 
						FROM tbl_service_reverse_search_data
						WHERE id = '.$key_id;

        $result = $this->db->query($str_query)->row_array();
        return $result['asin'];
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
