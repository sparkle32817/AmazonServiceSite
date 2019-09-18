<?php


class ImageHosting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Service_image_hosting_model', 'Image_hosting_model');
    }

    public function index()
    {
        if (!$this->session->userdata('client_logged_in')) {
            redirect('login');
        }

        $client_name = $this->session->userdata('client_logged_in');
        $source_dir = './images/'.$client_name.'/temporary/';
        foreach (scandir($source_dir) as $file) {

            if ($file == '.' || $file == '..')
                continue;

            $source_file = $source_dir . $file;

            unlink($source_file);
        }

        $header_data['username'] = $client_name;
        $header_data['user_avatar'] = $this->User_model->getUserAvatar($client_name);

        $this->load->view('user/common/header', $header_data);
        $this->load->view('user/services/image_hosting/main');
        $this->load->view('user/common/footer');
    }

    public function resultView($task_id)
    {
        if (!$this->session->userdata('client_logged_in')) {
            redirect('login');
        }

        $client_name = $this->session->userdata('client_logged_in');
        $images = array();

        $sku = $this->Image_hosting_model->getSku($task_id);
        $source_dir = './images/'.$client_name.'/'.$sku.'/';
        foreach (scandir($source_dir) as $file) {

            if ($file == '.' || $file == '..')
                continue;

            $images[] = base_url().'images/'.$client_name.'/'.$sku.'/' . $file;
        }

        $data['images'] = $images;

        $header_data['username'] = $client_name;
        $header_data['user_avatar'] = $this->User_model->getUserAvatar($client_name);

        $this->load->view('user/common/header', $header_data);
        $this->load->view('user/services/image_hosting/view', $data);
        $this->load->view('user/common/footer');
    }

    public function getHistory()
    {
        $results = $this->Image_hosting_model->getHistory($this->session->userdata('client_logged_in'));

        $i = 0;
        $returnVal = array();
        foreach ($results as $result)
        {
            $data = array();

            $data['no'] = ++$i;
            $data['market_place'] = $result['market'];
            $data['sku'] = $result['sku'];
            $data['date_searched'] = date('Y-m-d', strtotime($result['searched_date']));
            $data['action'] = $result['id'];

            $returnVal[] = $data;
        }

        echo json_encode(array('data'=>$returnVal));
    }

    public function uploadMainFile()
    {
        $client_name = $this->session->userdata('client_logged_in');
        $target_dir = './images/'.$client_name.'/temporary/';

        $target_file = $target_dir . '00-' . basename($_FILES["file"]["name"]);

        $msg = "";
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $msg = "Successfully uploaded";
        }else{
            $msg = "Error while uploading";
        }
        echo $msg;
    }

    public function uploadAdditionalFile()
    {
        $client_name = $this->session->userdata('client_logged_in');
        $target_dir = './images/'.$client_name.'/temporary/';

        $target_file = $target_dir . '10-' . basename($_FILES["file"]["name"]);

        $msg = "";
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $msg = "Successfully uploaded";
        }else{
            $msg = "Error while uploading";
        }
        echo $msg;
    }

    public function uploadSwatchFile()
    {
        $client_name = $this->session->userdata('client_logged_in');
        $target_dir = './images/'.$client_name.'/temporary/';

        $target_file = $target_dir . '20-' . basename($_FILES["file"]["name"]);

        $msg = "";
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $msg = "Successfully uploaded";
        }else{
            $msg = "Error while uploading";
        }
        echo $msg;
    }

    public function deleteUploadedFile()
    {
        $client_name = $this->session->userdata('client_logged_in');
        $target_dir = './images/'.$client_name.'/temporary/';

        $filename = $target_dir.$_POST['name'];
        if (file_exists($filename))
            unlink($filename);
    }

    public function isExistSkuDirectory()
    {
        $client_name = $this->session->userdata('client_logged_in');
        $target_dir = './images/'.$client_name.'/'.$_POST['sku'].'/';

        if (is_dir($target_dir))
        {
            echo 'true';
            exit;
        }

        echo 'false';
    }

    public function isExistUploadedFiles()
    {
        $client_name = $this->session->userdata('client_logged_in');
        $target_dir = './images/'.$client_name.'/temporary/';

        $main=0; $addition=0; $swatch=0;
        $files = scandir($target_dir);
        foreach ($files as $file) {

            if (strpos($file, '00-') !== false)
                $main=1;
            else if (strpos($file, '10-') !== false)
                $addition=1;
            else if (strpos($file, '20-') !== false)
                $swatch=1;
        }

        if ($main==0)
        {
            echo 'main';
            exit;
        }

        if ($addition==0)
        {
            echo 'additional';
            exit;
        }

        if ($swatch==0)
        {
            echo 'swatch';
            exit;
        }

        echo 'all';
    }

    public function saveFiles()
    {
        $client_name = $this->session->userdata('client_logged_in');

        if($this->Image_hosting_model->register($client_name) != 'fail')
        {
            $sku = $_POST['sku'];
            $source_dir = './images/'.$client_name.'/temporary/';
            $target_dir = './images/'.$client_name.'/'.$sku.'/';

            if (!is_dir($target_dir))
            {
                if (!mkdir($target_dir, 0777, true)) {
                    echo 'fail';
                    exit;
                }
            }

            foreach (scandir($target_dir) as $file) {

                if ($file == '.' || $file == '..')
                    continue;

                unlink($target_dir.$file);
            }

            $cnt=1;
            foreach (scandir($source_dir) as $file) {

                if ($file == '.' || $file == '..')
                    continue;

                $source_file = $source_dir.$file;
                $destination_file='';
                if (strpos($file, '00-') !== false)
                {
                    $destination_file = $target_dir.$sku.'-MAIN.JPEG';
                }
                else if (strpos($file, '10-') !== false)
                {
                    $destination_file = $target_dir.$sku.'-PT0'.$cnt.'.JPEG';

                    $cnt++;
                }
                else if (strpos($file, '20-') !== false)
                {
                    $destination_file = $target_dir.$sku.'-SWATCH.JPEG';
                }

                copy($source_file, $destination_file);
                unlink($source_file);
            }

            $output = '<div class="col-md-12">';

            foreach (scandir($target_dir) as $file) {

                if ($file == '.' || $file == '..')
                    continue;

                $output .= '
                        <div class="col-md-12 col-sm-12 dz-image">
                            <div class="col-md-4 col-sm-6">
                                <div class="image-container">
                                    <img src="'.base_url().'images/'.$client_name.'/'.$sku.'/'.$file.'" style="max-width:200px; max-height:200px;">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 input-group">
                                <label class="control-label" style="margin-top: 80px; border-bottom: 1px solid #000;">'.base_url().'images/'.$client_name.'/'.$sku.'/'.$file.'</label>
                            </div>                            
                        </div>
                        ';
            }

            $output .= '</div>';

            $returnVal['images'] = $output;
            $returnVal['status'] = 'success';

            echo json_encode($returnVal);
            exit;
        }

        $returnVal['images'] = '';
        $returnVal['status'] = 'fail';

        echo json_encode($returnVal);
    }

}

//<span class="" style="margin-top: 80px;">
//                                  <button type="button" class="btn btn-default image_btn_copy" c-id="'.base_url().'images/'.$client_name.'/'.$sku.'/'.$file.'">
//                                      <i class="fa fa-copy" title="Copy Link to Clipboard"></i>
//                                  </button>
//                                </span>
//                                <span class="" style="margin-top: 80px;">
//                                  <button type="button" class="btn btn-default image_btn_go" g-id="'.base_url().'images/'.$client_name.'/'.$sku.'/'.$file.'">
//                                      <i class="fa fa-mail-forward" title="Go to Link"></i>
//                                  </button>
//                                </span>