<?php


class BigData extends CI_Controller
{
    var $client_id;
    public function __construct()
    {
        parent::__construct();
		$this->load->model('User_model', 'Client_model');
		$this->load->model('Service_bigdata_model', 'Bigdata_model');

        $this->client_id = $this->Client_model->getUserId($this->session->userdata('client_logged_in'));
    }

	public function getMarketCategory()
	{
		$postData = $this->input->post();
		$market_id = $postData['market_id'];

		$result = $this->Bigdata_model->getMarketCategory($market_id);

		echo json_encode($result);
	}

    //Category
    public function category()
    {
        if (!$this->session->userdata('client_logged_in')) {
            redirect('login');
        }

        $user_name = $this->session->userdata('client_logged_in');
        $header_data['username'] = $user_name;
        $header_data['user_avatar'] = $this->Client_model->getUserAvatar($user_name);

        $this->load->view('user/common/header', $header_data);
        $this->load->view('user/services/big_data/category');
        $this->load->view('user/common/footer');
    }

    public function categoryResultView($task_id)
	{
		if (!$this->session->userdata('client_logged_in')) {
			redirect('login');
		}

		$this->Bigdata_model->setVisit($task_id);

		$user_name = $this->session->userdata('client_logged_in');
		$header_data['username'] = $user_name;
		$header_data['user_avatar'] = $this->Client_model->getUserAvatar($user_name);

		$data = array();

		$service_data_table = 'tbl_service_category_data';
		$service_complete_table = 'tbl_service_category_complete';
		$data['total_cnt'] = $this->Bigdata_model->getTotalCount($task_id, $service_complete_table);
		$data['status'] = $this->Bigdata_model->getStatus($task_id);
		$data['result'] = $this->Bigdata_model->getDataInfo($this->Bigdata_model->getRelatedTaskID($task_id), $service_data_table);

		$file_url = $this->makeExportFileForCategory($task_id);
		if (!empty($file_url))
			$data['export_file_name'] = base_url($file_url);
		else
			$data['export_file_name'] = 'javascript:;';

		$data['view_task_id'] = $task_id;

		$this->load->view('user/common/header', $header_data);
		$this->load->view('user/services/big_data/category_result_view', $data);
		$this->load->view('user/common/footer');
	}

	public function getCategoryCompletionData()
	{
		$task_id = $_POST['task_id'];

		$service_complete_table = 'tbl_service_category_complete';
		$results = $this->Bigdata_model->getCompletionData($task_id, $service_complete_table);

		$returnVal = array();
		foreach ($results as $result)
		{

			$data = array();

			$data['asin_info']['asin'] = $result['asin'];
			$data['asin_info']['market_url'] = $result['market_name'];

			$data['product']['title'] = $result['title'];
			$data['product']['category'] = $result['category'];
			$data['product']['brand'] = $result['brand'];
			$data['product']['fulfillment'] = $result['fulfillment'];
			$data['product']['size_tier'] = $result['size_tier'];
			$data['product']['num_image'] = $result['num_image'];
			$data['product']['variation_cnt'] = $result['variation_cnt'];
			$data['product']['weight'] = round($result['weight'],2);

			$data['sellers'] = $result['sellers'];
			$data['monthly_sales'] = $this->makeComma($result['monthly_sales']);
			$data['sales_rank'] = $this->makeComma($result['bsr']);

			$currency = $this->getCurrency($result['market_name']);
            $data['price'] = $this->makeComma($result['price'], $currency);
            $data['monthly_revenue'] = $this->makeComma($result['monthly_revenue'], $currency);

            $data['reviews']['count'] = $this->makeComma($result['review_cnt']);
			$data['reviews']['rating'] = $result['review_rating'];

			$data['others']['last_year_sales'] = $this->makeComma($result['review_cnt']);
			$data['others']['sales_year'] = $this->makeComma($result['sales_year']);
			$data['others']['sales_trend'] = $this->makeComma($result['sales_trend']);
			$data['others']['price_trend'] = $this->makeComma($result['price_trend']);
			$data['others']['best_sales_period'] = $result['best_sales_period'];
            $data['others']['sales_to_reviews'] = $this->makeComma($result['sales_to_reviews']);

			$returnVal[] = $data;
		}

		echo json_encode(array('data'=>$returnVal));
	}

