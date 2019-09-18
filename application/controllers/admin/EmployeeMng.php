<?php


class EmployeeMng extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Employee_info_model', 'Employee_model');
        $this->load->model('Employee_task_model', 'Employee_task');
    }

    public function employee_mng()
    {
        $this->admin_login_check();

        $data['employee_all_info'] = $this->Employee_model->getAllEmployeeInfo();
        $data['employee_all_action'] = $this->Employee_model->getEmployeeSession();

        $this->load->view('admin/common/header');
        $this->load->view('admin/home/employee_management', $data);
        $this->load->view('admin/common/footer');
    }

    public function employee_create()
    {
        echo $this->Employee_model->create($this->input->post());
    }

    public function employee_edit()
    {
    	$service_arr = array();
    	foreach ($this->Employee_model->getServiceName() as $service)
		{
			$service_arr[] = $service['name'];
		}

        $emp_id = $_GET['id'];
        $data['employee_info'] = $this->Employee_model->getEmployeeInfo($emp_id);
        $data['complete_all_info'] = $this->Employee_task->getAllTaskForEmployee($emp_id, $service_arr, 3);
        $data['services'] = $service_arr;

        $this->load->view('admin/common/header');
        $this->load->view('admin/home/employee_edit', $data);
        $this->load->view('admin/common/footer');

    }

    public function employee_update()
    {
        echo $this->Employee_model->updateEmployeeInfoByAdmin($this->input->post());
    }

    public function employee_delete()
    {
        echo $this->Employee_model->delete($this->input->post());
    }

    public function employee_enable_status()
    {
        echo $this->Employee_model->change_enable_status($this->input->post());
    }

    public function employee_period()
    {
        $result = $this->Employee_model->getAllEmployeeInfo($this->input->post());

        echo json_encode($result);
    }

    public function export_employee_info()
    {
        $data = array('start_time'=>$_GET['start'], 'end_time'=>$_GET['end']);

        $array = $this->Employee_model->getAllEmployeeInfo($data);

        $filename = "csv_export/employee_export_" . date("Y-m-d") . ".csv";

        header('Content-Type: text/csv; charset=utf-8');
        header("Content-Disposition: attachment; filename=\"" . $filename . "\";" );

        $df = fopen('php://output', 'w');
        fputcsv($df, array($_GET['start'], '~', $_GET['end']));
        fputcsv($df, array(''));
        fputcsv($df, array('#', 'UserName', 'Password', 'Average Time', 'Completed Tasks', 'Current Status', 'Permissions'));

        $cnt = 0;
        foreach ($array as $row) {

            $cnt++;
            $completion_count = $row['completion_count']==''?'0':$row['completion_count'];
            $current_working_status = $row['current_working_status']=='1'?'Working':'Idle';
            $service_permission = $row['service_permission']==''?'':$row['service_permission'];
            fputcsv($df, array($cnt, $row['name'], $row['password'], $row['completion_avg_time'], $completion_count, $current_working_status, $service_permission));
        }
        fclose($df);
        die();
    }

    public function export_employee_session()
    {

        $array = $this->Employee_model->getEmployeeSession();

        $filename = "csv_export/session_export_" . date("Y-m-d") . ".csv";

        header('Content-Type: text/csv; charset=utf-8');
        header("Content-Disposition: attachment; filename=\"" . $filename . "\";" );


        $df = fopen('php://output', 'w');

        fputcsv($df, array(''));
        fputcsv($df, array('#', 'Time', 'Employee Name', 'IP Address', 'Country', 'Action'));

        $cnt = 0;
        foreach ($array as $row) {

            $cnt++;
            fputcsv($df, array($cnt, $row['time'], $row['name'], $row['ip_address'], $row['country'], $row['action']));
        }
        fclose($df);
        die();
    }

    protected function admin_login_check()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('login_');
        }
    }

}
