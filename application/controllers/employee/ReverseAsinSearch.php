<?php


class ReverseAsinSearch extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Employee_task_model', 'Employee_task');
        $this->load->model('Employee_info_model', 'Employee_model');
        $this->load->model('Service_reserve_search_model', 'Reserve_model');
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
        $this->load->view('employee/home/reverse_asin_search');
        $this->load->view('employee/common/footer', $data);
    }

    //Draw Content//
    public function getTaskDetailInfo()
    {
        $this->existSession();

        $postData = $this->input->post();
        $task_id = $postData['id'];

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
		$returnVal['content'] = $this->getContentFromReserveSearch($id);

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
			$str = '0m';

		return $str;
	}

    public function getPendingTableInfo()
    {
        $this->existSession();

        $emp_name = $this->session->userdata('employee_logged_in');

        $this->Employee_task->updateEmployeeLogout($emp_name);

        $service_arr = array('Reverse ASIN Search');
        $results = $this->Employee_task->getAllTaskForEmployee($this->Employee_task->getEmployeeID($emp_name), $service_arr, 1);

        $now_time = new DateTime('now');
        $returnVal = array();
		foreach ($results as $result) {

			$after_time = date_diff(new DateTime($result['request_time']), $now_time);

			$data = array();
			$data['id'] = 'Ticket'.$result['id'];
			$data['client_name'] = $result['client_name'];
			$data['service'] = $result['service'];
			$data['after_time'] = $this->getCorrectTime1($after_time->format('%a %H:%I:%S'));
			$data['status'] = $result['status'];

			$returnVal[] = $data;
        }

        echo json_encode(array('data'=>$returnVal));
    }

    public function getCompleteTableInfo()
    {
        $this->existSession();

        $emp_name = $this->session->userdata('employee_logged_in');

        $service_arr = array('Reverse ASIN Search');
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

		if(!empty($_FILES['file']['name']))
		{
			echo $this->processServiceReserveSearch($task_id, $_FILES['file']['tmp_name']);
		}
		else
		{
			echo 'no_file';
		}

    }

    //Process about BigDataCategory
	public function getContentFromReserveSearch($id)
	{
		$result = $this->Reserve_model->getReverseDataInfo($id);

		$str_content = '<div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 20px;">
                            <div class="col-md-4 col-sm-4 col-xs-4"></div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <label class="control-label">Market Place</label>
                                            </div>
                                            <input type="text" class="input-category" value="'.$result['market'].'" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="item form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <label class="control-label">ASIN</label>
                                            </div>
                                            <input type="text" class="input-category" value="'.$result['asin'].'" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4"></div>
                        </div>';

		return $str_content;
	}

	public function processServiceReserveSearch($task_id, $file_name)
	{
		$data_id = $this->Reserve_model->getRelatedTaskID($task_id);

		if (($temp_data = fopen($file_name, "r")) !== FALSE) {

			$check = $this->confirmCsvReserveSearch($temp_data);
			if ($check == 'Success') {

				$file_data = fopen($file_name, 'r');

				$header = fgetcsv($file_data);        //Pop up Header.

				while (($content = fgetcsv($file_data)) !== FALSE) {
					$arr = array(
						'task_id' => $data_id,
						'phrase' => $content[0],
						'iq_score' => $content[1],
						'search_volume' => $content[2],
                        'competing_product' => $content[3],
                        'give_aways' => $content[4],
						'sponsored_asin' => $content[5],
                        'amz_recommended' => $content[6],
						'organic' => $content[7],
						'sponsored' => $content[8],
                        'amz_recommended_rank' => $content[9],
                        'sponsored_rank' => $content[10],
                        'organic_rank' => $content[11]
					);

					$this->Reserve_model->insertCompleteData($arr);
				}

				$this->Employee_task->completeTask($this->session->userdata['employee_logged_in'], $task_id);

				return 'success';
			}

			return $check;
		}
	}

    public function confirmCsvReserveSearch($file_data)
	{
		$header_arr = fgetcsv($file_data);
        $arr = array('Phrase', 'Cerebro IQ Score', 'Search Volume', 'Competing Products', 'CPR 8-Day Giveaways', 'Sponsored ASINs', 'Amazon Recommended', 'Sponsored', 'Organic', 'Amazon Recommended Rank', 'Sponsored Rank', 'Organic Rank');

        if (array_diff($header_arr, array(''))!=array_diff($arr, array('')))
            return 'Header Error';

        $cnt = 0;
        while (($content_arr = fgetcsv($file_data)) !== FALSE)
        {
            $cnt++;

            if (empty($content_arr[0]))
                return 'There is no Keyword in row '.$cnt;

            for ($i=1; $i<6; $i++)
                if (!is_numeric($content_arr[$i]) && $content_arr[$i]!='-')
                    return 'Incorrect '.$header_arr[$i].' in row '.$cnt;

            for ($i=6; $i<9; $i++)
                if ($content_arr[$i]!='0' && $content_arr[$i]!='1')
                    return 'Incorrect '.$header_arr[$i].' in row '.$cnt;

            for ($i=9; $i<12; $i++)
                if (!is_numeric($content_arr[$i]) && $content_arr[$i]!='-')
                    return 'Incorrect '.$header_arr[$i].' in row '.$cnt;

        }

        if ($cnt==0)
            return 'There is no file content';

        return 'Success';
	}

    public function exportReverseSearchTaskCSVFile()
    {
        $filename = "reserve_keyword_search_". $_GET['task_id'] . ".csv";

        header('Content-Type: text/csv; charset=utf-8');
        header("Content-Disposition: attachment; filename=\"" . $filename . "\";" );

        $out = fopen('php://output', 'w');

        $arr = array('Phrase', 'Cerebro IQ Score', 'Search Volume', 'Competing Products', 'CPR 8-Day Giveaways', 'Sponsored ASINs', 'Amazon Recommended', 'Sponsored', 'Organic', 'Amazon Recommended Rank', 'Sponsored Rank', 'Organic Rank');
        fputcsv($out, $arr);

        fclose($out);
        die();
    }

	//Common
	public function existSession()
	{
		$emp_name = $this->session->userdata('employee_logged_in');

		if (empty($emp_name)) {
			redirect('login_');
		}
	}

}