	public function getCategoryHistory()
	{
		$results = $this->Bigdata_model->getHistory($this->session->userdata('client_logged_in'), 'Big Data-Category');

		echo json_encode(array('data'=>$this->getHistoryArray($results)));
	}

	public function deleteCategoryHistory()
	{
		$task_id = $_POST['id'];
		echo $this->Bigdata_model->deleteBigDataHistory($task_id, 'tbl_service_category_data', 'tbl_service_category_complete');
	}

	public function makeExportFileForCategory($task_id)
	{
		$array = $this->Bigdata_model->getCompletionData($task_id, 'tbl_service_category_complete');

		if (count($array) == 0) {
			return null;
		}

		$structure = './csv_export/';

		if (!is_dir($structure))
		{
			if (!mkdir($structure, 0777, true)) {
				die('Failed to create folders...');
			}
		}

//		$filename = "csv_export/AmzDataVault".$task_id."_" . date("YmdHis") . ".csv";
		$filename = "csv_export/AmzDataVault".$task_id. ".csv";
		$df = fopen($filename, 'w');

		fputcsv($df, array('ASIN', 'Title', 'Category', 'Brand', 'BSR', 'Price', 'Monthly Sales', 'Net Price', 'Monthly Revenue',
			'Review Count','Review Rating', 'Sellers', 'Last Year Sales', 'Sales Year over Year', 'Sales Trend (90 days)', 'Price Trend (90 days)', 'Best Sales Period'));

		foreach ($array as $row) {

			$arr = array();

			$arr[] = $row['asin'];
			$arr[] = $row['title'];
			$arr[] = $row['category'];
			$arr[] = $row['brand'];
			$arr[] = $row['bsr'];
			$arr[] = $row['price'];
			$arr[] = $row['monthly_sales'];
			$arr[] = $row['net_price'];
			$arr[] = $row['monthly_revenue'];
			$arr[] = $row['review_cnt'];
			$arr[] = $row['review_rating'];
			$arr[] = $row['sellers'];
			$arr[] = $row['last_year_sales'];
			$arr[] = $row['sales_year'];
			$arr[] = $row['sales_trend'];
			$arr[] = $row['price_trend'];
			$arr[] = $row['best_sales_period'];

			fputcsv($df, $arr);
		}

		fclose($df);

		return $filename;
	}

	//Advertising
	public function advertising()
	{
		if (!$this->session->userdata('client_logged_in')) {
			redirect('login');
		}

		$user_name = $this->session->userdata('client_logged_in');
		$header_data['username'] = $user_name;
		$header_data['user_avatar'] = $this->Client_model->getUserAvatar($user_name);

		$this->load->view('user/common/header', $header_data);
		$this->load->view('user/services/big_data/advertising');
		$this->load->view('user/common/footer');
	}

	public function advertisingResultView($task_id)
	{
		if (!$this->session->userdata('client_logged_in')) {
			redirect('login');
		}

		$this->Bigdata_model->setVisit($task_id);

		$user_name = $this->session->userdata('client_logged_in');
		$header_data['username'] = $user_name;
		$header_data['user_avatar'] = $this->Client_model->getUserAvatar($user_name);

		$data = array();

		$service_data_table = 'tbl_service_advertising_data';
		$service_complete_table = 'tbl_service_advertising_complete';
		$data['total_cnt'] = $this->Bigdata_model->getTotalCount($task_id, $service_complete_table);
        $data['status'] = $this->Bigdata_model->getStatus($task_id);
		$data['result'] = $this->Bigdata_model->getDataInfo($this->Bigdata_model->getRelatedTaskID($task_id), $service_data_table);

		$file_url = $this->makeExportFileForAdvertising($task_id);
		if (!empty($file_url))
			$data['export_file_name'] = base_url($file_url);
		else
			$data['export_file_name'] = 'javascript:;';

		$data['view_task_id'] = $task_id;

		$this->load->view('user/common/header', $header_data);
		$this->load->view('user/services/big_data/advertising_result_view', $data);
		$this->load->view('user/common/footer');
	}

