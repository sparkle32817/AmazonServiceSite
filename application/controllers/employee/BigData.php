<?php


class BigData extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Employee_task_model', 'Employee_task');
        $this->load->model('Employee_info_model', 'Employee_model');
        $this->load->model('Service_bigdata_model', 'BigData_model');
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
        $this->load->view('employee/home/big_data');
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
		if ($result['service']=='Big Data-Category')
		{
			$returnVal['content'] = $this->getContentFromBigDataCategory($id);
		}
		else if ($result['service']=='Big Data-Advertising')
		{
			$returnVal['content']= $this->getContentFromBigDataAdvertising($id);
		}
		else if ($result['service']=='Big Data-Product')
		{
			$returnVal['content']= $this->getContentFromBigDataProduct($id);
		}
		else if ($result['service']=='Big Data-Keyword')
		{
			$returnVal['content']= $this->getContentFromBigDataKeyword($id);
		}
		else
		{
			$returnVal['content']='';
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

		$service_arr = array('Big Data-Category', 'Big Data-Advertising', 'Big Data-Product', 'Big Data-Keyword');
        $results = $this->Employee_task->getAllTaskForEmployee($this->Employee_task->getEmployeeID($emp_name), $service_arr, 1);

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

			$returnVal[] = $data;
        }

        echo json_encode(array('data'=>$returnVal));
    }

    public function getCompleteTableInfo()
    {
        $this->existSession();

        $emp_name = $this->session->userdata('employee_logged_in');

		$service_arr = array('Big Data-Category', 'Big Data-Advertising', 'Big Data-Product', 'Big Data-Keyword');
		$results = $this->Employee_task->getAllTaskForEmployee($this->Employee_task->getEmployeeID($emp_name), $service_arr, 2);

		$returnVal = array();
		foreach ($results as $result) {

			$ticket_id = $result['id'];
			if ($ticket_id<10)
				$ticket_id = '0'.$ticket_id;

			$data = array();
			$data['id'] = 'Ticket'.$ticket_id;
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

    public function password_update()
    {
        $this->existSession();

        echo $this->Employee_model->password_update($this->session->userdata['employee_logged_in'], $this->input->post());
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
		$service = $_POST['service'];

		if(!empty($_FILES['file']['name']))
		{

			if ($service == 'Big Data-Category'){

				echo $this->processServiceBigDataCategory($task_id, $_FILES['file']['tmp_name']);
			}
			else if ($service == 'Big Data-Advertising')
			{
				print_r($this->processServiceBigDataAdvertising($task_id, $_FILES['file']['tmp_name']));
			}
			else if ($service == 'Big Data-Product')
			{
				print_r($this->processServiceBigDataProduct($task_id, $_FILES['file']['tmp_name']));
			}
			else if ($service == 'Big Data-Keyword')
			{
				print_r($this->processServiceBigDataKeyword($task_id, $_FILES['file']['tmp_name']));
			}
		}
		else
		{
			echo 'no_file';
		}

    }

    public function completeTaskWithoutData()
    {
        $this->existSession();

        $task_id = $_POST['task_id'];

        echo $this->Employee_task->completeTaskWithoutData($this->session->userdata['employee_logged_in'], $task_id);
    }

    //Process about BigDataCategory
	public function getContentFromBigDataCategory($id)
	{
		$result = $this->BigData_model->getDataInfo($id, 'tbl_service_category_data');

		$str_content = '<div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 20px;">
							<div class="col-md-2 col-sm-4 col-xs-12">
								<div class="item form-group">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<label class="control-label">Marketplace</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
											<input type="text" class="input-category" value="'.$result['market_place'].'" readonly>
										</div>
									</div>
								</div>
								<div class="item form-group">
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<label class="control-label">Category</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
											<input type="text" class="input-category" value="'.$result['category'].'" readonly>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-2 col-sm-4 col-xs-12">
								<div class="item form-group">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<label class="control-label">Monthly Revenue</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['revenue_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['revenue_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Sales Year Over Year(%)</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['sales_year_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['sales_year_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Monthly Sales(Units)</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['monthly_sales_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['monthly_sales_max'].'" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-2 col-sm-4 col-xs-12">
								<div class="item form-group">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<label class="control-label">Price</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['price_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['price_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Price Change(%)</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['price_change_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['price_change_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Best Sales Rank(BSR)</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['sales_rank_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['sales_rank_max'].'" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-2 col-sm-4 col-xs-12">
								<div class="item form-group">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<label class="control-label">Review Count</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['review_cnt_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['review_cnt_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Sales Change(%)</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['sales_change_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['sales_change_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Number of Sellers</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['seller_num_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['seller_num_max'].'" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-2 col-sm-4 col-xs-12">
								<div class="item form-group">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<label class="control-label">Review Rating</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['review_rating_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['review_rating_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Best Sales Period</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<input type="text" class="input-category" value="'.$result['best_sales_period'].'" readonly>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Weight(lb)</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['weight_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['weight_max'].'" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-2 col-sm-4 col-xs-12">
								<div class="item form-group">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Variation Count</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['variation_cnt_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['variation_cnt_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Sales to Reviews</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['sales_review_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['sales_review_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Number of Images</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['image_num_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['image_num_max'].'" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Exclude Keyword:</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['ex_keywords'].'" readonly>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Include Keyword:</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['in_keywords'].'" readonly>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Fulfillment</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<input type="text" class="input-category" value="'.$result['fulfillment'].'" readonly>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Shipping Size Tier</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<input type="text" class="input-category" value="'.$result['shipping_tier'].'" readonly>
										</div>
									</div>
								</div>
							</div>
						</div>';


		return $str_content;
	}

	public function processServiceBigDataCategory($task_id, $file_name)
	{
		$market_name = $this->BigData_model->getMarketName($task_id);

		if (($temp_data = fopen($file_name, "r")) !== FALSE) {

			$confirm = $this->confirmCsvBigDataCategory($temp_data);

			if ($confirm=='Success') {

				$file_data = fopen($file_name, 'r');

				fgetcsv($file_data);        //Pop up Header.

				while (($content = fgetcsv($file_data)) !== FALSE) {
					$arr = array(
						'task_id' => $task_id,
						'market_name' => $market_name,
						'asin' => $content[0],
						'title' => $content[1],
						'category' => $content[2],
						'brand' => $content[3],
						'fulfillment' => $content[4],
						'size_tier' => $content[5],
						'num_image' => $content[6],
						'variation_cnt' => $content[7],
						'weight' => $content[8],
						'bsr' => $content[9],
						'price' => $content[10],
						'monthly_sales' => $content[11],
						'net_price' => $content[12],
						'monthly_revenue' => $content[13],
						'review_cnt' => $content[14],
						'review_rating' => $content[15],
						'sellers' => $content[16],
						'last_year_sales' => $content[17],
						'sales_year' => $content[18],
						'sales_trend' => $content[19],
						'price_trend' => $content[20],
						'best_sales_period' => $content[21],
						'sales_to_reviews' => $content[22]
					);

					$this->BigData_model->insertCompleteData('tbl_service_category_complete', $arr);
				}

				$this->Employee_task->completeTask($this->session->userdata['employee_logged_in'], $task_id);

				return 'success';
			}

			return $confirm;
		}
	}

    public function confirmCsvBigDataCategory($file_data)
	{
		$header_arr = fgetcsv($file_data);

		$arr = array('ASIN', 'Title', 'Category', 'Brand', 'Fulfillment', 'Size Tier', 'Number of Images', 'Variation Count', 'Weight', 'BSR', 'Price', 'Monthly Sales', 'Net Price', 'Monthly Revenue', 'Review Count', 'Reviews Rating', 'Sellers', 'Last Year Sales', 'Sales Year Over Year', 'Sales Trend (90 days)', 'Price Trend (90 days)', 'Best Sales Period', 'Sales to Reviews');

		if (array_diff($header_arr, array(''))!=array_diff($arr, array('')))
            return 'Header information is wrong.';

		$cnt = 0;
		while (($content_arr = fgetcsv($file_data)) !== FALSE)
		{
			$cnt++;

			if (empty($content_arr[0]))
                return 'There is no ASIN in row '.$cnt;

			if (strlen($content_arr[0])!=10)
                return 'ASIN length must be 10 characters in row '.$cnt;

			for ($i=6; $i<21; $i++)
				if (!empty($content_arr[$i]) && !is_numeric($content_arr[$i]) && $content_arr[$i]!='-')
                    return 'Incorrect '.$header_arr[$i].' in row '.$cnt;

			if (!empty($content_arr[15]) && $content_arr[15]<-1 || $content_arr[15]>5)
                return 'Incorrect Reviews Rating in row '.$cnt;

			if (!empty($content_arr[22]) && !is_numeric($content_arr[22]) && $content_arr[22]!='-')
                return 'Incorrect Sales to Reviews in row '.$cnt;

		}

		if ($cnt==0)
			return 'There is no file content';

		return 'Success';
	}

	//Process about BigDataAdvertising
	public function getContentFromBigDataAdvertising($id)
	{
		$result = $this->BigData_model->getDataInfo($id, 'tbl_service_advertising_data');

		$str_content = '<div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 20px;">
							<div class="col-md-2 col-sm-4 col-xs-12">
								<div class="item form-group">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Product Asin</label>
										</div>
										<input type="text" class="input-category" value="'.$result['asin'].'" readonly >
									</div>
								</div>
								<div class="item form-group">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<label class="control-label">Marketplace</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
											<input type="text" class="input-category" value="'.$result['market_place'].'" readonly>
										</div>
									</div>
								</div>
								<div class="item form-group">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<label class="control-label">Category</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
											<input type="text" class="input-category" value="'.$result['category'].'" readonly>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-2 col-sm-4 col-xs-12">
								<div class="item form-group">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<label class="control-label">Monthly Revenue</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['revenue_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['revenue_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Sales Year Over Year(%)</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['sales_year_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['sales_year_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Monthly Sales(Units)</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['monthly_sales_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['monthly_sales_max'].'" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-2 col-sm-4 col-xs-12">
								<div class="item form-group">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<label class="control-label">Price</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['price_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['price_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Price Change(%)</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['price_change_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['price_change_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Best Sales Rank(BSR)</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['sales_rank_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['sales_rank_max'].'" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-2 col-sm-4 col-xs-12">
								<div class="item form-group">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<label class="control-label">Review Count</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['review_cnt_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['review_cnt_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Sales Change(%)</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['sales_change_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['sales_change_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Number of Sellers</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['seller_num_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['seller_num_max'].'" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-2 col-sm-4 col-xs-12">
								<div class="item form-group">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<label class="control-label">Review Rating</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['review_rating_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['review_rating_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Best Sales Period</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<input type="text" class="input-category" value="'.$result['best_sales_period'].'" readonly>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Weight(lb)</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['weight_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['weight_max'].'" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-2 col-sm-4 col-xs-12">
								<div class="item form-group">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Variation Count</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['variation_cnt_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['variation_cnt_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Sales to Reviews</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['sales_review_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['sales_review_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Number of Images</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['image_num_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['image_num_max'].'" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Exclude Keyword:</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['ex_keywords'].'" readonly>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Include Keyword:</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['in_keywords'].'" readonly>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Fulfillment</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<input type="text" class="input-category" value="'.$result['fulfillment'].'" readonly>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Shipping Size Tier</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<input type="text" class="input-category" value="'.$result['shipping_tier'].'" readonly>
										</div>
									</div>
								</div>
							</div>
						</div>';

		return $str_content;
	}

	public function processServiceBigDataAdvertising($task_id, $file_name)
	{
		$market_name = $this->BigData_model->getMarketName($task_id);

		if (($temp_data = fopen($file_name, "r")) !== FALSE) {

			$confirm = $this->confirmCsvBigDataAdvertising($temp_data);

			if ($confirm=='Success')
			{
				$file_data = fopen($file_name, "r");

				fgetcsv($file_data);

				while (($content = fgetcsv($file_data)) !== FALSE)
				{
					$arr = array(
						'task_id' => $task_id,
						'market_name' => $market_name,
						'asin' => $content[0],
						'title' => $content[1],
						'source' => $content[2],
						'category' => $content[3],
						'brand' => $content[4],
						'fulfillment' => $content[5],
						'size_tier' => $content[6],
						'num_image' => $content[7],
						'variation_cnt' => $content[8],
						'weight' => $content[9],
						'bsr' => $content[10],
						'price' => $content[11],
						'monthly_sales' => $content[12],
						'net_price' => $content[13],
						'monthly_revenue' => $content[14],
						'review_cnt' => $content[15],
						'review_rating' => $content[16],
						'sellers' => $content[17],
						'last_year_sales' => $content[18],
						'sales_year' => $content[19],
						'sales_trend' => $content[20],
						'price_trend' => $content[21],
						'best_sales_period' => $content[22],
						'sales_to_reviews' => $content[23]
					);

					$this->BigData_model->insertCompleteData('tbl_service_advertising_complete', $arr);
				}

				$this->Employee_task->completeTask($this->session->userdata['employee_logged_in'], $task_id);

				return 'success';
			}
			else
				return $confirm;

			fclose($file_data);
		}


	}

	public function confirmCsvBigDataAdvertising($file_data)
	{
		$header_arr = fgetcsv($file_data);

		$arr = array('ASIN', 'Title', 'Source', 'Category', 'Brand', 'Fulfillment', 'Size Tier', 'Number of Images', 'Variation Count', 'Weight', 'BSR', 'Price', 'Monthly Sales', 'Net Price', 'Monthly Revenue', 'Review Count', 'Reviews Rating', 'Sellers', 'Last Year Sales', 'Sales Year Over Year', 'Sales Trend (90 days)', 'Price Trend (90 days)', 'Best Sales Period', 'Sales to Reviews');

		if (array_diff($header_arr, array(''))!=array_diff($arr, array('')))
			return 'Header information is wrong.';

		$cnt = 0;
		while (($content_arr = fgetcsv($file_data)) !== FALSE)
		{
			$cnt++;

			if (empty($content_arr[0]))
                return 'There is no ASIN in row '.$cnt;

			if (strlen($content_arr[0])!=10)
                return 'ASIN length must be 10 characters in row '.$cnt;

			for ($i=7; $i<22; $i++)
				if (!empty($content_arr[$i]) && !is_numeric($content_arr[$i]) && $content_arr[$i]!='-')
                    return 'Incorrect '.$header_arr[$i].' in row '.$cnt;

			if ($content_arr[16]<-1 || $content_arr[16]>5)
                return 'Incorrect Reviews Rating in row '.$cnt;

			if (!empty($content_arr[23]) && !is_numeric($content_arr[23]) && $content_arr[23]!='-')
                return 'Incorrect Sales to Reviews in row '.$cnt;
		}

		if ($cnt==0)
			return 'There is no file content';

		return 'Success';
	}

	//Process about BigDataProduct
	public function getContentFromBigDataProduct($id)
	{
		$result = $this->BigData_model->getDataInfo($id, 'tbl_service_product_data');

		$str_content = '<div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 20px;">
							<div class="col-md-2 col-sm-4 col-xs-12">
								<div class="item form-group">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Product Asin</label>
										</div>
										<input type="text" class="input-category" value="'.$result['asin'].'" readonly >
									</div>
								</div>
								<div class="item form-group">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<label class="control-label">Marketplace</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
											<input type="text" class="input-category" value="'.$result['market_place'].'" readonly>
										</div>
									</div>
								</div>
								<div class="item form-group">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<label class="control-label">Category</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
											<input type="text" class="input-category" value="'.$result['category'].'" readonly>
										</div>
									</div>
								</div>
							</div>							
							<div class="col-md-2 col-sm-4 col-xs-12">
								<div class="item form-group">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<label class="control-label">Monthly Revenue</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['revenue_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['revenue_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Sales Year Over Year(%)</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['sales_year_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['sales_year_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Monthly Sales(Units)</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['monthly_sales_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['monthly_sales_max'].'" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-2 col-sm-4 col-xs-12">
								<div class="item form-group">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<label class="control-label">Price</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['price_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['price_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Price Change(%)</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['price_change_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['price_change_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Best Sales Rank(BSR)</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['sales_rank_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['sales_rank_max'].'" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-2 col-sm-4 col-xs-12">
								<div class="item form-group">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<label class="control-label">Review Count</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['review_cnt_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['review_cnt_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Sales Change(%)</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['sales_change_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['sales_change_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Number of Sellers</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['seller_num_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['seller_num_max'].'" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-2 col-sm-4 col-xs-12">
								<div class="item form-group">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<label class="control-label">Review Rating</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['review_rating_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['review_rating_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Best Sales Period</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<input type="text" class="input-category" value="'.$result['best_sales_period'].'" readonly>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Weight(lb)</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['weight_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['weight_max'].'" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-2 col-sm-4 col-xs-12">
								<div class="item form-group">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Variation Count</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['variation_cnt_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['variation_cnt_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Sales to Reviews</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['sales_review_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['sales_review_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Number of Images</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['image_num_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['image_num_max'].'" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Exclude Keyword:</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['ex_keywords'].'" readonly>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Include Keyword:</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['in_keywords'].'" readonly>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Fulfillment</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<input type="text" class="input-category" value="'.$result['fulfillment'].'" readonly>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Shipping Size Tier</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<input type="text" class="input-category" value="'.$result['shipping_tier'].'" readonly>
										</div>
									</div>
								</div>
							</div>
						</div>';

		return $str_content;
	}

	public function processServiceBigDataProduct($task_id, $file_name)
	{
		$market_name = $this->BigData_model->getMarketName($task_id);

		if (($temp_data = fopen($file_name, "r")) !== FALSE) {

			$confirm = $this->confirmCsvBigDataProduct($temp_data);

			if ($confirm=='Success')
			{
				$file_data = fopen($file_name, "r");

				fgetcsv($file_data);

				while (($content = fgetcsv($file_data)) !== FALSE)
				{
					$arr = array(
						'task_id' => $task_id,
						'market_name' => $market_name,
						'asin' => $content[0],
						'title' => $content[1],
						'p_index' => $content[2],
						'category' => $content[3],
						'brand' => $content[4],
						'fulfillment' => $content[5],
						'size_tier' => $content[6],
						'num_image' => $content[7],
						'variation_cnt' => $content[8],
						'weight' => $content[9],
						'bsr' => $content[10],
						'price' => $content[11],
						'monthly_sales' => $content[12],
						'net_price' => $content[13],
						'monthly_revenue' => $content[14],
						'review_cnt' => $content[15],
						'review_rating' => $content[16],
						'sellers' => $content[17],
						'last_year_sales' => $content[18],
						'sales_year' => $content[19],
						'sales_trend' => $content[20],
						'price_trend' => $content[21],
						'best_sales_period' => $content[22],
						'sales_to_reviews' => $content[23]
					);

					$this->BigData_model->insertCompleteData('tbl_service_product_complete', $arr);
				}

				$this->Employee_task->completeTask($this->session->userdata['employee_logged_in'], $task_id);

				return 'success';
			}
			else
				return $confirm;

			fclose($file_data);
		}


	}

	public function confirmCsvBigDataProduct($file_data)
	{
		$header_arr = fgetcsv($file_data);

		$arr = array('ASIN', 'Title', 'P-index', 'Category', 'Brand', 'Fulfillment', 'Size Tier', 'Number of Images', 'Variation Count', 'Weight', 'BSR', 'Price', 'Monthly Sales', 'Net Price', 'Monthly Revenue', 'Review Count', 'Reviews Rating', 'Sellers', 'Last Year Sales', 'Sales Year Over Year', 'Sales Trend (90 days)', 'Price Trend (90 days)', 'Best Sales Period', 'Sales to Reviews');

		if (array_diff($header_arr, array(''))!=array_diff($arr, array('')))
            return 'Header information is wrong.';

		$cnt = 0;
		while (($content_arr = fgetcsv($file_data)) !== FALSE)
		{
			$cnt++;

			if (empty($content_arr[0]))
                return 'There is no ASIN in row '.$cnt;

			if (strlen($content_arr[0])!=10)
                return 'ASIN length must be 10 characters in row '.$cnt;

			if (!empty($content_arr[2]) && !is_numeric($content_arr[2]))
                return 'Incorrect P-index in row '.$cnt;

			for ($i=7; $i<22; $i++)
				if (!empty($content_arr[$i]) && !is_numeric($content_arr[$i]) && $content_arr[$i]!='-')
                    return 'Incorrect '.$header_arr[$i].' in row '.$cnt;

			if ($content_arr[16]<-1 || $content_arr[16]>5)
                return 'Incorrect Reviews Rating in row '.$cnt;

			if (!empty($content_arr[23]) && !is_numeric($content_arr[23]) && $content_arr[23]!='-')
                return 'Incorrect Sales to Reviews in row '.$cnt;
		}

		if ($cnt==0)
			return 'There is no file content';

		return 'Success';
	}

	//Process about BigDataKeyword
	public function getContentFromBigDataKeyword($id)
	{
		$result = $this->BigData_model->getDataInfo($id, 'tbl_service_keyword_data');

		$str_content = '<div class="col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 20px;">
							<div class="col-md-2 col-sm-4 col-xs-12">
								<div class="item form-group">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<label class="control-label">Marketplace</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
											<input type="text" class="input-category" value="'.$result['market_place'].'" readonly>
										</div>
									</div>
								</div>
								<div class="item form-group">
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<label class="control-label">Category</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
											<input type="text" class="input-category" value="'.$result['category'].'" readonly>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-2 col-sm-4 col-xs-12">
								<div class="item form-group">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<label class="control-label">Monthly Revenue</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['revenue_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['revenue_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Monthly Sales(Units)</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['monthly_sales_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['monthly_sales_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Competing Product</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['competing_product_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['competing_product_max'].'" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-2 col-sm-4 col-xs-12">
								<div class="item form-group">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<label class="control-label">Price</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['price_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['price_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Best Sales Rank(BSR)</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['sales_rank_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['sales_rank_max'].'" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-2 col-sm-4 col-xs-12">
								<div class="item form-group">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<label class="control-label">Review Count</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['review_cnt_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['review_cnt_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Number of Sellers</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['seller_num_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['seller_num_max'].'" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-2 col-sm-4 col-xs-12">
								<div class="item form-group">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<label class="control-label">Review Rating</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['review_rating_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['review_rating_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Best Sales Period</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<input type="text" class="input-category" value="'.$result['best_sales_period'].'" readonly>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-2 col-sm-4 col-xs-12">
								<div class="item form-group">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 5px;">
											<label class="control-label">Variation Count</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['variation_cnt_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['variation_cnt_max'].'" readonly>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Search Volume</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['search_volume_min'].'" readonly>
											</div>
											<div class="col-md-2 col-sm-2 col-xs-12" style="align-content: center; height: 34px;">
												-
											</div>
											<div class="col-md-5 col-sm-5 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['search_volume_max'].'" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Exclude Keyword:</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['ex_keywords'].'" readonly>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Include Keyword:</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px;">
												<input type="text" class="input-category" value="'.$result['in_keywords'].'" readonly>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Fulfillment</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<input type="text" class="input-category" value="'.$result['fulfillment'].'" readonly>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px;">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<label class="control-label">Shipping Size Tier</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12">
											<input type="text" class="input-category" value="'.$result['shipping_tier'].'" readonly>
										</div>
									</div>
								</div>
							</div>
						</div>';

		return $str_content;
	}

	public function processServiceBigDataKeyword($task_id, $file_name)
	{
		$market_name = $this->BigData_model->getMarketName($task_id);
		$data_id = $this->BigData_model->getRelatedTaskID($task_id);

		if (($temp_data = fopen($file_name, "r")) !== FALSE) {

			$confirm = $this->confirmCsvBigDataKeyword($data_id, $temp_data);

			if ($confirm=='Success')
			{
				$file_data = fopen($file_name, "r");

				fgetcsv($file_data);

				while (($content = fgetcsv($file_data)) !== FALSE)
				{
					$arr = array(
						'task_id' => $data_id,
						'market_name' => $market_name,
						'keyword' => $content[0],
						'search_volume' => $content[1],
						'category' => $content[2],
						'fulfillment' => $content[3],
						'size_tier' => $content[4],
						'variation_cnt' => $content[5],
						'bsr' => $content[6],
						'price' => $content[7],
						'monthly_sales' => $content[8],
						'monthly_revenue' => $content[9],
						'review_cnt' => $content[10],
						'review_rating' => $content[11],
						'sellers' => $content[12],
						'last_year_sales' => $content[13],
						'sales_year' => $content[14],
						'sales_trend' => $content[15],
						'price_trend' => $content[16],
						'best_sales_period' => $content[17],
						'broad_reach_potential' => $content[18],
						'competing_num' => $content[19],
						'sales_to_reviews' => $content[20]
					);

					$this->BigData_model->insertCompleteData('tbl_service_keyword_complete', $arr);
				}

				$this->Employee_task->completeTask($this->session->userdata['employee_logged_in'], $task_id);

				return 'success';
			}
			else
				return $confirm;

			fclose($file_data);
		}


	}

	public function confirmCsvBigDataKeyword($data_id, $file_data)
	{
		$header_arr = fgetcsv($file_data);

		$arr = array('Phrase', 'SearchVolume', 'Category', 'Fulfillment', 'Size Tier', 'Variation Count', 'BSR', 'Price', 'Monthly Sales', 'Monthly Revenue', 'Review Count', 'Reviews Rating', 'Sellers', 'Last Year Sales', 'Sales Year Over Year', 'Sales Trend (90 days)', 'Price Trend (90 days)', 'Best Sales Period', 'Broad Reach Potential' ,'Number of competing products', 'Sales to Reviews');

		if (array_diff($header_arr, array(''))!=array_diff($arr, array('')))
            return 'Header information is wrong.';

		$cnt = 0;
		while (($content_arr = fgetcsv($file_data)) !== FALSE)
		{
			$cnt++;

			if (empty($content_arr[0]))
                return 'There is no keyword in row '.$cnt;

			if (!empty($content_arr[1]) && !is_numeric($content_arr[1]))
				return 'Incorrect SearchVolume in row '.$cnt;

			if (!$this->BigData_model->checkCategory($data_id, $content_arr[2]))
			    return 'Incorrect category in row '.$cnt;

			for ($i=5; $i<17; $i++)
				if (!empty($content_arr[$i]) && !is_numeric($content_arr[$i]) && $content_arr[$i]!='-')
                    return 'Incorrect '.$header_arr[$i].' in row '.$cnt;

			for ($i=18; $i<21; $i++)
				if (!empty($content_arr[$i]) && !is_numeric($content_arr[$i]) && $content_arr[$i]!='-')
                    return 'Incorrect '.$header_arr[$i].' in row '.$cnt;

			if (!empty($content_arr[11]) && ($content_arr[11]<-1 || $content_arr[11]>5))
                return 'Incorrect Reviews Rating in row '.$cnt;

		}

		if ($cnt==0)
			return 'There is no file content';

		return 'Success';
	}

	//Common
    public function existSession()
    {
        $emp_name = $this->session->userdata('employee_logged_in');

        if (empty($emp_name)) {
            redirect('login_');
        }
    }

	function matchField( $string ) {
		return preg_match( '/[0-9-]/', $string );
	}

}
