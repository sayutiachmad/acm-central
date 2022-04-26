<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_plant extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function get_company(){
		return $this->db->get(TABLE_PERUSAHAAN)->result_array();
	}	

	public function get_plant(){
		$this->db->select(array(
			'a.'.FIELD_PLANT_PERUSAHAAN,
			'a.'.FIELD_PLANT_ID,
			'a.'.FIELD_PLANT_NAME,
			'a.'.FIELD_PLANT_ALAMAT_1,
			'a.'.FIELD_PLANT_ALAMAT_2,
			'a.'.FIELD_PLANT_LABEL,
			'a.'.FIELD_PLANT_PHONE,
			'a.'.FIELD_PLANT_SEQUENCE,
			'a.'.FIELD_PLANT_HOSTNAME,
			'a.'.FIELD_PLANT_HOST_USERNAME,
			'a.'.FIELD_PLANT_HOST_DB,
			'b.'.FIELD_PERUSAHAAN_NAME
		));
		$this->db->join(TABLE_PERUSAHAAN .' b', 'b.'. FIELD_PERUSAHAAN_ID .'= a.'. FIELD_PLANT_PERUSAHAAN, 'left');
		return $this->db->get(TABLE_PLANT .' a')->result_array();
	}

	public function update_plant($data){

		$sess = $this->session->userdata(SESSION_USER);

		$pwd = NULL;
		if( strlen($data['plant_host_password']) > 0 ){

			$this->load->library('encryption');
			$this->encryption->initialize(
		        array(
		                'cipher' => 'aes-256',
		                'mode' => 'ctr',
		        )
			);

			$pwd = $this->encryption->encrypt($data['plant_host_password']);

		}

		$this->db->trans_start();

		

		$obj = array(
			FIELD_PLANT_PERUSAHAAN		=> $data['id_p'],
			FIELD_PLANT_NAME			=> $data['plant_name'],
			FIELD_PLANT_ALAMAT_1		=> $data['alamat_1'],
			FIELD_PLANT_ALAMAT_2		=> $data['alamat_2'],
			FIELD_PLANT_LABEL			=> $data['plant_label'],
			FIELD_PLANT_PHONE			=> $data['phone'],
			FIELD_PLANT_HOSTNAME  		=> $data['plant_hostname'],
			FIELD_PLANT_HOST_USERNAME	=> $data['plant_host_username'],
			FIELD_PLANT_HOST_DB			=> $data['plant_datasource'],
			'update_by'					=> $sess[SESSION_USER_ID]
		);

		if($pwd !== NULL){
			$obj[FIELD_PLANT_HOST_PWD] = $pwd;
		}

		$this->db->where(FIELD_PLANT_ID, $data['kd_plant']);
		$this->db->update(TABLE_PLANT, $obj);

		$this->activity->log_activity(LOG_ACT_CAT_EDIT, LOG_ACT_TYPE_MASTER, $data['kd_plant'], 'Ubah data master Unit/Plant');


		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
		        return array('result' => FALSE, 'response' => 'Terjadi kesalahan saat menyimpan data');
		}


		return array('result' => TRUE, 'response' => 'Berhasil menambah data baru');

	}

	public function save_plant($data){

		$sess = $this->session->userdata(SESSION_USER);

		$pwd = NULL;
		if( strlen($data['plant_host_password']) > 0 ){

			$this->load->library('encryption');
			$this->encryption->initialize(
		        array(
		                'cipher' => 'aes-256',
		                'mode' => 'ctr',
		        )
			);

			$pwd = $this->encryption->encrypt($data['plant_host_password']);

		}

		$this->db->trans_start();

		$this->db->where(FIELD_PLANT_ID, $data['kd_plant']);
		$cek = $this->db->get(TABLE_PLANT);

		if ($cek->num_rows() > 0 ) {
			return array('result' => FALSE, 'response' => 'Kode tidak ditemukan');
		}else{

			$unit_lbl = "DC";

			$obj = array(
				FIELD_PLANT_PERUSAHAAN		=> $data['id_p'],
				FIELD_PLANT_NAME			=> $data['plant_name'],
				FIELD_PLANT_ALAMAT_1		=> $data['alamat_1'],
				FIELD_PLANT_ALAMAT_2		=> $data['alamat_2'],
				FIELD_PLANT_LABEL			=> $data['plant_label'],
				FIELD_PLANT_PHONE			=> $data['phone'],
				FIELD_PLANT_HOSTNAME  		=> $data['plant_hostname'],
				FIELD_PLANT_HOST_USERNAME	=> $data['plant_host_username'],
				FIELD_PLANT_HOST_PWD		=> $pwd,
				FIELD_PLANT_HOST_DB			=> $data['plant_datasource'],
				'create_by'					=> $sess[SESSION_USER_ID]
			);

			$this->db->set(FIELD_PLANT_ID,'(SELECT CONCAT("'.$unit_lbl.'", LPAD(COUNT(*)+1, 3, 0)) FROM '.TABLE_PLANT.' b WHERE b.'.FIELD_PLANT_PERUSAHAAN.' = "'.$data['id_p'].'")',FALSE);
			$this->db->set(FIELD_PLANT_SEQUENCE,'(SELECT LAST_INSERT_ID(IFNULL(MAX('.FIELD_PLANT_ID.')+1,"1")) FROM '.TABLE_PLANT.' b WHERE b.'.FIELD_PLANT_PERUSAHAAN.' = "'.$data['id_p'].'")',FALSE);
			$plant = $this->db->insert(TABLE_PLANT, $obj);

			$last = $this->db->insert_id();
			$this->db->where(FIELD_PLANT_PERUSAHAAN, $data['id_p']);
			$this->db->where(FIELD_PLANT_SEQUENCE, $last);
			$pl = $this->db->get(TABLE_PLANT,1)->row_array();


			$this->activity->log_activity(LOG_ACT_CAT_NEW, LOG_ACT_TYPE_MASTER, $pl[FIELD_PLANT_ID], 'Tambah data Unit/Plant baru');

		}

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
		        return array('result' => FALSE, 'response' => 'Terjadi kesalahan saat mengubah data');
		}


		return array('result' => TRUE, 'response' => 'Sukses melakukan perubahan data');
	}

	public function del_plant($id){
		$this->db->where(FIELD_PLANT_ID, $id);
		$this->db->delete(TABLE_PLANT);

		$this->activity->log_activity(LOG_ACT_CAT_DELETE, LOG_ACT_TYPE_MASTER, $id, 'Hapus data master Plant/Unit');

		return true;

	}

}

/* End of file Model_plant.php */
/* Location: ./application/models/Model_plant.php */