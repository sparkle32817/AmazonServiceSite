<?php


class ReverseAsinSearch extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'Client_model');
        $this->load->model('Service_reserve_search_model', 'Reserve_model');
    }

    public function index()
    {
        if (!$this->session->userdata('client_logged_in')) {
            redirect('login');
        }

        $user_name = $this->session->userdata('client_logged_in');
        $header_data['username'] = $user_name;
        $header_data['user_avatar'] = $this->Client_model->getUserAvatar($user_name);

        $this->load->view('user/common/header', $header_data);
        $this->load->view('user/services/reverse_asin_search/main');
        $this->load->view('user/common/footer');
    }

    public function resultView($task_id)
    {
        if (!$this->session->userdata('client_logged_in')) {
            redirect('login');
        }

        $this->Reserve_model->setVisit($task_id);

        $user_name = $this->session->userdata('client_logged_in');
        $header_data['username'] = $user_name;
        $header_data['user_avatar'] = $this->Client_model->getUserAvatar($user_name);

        $data = array();

        $data['result'] = $this->Reserve_model->getData($task_id);
        $data['status'] = $this->Reserve_model->getStatus((int)str_replace('Ticket', '', $task_id));
        $data['keyword_count'] = $this->makeCountArrayForView($task_id);

        $data['view_keyword_id'] = $this->Reserve_model->getRelatedTaskID($task_id);

        $this->load->view('user/common/header', $header_data);
        $this->load->view('user/services/reverse_asin_search/view', $data);
        $this->load->view('user/common/footer');
    }

    public function isExistAlready()
    {
        $client_id = $this->Client_model->getUserId($this->session->userdata('client_logged_in'));
        $result = $this->Reserve_model->isExistAlready($client_id, 'Reverse ASIN Search', $_POST);
        echo json_encode($result);
    }

    public function searchKeyword()
    {
        $client_id = $this->Client_model->getUserId($this->session->userdata('client_logged_in'));
        echo $this->Reserve_model->startSearchKeyword($client_id, 'Reverse ASIN Search', $_POST);
    }

    public function getHistory()
    {
        $results = $this->Reserve_model->getHistory($this->session->userdata('client_logged_in'));

        $i = 0;
        $returnVal = array();
        foreach ($results as $result)
        {
            $data = array();

            $data['no'] = ++$i;
            $data['market_place'] = $result['market_place'];
            $data['asin'] = $result['asin'];
            $data['date_searched'] = date('Y-m-d', strtotime($result['request_time']));
            $data['status'] = $result['status']=='complete'?'complete':'pending';
            $data['action']['id'] = $result['id'];
            $data['action']['status'] = $result['status'];

            $returnVal[] = $data;
        }

        echo json_encode(array('data'=>$returnVal));
    }

    public function getDetailInfo()
    {
        $results = $this->Reserve_model->getKeywordDetailInfo($_POST);
        $market_name = $this->Reserve_model->getMarketName($_POST['keyword_id']);
        $asin = $this->Reserve_model->getAsin($_POST['keyword_id']);

//        print_r($results);exit;

        $i = 0;
        $returnVal = array();
        foreach ($results as $result)
        {
            $data = array();

            $data['no'] = ++$i;
            $data['keyword']['phrase'] = $result['phrase'];
            $data['keyword']['view_url'] = 'http://www.'.$market_name.'/s?k='.$result['phrase'];
            $data['rank_url'] = 'http://www.'.$market_name.'/s?k='.$result['phrase'].'&ie=UTF8&field-asin='.$asin.'&rh=i:aps,ssx:relevance';
            $data['search_volume'] = $this->makeComma($result['search_volume']);
            $data['iq_score'] = $this->makeComma($result['iq_score']);
            $data['give_aways'] = $this->makeComma($result['give_aways']);
            $data['sponsored_asin'] = $this->makeComma($result['sponsored_asin']);
            $data['competing_product'] = $this->makeComma($result['competing_product']);
            $data['amz_recommended'] = $result['amz_recommended'];
            $data['sponsored'] = $result['sponsored'];
            $data['organic'] = $result['organic'];
            $data['amz_recommended_rank'] = $this->makeComma($result['amz_recommended_rank']);
            $data['sponsored_rank'] = $this->makeComma($result['sponsored_rank']);
            $data['organic_rank'] = $this->makeComma($result['organic_rank']);

            $returnVal[] = $data;
        }

        echo json_encode(array('data'=>$returnVal));
    }

    public function deleteHistory()
    {
        echo $this->Reserve_model->deleteHistory($_POST['id']);
    }

    public function downloadExportFile()
    {
        $results = $this->Reserve_model->getKeywordDetailInfo($_GET);

        $filename = "reverse_asin_". date("Y-m-d") . ".csv";

        header('Content-Type: text/csv; charset=utf-8');
        header("Content-Disposition: attachment; filename=\"" . $filename . "\";" );

        $out = fopen('php://output', 'w');
        fputcsv($out, array('Keyword', 'Opportunity Score', 'Search Volume', 'Sponsored Products', 'Competing Products', 'Min Units to Sell per Week to Rank on page 1 Search', 'Amazon Recommended Rank', 'Sponsored Rank', 'Organic Rank'));

        foreach ($results as $row) {

            fputcsv($out, array($row['phrase'], $row['iq_score'], $row['search_volume'], $row['sponsored_asin'], $row['competing_product'], $row['give_aways'], $row['amz_recommended_rank'], $row['sponsored_rank'], $row['organic_rank']));
        }
        fclose($out);
        die();
    }

    function makeCountArrayForView($task_id)
    {
        $result = $this->Reserve_model->getKeywordSum($task_id);
        $data = array();

        $data['cnt_phrase'] = $this->makeComma($result['cnt_phrase']);
        $data['sum_sponsored'] = $this->makeComma($result['sum_sponsored']);
        $data['sum_organic'] = $this->makeComma($result['sum_organic']);
        $data['sum_amz_recommended'] = $this->makeComma($result['sum_amz_recommended']);

        return $data;
    }

    function makeComma($var)
    {
        return str_replace('.00', '', ($var!='-' && $var!='')?number_format($var, 2, '.', ','):$var);
    }
}
