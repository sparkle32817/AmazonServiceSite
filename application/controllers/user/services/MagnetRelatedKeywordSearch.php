<?php


class MagnetRelatedKeywordSearch extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'Client_model');
        $this->load->model('Service_magnet_keyword_search_model', 'Magnet_model');
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
        $this->load->view('user/services/magnet_keyword_search/main');
        $this->load->view('user/common/footer');
    }

    public function resultView($task_id)
    {
        if (!$this->session->userdata('client_logged_in')) {
            redirect('login');
        }

        $this->Magnet_model->setVisit($task_id);

        $user_name = $this->session->userdata('client_logged_in');
        $header_data['username'] = $user_name;
        $header_data['user_avatar'] = $this->Client_model->getUserAvatar($user_name);

        $data = array();

        $data['result'] = $this->makeResultArrayForView($task_id);
        $data['keyword'] = $this->Magnet_model->getKeyword($task_id);
        $data['status'] = $this->Magnet_model->getStatus((int)str_replace('Ticket', '', $task_id));
        $result = $this->Magnet_model->getKeywordCount($task_id);
        $data['keyword_count']['cnt_phrase'] = $this->makeComma($result['cnt_phrase']);
        $data['keyword_count']['cnt_organic'] = $this->makeComma($result['cnt_organic']);
        $data['keyword_count']['cnt_smart'] = $this->makeComma($result['cnt_smart']);
        $data['keyword_count']['cnt_amz'] = $this->makeComma($result['cnt_amz']);

        $data['view_keyword_id'] = $this->Magnet_model->getRelatedTaskID($task_id);

        $this->load->view('user/common/header', $header_data);
        $this->load->view('user/services/magnet_keyword_search/view', $data);
        $this->load->view('user/common/footer');
    }

    public function isExistAlready()
    {
        $client_id = $this->Client_model->getUserId($this->session->userdata('client_logged_in'));
        $result = $this->Magnet_model->isExistAlready($client_id, 'Magnet Related Keyword Search', $_POST);
        echo json_encode($result);
    }

    public function searchKeyword()
    {
        $client_id = $this->Client_model->getUserId($this->session->userdata('client_logged_in'));
        echo $this->Magnet_model->startSearchKeyword($client_id, 'Magnet Related Keyword Search', $_POST);
    }

    public function getHistory()
    {
        $results = $this->Magnet_model->getHistory($this->session->userdata('client_logged_in'));

        $i = 0;
        $returnVal = array();
        foreach ($results as $result)
        {
            $data = array();

            $data['no'] = ++$i;
            $data['market_place'] = $result['market_place'];
            $data['keyword'] = $result['keyword'];
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
        $results = $this->Magnet_model->getKeywordDetailInfo($_POST);

        $market_name = $this->Magnet_model->getMarketName($_POST['keyword_id']);

        $i = 0;
        $returnVal = array();
        foreach ($results as $result)
        {
            $data = array();

            $data['no'] = ++$i;
            $data['keyword']['phrase'] = $result['phrase'];
            $data['keyword']['view_url'] = 'http://www.'.$market_name.'/s?k='.$result['phrase'];
            $data['iq_score'] = $this->makeComma($result['iq_score']);
            $data['search_volume'] = $this->makeComma($result['search_volume']);
            $data['sponsored_asin'] = $this->makeComma($result['sponsored_asin']);
            $data['headline_asin'] = $this->makeComma($result['headline_asin']);
            $data['competing_product'] = $this->makeComma($result['competing_product']);
            $data['give_aways'] = $this->makeComma($result['give_aways']);
            $data['amz_recommended'] = $result['amz_recommended'];
            $data['smart_complete'] = $result['smart_complete'];
            $data['organic'] = $result['organic'];

            $returnVal[] = $data;
        }

        echo json_encode(array('data'=>$returnVal));
    }

    public function deleteHistory()
    {
        echo $this->Magnet_model->deleteHistory($_POST['id']);
    }

    public function downloadExportFile()
    {
        $results = $this->Magnet_model->getKeywordDetailInfo($_GET);

        $filename = "magnet_keyword_". date("Y-m-d") . ".csv";

        header('Content-Type: text/csv; charset=utf-8');
        header("Content-Disposition: attachment; filename=\"" . $filename . "\";" );

        $out = fopen('php://output', 'w');
        fputcsv($out, array('Keyword', 'Keyword Score', 'Search Volume', 'Sponsored ASIN', 'Headline ASIN', 'Competing Products', 'Rank on Page 1 Sales Quantity'));

        foreach ($results as $row) {

            fputcsv($out, array($row['phrase'], $row['iq_score'], $row['search_volume'], $row['sponsored_asin'], $row['headline_asin'], $row['competing_product'], $row['give_aways']));
        }
        fclose($out);
        die();
    }

    function makeResultArrayForView($task_id)
    {
        $result1 = $this->Magnet_model->getDataInfo($task_id);
        $result2 = $this->Magnet_model->getMarketAndFlag($task_id);
        $data = array();

        $data['search_volume'] = $this->makeComma($result1['search_volume']);
        $data['iq_score'] = $this->makeComma($result1['iq_score']);
        $data['give_aways'] = $this->makeComma($result1['give_aways']);
        $data['organic'] = $this->makeComma($result1['organic']);
        $data['smart_complete'] = $this->makeComma($result1['smart_complete']);
        $data['amz_recommended'] = $this->makeComma($result1['amz_recommended']);
        $data['market'] = $result2['market_place'];
        $data['flag'] = $result2['flag'];

        return $data;
    }

    function makeComma($var)
    {
        return str_replace('.00', '', ($var!='-' && $var!='')?number_format($var, 2, '.', ','):$var);
    }
}