	public function getAdvertisingCompletionData()
	{
		$task_id = $_POST['task_id'];

		$service_complete_table = 'tbl_service_advertising_complete';
		$results = $this->Bigdata_model->getCompletionData($task_id, $service_complete_table);

		$returnVal = array();
		foreach ($results as $result)
		{

			$data = array();

			$data['asin_info']['asin'] = $result['asin'];
			$data['asin_info']['market_url'] = $result['market_name'];

			$data['product']['title'] = $result['title'];
			$data['product']['category'] = $result['category'];
			$data['product']['brand'] = $result['brand'];
			$data['product']['fulfillment'] = $result['fulfillment'];
			$data['product']['size_tier'] = $result['size_tier'];
			$data['product']['num_image'] = $result['num_image'];
			$data['product']['variation_cnt'] = $result['variation_cnt'];
            $data['product']['weight'] = round($result['weight'],2);

			$data['together'] = false;
			$data['custom'] = false;
			$data['amazon'] = false;
			if (!empty($result['source']))
			{
				if (strpos($result['source'], 'FBT') !== false)
					$data['together'] = true;

				if (strpos($result['source'], 'CAB') !== false)
					$data['custom'] = true;

				if (strpos($result['source'], 'PPC') !== false)
					$data['amazon'] = true;
			}

            $data['sellers'] = $result['sellers'];
            $data['monthly_sales'] = $this->makeComma($result['monthly_sales']);
            $data['sales_rank'] = $this->makeComma($result['bsr']);

            $currency = $this->getCurrency($result['market_name']);
            $data['price'] = $this->makeComma($result['price'], $currency);
            $data['monthly_revenue'] = $this->makeComma($result['monthly_revenue'], $currency);

            $data['reviews']['count'] = $this->makeComma($result['review_cnt']);
            $data['reviews']['rating'] = $result['review_rating'];

            $data['others']['last_year_sales'] = $this->makeComma($result['review_cnt']);
            $data['others']['sales_year'] = $this->makeComma($result['sales_year']);
            $data['others']['sales_trend'] = $this->makeComma($result['sales_trend']);
            $data['others']['price_trend'] = $this->makeComma($result['price_trend']);
            $data['others']['best_sales_period'] = $result['best_sales_period'];
            $data['others']['sales_to_reviews'] = $this->makeComma($result['sales_to_reviews']);

			$returnVal[] = $data;
		}

		echo json_encode(array('data'=>$returnVal));
	}

	public function getAdvertisingHistory()
	{
		$results = $this->Bigdata_model->getHistory($this->session->userdata('client_logged_in'), 'Big Data-Advertising');

		echo json_encode(array('data'=>$this->getHistoryArray($results)));
	}

	public function deleteAdvertisingHistory()
	{
		$task_id = $_POST['id'];
		echo $this->Bigdata_model->deleteBigDataHistory($task_id, 'tbl_service_category_data', 'tbl_service_category_complete');
	}

