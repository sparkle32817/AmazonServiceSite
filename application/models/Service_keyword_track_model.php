<?php


class Service_keyword_track_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function addProduct($client_id, $postData)
    {

        $service = $this->getServiceInfo('Keyword Rank Tracking');

        $arr = array(
            'asin_num'=>$postData['asin'],
            'market_id'=>$postData['market_id'],
            'client_id'=>$client_id,
            'exist_status'=>1
        );

        $result = $this->db->select('*')->get_where('tbl_service_tracking_asin', $arr);
        if ($result->num_rows()>0)                                                              //if already registered.
        {
            return 'already';
        }

        $arr['date_last_updated'] = date('Y-m-d H:i:s');

        $this->db->insert('tbl_service_tracking_asin', $arr);         //First register new Product(ASIN).
        $new_asin_id = $this->db->insert_id();
        $this->db->query("INSERT INTO `tbl_task` (`id`, `client_id`, `service_id`, `status`, `request_time`, `employee_id`, `start_time`, `end_time`, `related_task_id`, `market_id`) VALUES (NULL, '".$client_id."', '".$service['id']."', 'pending', '".date('Y-m-d H:i:s')."', NULL, NULL, NULL, '".$new_asin_id."', ".$postData['market_id'].");");

        if ($this->db->affected_rows()==0)
            return 'fail1';

        foreach ($this->removeDuplicatedKeyword($postData['keywords']) as  $keyword)
        {
            $keyword = trim($keyword);
            if (empty($keyword))
                continue;

            $arr = array();

            $arr['asin_id'] = $new_asin_id;
            $arr['keyword'] = $keyword;
            $arr['date_last_updated'] = date('Y-m-d H:i:s');
            $arr['is_last'] = 1;
            $arr['exist_status'] = 1;

            $str_sql1 = 'SELECT *
                            FROM tbl_view_asin_track
                            WHERE asin_num = \''.$postData['asin'].'\' AND keyword = \''.$keyword.'\' AND (asin_num, keyword, date_last_updated) IN (
                                SELECT asin_num, keyword, MAX(date_last_updated)
                                FROM tbl_view_asin_track
                                GROUP BY asin_num, keyword
                            )';

            $result1 = $this->db->query($str_sql1);
            if ($result1->num_rows()>0)                                                              //If ASIN and keyword both are same before...
            {
                $result2 = $result1->row_array();

                $arr['exact_search_volume'] = $result2['exact_search_volume'];
                $arr['broad_search_volume'] = $result2['broad_search_volume'];
                $arr['competing_product'] = $result2['competing_product'];
                $arr['rank'] = $result2['rank'];
            }
            else
            {
                $str_sql2 = 'SELECT *
                            FROM tbl_view_asin_track
                            WHERE keyword = \''.$keyword.'\' AND (keyword, date_last_updated) IN (
                                SELECT keyword, MAX(date_last_updated)
                                FROM tbl_view_asin_track
                                GROUP BY keyword
                            )';

                $result3 = $this->db->query($str_sql2);
                if ($result3->num_rows()>0)                                                              //If ASIN is different and keyword is same before...
                {
                    $result4 = $result3->row_array();

                    $arr['exact_search_volume'] = $result4['exact_search_volume'];
                    $arr['broad_search_volume'] = $result4['broad_search_volume'];
                    $arr['competing_product'] = $result4['competing_product'];
                }

            }

            $this->db->insert('tbl_service_tracking_detail', $arr);
            if ($this->db->affected_rows()==0)
                return 'fail2';

        }

        return 'success';
    }

    public function deleteAsinInfo($client_id, $asin_id)
    {
        $this->db->where(array('asin_id'=>$asin_id, 'is_last'=>1));
        $this->db->group_start();
        $this->db->where('exist_status', 1);
        $this->db->or_where('exist_status', 2);
        $this->db->group_end();
        $this->db->update('tbl_service_tracking_detail', array('exist_status'=>0, 'is_last'=>0));

        $this->db->where('id', $asin_id);
        $this->db->update('tbl_service_tracking_asin', array('exist_status'=>-1));
    }

    public function getAllAsinTrackInfo($client_id)
    {
        $str_today_start = date('Y-m-d 00:00:00');
        $str_today_end   = date('Y-m-d 23:59:59');

        $str_yester_start = date('Y-m-d 00:00:00', strtotime("-1 days"));
        $str_yester_end   = date('Y-m-d 23:59:59', strtotime("-1 days"));

        $str_query = 'SELECT n.*, (n.key_10-COALESCE(o.key_10,0)) AS key_10_sub, (n.key_50-COALESCE(o.key_50,0)) AS key_50_sub
                        FROM(
                            SELECT a.*, COALESCE(key_10, 0)  AS key_10 , COALESCE(exact_10, 0)  AS exact_10, COALESCE(broad_10, 0)  AS broad_10, COALESCE(key_50, 0)  AS key_50, COALESCE(exact_50, 0)  AS exact_50, COALESCE(broad_50, 0)  AS broad_50  
                            FROM (
                            SELECT id, client_id, asin_id, asin_num, market_url, country_code, COUNT(id) AS cnt 
                            FROM tbl_view_asin_track
                            WHERE (exist_status=1 OR exist_status=2) AND is_last=1 
                            GROUP BY client_id, asin_id 
                            ) a 
                            LEFT JOIN (
                            SELECT asin_id, COUNT(keyword) AS key_10, SUM(exact_search_volume) AS exact_10, SUM(broad_search_volume) AS broad_10 
                            FROM tbl_view_asin_track 
                            WHERE rank<11 AND rank IS NOT NULL AND rank!=0 AND date_last_updated BETWEEN \'2019-09-24 00:00:00\' AND \'2019-09-24 23:59:59\'
                            GROUP BY client_id, asin_id 
                            ) b ON b.asin_id = a.asin_id 
                            LEFT JOIN (
                            SELECT asin_id, COUNT(keyword) AS key_50, SUM(exact_search_volume) AS exact_50, SUM(broad_search_volume) AS broad_50 
                            FROM tbl_view_asin_track 
                            WHERE rank<51 AND rank IS NOT NULL AND rank!=0 AND date_last_updated BETWEEN \'2019-09-24 00:00:00\' AND \'2019-09-24 23:59:59\'
                            GROUP BY client_id, asin_id 
                            ) c ON c.asin_id = a.asin_id
                        ) n
                        LEFT JOIN(
                            SELECT a.*, COALESCE(key_10, 0)  AS key_10, COALESCE(key_50, 0)  AS key_50
                            FROM (
                            SELECT asin_id, asin_num, market_url
                            FROM tbl_view_asin_track
                            WHERE (exist_status=1 OR exist_status=2) AND is_last!=1 
                            GROUP BY client_id, asin_id 
                            ) a 
                            LEFT JOIN (
                            SELECT asin_id, COUNT(keyword) AS key_10 
                            FROM tbl_view_asin_track 
                            WHERE rank<11 AND rank IS NOT NULL AND rank!=0 AND date_last_updated BETWEEN \'2019-09-23 00:00:00\' AND \'2019-09-23 23:59:59\'
                            GROUP BY client_id, asin_id 
                            ) b ON b.asin_id = a.asin_id 
                            LEFT JOIN (
                            SELECT asin_id, COUNT(keyword) AS key_50 
                            FROM tbl_view_asin_track 
                            WHERE rank<51 AND rank IS NOT NULL AND rank!=0 AND date_last_updated BETWEEN \'2019-09-23 00:00:00\' AND \'2019-09-23 23:59:59\'
                            GROUP BY client_id, asin_id 
                            ) c ON c.asin_id = a.asin_id
                        ) o ON n.asin_num = o.asin_num AND o.market_url = n.market_url
						WHERE n.client_id = '.$client_id.'
                        ORDER BY n.asin_id ASC';

        $result = $this->db->query($str_query);

        if ($result->num_rows()>0)
            return $result->result_array();

        return array();
    }

    public function getAsinTrackingInfo($asin_id)
    {
        $str_query = 'SELECT @n := @n + 1 num, id, keyword, COALESCE(exact_search_volume, \'-\') AS exact, COALESCE(broad_search_volume, \'-\') AS  broad, COALESCE(competing_product, \'-\') AS competing, COALESCE(`rank`, \'-\') AS rank 
                        FROM tbl_service_tracking_detail, (SELECT @n := 0) m
                        WHERE asin_id='.$asin_id.' AND (exist_status=1 OR exist_status=2) AND is_last=1';

        $result = $this->db->query($str_query);

        return $result->result_array();

    }

    public function getAsinInfo($asin_id)
    {
        $str_query = 'SELECT asin_id as id, asin_num, market_url as market, country_code AS flag, COUNT(id) AS cnt
                        FROM tbl_view_asin_track
                        WHERE asin_id = '.$asin_id.'  AND is_last = 1
                        GROUP BY asin_id';

        return $this->db->query($str_query)->row_array();
    }

    public function getKeywordInfo($id)
    {
        $str_query = 'SELECT id, keyword, country_code, asin_num, asin_id
                        FROM tbl_view_asin_track 
                        WHERE id = '.$id.' and exist_status = 1';

        return $this->db->query($str_query)->row_array();
    }

    public function getKeywords($asin_id)
    {
        $this->db->select('*');
        $this->db->where(array('asin_id'=>$asin_id, 'is_last'=>1));
        $this->db->group_start();
        $this->db->where('exist_status', 1);
        $this->db->or_where('exist_status', 2);
        $this->db->group_end();
        $this->db->group_by('keyword');
        return $this->db->get('tbl_view_asin_track')->result_array();
    }

    public function getTrackingKeywordNum($client_id)
    {
        $str_query = 'SELECT COALESCE(COUNT(*), 0) AS `count`
                        FROM tbl_view_asin_track
                        WHERE is_last=1 AND (exist_status=1 OR exist_status=2) AND client_id='.$client_id;

        return $this->db->query($str_query)->row_array();
    }

    public function getSignedUpKeywordNum($client_id)
    {
        $str_query = 'SELECT COALESCE(COUNT(*), 0) AS `count`
                        FROM tbl_view_asin_track
                        WHERE client_id = '.$client_id;

        return $this->db->query($str_query)->row_array();
    }

    public function addKeywords($client_id, $postData)
    {
        $asin_info = $this->db->where('id', $postData['asin_id'])->get('tbl_service_tracking_asin')->row_array();
        $asin_num = $asin_info['asin_num'];

        foreach ($this->removeDuplicatedKeyword($postData['keywords']) as  $keyword)
        {
            $keyword = trim($keyword);
            if (!empty($keyword))
            {
                $arr = array(
                    'client_id'=>$client_id,
                    'asin_id'=>$postData['asin_id'],
                    'keyword'=>$keyword,
//                    'is_last'=>1
                );

                $result = $this->db->get_where('tbl_view_asin_track', $arr);
                if ($result->num_rows()==0)                                                 //If keyword doesn't exist already in product..
                {
                    $arr1 = array();

                    $arr1['asin_id'] = $postData['asin_id'];
                    $arr1['keyword'] = $keyword;
                    $arr1['date_last_updated'] = date('Y-m-d H:i:s');
                    $arr1['is_last'] = 1;
                    $arr1['exist_status'] = 2;

                    $str_sql1 = 'SELECT *
                                    FROM tbl_view_asin_track
                                    WHERE asin_num = \''.$asin_num.'\' AND keyword = \''.$keyword.'\' AND (asin_num, keyword, date_last_updated) IN (
                                        SELECT asin_num, keyword, MAX(date_last_updated)
                                        FROM tbl_view_asin_track
                                        GROUP BY asin_num, keyword
                                    )';

                    $result1 = $this->db->query($str_sql1)->row_array();                    //Get most recent uploaded keyword data(whole data).
                    if (!empty($result1))
                    {
                        $arr1['exact_search_volume'] = $result1['exact_search_volume'];
                        $arr1['broad_search_volume'] = $result1['broad_search_volume'];
                        $arr1['competing_product'] = $result1['competing_product'];
                        $arr1['rank'] = $result1['rank'];
                    }
                    else
                    {
                        $str_sql2 = 'SELECT *
                                        FROM tbl_view_asin_track
                                        WHERE keyword = \''.$keyword.'\' AND (keyword, date_last_updated) IN (
                                            SELECT keyword, MAX(date_last_updated)
                                            FROM tbl_view_asin_track
                                            GROUP BY keyword
                                        )';

                        $result2 = $this->db->query($str_sql2)->row_array();                //Get most recent uploaded keyword data(some data).
                        if (!empty($result2))
                        {
                            $arr1['exact_search_volume'] = $result2['exact_search_volume'];
                            $arr1['broad_search_volume'] = $result2['broad_search_volume'];
                            $arr1['competing_product'] = $result2['competing_product'];
                        }
                    }

                    if (!$this->db->insert('tbl_service_tracking_detail', $arr1))
                        return 'fail';
                }
                else
                {
                    $result = $result->row_array();
                    if ($result['exist_status'] == 0 || $result['exist_status'] == -1)
                    {
                        $this->db->where('id', $result['id']);
                        $this->db->update('tbl_service_tracking_detail', array('exist_status'=>2, 'is_last'=>1));
                    }
                }
            }
        }

        return 'success';
    }

    public function editKeywords($client_id, $postData)
    {
        $asin_id = $postData['asin_id'];
        $keywords = $postData['keywords'];

        $this->db->select('keyword');
        $this->db->where('asin_id', $asin_id);
        $results = $this->db->get('tbl_service_tracking_detail')->result_array();

        $arr_remove = array();
        foreach ($results as $result) {
            if (in_array($result['keyword'], $keywords))
            {
                array_push($arr_remove, $result['keyword']);
            }
            else
            {
                $this->db->where(array('asin_id'=>$asin_id, 'keyword'=>$result['keyword']));
                $this->db->update('tbl_service_tracking_detail', array('is_last'=>0, 'exist_status'=>-1));
            }
        }
        $keywords = array_diff($keywords, $arr_remove);

        return $this->addKeywords($client_id, array('asin_id'=>$asin_id, 'keywords'=>$keywords));
    }

    public function deleteKeyword($id)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_service_tracking_detail', array('is_last'=>0, 'exist_status'=>-1));

        return 'success';
    }

    public function getTrackedKeywordPercentage($client_id, $asin_num, $market_url)
    {
        $str_query = 'SELECT asin_num, client_id, COALESCE(cnt, 0) AS cnt, COALESCE(total_cnt, 0) AS total_cnt
                        FROM(
                            SELECT asin_id, client_id, asin_num, market_url, COUNT(*) AS total_cnt
                            FROM tbl_view_asin_track
                            WHERE is_last=1 AND (exist_status=1 OR exist_status=2)
                            GROUP BY asin_num, client_id, market_url
                        ) a
                        LEFT JOIN (
                            SELECT asin_id, COUNT(asin_id) AS cnt
                            FROM tbl_view_asin_track
                            WHERE rank<51 AND rank!=0 AND is_last=1 AND (exist_status=1 OR exist_status=2)
                            GROUP BY asin_num, client_id, market_url
                        ) b ON a.asin_id = b.asin_id
                        WHERE asin_num=\''.$asin_num.'\' AND market_url=\''.$market_url.'\' AND client_id='.$client_id ;

        $result = $this->db->query($str_query);

        if ($result->num_rows()>0)
            return $result->result_array();

        return false;
    }

    public function getChartData($client_id, $asin_num, $market_url, $start, $end)
    {

        $str_query = 'SELECT asin_id, COUNT(asin_id) AS cnt 
						FROM tbl_view_asin_track
						WHERE asin_num=\''.$asin_num.'\' AND market_url=\''.$market_url.'\' AND rank<51 AND rank!=0 AND client_id='.$client_id.' AND date_last_updated BETWEEN \''.$start.'\' AND \''.$end.'\'
						GROUP BY client_id, asin_num, market_url';

        $result = $this->db->query($str_query);
//return $this->db->last_query();
        return $result->row_array();
    }

    public function getHistoryChartData($client_id, $asin_id, $start, $end)
    {
        $result = $this->db->where('asin_id', $asin_id)->get('tbl_view_asin_track')->row_array();

        $str_query = 'SELECT a.asin_id, COALESCE(b.top_10,0) AS top_10, a.top_50
						FROM(
							SELECT COUNT(*) AS top_50, asin_id
							FROM tbl_view_asin_track
							WHERE asin_num = '.$result['asin_num'].' AND market_url = \''.$result['market_url'].'\' AND rank<51 AND rank!=0 AND date_last_updated BETWEEN \''.$start.'\' AND \''.$end.'\'
							) a
						LEFT JOIN (
							SELECT COUNT(*) AS top_10, asin_id
							FROM tbl_view_asin_track
							WHERE asin_num = '.$result['asin_num'].' AND market_url = \''.$result['market_url'].'\' AND rank<11 AND rank!=0 AND date_last_updated BETWEEN \''.$start.'\' AND \''.$end.'\'
							) b
						ON a.asin_id = b.asin_id';

        $result = $this->db->query($str_query);

        if ($result->num_rows()>0)
            return $result->row_array();

        return false;
    }

    public function getKeyHistoryChartData($keyword, $asin_id, $start, $end)
    {
        $result = $this->db->where('asin_id', $asin_id)->get('tbl_view_asin_track')->row_array();

        $str_query = 'SELECT AVG(rank) AS rank 
						FROM tbl_view_asin_track
						WHERE asin_num = '.$result['asin_num'].' AND market_url = \''.$result['market_url'].'\' AND keyword = \''.$keyword.'\' AND date_last_updated BETWEEN \''.$start.'\' AND \''.$end.'\'';

        $result = $this->db->query($str_query);

        if ($result->num_rows()>0)
            return $result->row_array();

        return false;
    }

    public function getTrendData($id, $offset)
    {
        $start = date('Y-m-d 00:00:00', strtotime($offset.' days'));
        $end   = date('Y-m-d 23:59:59', strtotime($offset.' days'));

        $str_query = 'SELECT rank 
                        FROM tbl_view_asin_track 
                        WHERE date_last_updated BETWEEN \''.$start.'\' AND \''.$end.'\' AND (keyword, asin_num) IN (
                            SELECT keyword, asin_num
                            FROM tbl_view_asin_track
                            WHERE id='.$id.'
                        )
                        ORDER BY date_last_updated DESC LIMIT 1';

        $result =  $this->db->query($str_query);
        if ($result->num_rows()>0)
        {
            $result = $result->row_array();
            return $result['rank'];
        }
        else
            return null;
    }

    public function getServiceInfo($service_name)
    {
        $this->db->select('*');
        $this->db->where('name', $service_name);
        return $this->db->get('tbl_service')->row_array();
    }

    public function getTodayTopAsinNum($client_id)
    {
        $start_today = date('Y-m-d 00:00:00');
        $end_today = date('Y-m-d 23:59:59');
        $str_query = 'SELECT asin_id, asin_num, market_url, COUNT(*) AS cnt
                        FROM tbl_view_asin_track
                        WHERE (exist_status=1 OR exist_status=2) AND is_last=1 AND client_id='.$client_id.' /*AND (date_last_updated BETWEEN \''.$start_today.'\' AND \''.$end_today.'\')*/ 
                        GROUP BY client_id, asin_num, market_url
                        ORDER BY asin_id
                        LIMIT 0, 5';

        $result = $this->db->query($str_query);

        return $result->result_array();

    }

    //Employee Side
    public function getAsinDataInfo($id)
    {
        $this->db->select('a.*, b.name as market_url');
        $this->db->from('tbl_service_tracking_asin a');
        $this->db->join('tbl_market b', 'b.id=a.market_id');
        $this->db->where('a.id', $id);
        return $this->db->get()->row_array();
    }

    public function checkExistingData($asin_id)
    {
        $this->db->where('id', $asin_id);
        $this->db->where('exist_status', 1);
        if ($this->db->get('tbl_service_tracking_asin')->num_rows()>0)
        {
            return true;
        }

        return false;
    }

    public function checkContent($result)
    {
        if ($result['status']!='pending')
            return true;

        if ($result['status']=='working')
        {
            $res = $this->db->where('id', $result['related_task_id'])
                ->get('tbl_service_tracking_asin')
                ->row_array();

            if ($res['exist_status'] == 0)
                return false;
        }

        $this->db->where('asin_id', $result['related_task_id']);
        $this->db->group_start();
        $this->db->where('exist_status', 1);
        $this->db->or_where('exist_status', 2);
        $this->db->group_end();
        $res = $this->db->get('tbl_service_tracking_detail');
        if ($res->num_rows()>0)
            return true;

        return false;
    }

    public function checkKeyword($task_id, $keyword)
    {
//        $this->db->where('asin_id');
        $result = $this->db->get_where('tbl_view_asin_track', array('asin_id'=>$this->getRelatedTaskID($task_id), 'keyword'=>$keyword));
//return $this->db->last_query();
        if ($result->num_rows()>0)
        {
            return $result->row_array();
        }

        return false;
    }

    public function getExistStatus($id)
    {
        $res = $this->db->select('exist_status')->from('tbl_service_tracking_asin')->where('id', $id)->get()->row_array();

        return $res['exist_status'];
    }

    public function getPendingKeywords($id)
    {
        $this->db->select('keyword');
        $this->db->from('tbl_service_tracking_detail');
        $this->db->where('asin_id', $id);
        $this->db->where('is_last', 1);
        return $this->db->get()->result_array();
    }

    public function getCompletedKeywords($id)
    {
        $this->db->select('keyword');
        $this->db->from('tbl_service_tracking_detail');
        $this->db->where('asin_id', $id);
        $this->db->group_start();
        $this->db->where('exist_status', 1);
        $this->db->or_where('exist_status', 2);
        $this->db->group_end();
        return $this->db->get()->result_array();
    }

    public function getWorkingKeywords($id)
    {
        $this->db->select('keyword');
        $this->db->from('tbl_service_tracking_detail');
        $this->db->where('asin_id', $id);
        $this->db->where('is_last', 1);
        $this->db->where('exist_status', 1);
        return $this->db->get()->result_array();
    }

    public function getAddedKeywords($id)
    {
        $this->db->select('keyword');
        $this->db->from('tbl_service_tracking_detail');
        $this->db->where('asin_id', $id);
        $this->db->where('is_last', 1);
        $this->db->where('exist_status', 2);
        return $this->db->get()->result_array();
    }

    public function getDeletedKeywords($id)
    {
        $this->db->select('keyword');
        $this->db->from('tbl_service_tracking_detail');
        $this->db->where('asin_id', $id);
        $this->db->where('is_last', 0);
        $this->db->where('exist_status', -1);
        return $this->db->get()->result_array();
    }

    public function insertCompleteData($task_id, $arr)
    {
        $this->db->update('tbl_service_tracking_detail', $arr, array('asin_id'=>$this->getRelatedTaskID($task_id), 'keyword'=>$arr['keyword']));

        return $this->db->last_query();
    }

    public function getRelatedTaskID($task_id)
    {
        $str_query = 'SELECT related_task_id FROM tbl_task WHERE id = \''.$task_id.'\'';
        $query = $this->db->query($str_query);

        $result = $query->row_array();
        return $result['related_task_id'];
    }

    function removeDuplicatedKeyword($keywords)
    {
        $arr = array();

        foreach ($keywords as $keyword) {

            if (!in_array($keyword, $arr) && !empty($keyword))
            {
                array_push($arr, $keyword);
            }
        }

        return $arr;
    }

    public function generateAutoNewTicket()
    {
        $service = $this->getServiceInfo('Keyword Rank Tracking');

        $this->db->where('exist_status', 1);
        $this->db->where('is_last', 1);
        $results = $this->db->get('tbl_service_tracking_asin')->result_array();

        foreach ($results as $result)
        {
            //update previous task status = 0.
            $this->db->where('id', $result['id']);
            $this->db->update('tbl_service_tracking_asin', array('is_last' => 0));

            //generate new task in asin table.
            $arr = array(
                'asin_num' => $result['asin_num'],
                'client_id' => $result['client_id'],
                'market_id' => $result['market_id'],
                'date_last_updated' => date('Y-m-d H:i:s'),
                'exist_status' => 1,
                'is_last' => 1
            );
            $this->db->insert('tbl_service_tracking_asin', $arr);
            $new_asin_id = $this->db->insert_id();

            //copy keywords to new
            $this->db->where(array('asin_id'=>$result['id'], 'is_last'=>1));
            $this->db->group_start();
            $this->db->where('exist_status', 1);
            $this->db->or_where('exist_status', 2);
            $this->db->group_end();
            $result_keywords = $this->db->get('tbl_service_tracking_detail')->result_array();
            foreach ($result_keywords as $keyword)
            {
                //previous keyword is_last = 0
                $this->db->where('id', $keyword['id']);
                $this->db->update('tbl_service_tracking_detail', array('is_last'=>0));

                $keyword = array_diff($keyword, array($keyword['id']));
                $keyword['asin_id'] = $new_asin_id;
                $keyword['exist_status'] = 1;
                $keyword['date_last_updated'] = date('Y-m-d H:i:s');
                $this->db->insert('tbl_service_tracking_detail', $keyword);
            }

            //task update
            $this->db->where('service_id', $service['id']);
            $this->db->where('related_task_id', $result['id']);
            $result1 = $this->db->get('tbl_task')->row_array();

            if ($result1['status'] == 'complete')
            {
                $this->db->query("INSERT INTO `tbl_task` (`id`, `client_id`, `service_id`, `status`, `request_time`, `employee_id`, `start_time`, `end_time`, `related_task_id`, `market_id`)
                                    VALUES (NULL, '".$result1['client_id']."', '".$service['id']."', 'pending', '".date('Y-m-d H:i:s')."', NULL, NULL, NULL, '".$new_asin_id."', ".$result1['market_id'].");");
            }
            else
            {
                $this->db->where('id', $result1['id']);
                $this->db->update('tbl_task', array('related_task_id'=>$new_asin_id));
            }

        }
    }
}