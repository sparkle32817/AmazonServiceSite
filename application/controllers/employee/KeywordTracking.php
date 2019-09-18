<?php


class KeywordTracking extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Employee_task_model', 'Employee_task');
        $this->load->model('Employee_info_model', 'Employee_model');
        $this->load->model('Service_keyword_track_model', 'KeyTracking_model');
    }

    public function index()
    {
        $this->existSession();

        $emp_name = $this->session->userdata('employee_logged_in');

		$service_arr = array('Big Data-Category', 'Big Data-Advertising', 'Big Data-Product', 'Big Data-Keyword');
		$result_big_data = $this->Employee_task->getAllTaskForEmployee($this->Employee_task->getEmployeeID($emp_name), $service_arr, 1);

		$service_arr = array('AMZ Product Keyword Index Checker');
		$result_index_checker = $this->Employee_task->getAllTaskForEmployee($this->Employee_task->getEmployeeID($emp_name), $service_arr, 1);

		$service_arr = array('Keyword Rank Tracking');
		$result_key_tracking = $this->Employee_task->getAllTaskForEmployee($this->Employee_task->getEmployeeID($emp_name), $service_arr, 1);

        $service_arr = array('Magnet Related Keyword Search');
        $magnet_key_search = $this->Employee_task->getAllTaskForEmployee($this->Employee_task->getEmployeeID($emp_name), $service_arr, 1);

        $service_arr = array('Reverse ASIN Search');
        $reverse_asin_search = $this->Employee_task->getAllTaskForEmployee($this->Employee_task->getEmployeeID($emp_name), $service_arr, 1);

        $service_arr = array('Reverse ASIN Search');
        $result_key_optimization = $this->Employee_task->getAllTaskForEmployee($this->Employee_task->getEmployeeID($emp_name), $service_arr, 1);

        $header_data['key_tracking'] = '('.sizeof($result_key_tracking).')';
        $header_data['big_data'] = '('.sizeof($result_big_data).')';
        $header_data['key_index_checker'] = '('.sizeof($result_index_checker).')';
        $header_data['magnet_key_search'] = '('.sizeof($magnet_key_search).')';
        $header_data['reverse_asin_search'] = '('.sizeof($reverse_asin_search).')';
        $header_data['key_optimization'] = '('.sizeof($result_key_optimization).')';

        $data['most_recent_time'] = $this->Employee_task->getRecentTaskCompletionTime($emp_name);
        $data['this_month'] = $this->Employee_task->getAvgCompletionTime($emp_name);
        $data['previous_month'] = $this->Employee_task->getAvgCompletionTime($emp_name, 'previous');


        $this->load->view('employee/common/header', $header_data);
        $this->load->view('employee/home/tasks_keyword_tracking');
        $this->load->view('employee/common/footer', $data);
    }

    //Draw Content//
    public function getTaskDetailInfo()
    {
        $this->existSession();

        $postData = $this->input->post();
        $task_id = $postData['id'];
        $status = $postData['status'];

        $result = $this->Employee_task->getPendingTask($task_id);

        $returnVal['status'] = $result['status'];

        if ($result['status']=='complete'){

            $start_date = new DateTime($result['start_time']);
            $complete = $start_date->diff(new DateTime($result['end_time']));

            $time_str = '';

            if ( $complete->d == 1 )
                $time_str .= '1 day ';
            elseif ( $complete->d > 1 )
                $time_str .= $complete->d.' days ';

            $time_str .= ($complete->h>9)?$complete->h:'0'.$complete->h;
            $time_str .= ':';
            $time_str .= ($complete->i>9)?$complete->i:'0'.$complete->i;
            $time_str .= ':';
            $time_str .= ($complete->s>9)?$complete->s:'0'.$complete->s;

            $returnVal['time'] = 'Completed during : '.$time_str;
        }
        else
        {
			$now_time = new DateTime('now');
			$after_time = date_diff(new DateTime($result['request_time']), $now_time);

            $returnVal['time'] = 'Time since submitted : '.$this->getCorrectTime1($after_time->format('%a %H:%I:%S'));
        }

		$id = $result['related_task_id'];
        $asin_info = $this->KeyTracking_model->getAsinDataInfo($id);

        if ($result['status'] && $this->KeyTracking_model->getExistStatus($id)==-1)
        {
            $returnVal['content'] = '<div class="form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-md-4 col-sm-12 col-xs-12" style="margin-top: 5px;">
                                                <label class="control-label" style="float:right;"> Deleted ASIN : </label>
                                            </div>
                                            <div class="col-md-7 col-sm-12 col-xs-12" style="padding: 0px;">
                                                <input type="text" class="input-category" value="'.$asin_info['asin_num'].'" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px">
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 5px;">
                                            <center><label class="control-label" style="margin-left: 40px;"> This task is deleted by Client</label></center>
                                        </div>
                                    </div>';

            $returnVal['completable'] = true;
        }
        else
        {
            $returnVal['content']= $this->getContentFromKeyRankTracking($id, $result['status']);
        }

        if ( $result['status']=='working' && $this->session->userdata['employee_logged_in']!=$result['employee_name'] )
            $returnVal['own']='other';
        else
            $returnVal['own']='self';

        echo json_encode($returnVal);

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

    public function getPendingTableInfo()
    {
        $this->existSession();

        $emp_name = $this->session->userdata('employee_logged_in');

        $this->Employee_task->updateEmployeeLogout($emp_name);

        $service_arr = array('Keyword Rank Tracking');
        $results = $this->Employee_task->getAllTaskForEmployee($this->Employee_task->getEmployeeID($emp_name), $service_arr, 1);

        $now_time = new DateTime('now');
        $returnVal = array();
		foreach ($results as $result) {

		    if ($this->KeyTracking_model->checkContent($result))
            {
                $after_time = date_diff(new DateTime($result['request_time']), $now_time);

                $data = array();
                $data['id'] = 'Ticket'.$result['id'];
                $data['client_name'] = $result['client_name'];
                $data['service'] = $result['service'];
                $data['after_time'] = $this->getCorrectTime1($after_time->format('%a %H:%I:%S'));
                $data['status'] = $result['status'];

                $returnVal[] = $data;
            }
        }

        echo json_encode(array('data'=>$returnVal));
    }

    public function getCompleteTableInfo()
    {
        $this->existSession();

        $emp_name = $this->session->userdata('employee_logged_in');

		$service_arr = array('Keyword Rank Tracking');
		$results = $this->Employee_task->getAllTaskForEmployee($this->Employee_task->getEmployeeID($emp_name), $service_arr, 2);

		$returnVal = array();
		foreach ($results as $result) {
			$data = array();
			$data['id'] = 'Ticket'.$result['id'];
			$data['client_name'] = $result['client_name'];
			$data['service'] = $result['service'];
			$data['request_time'] = $result['request_time'];
			$data['start_time'] = $result['start_time'];
			$data['end_time'] = $result['end_time'];
			$data['status'] = $result['status'];

			$returnVal[] = $data;
		}

		echo json_encode(array('data'=>$returnVal));
    }

    public function startTask()
    {
        $this->existSession();

        $result = $this->Employee_task->startTask($this->session->userdata['employee_logged_in'], $this->input->post());
        echo $result;
    }

    public function completeTask()
    {
        $this->existSession();

		$task_id = $_POST['id'];
//		$service = $_POST['service'];

		if(!empty($_FILES['file']['name']))
        {
            print_r($this->processServiceKeywordTracking($task_id, $_FILES['file']['tmp_name']));
		}
		else
		{
			echo 'no_file';
		}

    }

    public function completeDeletedTask()
    {
        $this->existSession();

        $task_id = $_POST['task_id'];

        echo $this->Employee_task->completeDeletedTask($this->session->userdata['employee_logged_in'], $task_id);
    }

    //Process about Keyword Rank Tracking
	public function getContentFromKeyRankTracking($id, $status)
	{
		$result = $this->KeyTracking_model->getAsinDataInfo($id);

		if ($status == 'pending')
        {
            $str_content = $this->getActionContent($result['asin_num'], $this->KeyTracking_model->getPendingKeywords($id));
            return '<div class="col-md-6 col-sm-12">'.$str_content.'</div>';
        }
		else if ($status == 'working')
        {
            $str_main = $this->getActionContent($result['asin_num'], $this->KeyTracking_model->getWorkingKeywords($id), 0);
            $str_added = $this->getActionContent($result['asin_num'], $this->KeyTracking_model->getAddedKeywords($id), 1);
            $str_deleted = $this->getActionContent($result['asin_num'], $this->KeyTracking_model->getDeletedKeywords($id), 2);

            $str_content = '<div class="col-md-6 col-sm-12">'.$str_main.'</div>';
            $str_content .= '<div class="col-md-6 col-sm-12">';
            if (!empty($str_added))
                $str_content .= '<div class="col-md-12 col-sm-12" style="margin-bottom: 30px;">'.$str_added.'</div>';
            $str_content .= '<div class="col-md-12 col-sm-12">'.$str_deleted.'</div>';
            $str_content .= '</div>';
            return $str_content;
        }

        $str_content = $this->getActionContent($result['asin_num'], $this->KeyTracking_model->getCompletedKeywords($id));
		return '<div class="col-md-6 col-sm-12">'.$str_content.'</div>';
	}

	function getActionContent($asin_num, $keywords, $type='')
    {
        if ($keywords == array())
            return '';

        $prefix_asin = 'New ';
        $prefix_keyword = '';
        $str_style = '';
        if ($type == 0)
        {
            $prefix_asin = '';
        }
        else if ($type == 1)
        {
            $prefix_asin = 'Existing ';
            $prefix_keyword = 'Added ';
            $str_style = 'style="height: 200px;"';
        }
        else if ($type == 2)
        {
            $prefix_asin = 'Existing ';
            $prefix_keyword = 'Deleted ';
            $str_style = 'style="height: 200px;"';
        }

        $str_content = '<div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="col-md-4 col-sm-12 col-xs-12" style="margin-top: 5px;">
                                    <label class="control-label" style="float:right;">'.$prefix_asin.'ASIN : </label>
                                </div>
                                <div class="col-md-7 col-sm-12 col-xs-12" style="padding: 0px;">
                                    <input type="text" class="input-category" value="'.$asin_num.'" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px">
                                <div class="col-md-4 col-sm-12 col-xs-12" style="margin-top: 5px;">
                                    <label class="control-label" style="float:right;">'.$prefix_keyword.'Keywords : </label>
                                </div>
                                <div class="col-md-7 col-sm-12 col-xs-12" style="padding: 0px;">
                                    <textarea '.$str_style.' readonly>'.$this->getKeywordString($keywords).'</textarea>
                                </div>
                            </div>
                        </div>';

        return $str_content;
    }

	function getKeywordString($keywords)
    {
        $str_keywords='';
        foreach ($keywords as $keyword)
        {
            $str_keywords .= $keyword['keyword'].'&#13;&#10;';
        }

        return $str_keywords;
    }

	public function processServiceKeywordTracking($task_id, $file_name)
	{

        if (($temp_data = fopen($file_name, "r")) !== FALSE) {

            $confirm = $this->confirmCsvKeywordTracking($task_id, $temp_data);

            if ($confirm=='Success') {

                $file_data = fopen($file_name, 'r');

                fgetcsv($file_data);        //Pop up Header.

                while (($content = fgetcsv($file_data)) !== FALSE) {
                    $arr = array(
                        'keyword' => $content[1],
                        'exact_search_volume' => $content[2],
                        'broad_search_volume' => $content[3],
                        'competing_product' => $content[4],
                        'rank' => $content[7],
                        'date_last_updated' => date('Y-m-d H:i:s')
                    );

                    $this->KeyTracking_model->insertCompleteData($task_id, $arr);
                }

                $this->Employee_task->completeTask($this->session->userdata['employee_logged_in'], $task_id);

                return 'success';
            }

            return $confirm;
        }
	}

    public function confirmCsvKeywordTracking($task_id, $file_data)
	{
		$header_arr = fgetcsv($file_data);
		$arr = array('ASIN', 'Keyword', 'Exact Search Volume', 'Broad Search Volume', 'Competing Products', 'Marketplace', 'Date Last Updated', 'Organic Rank');

        if (!$this->compareHeader($header_arr, $arr))
        {
            return 'Header Error';
        }

        $cnt = 0;
        while (($content_arr = fgetcsv($file_data)) !== FALSE)
        {
            $cnt++;

            if (empty($content_arr[0]))
                return 'No_ASIN'.','.$cnt;

            if (strlen($content_arr[0])!=10)
                return 'ASIN length('.strlen($content_arr[0]).') error in row '.$cnt;

            if (!$this->KeyTracking_model->checkKeyword($task_id, $content_arr[0], $content_arr[1], $content_arr[5]))
                return 'Keyword or marketplace is not matched correctly in row '.$cnt;
//                return $this->KeyTracking_model->checkKeyword($task_id, $content_arr[1], $content_arr[2], $content_arr[6]);

            for ($i=2; $i<5; $i++)
                if (empty($content_arr[$i]) || !is_numeric($content_arr[$i]) && $content_arr[$i]!='-')
                    return $header_arr[$i].'('.$content_arr[$i].') must be number or \'-\' in row '.$cnt;

//            if ($content_arr[7]<1)
//                return 'Organic Rank::'.$content_arr[7].','.$cnt;
        }

        if ($cnt==0)
            return 'There is no file content';

        return 'Success';
	}

	public function exportKeywordTrackingTaskCSVFile()
    {

        $filename = "keyword_rank_tracking_". $_GET['asin_id'] . ".csv";

        header('Content-Type: text/csv; charset=utf-8');
        header("Content-Disposition: attachment; filename=\"" . $filename . "\";" );

        $out = fopen('php://output', 'w');

        $arr = array('ASIN', 'Keyword', 'Exact Search Volume', 'Broad Search Volume', 'Competing Products', 'Marketplace', 'Date Last Updated', 'Organic Rank');
        fputcsv($out, $arr);

        fclose($out);
        die();
    }

	//Common
    public function compareHeader($csv_header, $header)
    {
        $arr = array();
        foreach ( $csv_header as $item) {
            array_push($arr, trim($item));

//            var_dump($arr);
//            echo '<br>';
        }

        if (array_diff($arr, array(''))!=array_diff($header, array(''))) {

//            var_dump($arr);
//            echo '<br>';
//            var_dump($header);
//            echo '<br>';

            return false;
        }

        return true;
    }

    public function existSession()
    {
        $emp_name = $this->session->userdata('employee_logged_in');

        if (empty($emp_name)) {
            redirect('login_');
        }
    }

}
