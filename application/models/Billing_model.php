<?php


class Billing_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getHistory($user_id)
    {
        $this->db->select('h.date_time, h.amount, h.currency, h.content, p.name as `payment_name`')
                ->from('tbl_history_billing as h')
                ->join('tbl_payment as p', 'p.id = h.payment_id')
                ->where('user_id', $user_id);
        $result = $this->db->get();

        if ($result->num_rows()>0)
        {
            return $result->result_array();
        }
        else
            return false;
    }

    public function makeHistory($user_id, $payment_id, $member_id, $status)
    {
        $date_time = date("Y-m-d H:i");

        //amount
        $result = $this->db->select('amount')->where('id', $member_id)->get('tbl_membership')->row_array();
        $amount = (float)$result['amount'];

//        if ($status=="Upgrade")
//            $amount = (-1)*$amount;

        //content
        $content = "Membership ".$status;

        $arr = array(
            'user_id' => $user_id,
            'date_time' => $date_time,
            'content' => $content,
            'amount' => $amount,
            'payment_id' => $payment_id,
            'currency' => 'USD'
        );

        $restult = $this->db->insert('tbl_history_billing', $arr);
        if ($this->db->affected_rows()>0)
            return "ok";
        else
            return "fail";
    }
}