	public function makeExportFileForAdvertising($task_id)
	{
		$array = $this->Bigdata_model->getCompletionData($task_id, 'tbl_service_advertising_complete');

		if (count($array) == 0) {
			return null;
		}

		$structure = './csv_export/';

		if (!is_dir($structure))
		{
			if (!mkdir($structure, 0777, true)) {
				die('Failed to create folders...');
			}
		}

//		$filename = "csv_export/AmzDataVault".$task_id."_" . date("YmdHis") . ".csv";
		$filename = "csv_export/AmzDataVault".$task_id. ".csv";
		$df = fopen($filename, 'w');

		fputcsv($df, array('ASIN', 'Title', 'Category', 'Brand', 'BSR', 'Price', 'Monthly Sales', 'Net Price', 'Monthly Revenue',
			'Review Count','Review Rating', 'Sellers', 'Last Year Sales', 'Sales Year over Year', 'Sales Trend (90 days)', 'Price Trend (90 days)', 'Best Sales Period'));

		foreach ($array as $row) {

			$arr = array();

			$arr[] = $row['asin'];
			$arr[] = $row['title'];
			$arr[] = $row['category'];
			$arr[] = $row['brand'];
			$arr[] = $row['bsr'];
			$arr[] = $row['price'];
			$arr[] = $row['monthly_sales'];
			$arr[] = $row['net_price'];
			$arr[] = $row['monthly_revenue'];
			$arr[] = $row['review_cnt'];
			$arr[] = $row['review_rating'];
			$arr[] = $row['sellers'];
			$arr[] = $row['last_year_sales'];
			$arr[] = $row['sales_year'];
			$arr[] = $row['sales_trend'];
			$arr[] = $row['price_trend'];
			$arr[] = $row['best_sales_period'];

			fputcsv($df, $arr);
		}

		fclose($df);

		return $filename;
	}

	//Product
	public function product()
	{
		if (!$this->session->userdata('client_logged_in')) {
			redirect('login');
		}

		$user_name = $this->session->userdata('client_logged_in');
		$header_data['username'] = $user_name;
		$header_data['user_avatar'] = $this->Client_model->getUserAvatar($user_name);

		$this->load->view('user/common/header', $header_data);
		$this->load->view('user/services/big_data/product');
		$this->load->view('user/common/footer');
	}

	public function productResultView($task_id)
	{
		if (!$this->session->userdata('client_logged_in')) {
			redirect('login');
		}

		$this->Bigdata_model->setVisit($task_id);

		$user_name = $this->session->userdata('client_logged_in');
		$header_data['username'] = $user_name;
		$header_data['user_avatar'] = $this->Client_model->getUserAvatar($user_name);

		$data = array();

		$service_data_table = 'tbl_service_product_data';
		$service_complete_table = 'tbl_service_product_complete';
		$data['total_cnt'] = $this->Bigdata_model->getTotalCount($task_id, $service_complete_table);
        $data['status'] = $this->Bigdata_model->getStatus($task_id);
		$data['result'] = $this->Bigdata_model->getDataInfo($this->Bigdata_model->getRelatedTaskID($task_id), $service_data_table);

		$file_url = $this->makeExportFileForProduct($task_id);
		if (!empty($file_url))
			$data['export_file_name'] = base_url($file_url);
		else
			$data['export_file_name'] = 'javascript:;';

		$data['view_task_id'] = $task_id;

		$this->load->view('user/common/header', $header_data);
		$this->load->view('user/services/big_data/product_result_view', $data);
		$this->load->view('user/common/footer');
	}

