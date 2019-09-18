<?php


class MarketUrlGernerator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'Client_model');
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
        $this->load->view('user/services/market_url/promote_brand', $data);
        $this->load->view('user/common/footer');
    }

    public function asinkeyword()
    {
        if (!$this->session->userdata('client_logged_in')) {
            redirect('login');
        }

        $user_name = $this->session->userdata('client_logged_in');
        $header_data['username'] = $user_name;
        $header_data['user_avatar'] = $this->Client_model->getUserAvatar($user_name);
		$data['markets'] = $this->Client_model->getMarkets();

        $this->load->view('user/common/header', $header_data);
        $this->load->view('user/services/market_url/asin_keyword_url', $data);
        $this->load->view('user/common/footer');
    }

	public function asin_keyword_special()
	{
		if (!$this->session->userdata('client_logged_in')) {
			redirect('login');
		}

		$user_name = $this->session->userdata('client_logged_in');
		$header_data['username'] = $user_name;
		$header_data['user_avatar'] = $this->Client_model->getUserAvatar($user_name);
		$data['markets'] = $this->Client_model->getMarkets();

		$this->load->view('user/common/header', $header_data);
		$this->load->view('user/services/market_url/asin_keyword_url_special', $data);
		$this->load->view('user/common/footer');
	}

	public function search_engine_amazon_url()
	{
		if (!$this->session->userdata('client_logged_in')) {
			redirect('login');
		}

		$user_name = $this->session->userdata('client_logged_in');
		$header_data['username'] = $user_name;
		$header_data['user_avatar'] = $this->Client_model->getUserAvatar($user_name);
		$data['markets'] = $this->Client_model->getMarkets();

		$this->load->view('user/common/header', $header_data);
		$this->load->view('user/services/market_url/search_engine_amazon_url', $data);
		$this->load->view('user/common/footer');
	}

	public function add_cart_url()
	{
		if (!$this->session->userdata('client_logged_in')) {
			redirect('login');
		}

		$user_name = $this->session->userdata('client_logged_in');
		$header_data['username'] = $user_name;
		$header_data['user_avatar'] = $this->Client_model->getUserAvatar($user_name);
		$data['markets'] = $this->Client_model->getMarkets();

		$this->load->view('user/common/header', $header_data);
		$this->load->view('user/services/market_url/add_cart_url', $data);
		$this->load->view('user/common/footer');
	}

	public function add_cart_multiple_url()
	{
		if (!$this->session->userdata('client_logged_in')) {
			redirect('login');
		}

		$user_name = $this->session->userdata('client_logged_in');
		$header_data['username'] = $user_name;
		$header_data['user_avatar'] = $this->Client_model->getUserAvatar($user_name);
		$data['markets'] = $this->Client_model->getMarkets();

		$this->load->view('user/common/header', $header_data);
		$this->load->view('user/services/market_url/add_cart_multiple_url', $data);
		$this->load->view('user/common/footer');
	}

	public function search_multi_asin()
	{
		if (!$this->session->userdata('client_logged_in')) {
			redirect('login');
		}

		$user_name = $this->session->userdata('client_logged_in');
		$header_data['username'] = $user_name;
		$header_data['user_avatar'] = $this->Client_model->getUserAvatar($user_name);
		$data['markets'] = $this->Client_model->getMarkets();

		$this->load->view('user/common/header', $header_data);
		$this->load->view('user/services/market_url/search_multi_asin', $data);
		$this->load->view('user/common/footer');
	}

    public function test_submit()
    {
        $client_name = $this->session->userdata('client_logged_in');

//        echo $this->Client_model->submit_task($client_name, $this->input->post());
    }

}
