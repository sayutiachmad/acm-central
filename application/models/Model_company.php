<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_company extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function get_company(){
		return $this->db->get(TABLE_PERUSAHAAN)->result_array();
	}


	public function save_company($data){

		if ($data['kd_company'] != 'true') {

			$obj = array(
			FIELD_PERUSAHAAN_ID		=> strtoupper($data['per_id']),
			FIELD_PERUSAHAAN_NAME	=> $data['per_name']
			);
			$this->db->where(FIELD_PERUSAHAAN_ID, $data['kd_company']);
			$this->db->update(TABLE_PERUSAHAAN, $obj);

			$this->activity->log_activity(LOG_ACT_CAT_EDIT, LOG_ACT_TYPE_MASTER, $data['per_id'], 'Update data master perusahaan');
			
			return true;

		}else{
			
			$this->db->where(FIELD_PERUSAHAAN_ID, $data['per_id']);
			$cek = $this->db->get(TABLE_PERUSAHAAN);
			if ($cek->num_rows() > 0) {
				return false;
			}else{
				$obj = array(
					FIELD_PERUSAHAAN_ID		=> strtoupper($data['per_id']),
					FIELD_PERUSAHAAN_NAME	=> $data['per_name']
				);

				$do = $this->db->insert(TABLE_PERUSAHAAN, $obj);

				$this->activity->log_activity(LOG_ACT_CAT_NEW, LOG_ACT_TYPE_MASTER, $data['per_id'], 'Tambah data master perusahaan baru');
				return true;	
			}
	
		}

		return false;


	}

	public function del_company($id){
		$this->db->where(FIELD_PERUSAHAAN_ID, $id);
		$this->db->delete(TABLE_PERUSAHAAN);

		$this->activity->log_activity(LOG_ACT_CAT_DELETE, LOG_ACT_TYPE_MASTER, $id, 'Hapus data master perusahaan');

		return true;

	}

}

/* End of file Model_company.php */
/* Location: ./application/models/Model_company.php */