<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TaxInvoice_model extends CI_Model {
    function __construct() {
        parent::__construct();
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }
	
	public function updateData($fields, $dbtable, $where) {
        $getUser = $this->db->get_where($dbtable, $where);
        if ($getUser->num_rows() > 0) {
            if ($this->db->where($where)->update($dbtable, $fields)) {
                return 1;
            }
        } else {
			if ($this->db->insert($dbtable, $fields)) {
                $insert_id = $this->db->insert_id();
                return 1;
            }
		}
		
        $error = $this->db->error();
        if (isset($error)) {
            print_r($error['message']);
            exit;
        }
    }

    public function getDataWhere($dbtable, $where) {
        $getData = $this->db->get_where($dbtable, $where);        
		if($getData->num_rows() > 0) {
			return $getData->result_array();
		} else {
			return 0;
		}
		
        $error = $this->db->error();
        if (isset($error)) {
            print_r($error['message']);
            exit;
        }
    }

    public function getAllData($dbtable) {
        $getData = $this->db->get($dbtable);
		return $getData->result_array();
		
		$error = $this->db->error();
        if (isset($error)) {
            print_r($error['message']);
            exit;
        }
    }
}