<?php


class TaskMng extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Employee_info_model', 'Employee_model');
        $this->load->model('Employee_task_model', 'Employee_task');
        //Service Models
        $this->load->model('Service_bigdata_model', 'Bigdata_model');
        $this->load->model('Service_keyword_track_model', 'KeyTrack_model');
        $this->load->model('Service_keyword_checker_model', 'KeyChecker_model');
    }

    public function task_mng()
    {
        $this->admin_login_check();

        $data['pending_all_info'] = $this->getViewInfoPendingTask($this->Employee_task->getAllPendingTaskByPeriod());
        $data['complete_all_info'] = $this->getViewInfoCompletionTask($this->Employee_task->getAllCompleteTaskByPeriod());
        $data['employee_infos'] = $this->Employee_model->getEmployeeInfos();

        $this->load->view('admin/common/header');
        $this->load->view('admin/home/task_management', $data);
        $this->load->view('admin/common/footer');
    }

    public function task_pending()
    {
        $postData = $this->input->post();

        $results = $this->Employee_task->getAllPendingTaskByPeriod($postData);

        echo json_encode($this->getViewInfoPendingTask($results));
    }

    public function task_complete()
    {
        $postData = $this->input->post();

        $results = $this->Employee_task->getAllCompleteTaskByPeriod($postData);

        echo json_encode($this->getViewInfoCompletionTask($results));
    }

    public function task_edit()
    {
        $postData = $this->input->post();

        echo $this->Employee_task->editTask($postData);
    }

    public function complete_task_delete()
    {
        $task_id = (int)str_replace('Ticket', '', $_POST['id']);
        $service = $_POST['service'];


        if ($service == 'Big Data-Category')
        {
            echo $this->Employee_task->deleteCompletedTask($task_id, 'tbl_service_category_data', 'tbl_service_category_complete');
        }
        else if ($service == 'Big Data-Advertising')
        {
            echo $this->Employee_task->deleteCompletedTask($task_id, 'tbl_service_category_data', 'tbl_service_category_complete');
        }
        else if ($service == 'Big Data-Product')
        {
            echo $this->Employee_task->deleteCompletedTask($task_id, 'tbl_service_product_data', 'tbl_service_product_complete');
        }
        else if ($service == 'Big Data-Keyword')
        {
            echo $this->Employee_task->deleteCompletedTask($task_id, 'tbl_service_keyword_data', 'tbl_service_keyword_complete');
        }
        else if ($service == 'Magnet Related Keyword Search')
        {
            echo $this->Employee_task->deleteCompletedTask($task_id, 'tbl_service_magnet_search_data', 'tbl_service_magnet_search_complete');
        }
        else if ($service == 'Reverse ASIN Search')
        {
            echo $this->Employee_task->deleteCompletedTask($task_id, 'tbl_service_reverse_search_data', 'tbl_service_reverse_search_complete');
        }
        else if ($service == 'Search Term Optimization')
        {
            echo $this->Employee_task->deleteCompletedTask($task_id, 'tbl_service_optimization_asin_data', 'tbl_service_optimization_data');
        }
    }

    public function pending_task_delete()
    {
        $task_id = (int)str_replace('Ticket', '', $_POST['id']);
        $service = $_POST['service'];

        echo $this->Employee_task->deletePendingTask($task_id, $service);

    }

    public function approveCompletedTask()
    {
        echo $this->Employee_task->approveCompletedTask($_POST['task_id']);
    }

    public function rejectCompletedTask()
    {
        echo $this->Employee_task->rejectCompletedTask($_POST['task_id']);
    }

    function getViewInfoPendingTask($results)
    {
        $now_time = new DateTime('now');
        $returnVal = array();
        foreach ($results as $result) {

            $after_time = date_diff(new DateTime($result['request_time']), $now_time);

            $ticket_id = $result['id'];
            if ($ticket_id<10)
                $ticket_id = '0'.$ticket_id;

            $data = array();
            $data['id'] = 'Ticket'.$ticket_id;
            $data['client_name'] = $result['client_name'];
            $data['service'] = $result['service'];
            $data['after_time'] = $this->getCorrectTime1($after_time->format('%a %H:%I:%S'));
            $data['status'] = $result['status'];
            $data['employee_id'] = $result['employee_id'];
            $data['employee_name'] = $result['employee_name']!=null?$result['employee_name']:'';
            $data['view_url'] = $this->getViewUrl($result['service'], $result['id']);

            $returnVal[] = $data;
        }

        return $returnVal;
    }

    function getViewInfoCompletionTask($results)
    {
        $returnVal = array();
        foreach ($results as $result) {


            $ticket_id = $result['id'];
            if ($ticket_id<10)
                $ticket_id = '0'.$ticket_id;

            $data = array();
            $data['id'] = 'Ticket'.$ticket_id;
            $data['client_name'] = $result['client_name'];
            $data['service'] = $result['service'];
            $data['start_time'] = $result['start_time'];
            $data['end_time'] = $result['end_time'];
            $data['completion_time'] = $this->getCorrectTime($result['completion_time']);
            $data['status'] = $result['status'];
            $data['employee_name'] = $result['employee_name'];
            $data['view_url'] = $this->getViewUrl($result['service'], $result['id']);

            $data['approved'] = 'Approved';
            if (!$result['is_approved_task'])
            {
                $str = 'No Approved&nbsp;&nbsp;';
                $str .= '<a href="javascript:;"><i class="fa fa-check-circle approve_task" a-id="'.$result['id'].'" style="font-size: 16px; color: #1ABB9C" title="Approve this task"></i></a>&nbsp;&nbsp;';
                $str .= '<a href="javascript:;"><i class="fa fa-times-circle reject_task" a-id="'.$result['id'].'" style="font-size: 16px; color: red;" title="Reject this task"></i></a>';

                $data['approved'] = $str;
            }

            $returnVal[] = $data;
        }

        return $returnVal;
    }

    public function task_over()
    {
        $this->admin_login_check();

        $data['service_times_info'] = $this->Employee_task->getServicesUsedTimes();

        $this->load->view('admin/common/header');
        $this->load->view('admin/home/task_overview', $data);
        $this->load->view('admin/common/footer');
    }

    public function task_over_period()
    {
        $postData = $this->input->post();

        $result = $this->Employee_task->getServicesUsedTimes($postData);

        echo json_encode($result);
    }

    public function export_task_overview()
    {
        $data = array('start_time'=>$_GET['start'], 'end_time'=>$_GET['end']);

        $array = $this->Employee_task->getServicesUsedTimes($data);

        $filename = "task_export_". date("Y-m-d") . ".csv";

        header('Content-Type: text/csv; charset=utf-8');
        header("Content-Disposition: attachment; filename=\"" . $filename . "\";" );

        $out = fopen('php://output', 'w');
        fputcsv($out, array($_GET['start'], '~', $_GET['end']));
        fputcsv($out, array(''));
        fputcsv($out, array('Service ID', 'Service Name', 'Used Times'));

        $cnt = 0;
        foreach ($array as $row) {

            $cnt++;
            fputcsv($out, array($cnt, $row['name'], $row['times']));
        }
        fclose($out);
        die();
    }

    protected function admin_login_check()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('login_');
        }
    }

    public function getCorrectTime($time)
    {
        $str='';

        if (!empty($time))
        {

            $arr = explode(":", $time);

            $day = intval($arr[0]/24);
            $h = $arr[0]-$day*24;
            $min = $arr[1];

            if ($day==1)
                $str .= $day.'day ';
            else if ($day>1)
                $str .= $day.'days ';

            if ($h!=0)
                $str .= $h."h ";

            if ($min!=0)
                $str .= $min."min";

        }

        if ($str=='')
            $str = '0min';

        return $str;
    }

    public function getCorrectTime1($time)
    {
        $str='';

        if (!empty($time))
        {

            $arr = explode(" ", $time);

            $day = $arr[0];
            if ($day==1)
                $str .= $day.'day ';
            else if ($day>1)
                $str .= $day.'days ';


            $arr1 = explode(":", $arr[1]);
            $h = $arr1[0];

            if ($h!=0)
                $str .= $h."h ";

            $min = $arr1[1];
            if ($min!=0)
                $str .= $min."min";

        }

        if ($str=='')
            $str = '0min';

        return $str;
    }

    function getViewUrl($service, $id)
    {
        $view_url = 'javascript:;';
        if ($service == 'Big Data-Category')
            $view_url = base_url().'admin/viewCategory/'.$id;
        else if ($service == 'Big Data-Advertising')
            $view_url = base_url().'admin/viewAdvertising/'.$id;
        else if ($service == 'Big Data-Product')
            $view_url = base_url().'admin/viewProduct/'.$id;
        else if ($service == 'Big Data-Keyword')
            $view_url = base_url().'admin/viewKeyword/'.$id;
        else if ($service == 'AMZ Product Keyword Index Checker')
            $view_url = base_url().'admin/viewKeywordChecker/'.$id;
        else if ($service == 'Magnet Related Keyword Search')
            $view_url = base_url().'admin/viewMagnetSearch/'.$id;
        else if ($service == 'Reverse ASIN Search')
            $view_url = base_url().'admin/viewReverseSearch/'.$id;
        else if ($service == 'Search Term Optimization')
            $view_url = base_url().'admin/viewKeywordOptimization/'.$id;

        return $view_url;
    }

}
