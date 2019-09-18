<?php


class ProductKeywordIndexChecker extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('User_model', 'Client_model');
		$this->load->model('Service_keyword_checker_model', 'KeyChecker_model');
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
        $this->load->view('user/services/product_keyword_index_checker/main', $data);
        $this->load->view('user/common/footer');
    }

    public function resultView($task_id)
	{
		if (!$this->session->userdata('client_logged_in')) {
			redirect('login');
		}

		$this->KeyChecker_model->setVisit($task_id);

		$user_name = $this->session->userdata('client_logged_in');
		$header_data['username'] = $user_name;
		$header_data['user_avatar'] = $this->Client_model->getUserAvatar($user_name);

		$data = array();

        $data['status'] = $this->KeyChecker_model->getStatus($task_id);
		$data['result'] = $this->KeyChecker_model->getDataInfo($this->KeyChecker_model->getRelatedTaskID($task_id));
//		$data['keywords'] = $this->KeyChecker_model->getKeywords($this->KeyChecker_model->getRelatedTaskID($task_id));

		$data['view_asin_id'] = $this->KeyChecker_model->getRelatedTaskID($task_id);

		$this->load->view('user/common/header', $header_data);
		$this->load->view('user/services/product_keyword_index_checker/view', $data);
		$this->load->view('user/common/footer');
	}

    public function isExistAlready()
    {
        $client_id = $this->Client_model->getUserId($this->session->userdata('client_logged_in'));
        $result = $this->KeyChecker_model->isExistAlready($client_id, 'AMZ Product Keyword Index Checker', $_POST['dataArr']);
        echo json_encode($result);
    }

	public function checkKeyword()
	{
		$client_id = $this->Client_model->getUserId($this->session->userdata('client_logged_in'));
		echo $this->KeyChecker_model->startCheckKeyword($client_id, 'AMZ Product Keyword Index Checker', $_POST['dataArr']);
	}

	public function getKeywordDetailInfo()
	{
		$asin_id = $_POST['asin_id'];

		$result = array();
		if ($_POST['status'] == 'complete')
        {
            $result = $this->KeyChecker_model->getKeywordDetailInfo($asin_id);
        }

		echo json_encode(array('data'=>$result));
	}

	public function getHistory()
	{
		$results = $this->KeyChecker_model->getHistory($this->session->userdata('client_logged_in'));

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

	public function deleteHistory()
	{
		$task_id = $_POST['id'];
		echo $this->KeyChecker_model->deleteHistory($task_id);
	}

}
