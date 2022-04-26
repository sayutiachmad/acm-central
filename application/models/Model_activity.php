<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_activity extends CI_Model {

	public function __construct(){
		parent::__construct();
		
	}

	public function store($data){

		return $this->db->insert(TABLE_LOG_TRANSACTION, $data);

	}

	public function select_log_transaction($where = null, $where_like = null){

		$this->db->select(array(
			'a.*',
			'b.'.F_USER_USERNAME,
			'c.'.FIELD_ITEM_NAME,
			'DATE(a.'.FIELD_CREATE_DATETIME.') AS day_group'
		));
		$this->db->from(TABLE_LOG_TRANSACTION.' a');
		$this->db->join(TABLE_USER.' b', 'b.'.F_USER_ID.' = a.'.FIELD_CREATE_USER, 'left');
		$this->db->join(TABLE_ITEM.' c', 'c.'.FIELD_ITEM_ID.' = a.'.FIELD_LOG_TRANS_ITEM, 'left');

		if($where != null){
			$this->db->where($where);
		}

		if($where_like != null){
			$this->db->like($where_like);
		}

		return $this->db->get()->result_array();

	}

	public function store_log_action($data){
		return $this->db->insert(TABLE_LOG_ACTIVITY, $data);
	}
	
	public function select_log_activity($where = null, $where_like = null){

		$this->db->select(array(
			'a.*',
			'b.'.F_USER_USERNAME,
			'DATE(a.create_at) AS day_group'
		));
		$this->db->from(TABLE_LOG_ACTIVITY.' a');
		$this->db->join(TABLE_USER.' b', 'b.'.F_USER_ID.' = a.create_by', 'left');

		if($where != null){
			$this->db->where($where);
		}

		if($where_like != null){
			$this->db->like($where_like);
		}

		$this->db->order_by('create_at', 'desc');

		return $this->db->get()->result_array();

	}

}

/* End of file M_activity.php */
/* Location: ./application/models/M_activity.php */