<?php


class Employee_task_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAllPendingTask($status='')
    {
        $start_time = date('Y-m-d 00:00:00');
        $end_time = date('Y-m-d 23:59:59');

        if ($status=='') {
            $this->db->where('status != ', 'complete');
            $this->db->where('request_time >=', $start_time);
            $this->db->where('request_time <=', $end_time);
        }
        else {
            $this->db->where('status', 'complete');
            $this->db->where('start_time >=', $start_time);
            $this->db->where('end_time <=', $end_time);
        }

        $query = $this->db->get('tbl_view_all_task');

		return $query->result_array();

    }

    public function getAllTaskForEmployee($emp_id, $service_arr, $status)
    {
        $this->db->select('service_permission');
        $this->db->where('id', $emp_id);
        $result = $this->db->get('tbl_employee_info')->row_array();
        $service_names = explode(",", $result['service_permission']);

        $this->db->select('*');
        $tmp_arr = array_diff($service_arr, $service_names);
        $arr = array_diff($service_arr, $tmp_arr);

		if ($arr==array())
			return $arr;

        if ($status==1) {
            $this->db->where('status !=', 'complete');
        }
        else if ($status==2) {
            $this->db->group_start();
            $this->db->where('employee_id', $emp_id);
            $this->db->where('status', 'complete');
            $this->db->where('is_approved_task', 1);
            $this->db->group_end();
        }
        else if ($status==3) {
            $this->db->group_start();
            $this->db->where('employee_id', $emp_id);
            $this->db->where('status !=', 'pending');
            $this->db->group_end();
        }
        $this->db->where_in('service', $arr);
        $this->db->group_by('id', 'ASC');
        $query = $this->db->get('tbl_view_all_task');

        return $query->result_array();
    }

    public function getServiceID($service_name)
    {
        $this->db->select('id');
        $this->db->where('name', $service_name);
        $result = $this->db->get('tbl_service')->row_array();

        return $result['id'];
    }

    public function getAllPendingTaskByPeriod($postData='')
    {
        $start_time = date('Y-m-d 00:00:00');
        $end_time   = date('Y-m-d 23:59:59');

        if ($postData!='')
        {
            $start_time =  $postData['start_time'];
            $end_time =  $postData['end_time'];
        }

        $this->db->where('request_time >=', $start_time);
        $this->db->where('request_time <=', $end_time);
        $this->db->where('status !=', 'complete');
        $query = $this->db->get('tbl_view_all_task');

        return $query->result_array();
    }

    public function getAllCompleteTaskByPeriod($postData='')
    {
        $start_time = date('Y-m-d 00:00:00');
        $end_time   = date('Y-m-d 23:59:59');

        if ($postData!='')
        {
            $start_time =  $postData['start_time'];
            $end_time =  $postData['end_time'];
        }

        $this->db->where('start_time >=', $start_time);
        $this->db->where('end_time <=', $end_time);
        $this->db->where('status', 'complete');
//        $this->db->order_by('end_time', 'DESC');
        $query = $this->db->get('tbl_view_all_task');

        return $query->result_array();
    }

    public function getPendingTask($task_id)
    {
        $id = (int)str_replace('Ticket', '', $task_id);

        $this->db->where('id', $id);
        $query = $this->db->get('tbl_view_all_task');

        return $query->row_array();
    }

    public function getServicesUsedTimes($postData='')
    {
        $start_time = date('Y-m-d 00:00:00');
        $end_time   = date('Y-m-d 23:59:59');

        if ($postData!='')
        {
            $start_time =  $postData['start_time'];
            $end_time =  $postData['end_time'];
        }

        $str_query  = "SELECT t.*, COALESCE(v.times, '0') AS times
						FROM tbl_service AS t 
						LEFT JOIN ( 
							SELECT *, COUNT(request_time) AS times 
							FROM tbl_view_service_used_times
							WHERE request_time >= '".$start_time."' AND request_time <= '".$end_time."'
							GROUP BY id
							) AS v 
						ON v.id=t.id
						ORDER BY t.id";

        $query = $this->db->query($str_query);

        return $query->result_array();
    }

    public function getServicesUsedTimesForClient($client_id, $postData='')
    {
        $start_time = date('Y-m', strtotime('last month')).date('-d 00:00:00', strtotime('next day'));
        $end_time   = date('Y-m-d 23:59:59');

        if ($postData!='')
        {
            $start_time =  $postData['start_time'];
            $end_time =  $postData['end_time'];
        }

        $str_query  = "SELECT t.*, COALESCE(v.times, '0') AS times
						FROM tbl_service AS t 
						LEFT JOIN ( 
							SELECT *, COUNT(request_time) AS times 
							FROM tbl_view_service_used_times
							WHERE request_time >= '".$start_time."' AND request_time <= '".$end_time."' AND client_id = '".$client_id."'
							GROUP BY id
							) AS v 
						ON v.id=t.id
						ORDER BY t.id";

        $query = $this->db->query($str_query);

        return $query->result_array();
    }

    public function startTask($emp_name, $postData)
    {
        $emp_id = $this->getEmployeeID($emp_name);

        if (empty($emp_id))
            return "fail";

        $this->db->select('current_working_status');
        $this->db->where('id', $emp_id);
        $res = $this->db->get('tbl_employee_info')->row_array();
        $status = $res['current_working_status'];

        if ($status==1)
            return "already";

        $id = (int)str_replace('Ticket', '', $postData['id']);
        $arr = array(
            'status' => 'working',
            'employee_id' => $emp_id,
            'start_time' => date('Y-m-d H:i:s')
        );


        $this->db->where('id', $id);
        $this->db->update('tbl_task', $arr);

        if ($this->db->affected_rows()>0)
        {
            $this->setEmployeeSession($emp_name, 'Working start');

            $this->db->where('id', $emp_id);
            $this->db->update('tbl_employee_info', array('current_working_status' => 1));

            return "success";
        }

        return "fail";
    }

    public function completeTask($emp_name, $id)
    {
        $emp_id = $this->getEmployeeID($emp_name);

        if (empty($emp_id))
            return "fail";

        $this->db->where('id', $id);
        $this->db->update('tbl_task', array(
                'status' => 'complete',
                'end_time' => date('Y-m-d H:i:s')
            )
        );

        if ($this->db->affected_rows()>0)
        {
            $this->setEmployeeSession($emp_name, 'Complete');

            //check task reservation
            $this->db->where('employee_id', $emp_id);
            $this->db->order_by('id', 'ASC');
            $result1 = $this->db->get('tbl_task_reservation');
            if ($result1->num_rows()>0) // if reserved task exists
            {

                //Delete task in reservation table
                $result2 = $result1->row_array();

                $this->db->delete('tbl_task_reservation', array('id' => $result2['id']));

                //change task table contents
                $this->db->where('id', $result2['task_id']);
                if(!$this->db->update('tbl_task', array('status'=>'working', 'employee_id'=>$emp_id, 'start_time'=>date('Y-m-d H:i:s'))))
                    return 'fail';

                //release employee working status
                $this->db->where('id', $emp_id);
                $this->db->update('tbl_employee_info', array('current_working_status' => 1));
            }
            else    //No reservation
            {
                //release employee working status
                $this->db->where('id', $emp_id);
                $this->db->update('tbl_employee_info', array('current_working_status' => 0));
            }

            return "success";
        }

        return "fail";
    }

    public function completeDeletedTask($emp_name, $task_id)
    {
        $emp_id = $this->getEmployeeID($emp_name);

        $this->db->where('id', $task_id);
        if ($this->db->update('tbl_task', array('status'=>'complete', 'end_time' => date('Y-m-d H:i:s'))))
        {
            $this->setEmployeeSession($emp_name, 'Complete');

            //check task reservation
            $this->db->where('employee_id', $emp_id);
            $this->db->order_by('id', 'ASC');
            $result1 = $this->db->get('tbl_task_reservation');
            if ($result1->num_rows()>0) // if reserved task exists
            {

                //Delete task in reservation table
                $result2 = $result1->row_array();

                $this->db->delete('tbl_task_reservation', array('id' => $result2['id']));

                //change task table contents
                $this->db->where('id', $result2['task_id']);
                if(!$this->db->update('tbl_task', array('status'=>'working', 'employee_id'=>$emp_id, 'start_time'=>date('Y-m-d H:i:s'))))
                    return 'fail';

                //release employee working status
                $this->db->where('id', $emp_id);
                $this->db->update('tbl_employee_info', array('current_working_status' => 1));
            }
            else    //No reservation
            {
                //release employee working status
                $this->db->where('id', $emp_id);
                $this->db->update('tbl_employee_info', array('current_working_status' => 0));
            }

            return "success";
        }

        return 'fail';
    }

    public function completeTaskWithoutData($emp_name, $task_id)
    {
        $emp_id = $this->getEmployeeID($emp_name);

        $this->db->where('id', $task_id);
        if ($this->db->update('tbl_task', array('status'=>'complete', 'is_approved_task'=>0, 'end_time' => date('Y-m-d H:i:s'))))
        {
            $this->setEmployeeSession($emp_name, 'Complete');

            //check task reservation
            $this->db->where('employee_id', $emp_id);
            $this->db->order_by('id', 'ASC');
            $result1 = $this->db->get('tbl_task_reservation');
            if ($result1->num_rows()>0) // if reserved task exists
            {

                //Delete task in reservation table
                $result2 = $result1->row_array();

                $this->db->delete('tbl_task_reservation', array('id' => $result2['id']));

                //change task table contents
                $this->db->where('id', $result2['task_id']);
                if(!$this->db->update('tbl_task', array('status'=>'working', 'employee_id'=>$emp_id, 'start_time'=>date('Y-m-d H:i:s'))))
                    return 'fail';

                //release employee working status
                $this->db->where('id', $emp_id);
                $this->db->update('tbl_employee_info', array('current_working_status' => 1));
            }
            else    //No reservation
            {
                //release employee working status
                $this->db->where('id', $emp_id);
                $this->db->update('tbl_employee_info', array('current_working_status' => 0));
            }

            return "success";
        }

        return 'fail';
    }

    public function approveCompletedTask($task_id)
    {
        $this->db->where('id', $task_id);
        if ($this->db->update('tbl_task', array('is_approved_task'=>1)))
            return 'success';

        return 'fail';
    }

    //Reject the Task has no data, so it is returned into working status.
    public function rejectCompletedTask($task_id)
    {
        $result = $this->db->where('id', $task_id)->get('tbl_task')->row_array();

        //check new user's current working status
        $this->db->select('current_working_status');
        $this->db->where('id', $result['employee_id']);
        $result1 = $this->db->get('tbl_employee_info')->row_array();

        if ($result1['current_working_status'] == 1)
        {

            $this->db->where('id', $task_id);
            $this->db->update('tbl_task', array('status'=>'pending', 'start_time'=>null, 'employee_id'=>null, 'end_time'=>null, 'is_approved_task'=>1));

            $this->db->insert('tbl_task_reservation', array('employee_id'=>$result['employee_id'], 'task_id'=>$task_id, 'reservation_time'=>date('Y-m-d H:i:s')));

//            return 'reserved';
            return 'success';
        }
        else
        {
            $this->db->where('id', $task_id);
            $this->db->update('tbl_task', array('status'=>'working', 'end_time'=>null, 'is_approved_task'=>1));

            //change new employee's working status
            $this->db->where('id', $result['employee_id']);
            $this->db->update('tbl_employee_info', array('current_working_status' => 1));
        }

        return 'success';

    }

    //Task Status Edit
    public function editTask($postData)
    {
        $task_id = (int)str_replace('Ticket', '', $postData['task_id']);
        $status = $postData['status'];
        $employee_id = $postData['employee_id'];

        $result = $this->db->where('id', $task_id)->get('tbl_task')->row_array();

        if ($status==$result['status'])
        {
            if ($employee_id==$result['employee_id'])
                return 'already';

            //if status=pending... return;
            if ($status == 'pending')
                return 'already';
        }

        if ($status == 'pending')
        {
            //Get Employee ID
            $result0 = $this->db->select('employee_id')->where('id', $task_id)->get('tbl_task')->row_array();

            //check task reservation
            $this->db->where('employee_id', $result0['employee_id']);
            $this->db->order_by('id', 'ASC');
            $result1 = $this->db->get('tbl_task_reservation');
            if ($result1->num_rows()>0) // if reserved task exists
            {

                //Delete task in reservation table
                $result2 = $result1->row_array();

                $this->db->delete('tbl_task_reservation', array('id' => $result2['id']));

                //change task table contents
                $this->db->where('id', $result2['task_id']);
                if(!$this->db->update('tbl_task', array('status'=>'working', 'employee_id'=>$result2['employee_id'], 'start_time'=>date('Y-m-d H:i:s'))))
                    return 'fail';

            }
            else    //No reservation
            {
                //release employee working status
                $this->db->where('id', $result['employee_id']);
                $this->db->update('tbl_employee_info', array('current_working_status' => 0));
            }

            //change task table contents
            $this->db->where('id', $task_id);
            $this->db->update('tbl_task', array('status'=>$status, 'employee_id'=>null, 'start_time'=>null));

            return 'success';
        }
        else if ($status == 'working')
        {
            //check new user's current working status
            $this->db->select('current_working_status');
            $this->db->where('id', $employee_id);
            $result1 = $this->db->get('tbl_employee_info')->row_array();

//            $return_str = 'success';
            if ($result1['current_working_status'] == 1)
            {
                $this->db->select('id');
                $result2 = $this->db->where('task_id', $task_id)->get('tbl_task_reservation');
                if ($result2->num_rows()>0)
                {
                    return 'already_reserved';
                }

                $this->db->insert('tbl_task_reservation', array('employee_id'=>$employee_id, 'task_id'=>$task_id, 'reservation_time'=>date('Y-m-d H:i:s')));

                return 'reserved';
            }
            else
            {
                //change new employee's working status
                $this->db->where('id', $employee_id);
                $this->db->update('tbl_employee_info', array('current_working_status' => 1));

                //change task table contents
                $this->db->where('id', $task_id);
                if(!$this->db->update('tbl_task', array('status'=>$status, 'employee_id'=>$employee_id, 'start_time'=>date('Y-m-d H:i:s'))))
                    return 'fail';

            }

            return 'success';
        }

    }

    public function setEmployeeSession($employee_name, $action, $logout_time='')
    {
        $id =  $this->getEmployeeID($employee_name);

        $this->db->select('last_ip, last_country');
        $this->db->where('id', $id);
        $result = $this->db->get('tbl_employee_info')->row_array();

        $ip = $result['last_ip'];
        $country = $result['last_country'];

        if (empty($id)) return;

        $time = date('Y-m-d H:i:s');
        if ( $action=='Logout' && !empty($logout_time) )
        {
            $time = $logout_time;
        }

        $arr = array(
            'employee_id' => $id,
            'time' => $time,
            'ip_address' => $ip,
            'country' => $country,
            'action' => $action
        );

        $res = $this->db->get_where('tbl_session_employee', $arr);
        if ($res->num_rows()>0) return;

        $this->db->insert('tbl_session_employee', $arr);
        $insert_id = $this->db->insert_id();

        return  $insert_id;
    }

    public function updateEmployeeLogout($employee_name)
    {
        $id =  $this->getEmployeeID($employee_name);

        if (empty($id)) return;

        $this->db->where('id', $id);
        $this->db->update('tbl_employee_info', array('logout_time' => date('Y-m-d H:i:s')));

    }

    public function setAllEmployeeLogoutTime()
    {
        $result = $this->db->query('SELECT * FROM `tbl_employee_info`');

        if ($result->num_rows()>0)
        {
            foreach ($result->result_array() as $emp)
            {
                if ( !empty($emp['logout_time']) )
                {
                    $now = date('Y-m-d H:i:s');
                    $sec = date($emp['logout_time']);
                    $interval = abs(strtotime($now) - strtotime($sec));

                    if ($interval>30)
                    {
                        $this->setEmployeeSession($emp['name'], 'Logout', $sec);
                    }

                }
            }
        }
    }

    public function getEmployeeLogoutTime($employee_name)
    {
        $this->db->where('id', $this->getEmployeeID($employee_name));
        $result = $this->db->get('tbl_employee_info')->row_array();

        return $result['logout_time'];
    }

    public function getEmployeeID($name)
    {
//        $this->db->select('*');
        $this->db->where('name', $name);
        $result = $this->db->get('tbl_employee_info')->row_array();

        return $result['id'];
    }

    //Employee
    public function getRecentTaskCompletionTime($name)
    {
        $this->db->select('completion_time');
        $this->db->where('employee_name', $name);
//        $this->db->where('completion_time !=', '');
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get('tbl_view_all_task')->row_array();

        return $result['completion_time'];
    }

    public function getAvgCompletionTime($name, $month='')
    {
        $start_time = date('Y-m-01 00:00:00');
        $end_time = date('Y-m-t 23:59:59');
        if ($month=='previous')
        {
            $start_time = date('Y-m-01 00:00:00', strtotime('last month'));
            $end_time = date('Y-m-t 23:59:59', strtotime('last month'));
        }

        $str_query = "SELECT SEC_TO_TIME(AVG(TIME_TO_SEC((SELECT TIMEDIFF(`t`.`end_time`,`t`.`start_time`) LIMIT 1)))) AS `complete_time`,".
                    "COUNT((SELECT TIMEDIFF(`t`.`end_time`,`t`.`start_time`) LIMIT 1)) AS `complete_count` FROM tbl_task AS t ".
                    "WHERE start_time >= '".$start_time."' AND end_time <= '".$end_time."' AND t.employee_id='".$this->getEmployeeID($name)."'";

        return $this->db->query($str_query)->row_array();
    }

    //Task Delete

    public function deleteCompletedTask($task_id, $data_table, $complete_table)
    {
        $related_id = $this->getRelatedTaskID($task_id);

        $this->db->delete($data_table, array('id'=>$related_id));
        $this->db->delete($complete_table, array('task_id'=>$task_id));
        $this->db->delete('tbl_task', array('id'=>$task_id));

        return 'success';
    }

    public function deletePendingTask($task_id, $service)
    {
        $this->db->select('alias');
        $this->db->where('name', $service);
        $result = $this->db->get('tbl_service')->row_array();
        $data_table = $result['alias'];

        $str_query = 'SELECT * FROM tbl_task WHERE id = \''.$task_id.'\'';
        $query = $this->db->query($str_query);
        $result = $query->row_array();
        $related_id = $result['related_task_id'];
        $status = $result['status'];
        $emp_id = $result['employee_id'];

        if ($status == 'working')
        {
            //check task reservation
            $this->db->where('employee_id', $emp_id);
            $this->db->order_by('id', 'ASC');
            $result1 = $this->db->get('tbl_task_reservation');
            if ($result1->num_rows()>0) // if reserved task exists
            {

                //Delete task in reservation table
                $result2 = $result1->row_array();

                $this->db->delete('tbl_task_reservation', array('id' => $result2['id']));

                //change task table contents
                $this->db->where('id', $result2['task_id']);
                if(!$this->db->update('tbl_task', array('status'=>'working', 'employee_id'=>$emp_id, 'start_time'=>date('Y-m-d H:i:s'))))
                    return 'fail';

                //release employee working status
                $this->db->where('id', $emp_id);
                $this->db->update('tbl_employee_info', array('current_working_status' => 1));
            }
            else    //No reservation
            {
                //release employee working status
                $this->db->where('id', $emp_id);
                $this->db->update('tbl_employee_info', array('current_working_status' => 0));
            }
        }

        if ($data_table == 'tbl_service_tracking_asin')
        {
            $this->db->where(array('asin_id'=>$related_id, 'is_last'=>1));
            $this->db->group_start();
            $this->db->where('exist_status', 1);
            $this->db->or_where('exist_status', 2);
            $this->db->group_end();
            $this->db->update('tbl_service_tracking_detail', array('exist_status'=>0, 'is_last'=>0));

            $this->db->where('id', $related_id);
            $this->db->update('tbl_service_tracking_asin', array('exist_status'=>0));
        }
        else
        {
            $this->db->delete($data_table, array('id'=>$related_id));
        }

        $this->db->delete('tbl_task', array('id'=>$task_id));

        return 'success';
    }

    public function getRelatedTaskID($task_id)
    {
        $str_query = 'SELECT related_task_id FROM tbl_view_all_task WHERE id = \''.$task_id.'\'';

        $query = $this->db->query($str_query);

        $result = $query->row_array();
        return $result['related_task_id'];
    }

}
