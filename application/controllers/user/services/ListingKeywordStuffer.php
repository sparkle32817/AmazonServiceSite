<?php


class ListingKeywordStuffer extends CI_Controller
{
    var $client_id;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'Client_model');
        $this->load->model('Service_listing_stuffer_model', 'Stuffer_model');

        $this->client_id = $this->Client_model->getUserId($this->session->userdata('client_logged_in'));
    }

    public function index()
    {
        if (!$this->session->userdata('client_logged_in')) {
            redirect('login');
        }

        $client_name = $this->session->userdata('client_logged_in');
        $header_data['username'] = $client_name;
        $header_data['user_avatar'] = $this->Client_model->getUserAvatar($client_name);

        $data['result'] = $this->Stuffer_model->getLastDataInfo($this->client_id);

        $this->load->view('user/common/header', $header_data);
        $this->load->view('user/services/listing_keyword_stuffer/main', $data);
        $this->load->view('user/common/footer');
    }

    public function resultView($id)
    {
        if (!$this->session->userdata('client_logged_in')) {
            redirect('login');
        }

        $client_name = $this->session->userdata('client_logged_in');
        $header_data['username'] = $client_name;
        $header_data['user_avatar'] = $this->Client_model->getUserAvatar($client_name);

        $data = array();

        $data['result'] = $this->Stuffer_model->getDataInfo($id);

        $this->load->view('user/common/header', $header_data);
        $this->load->view('user/services/listing_keyword_stuffer/view', $data);
        $this->load->view('user/common/footer');
    }

    public function saveKeywords()
    {
        echo $this->Stuffer_model->saveKeywords($this->client_id, $_POST);
    }

    public function getWords()
    {
        echo json_encode($this->Stuffer_model->getWords($this->client_id));
    }

    public function getHistory()
    {
        $results = $this->Stuffer_model->getHistory($this->client_id);

        $i = 0;
        $returnVal = array();
        foreach ($results as $result)
        {
            $data = array();

            $data['no'] = ++$i;
            $data['action'] = $result['id'];
            $data['market_place'] = $result['market_place'];
            $data['keywords'] = str_replace(',', ', ', $result['searched_text']);
            $data['date_searched'] = $result['searched_date'];

            $returnVal[] = $data;
        }

        echo json_encode(array('data'=>$returnVal));
    }

    public function deleteHistory()
    {
        echo $this->Stuffer_model->deleteHistory($this->client_id, $_POST['id']);
    }

}