	public function getProductCompletionData()
	{
		$task_id = $_POST['task_id'];

		$service_complete_table = 'tbl_service_product_complete';
		$results = $this->Bigdata_model->getCompletionData($task_id, $service_complete_table);

		$returnVal = array();
		foreach ($results as $result)
		{

			$data = array();

			$data['asin_info']['asin'] = $result['asin'];
			$data['asin_info']['market_url'] = $result['market_name'];

			$data['product']['title'] = $result['title'];
			$data['product']['category'] = $result['category'];
			$data['product']['brand'] = $result['brand'];
			$data['product']['fulfillment'] = $result['fulfillment'];
			$data['product']['size_tier'] = $result['size_tier'];
			$data['product']['num_image'] = $result['num_image'];
			$data['product']['variation_cnt'] = $result['variation_cnt'];
            $data['product']['weight'] = round($result['weight'],2);

			$data['p_index'] = $result['p_index'];
            $data['sellers'] = $result['sellers'];
            $data['monthly_sales'] = $this->makeComma($result['monthly_sales']);
            $data['sales_rank'] = $this->makeComma($result['bsr']);

            $currency = $this->getCurrency($result['market_name']);
            $data['price'] = $this->makeComma($result['price'], $currency);
            $data['monthly_revenue'] = $this->makeComma($result['monthly_revenue'], $currency);

            $data['reviews']['count'] = $this->makeComma($result['review_cnt']);
            $data['reviews']['rating'] = $result['review_rating'];

            $data['others']['last_year_sales'] = $this->makeComma($result['review_cnt']);
            $data['others']['sales_year'] = $this->makeComma($result['sales_year']);
            $data['others']['sales_trend'] = $this->makeComma($result['sales_trend']);
            $data['others']['price_trend'] = $this->makeComma($result['price_trend']);
            $data['others']['best_sales_period'] = $result['best_sales_period'];
            $data['others']['sales_to_reviews'] = $this->makeComma($result['sales_to_reviews']);

            $returnVal[] = $data;
		}

		echo json_encode(array('data'=>$returnVal));
	}

	public function getProductHistory()
	{
		$results = $this->Bigdata_model->getHistory($this->session->userdata('client_logged_in'), 'Big Data-Product');

		echo json_encode(array('data'=>$this->getHistoryArray($results)));
	}

	public function deleteProductHistory()
	{
		$task_id = $_POST['id'];
		echo $this->Bigdata_model->deleteBigDataHistory($task_id, 'tbl_service_product_data', 'tbl_service_product_complete');
	}

	public function makeExportFileForProduct($task_id)
	{
		$array = $this->Bigdata_model->getCompletionData($task_id, 'tbl_service_product_complete');

		if (count($array) == 0) {
			return null;
		}

		$structure = './csv_export/';

		if (!is_dir($structure))
		{
			if (!mkdir($structure, 0777, true)) {
				die('Failed to create folders...');
			}
		}

//		$filename = "csv_export/AmzDataVault".$task_id."_" . date("YmdHis") . ".csv";
		$filename = "csv_export/AmzDataVault".$task_id. ".csv";
		$df = fopen($filename, 'w');

		fputcsv($df, array('ASIN', 'Title', 'ProxScore', 'Category', 'Brand', 'BSR', 'Price', 'Monthly Sales', 'Net Price', 'Monthly Revenue',
			'Review Count','Review Rating', 'Sellers', 'Last Year Sales', 'Sales Year over Year', 'Sales Trend (90 days)', 'Price Trend (90 days)', 'Best Sales Period'));

		foreach ($array as $row) {

			$arr = array();

			$arr[] = $row['asin'];
			$arr[] = $row['title'];
			$arr[] = $row['p_index'];
			$arr[] = $row['category'];
			$arr[] = $row['brand'];
			$arr[] = $row['bsr'];
			$arr[] = $row['price'];
			$arr[] = $row['monthly_sales'];
			$arr[] = $row['net_price'];
			$arr[] = $row['monthly_revenue'];
			$arr[] = $row['review_cnt'];
			$arr[] = $row['review_rating'];
			$arr[] = $row['sellers'];
			$arr[] = $row['last_year_sales'];
			$arr[] = $row['sales_year'];
			$arr[] = $row['sales_trend'];
			$arr[] = $row['price_trend'];
			$arr[] = $row['best_sales_period'];

			fputcsv($df, $arr);
		}

		fclose($df);

		return $filename;
	}

	//Keyword
	public function keyword()
	{
		if (!$this->session->userdata('client_logged_in')) {
			redirect('login');
		}

		$user_name = $this->session->userdata('client_logged_in');
		$header_data['username'] = $user_name;
		$header_data['user_avatar'] = $this->Client_model->getUserAvatar($user_name);

		$this->load->view('user/common/header', $header_data);
		$this->load->view('user/services/big_data/keyword');
		$this->load->view('user/common/footer');
	}

