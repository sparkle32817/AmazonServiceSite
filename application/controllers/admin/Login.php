<?php


class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_info_model', 'Admin_model');
        $this->load->model('Employee_task_model', 'Employee_task');
        $this->load->model('Employee_info_model', 'Employee_model');
    }

    public function index()
    {
        $postData=$this->input->post();
        if (isset($postData['lgin_username'])&&isset($postData['lgin_password']))
        {
            $result = $this->Admin_model->loginCheck($postData);
            $name = $postData['lgin_username'];

            if ($result=="admin") {
                $this->session->set_userdata('admin_logged_in', $name);
                $this->Employee_task->setAllEmployeeLogoutTime();

                echo $result;
            }
            elseif ( $result=="employee")
            {
                $emp_ip = $this->getUserIpAddr();
                $xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=".$emp_ip);
                $emp_country = $xml->geoplugin_countryName;
                $this->Employee_model->setIpCountry($name, $emp_ip, $emp_country);
//                $this->Employee_model->setIpCountry($name, $emp_ip, "China");

                $this->session->set_userdata('employee_logged_in', $name);

                $logout_time = $this->Employee_task->getEmployeeLogoutTime($name);
                if (!empty($logout_time))
                    $this->Employee_task->setEmployeeSession($name, 'Logout', $logout_time);

                $this->Employee_task->setEmployeeSession($name, 'Login');

                echo $result;
            }
            else if ($result=="no_user") {
                echo "Unregistered User";
            }
            else if ($result=="disabled_user") {
                echo "You can't sign in now. Please contact to administrator.";
            }
            else
            {
                echo "Wrong password. Please try again.";
            }
            exit;
        }

        $this->load->view('admin/login/login');

    }

    private function getUserIpAddr(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

}
