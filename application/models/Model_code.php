<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_code extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function get_code(){
		$this->db->order_by(FIELD_CODE_HEAD, 'asc');
		return $this->db->get(TABLE_CODE)->result_array();
	}


	public function save_code($data){

		if ($data['kd_code'] != 'true') {

			$obj = array(
			FIELD_CODE_HEAD		=> strtoupper($data['head']),
			FIELD_CODE			=> strtoupper($data['code']),
			FIELD_CODE_NAME		=> $data['code_name']
			);
			$this->db->where(FIELD_CODE_ID, $data['kd_code']);
			$this->db->update(TABLE_CODE, $obj);
			
			return true;

		}else{
			
			$this->db->where(FIELD_CODE, $data['code']);
			$cek = $this->db->get(TABLE_CODE);
			if ($cek->num_rows() > 0) {
				return false;
			}else{
				$obj = array(
					FIELD_CODE_HEAD		=> strtoupper($data['head']),
					FIELD_CODE		=> strtoupper($data['code']),
					FIELD_CODE_NAME		=> $data['code_name']
				);

				$do = $this->db->insert(TABLE_CODE, $obj);
				return true;	
			}
	
		}

		return false;


	}

	public function del_code($id){
		$this->db->where(FIELD_CODE_ID, $id);
		$this->db->delete(TABLE_CODE);

		return true;

	}

}

/* End of file Master_code.php */
/* Location: ./application/models/Master_code.php */