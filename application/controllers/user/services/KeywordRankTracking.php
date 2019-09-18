<?php


class KeywordRankTracking extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'Client_model');
        $this->load->model('Service_keyword_track_model', 'KeyTrack_model');
    }

    public function index()
    {
        if (!$this->session->userdata('client_logged_in')) {
            redirect('login');
        }

        $client_name = $this->session->userdata('client_logged_in');
        $client_id = $this->Client_model->getUserId($client_name);
        $header_data['username'] = $client_name;
        $header_data['user_avatar'] = $this->Client_model->getUserAvatar($client_name);
        $data['markets'] = $this->Client_model->getMarkets();
        $data['tracking_num'] = $this->KeyTrack_model->getTrackingKeywordNum($client_id);
        $data['signed_up_num'] = $this->KeyTrack_model->getSignedUpKeywordNum($client_id);

        $data['nums'] = array();
        $today_asin_num = $this->KeyTrack_model->getTodayTopAsinNum($client_id);
        foreach ($today_asin_num as $asin_num)
        {
            $data['nums'][] = $this->KeyTrack_model->getTrackedKeywordPercentage($client_id, $asin_num['asin_num']);
        }

        $this->load->view('user/common/header', $header_data);
        $this->load->view('user/services/keyword_rank_tracking', $data);
        $this->load->view('user/common/footer');
    }

    public function createNewProduct()
    {
        $client_name = $this->session->userdata('client_logged_in');
        $postData = $this->input->post();
        $result = $this->KeyTrack_model->addProduct($this->Client_model->getUserId($client_name), $postData);

        echo $result;
    }

    public function getAllAsinInfo()
    {

        $client_id = $this->Client_model->getUserId($this->session->userdata('client_logged_in'));
        $result1 = $this->KeyTrack_model->getAllAsinTrackInfo($client_id);

        $result = array();
        foreach ($result1 as $res1)
        {
            $res_product['id'] = $res1['asin_id'];
            $res_product['asin'] = $res1['asin_num'];
            $res_product['market_url'] = $res1['market_url'];
            $res_product['flag'] = $res1['country_code'];
            $res_product['tracked_count'] = !empty($res1['cnt'])?$res1['cnt']:'0';

            $res_overview['key_10'] = $res1['key_10'];
            $res_overview['key_10_sub'] = $res1['key_10_sub'];
            if ($res_overview['key_10_sub']==0)
            {
                $res_overview['key_10_sub'] = '';
                $res_overview['key_10_sub_color'] = 'white';
            }elseif ($res_overview['key_10_sub']>0)
            {
                $res_overview['key_10_sub'] = '+'.$res_overview['key_10_sub'];
                $res_overview['key_10_sub_color'] = 'green';
            }
            else
                $res_overview['key_10_sub_color'] = 'red';

            $res_overview['exact_10'] = $res1['exact_10'];
            $res_overview['broad_10'] = $res1['broad_10'];

            $res_overview['key_50'] = $res1['key_50'];
            $res_overview['key_50_sub'] = $res1['key_50_sub'];
            if ($res_overview['key_50_sub']==0)
            {
                $res_overview['key_50_sub'] = '';
                $res_overview['key_50_sub_color'] = 'white';
            }elseif ($res_overview['key_50_sub']>0)
            {
                $res_overview['key_50_sub'] = '+'.$res_overview['key_50_sub'];
                $res_overview['key_50_sub_color'] = 'green';
            }
            else
                $res_overview['key_50_sub_color'] = 'red';

            $res_overview['exact_50'] = $res1['exact_50'];
            $res_overview['broad_50'] = $res1['broad_50'];

            $arr = array('id'=>$res1['asin_id'], 'product'=>$res_product, 'overview'=>$res_overview);

            $result[] = $arr ;
        }

        echo json_encode(array('data'=>$result));
    }

    public function getIndividualAsinInfo()
    {
        $postData = $this->input->post();
        $asin_id = $postData['asin_id'];
        $results = $this->KeyTrack_model->getAsinTrackingInfo($asin_id);

        $result = array();
        foreach ($results as $res)
        {
            $labels = array();
            $data = array();
            for ($offset=-6; $offset<=0; $offset++)
            {
                $date = date('Y-m-d', strtotime($offset.' days'));
                $rank = $this->KeyTrack_model->getTrendData($res['id'], $offset);

                array_push($labels, $date);
                array_push($data, $rank);
            }

            $result[] = array(
                'num' => $res['num'],
                'keyword' => $res['keyword'],
                'exact' => $res['exact'],
                'broad' => $res['broad'],
                'competing' => $res['competing'],
                'rank' => $res['rank'],
                'trend' => array(
                    'labels' => $labels,
                    'datasets' => array(
                        array(
                            'data' => $data,
                            'label' => 'rank',
                            'borderColor' => '#3e95cd',
                            'fill' => true
                        )
                    )
                ),
                'key_id' => array(
                    'keyword' => $res['keyword'],
                    'id' => $res['id']
                )
            );
        }

        echo json_encode(array('data'=>$result));
    }

    public function getAsinInfo()
    {
        $postData = $this->input->post();
        $asin_id = $postData['asin_id'];
//        $client_id = $this->Client_model->getUserId($this->session->userdata('client_logged_in'));
        $res = $this->KeyTrack_model->getAsinInfo($asin_id);

        $result['id'] = $res['id'];
        $result['asin_num'] = $res['asin_num'];
        $result['market'] = $res['market'];
        $result['flag'] = $res['flag'];
        $result['cnt'] = $res['cnt'];
        $result['keywords'] = $this->KeyTrack_model->getKeywords($res['id']);

        echo json_encode($result);
    }

    public function getKeywordInfo()
    {
        $postData = $this->input->post();
        $key_id = $postData['id'];
        $res = $this->KeyTrack_model->getKeywordInfo($key_id);
//print_r($res);exit;
        $result['id'] = $res['id'];
        $result['keyword'] = $res['keyword'];
        $result['flag'] = $res['country_code'];
        $result['asin_num'] = $res['asin_num'];
        $result['asin_id'] = $res['asin_id'];

        echo json_encode($result);
    }

    public function deleteAsinInfo()
    {
        $postData = $this->input->post();
        $asin_id = $postData['asin_id'];
        $client_id = $this->Client_model->getUserId($this->session->userdata('client_logged_in'));
        echo $this->KeyTrack_model->deleteAsinInfo($client_id, $asin_id);
    }

    public function addKeywords()
    {
        $postData = $this->input->post();
        $client_id = $this->Client_model->getUserId($this->session->userdata('client_logged_in'));
        echo $this->KeyTrack_model->addKeywords($client_id, $postData);
    }

    public function editKeywords()
    {
        $postData = $this->input->post();
        $client_id = $this->Client_model->getUserId($this->session->userdata('client_logged_in'));
        echo $this->KeyTrack_model->editKeywords($client_id, $postData);
    }

    public function delete_keyword()
    {
        $postData = $this->input->post();
        echo $this->KeyTrack_model->deleteKeyword($postData['id']);
    }

    public function getChartData()
    {
        $client_id = $this->Client_model->getUserId($this->session->userdata('client_logged_in'));

        $postData = $this->input->post();
        $start = new DateTime($postData['start']);
        $end = new DateTime($postData['end']);
        $sub = (int)$start->diff($end)->format('%R%a');

        $labels = array();

        $period = $sub;

        if ($period==6)
        {
            $interval = 1;
        }
        else if ($period==29)
        {
            $interval = 3;
        }
        else if ($period==89)
        {
            $interval = 9;
        }
        else if ($period==364)
        {
            $interval = 30;
        }
        else if ($period<11)
        {
            $interval = 1;
        }
        else
        {
            $interval = (int)((int)$sub/10);
        }

        $colors = array('#4dc9f6', '#f67019', '#f53794', '#537bc4', '#acc236', '#166a8f', '#00a950', '#58595b', '#8549ba');
        $result_asin_num = $this->KeyTrack_model->getTodayTopAsinNum($client_id);

        $arr_asin_num = array();
        $res_datas = array();

        foreach ($result_asin_num as $r)
        {
            array_push($arr_asin_num, $r['asin_num']);
            $res_datas[$r['asin_num']] = array();
        }

        while($sub>=0)
        {
            $t_end = new DateTime($start->format('Y-m-d'));
            $t_end->add(new DateInterval('P'.($interval-1).'D'));

            if ($t_end>$end)
                $t_end = $end;

            foreach ($arr_asin_num as $asin_num)
            {
                $result = $this->KeyTrack_model->getChartData($client_id, $asin_num, $start->format('Y-m-d 00:00:00'), $t_end->format('Y-m-d 23:59:59'));

                if (!empty($result))
                {
                    $res_datas[$asin_num][] = $result['cnt'];
                }
                else
                {
                    $res_datas[$asin_num][] = 0;
                }
            }

            $start->add(new DateInterval('P'.$interval.'D'));
            array_push($labels, $t_end->format('Y-m-d'));

            $sub = (int)$start->diff($end)->format('%R%a');
        }

        $json_data['labels'] = $labels;

        $productData = array();

        $i = 0;
        foreach ($arr_asin_num as $asin_num)
        {
            $str['data'] = $res_datas[$asin_num];
            $str['label'] = $asin_num;
            $str['borderColor'] = $colors[$i%9];
            $str['fill'] = false;

            $productData[] = $str;
            $i++;
        }

        $json_data['datasets'] = $productData;

        echo json_encode($json_data);
    }

    public function getHistoryChartData()
    {
        $client_id = $this->Client_model->getUserId($this->session->userdata('client_logged_in'));

        $postData = $this->input->post();
        $start = new DateTime($postData['start']);
        $end = new DateTime($postData['end']);
        $sub = (int)$start->diff($end)->format('%R%a');

        $labels = array();
        $datas = array();

        $period = $sub;

        if ($period==6)
        {
            $interval = 1;
        }
        else if ($period==29)
        {
            $interval = 3;
        }
        else if ($period==89)
        {
            $interval = 9;
        }
        else if ($period==364)
        {
            $interval = 30;
        }
        else if ($period<11)
        {
            $interval = 1;
        }
        else
        {
            $interval = (int)($sub/10);
        }

        $res_datas = array();
        $res_datas['top10'] = array();
        $res_datas['top50'] = array();
        $colors = array('#4dc9f6', '#f67019', '#f53794', '#537bc4', '#acc236', '#166a8f', '#00a950', '#58595b', '#8549ba');

        while($sub>=0)
        {
            $t_end = new DateTime($start->format('Y-m-d'));
            $t_end->add(new DateInterval('P'.($interval-1).'D'));
            if ($t_end>$end)
                $t_end = $end;

            $result = $this->KeyTrack_model->getHistoryChartData($client_id, $postData['asin_id'], $start->format('Y-m-d 00:00:00'), $t_end->format('Y-m-d 23:59:59'));

            if ($result)
            {
                $res_datas['top10'][] = $result['top_10'];
                $res_datas['top50'][] = $result['top_50'];
            }
            else
            {
                $res_datas['top10'][] = 0;
                $res_datas['top50'][] = 0;
            }

            $start->add(new DateInterval('P'.$interval.'D'));
            array_push($labels, $t_end->format('Y-m-d'));

            $sub = (int)$start->diff($end)->format('%R%a');
        }

        $json_data['labels'] = $labels;

        $productData = array();

        $str['data'] = $res_datas['top10'];
        $str['label'] = 'top10';
        $str['borderColor'] = $colors[0];
        $str['fill'] = false;

        $productData[] = $str;

        $str['data'] = $res_datas['top50'];
        $str['label'] = 'top50';
        $str['borderColor'] = $colors[5];
        $str['fill'] = false;

        $productData[] = $str;

        $json_data['datasets'] = $productData;

        echo json_encode($json_data);
    }

    public function getKeyHistoryChartData()
    {
        $client_id = $this->Client_model->getUserId($this->session->userdata('client_logged_in'));

        $postData = $this->input->post();
        $keyword = $postData['key'];
        $asin_id = $postData['asin_id'];
        $start = new DateTime($postData['start']);
        $end = new DateTime($postData['end']);
        $sub = (int)$start->diff($end)->format('%R%a');

        $labels = array();
        $datas = array();

        $period = $sub;

        if ($period==6)
        {
            $interval = 1;
        }
        else if ($period==29)
        {
            $interval = 3;
        }
        else if ($period==89)
        {
            $interval = 9;
        }
        else if ($period==364)
        {
            $interval = 30;
        }
        else if ($period<11)
        {
            $interval = 1;
        }
        else
        {
            $interval = (int)($sub/10);
        }

        $res_datas = array();

        $colors = array('#4dc9f6', '#f67019', '#f53794', '#537bc4', '#acc236', '#166a8f', '#00a950', '#58595b', '#8549ba');

        while($sub>=0)
        {
            $t_end = new DateTime($start->format('Y-m-d'));
            $t_end->add(new DateInterval('P'.($interval-1).'D'));
            if ($t_end>$end)
                $t_end = $end;

            $result = $this->KeyTrack_model->getKeyHistoryChartData($keyword, $asin_id, $start->format('Y-m-d 00:00:00'), $t_end->format('Y-m-d 23:59:59'));

            if ($result)
            {
                $res_datas[] = round($result['rank'], 2);
            }
            else
            {
                $res_datas[] = 0;
            }

            $start->add(new DateInterval('P'.$interval.'D'));
            array_push($labels, $t_end->format('Y-m-d'));

            $sub = (int)$start->diff($end)->format('%R%a');
        }

        $json_data['labels'] = $labels;

        $productData = array();

        $str['data'] = $res_datas;
        $str['label'] = 'rank';
        $str['borderColor'] = $colors[0];
        $str['fill'] = false;

        $productData[] = $str;

        $json_data['datasets'] = $productData;

        echo json_encode($json_data);
    }

    public function generateAutoNewTicket()
    {
        $this->KeyTrack_model->generateAutoNewTicket();
    }

}
