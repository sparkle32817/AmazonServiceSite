<?php


class Billing extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Billing_model');
    }

    public function membership()
    {
        if (!$this->session->userdata('client_logged_in')) {
            redirect('login');
        }

        $user_name = $this->session->userdata('client_logged_in');
        $user_id = $this->User_model->getUserId($user_name);

        $header_data['username'] = $user_name;
        $header_data['user_avatar'] = $this->User_model->getUserAvatar($user_name);

        $data['histories'] = $this->Billing_model->getHistory($user_id);
        $data['member_status'] = $this->User_model->getMemberStatus($user_id);
        $this->load->view('user/common/header', $header_data);
        $this->load->view('user/billing/membership', $data);
        $this->load->view('user/common/footer');
    }

    public function payment()
    {
        $postData = $this->input->post();
        $user_name = $postData['user_name'];
        $member_id = $postData['member_id'];
        $status = $postData['status'];          //Upgrade or Downgrade
        $payment_id = $postData['payment_id'];

        $result = $this->Billing_model->makeHistory($this->User_model->getUserId($user_name), $payment_id, $member_id, $status);
        $this->User_model->updateUserMembership($user_name, $member_id);//In future...Membership_mng

//        if ($result=="ok")
//            $this->membership();

    }

}