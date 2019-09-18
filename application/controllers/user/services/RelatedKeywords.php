<?php


class RelatedKeywords extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index()
    {
        if (!$this->session->userdata('client_logged_in')) {
            redirect('login');
        }

        $user_name = $this->session->userdata('client_logged_in');
        $header_data['username'] = $user_name;
        $header_data['user_avatar'] = $this->User_model->getUserAvatar($user_name);

        $this->load->view('user/common/header', $header_data);
        $this->load->view('user/services/find_related_keywords');
        $this->load->view('user/common/footer');
    }

}