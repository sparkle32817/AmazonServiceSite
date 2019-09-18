<?php


class ViewServices extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Service_bigdata_model', 'Bigdata_model');
        $this->load->model('Service_keyword_checker_model', 'KeyChecker_model');
        $this->load->model('Service_magnet_keyword_search_model', 'Magnet_model');
        $this->load->model('Service_reserve_search_model', 'Reserve_model');
        $this->load->model('Service_keyword_optimization_model', 'Optimization_model');
    }

    public function categoryResultView($task_id)
    {
        $this->admin_login_check();

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

        $this->load->view('admin/common/header');
        $this->load->view('admin/view_service/category_result_view', $data);
        $this->load->view('admin/common/footer');
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

        $filename = "AmzDataVault".$task_id. ".csv";
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

    public function advertisingResultView($task_id)
    {
        $this->admin_login_check();

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

        $this->load->view('admin/common/header');
        $this->load->view('admin/view_service/advertising_result_view', $data);
        $this->load->view('admin/common/footer');
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

    public function productResultView($task_id)
    {
        $this->admin_login_check();

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

        $this->load->view('admin/common/header');
        $this->load->view('admin/view_service/product_result_view', $data);
        $this->load->view('admin/common/footer');
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

    public function keywordResultView($task_id)
    {
        $this->admin_login_check();

        $data = array();

        $service_data_table = 'tbl_service_keyword_data';
        $service_complete_table = 'tbl_service_keyword_complete';
        $data['total_cnt'] = $this->Bigdata_model->getTotalCount($task_id, $service_complete_table);
        $data['status'] = $this->Bigdata_model->getStatus($task_id);
        $data['result'] = $this->Bigdata_model->getDataInfo($this->Bigdata_model->getRelatedTaskID($task_id), $service_data_table);

        $file_url = $this->makeExportFileForKeyword($task_id);
        if (!empty($file_url))
            $data['export_file_name'] = base_url($file_url);
        else
            $data['export_file_name'] = 'javascript:;';

        $data['view_task_id'] = $task_id;

        $this->load->view('admin/common/header');
        $this->load->view('admin/view_service/keyword_result_view', $data);
        $this->load->view('admin/common/footer');
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

    public function keywordCheckerResultView($task_id)
    {
        $this->admin_login_check();

        $data = array();

        $data['status'] = $this->KeyChecker_model->getStatus($task_id);
        $data['result'] = $this->KeyChecker_model->getDataInfo($this->KeyChecker_model->getRelatedTaskID($task_id));

        $data['view_asin_id'] = $this->KeyChecker_model->getRelatedTaskID($task_id);

        $this->load->view('admin/common/header');
        $this->load->view('admin/view_service/keyword_index_checker_view', $data);
        $this->load->view('admin/common/footer');
    }

    public function magnetSearchResultView($task_id)
    {
        $this->admin_login_check();

        $data = array();

        $data['result'] = $this->Magnet_model->getDataInfo($task_id);
        $data['keyword'] = $this->Magnet_model->getKeyword($task_id);
        $data['status'] = $this->Magnet_model->getStatus((int)str_replace('Ticket', '', $task_id));
        $data['keyword_count'] = $this->Magnet_model->getKeywordCount($task_id);

        $data['view_keyword_id'] = $this->KeyChecker_model->getRelatedTaskID($task_id);

        $this->load->view('admin/common/header');
        $this->load->view('admin/view_service/magnet_keyword_search_view', $data);
        $this->load->view('admin/common/footer');
    }

    public function reverseSearchResultView($task_id)
    {
        $this->admin_login_check();

        $data = array();

        $data['result'] = $this->Reserve_model->getData($task_id);
        $data['status'] = $this->Reserve_model->getStatus((int)str_replace('Ticket', '', $task_id));
        $data['keyword_count'] = $this->Reserve_model->getKeywordSum($task_id);

        $data['view_keyword_id'] = $this->Reserve_model->getRelatedTaskID($task_id);

        $this->load->view('admin/common/header');
        $this->load->view('admin/view_service/reverse_asin_search_view', $data);
        $this->load->view('admin/common/footer');
    }

    public function keywordOptimizationResultView($task_id)
    {
        $this->admin_login_check();

        $data = array();

        $data['input_result'] = $this->Optimization_model->getInputData($task_id);
        $data['searched_result'] = $this->Optimization_model->getSearchedData($task_id);

        $this->load->view('admin/common/header');
        $this->load->view('admin/view_service/keyword_optimization_view', $data);
        $this->load->view('admin/common/footer');
    }

    protected function admin_login_check()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('login_');
        }
    }

}