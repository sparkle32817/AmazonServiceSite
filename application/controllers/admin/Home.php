<?php


class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('User_model', 'Client_model');
        $this->load->model('Employee_info_model', 'Employee_model');
        $this->load->model('Employee_task_model', 'Employee_task');
        $this->load->model('Admin_info_model', 'Admin_model');
        $this->load->model('Service_account_management_model', 'Account_model');
    }

    public function index()
    {
        $this->admin_login_check();

        $data['client_all_info'] = $this->Client_model->getAllUserInfo();


        $this->load->view('admin/common/header');
        $this->load->view('admin/home/client_management', $data);
        $this->load->view('admin/common/footer');
    }

    public function client_edit()
    {
        $client_id = $_GET['id'];
        $data['client_info'] = $this->Client_model->getUserInfo($client_id);
        $data['markets'] = $this->Client_model->getMarkets();
        $data['service_times_info'] = $this->Employee_task->getServicesUsedTimesForClient($client_id);

        $this->load->view('admin/common/header');
        $this->load->view('admin/home/client_edit', $data);
        $this->load->view('admin/common/footer');

    }

    public function client_update()
    {
        echo $this->Client_model->updateUserInfoByAdmin($this->input->post());
    }

    public function viewClient()
    {
        $client_id = $_GET['id'];
        $data['client_info'] = $this->Client_model->getUserInfo($client_id);
        $data['cur_info'] = $this->Account_model->getAccountInfo($client_id);
        $data['before_info'] = $this->Account_model->getBeforeAccountInfo($client_id);

        $this->load->view('admin/common/header');
        $this->load->view('admin/home/client_view', $data);
        $this->load->view('admin/common/footer');

    }

    public function client_delete()
    {
        echo $this->Client_model->delete($this->input->post());
    }

    public function getServiceName()
    {
        $results = $this->Employee_model->getServiceName();

        $str = "";
        $cnt = 0;
        foreach ($results as $result)
        {
            if ($cnt==0) $str .= "'".$result['name']."'";
            else $str .= ", '".$result['name']."'";

            $cnt++;
        }

        echo $str;
    }

    public function client_function_period()
    {
        $postData = $this->input->post();

        $result = $this->Employee_task->getServicesUsedTimesForClient($postData['id'], $postData);

        echo json_encode($result);
    }

    public function client_info_period()
    {
        $results = $this->Client_model->getAllUserInfo($this->input->post());

        $returnVal = array();
        foreach ($results as $result) {

            $result['total_spent_amount'] = !empty($result['total_spent_amount']) ? $result['total_spent_amount'] : '0';
            $result['part_amount'] = !empty($result['part_amount']) ? $result['part_amount'] : '0';

            $allow_status = $result['allow_status'];
            if ($allow_status == "0") $allow_status = "Pending";
            else if ($allow_status == "1") $allow_status = "Approved";
            else if ($allow_status == "2") $allow_status = "Cancelled";
            else if ($allow_status == "3") $allow_status = "Balance Overdue";
            $result['allow_status'] = $allow_status;

            $data = array();
            $data['status'] = $result['app_status'];
            $data['id'] = $result['id'];

            $result['app_status'] = $data;

            array_push($returnVal, $result);
        }
        echo json_encode(array('data'=>$returnVal));
    }

    public function export_client_info()
    {
        $data = array('start_time'=>$_GET['start'], 'end_time'=>$_GET['end']);

        $array = $this->Client_model->getAllUserInfo($data);

        $filename = "csv_export/client_export_" . date("Y-m-d") . ".csv";

        header('Content-Type: text/csv; charset=utf-8');
        header("Content-Disposition: attachment; filename=\"" . $filename . "\";" );


        $df = fopen('php://output', 'w');
        fputcsv($df, array($_GET['start'], '~', $_GET['end']));
        fputcsv($df, array(''));
        fputcsv($df, array('#', 'UserName', 'Email', 'Phone Number',
            'Market Place', 'Amazon Seller ID', 'Invitation Code',
            'QQ', 'Membership', 'Client Total Spend', 'Current Status', 'Current Credits'));

        $cnt = 0;
        foreach ($array as $row) {

            $cnt++;
            $status = $row["allow_status"];
            if ($status=="0") $status = "Pending";
            else if ($status=="1") $status = "Approved";
            else if ($status=="2") $status = "Cancelled";
            else if ($status=="3") $status = "Balance Overdue";

            fputcsv($df, array($cnt, $row['user_name'], $row['email'], $row['phone_number'], $row['market_place'], $row['amazon_id'],
                $row['invitation_code'], $row['qq'], $row['membership'], $row['total_spent_amount'], $row['part_amount'], $status, $row['current_credit']));
        }
        fclose($df);
        die();

    }

    public function deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }

    protected function admin_login_check()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('login_');
        }
    }

    public function password_update()
    {
        echo $this->Admin_model->password_update($this->input->post());
    }

    public function logout($what='')
    {
        if ($what=='employee') {
            $emp_name = $this->session->userdata['employee_logged_in'];
            $this->Employee_task->setEmployeeSession($emp_name, 'Logout', $this->Employee_task->getEmployeeLogoutTime($emp_name));

            unset($this->session->userdata['employee_logged_in']);
        }
        else
        {
            unset($this->session->userdata['admin_logged_in']);
        }

//        $this->session->sess_destroy();

        redirect('login_');
    }

}