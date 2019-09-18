<?php


class Service_listing_stuffer_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function saveKeywords($client_id, $postData)
	{
        $keywords = $postData['keywords'];
        $keywords = array_map(function($val) { return trim($val); }, $keywords);
        $keywords = array_diff($keywords, array(''));

        $arr_main = array(
            'client_id' => $client_id,
            'market_id' => $postData['market_id'],
            'searched_date' => date('Y-m-d'),
            'searched_text' => implode(',', $keywords)
            );

        $this->db->insert('tbl_service_listing_stuffer_main', $arr_main);

        $this->db->delete('tbl_service_listing_stuffer_word', array('client_id'=>$client_id));

        $this->insertKeywords($client_id, $keywords);

        return 'success';
	}

	function insertKeywords($client_id, $keywords)
    {
        foreach ($keywords as  $keyword)
        {
            if (strpos($keyword, ' ') !== false)
            {
                foreach (array_diff(explode(' ', $keyword), array('')) as $key)
                {
                    $this->insertKeyword(array('client_id' => $client_id, 'word' => $key));
                }
            }
            $this->insertKeyword(array('client_id' => $client_id, 'word' => $keyword));
        }
    }

	function insertKeyword($arr)
    {
        if ($this->db->get_where('tbl_service_listing_stuffer_word', $arr)->num_rows()>0)
            return;

        $type = 0;
        if (strpos($arr['word'], ' ')!== false)
        {
            $type = 1;
        }
        $arr['type'] = $type;

        $this->db->insert('tbl_service_listing_stuffer_word', $arr);
    }

    public function getLastDataInfo($client_id)
    {
        return $this->db->select('a.*, b.name as market_place')
                        ->from('tbl_service_listing_stuffer_main a')
                        ->join('tbl_market b', 'b.id=a.market_id')
                        ->where('a.client_id', $client_id)
                        ->order_by('a.id', 'DESC')
                        ->get()->row_array();
    }

    public function getDataInfo($id)
    {
        return $this->db->select('a.*, b.name as market_place')
            ->from('tbl_service_listing_stuffer_main a')
            ->join('tbl_market b', 'b.id=a.market_id')
            ->where('a.id', $id)
            ->get()->row_array();
    }

    public function getWords($client_id)
    {
        return $this->db->select('word, type')
                        ->from('tbl_service_listing_stuffer_word')
                        ->where('client_id', $client_id)
                        ->get()->result_array();
    }

    public function getHistory($client_id)
    {
        return $this->db->select('a.*, b.name as market_place')
            ->from('tbl_service_listing_stuffer_main a')
            ->join('tbl_market b', 'b.id=a.market_id')
            ->where('a.client_id', $client_id)
            ->order_by('a.id', 'ASC')
            ->get()->result_array();
    }

    public function deleteHistory($client_id, $id)
    {
        $returnVal = array();

        $result = $this->db->from('tbl_service_listing_stuffer_main')->order_by('id', 'DESC')->get()->row_array();
        if ($result['id'] == $id)   //If current history
        {
            $this->db->delete('tbl_service_listing_stuffer_main', array('id'=>$id));
            $this->db->delete('tbl_service_listing_stuffer_word', array('client_id'=>$client_id));

            //Popup Previous result
            $result = $this->db->from('tbl_service_listing_stuffer_main')->order_by('id', 'DESC')->get()->row_array();


            if (!empty($result))
            {
                $this->insertKeywords($client_id, explode(',', $result['searched_text']));
            }

            $returnVal['cur_keywords'] = $result['searched_text'];
        }
        else
        {
            $this->db->delete('tbl_service_listing_stuffer_main', array('id'=>$id));

            $returnVal['cur_keywords'] = $result['searched_text'];
        }

        $returnVal['status'] = 'success';

        return json_encode($returnVal);
    }
}
