<?php


class SearchTermOptimization extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'Client_model');
        $this->load->model('Service_keyword_optimization_model', 'Optimization_model');
    }

    public function index()
    {
        if (!$this->session->userdata('client_logged_in')) {
            redirect('login');
        }

        $user_name = $this->session->userdata('client_logged_in');
        $header_data['username'] = $user_name;
        $header_data['user_avatar'] = $this->Client_model->getUserAvatar($user_name);
        $data['markets'] = $this->Client_model->getMarkets();

        $this->load->view('user/common/header', $header_data);
        $this->load->view('user/services/search_term_optimization/main', $data);
        $this->load->view('user/common/footer');
    }

    public function resultView($task_id)
    {
        if (!$this->session->userdata('client_logged_in')) {
            redirect('login');
        }

        $this->Optimization_model->setVisit($task_id);

        $user_name = $this->session->userdata('client_logged_in');
        $header_data['username'] = $user_name;
        $header_data['user_avatar'] = $this->Client_model->getUserAvatar($user_name);

        $data = array();

        $data['input_result'] = $this->Optimization_model->getInputData($task_id);
        $data['searched_result'] = $this->Optimization_model->getSearchedData($task_id);

        $this->load->view('user/common/header', $header_data);
        $this->load->view('user/services/search_term_optimization/view', $data);
        $this->load->view('user/common/footer');
    }

    public function isExistAlready()
    {
        $client_id = $this->Client_model->getUserId($this->session->userdata('client_logged_in'));
        $result = $this->Optimization_model->isExistAlready($client_id, 'Search Term Optimization', $_POST['dataArr']);
        echo json_encode($result);
    }

    public function findKeyword()
    {
        $client_id = $this->Client_model->getUserId($this->session->userdata('client_logged_in'));
        echo $this->Optimization_model->startFindKeyword($client_id, 'Search Term Optimization', $_POST['dataArr']);
    }

    public function getHistory()
    {
        $results = $this->Optimization_model->getHistory($this->session->userdata('client_logged_in'));

        $i = 0;
        $returnVal = array();
        foreach ($results as $result)
        {
            $data = array();

            $data['no'] = ++$i;
            $data['id'] = $result['id'];
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

}