	public function keywordResultView($task_id)
	{
		if (!$this->session->userdata('client_logged_in')) {
			redirect('login');
		}

		$this->Bigdata_model->setVisit($task_id);

		$user_name = $this->session->userdata('client_logged_in');
		$header_data['username'] = $user_name;
		$header_data['user_avatar'] = $this->Client_model->getUserAvatar($user_name);

		$data = array();

		$service_data_table = 'tbl_service_keyword_data';
		$service_complete_table = 'tbl_service_keyword_complete';
		$data['total_cnt'] = $this->Bigdata_model->getTotalCount($task_id, $service_complete_table);
        $data['status'] = $this->Bigdata_model->getStatus($task_id);
		$result = $this->Bigdata_model->getDataInfo($this->Bigdata_model->getRelatedTaskID($task_id), $service_data_table);

        array_diff($result, array($result['category_id']));
        $data['result'] = $result;
        $data['result']['category'] = $this->getCategory($result['category_id']);

		$file_url = $this->makeExportFileForKeyword($task_id);
		if (!empty($file_url))
			$data['export_file_name'] = base_url($file_url);
		else
			$data['export_file_name'] = 'javascript:;';

		$data['view_task_id'] = $task_id;

		$this->load->view('user/common/header', $header_data);
		$this->load->view('user/services/big_data/keyword_result_view', $data);
		$this->load->view('user/common/footer');
	}

	public function getKeywordCompletionData()
	{
		$task_id = $_POST['task_id'];

		$service_complete_table = 'tbl_service_keyword_complete';
		$results = $this->Bigdata_model->getCompletionData($task_id, $service_complete_table);

		$returnVal = array();
		foreach ($results as $result)
		{

			$data = array();

			$data['product']['market_url'] = $result['market_name'];
			$data['product']['keyword'] = $result['keyword'];
			$data['product']['category'] = $result['category'];
			$data['product']['fulfillment'] = $result['fulfillment'];
			$data['product']['size_tier'] = $result['size_tier'];
			$data['product']['variation_cnt'] = $result['variation_cnt'];
            $data['product']['sellers'] = $result['sellers'];

			$data['search_volume'] = $this->makeComma($result['search_volume']);
            $data['monthly_sales'] = $this->makeComma($result['monthly_sales']);
            $data['sales_rank'] = $this->makeComma($result['bsr']);

            $currency = $this->getCurrency($result['market_name']);
            $data['price'] = $this->makeComma($result['price'], $currency);
            $data['monthly_revenue'] = $this->makeComma($result['monthly_revenue'], $currency);

            $data['reviews']['count'] = $this->makeComma($result['review_cnt']);
            $data['reviews']['rating'] = $result['review_rating'];

            $data['others']['last_year_sales'] = $this->makeComma($result['review_cnt']);
            $data['others']['sales_year'] = $this->makeComma($result['sales_year']);
            $data['others']['sales_trend'] = $this->makeComma($result['sales_trend']);
            $data['others']['price_trend'] = $this->makeComma($result['price_trend']);
			$data['others']['best_sales_period'] = $result['best_sales_period'];
			$data['others']['sales_to_reviews'] = $this->makeComma($result['sales_to_reviews']);
			$data['others']['broad_reach_potential'] = $result['broad_reach_potential'];
            $data['others']['competing_num'] = $this->makeComma($result['competing_num']);

			$returnVal[] = $data;
		}

		echo json_encode(array('data'=>$returnVal));
	}

	public function getKeywordHistory()
	{
		$results = $this->Bigdata_model->getHistory($this->session->userdata('client_logged_in'), 'Big Data-Keyword');

		echo json_encode(array('data'=>$this->getHistoryArray($results)));
	}

