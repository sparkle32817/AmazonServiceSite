<?php


class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('History_model');
        $this->load->model('Service_bigdata_model', 'Bigdata_model');
        $this->load->model('Service_keyword_track_model', 'KeyTrack_model');
        $this->load->model('Service_keyword_checker_model', 'KeyChecker_model');
        $this->load->helper('url');
    }

    function switchLang($language = "") {
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
        redirect($_SERVER['HTTP_REFERER']);
//        redirect(base_url());
    }


    public function index()
    {
        $this->login_check();

        $client_name = $this->session->userdata('client_logged_in');
        $header_data['username'] = $client_name;
        $header_data['user_avatar'] = $this->User_model->getUserAvatar($client_name);

        $data['user_info'] = $this->User_model->getUserInfo($this->User_model->getUserId($client_name));
        $data['pending_info'] = $this->makeHistoryInfo($this->History_model->getPendingHistory($this->User_model->getUserId($client_name)));
        $data['complete_info'] = $this->makeHistoryInfo($this->History_model->getCompleteHistory($this->User_model->getUserId($client_name), 0));
        $data['history_info'] = $this->makeHistoryInfo($this->History_model->getCompleteHistory($this->User_model->getUserId($client_name), 1));
//		$data['nums'] = $this->KeyTrack_model->getTrackedKeywordPercentage($this->User_model->getUserId($client_name));

        $this->load->view('user/common/header', $header_data);
        $this->load->view('user/home/dashboard', $data);
        $this->load->view('user/common/footer');
    }

    public function makeHistoryInfo($result_array)
    {
        $res = array();
        foreach ($result_array as $result)
        {
            $data = array();

            $data['request_time'] = $result['request_time'];
            $data['service'] = $result['service'];
            $data['status'] = $result['status'];

            if ($result['service'] == 'Big Data-Category')
            {
                $data['url'] = base_url('services/big_data/categoryResultView/'.$result['id']);
            }
            else if ($result['service'] == 'Big Data-Advertising')
            {
                $data['url'] = base_url('services/big_data/advertisingResultView/'.$result['id']);
            }
            else if ($result['service'] == 'Big Data-Product')
            {
                $data['url'] = base_url('services/big_data/productResultView/'.$result['id']);
            }
            else if ($result['service'] == 'Big Data-Keyword')
            {
                $data['url'] = base_url('services/big_data/keywordResultView/'.$result['id']);
            }
            else if ($result['service'] == 'AMZ Product Keyword Index Checker')
            {
                $data['url'] = base_url('services/keyword_index_checker/resultView/'.$result['id']);
            }
            else if ($result['service'] == 'Magnet Related Keyword Search')
            {
                $data['url'] = base_url('services/magnet_search/resultView/'.$result['id']);
            }
            else if ($result['service'] == 'Keyword Rank Tracking')
            {
                $data['url'] = base_url('services/keyword_rank_tracking');
            }
            else if ($result['service'] == 'Reverse ASIN Search')
            {
                $data['url'] = base_url('services/reserve_search/resultView/'.$result['id']);
            }
            else if ($result['service'] == 'Search Term Optimization')
            {
                $data['url'] = base_url('services/keyword_optimization/resultView/'.$result['id']);
            }
            else
            {
                $data['url'] = 'javascript:;';
            }

            $res[] = $data;
        }

        return $res;
    }

    public function history()
    {
        if (!$this->session->userdata('client_logged_in')) {
            redirect('login');
        }

        $client_name = $this->session->userdata('client_logged_in');
        $header_data['username'] = $client_name;
        $header_data['user_avatar'] = $this->User_model->getUserAvatar($client_name);
//        $data['history_info'] = $this->History_model->getHistoryInfo($this->User_model->getUserId($client_name), 'ASC');     Real, But All Not Clear
        $results = $this->History_model->getPendingHistoryTemp($this->User_model->getUserId($client_name));

        $returnVal = array();
        foreach ($results as $result)
        {
            $arr = array();

            $arr['id'] = $result['id'];
            $arr['service'] = $result['service'];
            $arr['request_time'] = $result['request_time'];
            $arr['status'] = $result['status'];
            $arr['asin'] = $this->History_model->getAsin($result['service'], $result['related_task_id']);

            $returnVal[] = $arr;
        }

        $data['history_info'] = $returnVal;

        $this->load->view('user/common/header', $header_data);
        $this->load->view('user/home/history', $data);
        $this->load->view('user/common/footer');
    }

    public function deleteHistory()
    {
        $task_id = $_POST['id'];
        $service = $_POST['service'];


        if ($service == 'Big Data-Category')
        {
            echo $this->Bigdata_model->deleteBigDataHistory($task_id, 'tbl_service_category_data', 'tbl_service_category_complete');
        }
        else if ($service == 'Big Data-Advertising')
        {
            echo $this->Bigdata_model->deleteBigDataHistory($task_id, 'tbl_service_category_data', 'tbl_service_category_complete');
        }
        else if ($service == 'Big Data-Product')
        {
            echo $this->Bigdata_model->deleteBigDataHistory($task_id, 'tbl_service_product_data', 'tbl_service_product_complete');
        }
        else if ($service == 'Big Data-Keyword')
        {
            echo $this->Bigdata_model->deleteBigDataHistory($task_id, 'tbl_service_keyword_data', 'tbl_service_keyword_complete');
        }
        else if ($service == 'AMZ Product Keyword Index Checker')
        {
            echo $this->KeyChecker_model->deleteHistory($task_id);
        }
    }

    protected function login_check()
    {
        if (!$this->session->userdata('client_logged_in')) {
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

}
