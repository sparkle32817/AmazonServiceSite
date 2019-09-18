<?php


class AccountManagement extends CI_Controller
{
    var $client_id;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'Client_model');
        $this->load->model('Service_account_management_model', 'Account_model');

        $this->client_id = $this->Client_model->getUserId($this->session->userdata('client_logged_in'));
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
        $this->load->view('user/services/account_management/first');
        $this->load->view('user/common/footer');
    }

    public function main()
    {
        if (!$this->session->userdata('client_logged_in')) {
            redirect('login');
        }

        $user_name = $this->session->userdata('client_logged_in');
        $header_data['username'] = $user_name;
        $header_data['user_avatar'] = $this->Client_model->getUserAvatar($user_name);

        $data['exist'] = $this->Account_model->existApplication($this->client_id);

        $this->load->view('user/common/header', $header_data);
        $this->load->view('user/services/account_management/main', $data);
        $this->load->view('user/common/footer');
    }

    public function view()
    {
        if (!$this->session->userdata('client_logged_in')) {
            redirect('login');
        }

        $user_name = $this->session->userdata('client_logged_in');
        $header_data['username'] = $user_name;
        $header_data['user_avatar'] = $this->Client_model->getUserAvatar($user_name);

        $data['info'] = $this->Account_model->getAccountInfo($this->client_id);

        $this->load->view('user/common/header', $header_data);
        $this->load->view('user/services/account_management/view', $data);
        $this->load->view('user/common/footer');
    }

    public function register()
    {
        echo $this->Account_model->register($this->client_id, $this->getUserIpAddr(), $_POST);
    }

    public function update()
    {
        echo $this->Account_model->update($this->client_id, $this->getUserIpAddr(), $_POST);
    }

    private function getUserIpAddr(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

}