	public function deleteKeywordHistory()
	{
		$task_id = $_POST['id'];
		echo $this->Bigdata_model->deleteBigDataHistory($task_id, 'tbl_service_keyword_data', 'tbl_service_keyword_complete');
	}

	public function makeExportFileForKeyword($task_id)
	{
		$array = $this->Bigdata_model->getCompletionData($task_id, 'tbl_service_keyword_complete');

		if (count($array) == 0) {
			return null;
		}

		$structure = './csv_export/';

		if (!is_dir($structure))
		{
			if (!mkdir($structure, 0777, true)) {
				die('Failed to create folders...');
			}
		}

//		$filename = "csv_export/AmzDataVault".$task_id."_" . date("YmdHis") . ".csv";
		$filename = "csv_export/AmzDataVault".$task_id. ".csv";
		$df = fopen($filename, 'w');

		fputcsv($df, array('Phrase', 'Search Volume', 'Category', 'BSR', 'Price', 'Monthly Sales', 'Monthly Revenue', 'Review Count','Review Rating', 'Sellers', 'Last Year Sales',
			'Sales Year over Year', 'Sales Trend (90 days)', 'Price Trend (90 days)', 'Best Sales Period', 'Broad Search Potential', 'Number of Competing Products', 'Sales to Reviews'));

		foreach ($array as $row) {

			$arr = array();

			$arr[] = $row['keyword'];
			$arr[] = $row['search_volume'];
			$arr[] = $row['category'];
			$arr[] = $row['bsr'];
			$arr[] = $row['price'];
			$arr[] = $row['monthly_sales'];
			$arr[] = $row['monthly_revenue'];
			$arr[] = $row['review_cnt'];
			$arr[] = $row['review_rating'];
			$arr[] = $row['sellers'];
			$arr[] = $row['last_year_sales'];
			$arr[] = $row['sales_year'];
			$arr[] = $row['sales_trend'];
			$arr[] = $row['price_trend'];
			$arr[] = $row['best_sales_period'];
			$arr[] = $row['broad_reach_potential'];
			$arr[] = $row['competing_num'];
			$arr[] = $row['sales_to_reviews'];

			fputcsv($df, $arr);
		}

		fclose($df);

		return $filename;
	}

	//Common
    public function isExistAlready()
    {
        $result = $this->Bigdata_model->isExistAlready($this->client_id, $_POST['dataArr']);
        echo json_encode($result);
    }

    public function startSearch()
    {
        echo $this->Bigdata_model->startSearch($this->client_id, $_POST['dataArr']);
    }

    public function getHistoryArray($results)
	{
		$i = 0;
		$returnVal = array();
		foreach ($results as $result)
		{
			$data = array();

			$data['no'] = ++$i;
			$data['market_place'] = $result['market_place'];
			$data['category'] = $this->getCategory($result['category_id']);
			$data['date_searched'] = date('Y-m-d', strtotime($result['request_time']));
			$data['status'] = $result['status']=='complete'?'complete':'pending';
			$data['action']['id'] = $result['id'];
			$data['action']['status'] = $result['status'];

			if (isset($result['asin']))
				$data['asin'] = $result['asin'];

			$returnVal[] = $data;
		}

		return $returnVal;
	}

	function getCategory($category_id)
    {
        $arr = array();

        foreach (explode(",", $category_id) as $category)
        {
            array_push($arr, $this->Bigdata_model->getCategory($category));
        }

        return implode("; ", $arr);
    }

    function getCurrency($market) {
        if ($market == 'Amazon.com')
            return '$';
        if ($market == 'Amazon.ca')
            return 'c$';
        if ($market == 'Amazon.de' || $market == 'Amazon.es' || $market == 'Amazon.fr' || $market == 'Amazon.it')
            return '€';
        if ($market == 'Amazon.co.uk')
            return '£';
    }

    function makeComma($var, $currency='')
    {
        return str_replace('.00', '', ($var!='-' && $var!='')?$currency.number_format($var, 2, '.', ','):$var);
    }
}
