<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plant extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_plant','_model');
	}

	public function index(){
		$this->layout->set_header("Manage Plant");
		$this->layout->set_title("Manage Plant");
		$this->layout->set_sidebar_collapse(true);
		
		$this->layout->set_script(base_url('assets/js/plant/plant.js'));

		$data = array();
		$data['perusahaan'] = $this->_model->get_company();

		$this->layout->set_breadcrumb('Master');
		$this->layout->set_breadcrumb('Plant');


		$this->layout->set_content('plant/master_plant');
		$this->layout->render($data);
	}

	public function get_plant(){
		if ($this->input->is_ajax_request()) {
			
			$get = $this->_model->get_plant();

			echo json_encode(array('data' => $get));

		}else{
			echo "error";
		}
	}

	public function save_plant(){
		if ($this->input->is_ajax_request()) {
			$data = $this->input->post();

			if ($data['kd_plant'] == 'true') {

				$chk_lbl = $this->gm_->get_single_data(TABLE_PLANT, array('*'), array(FIELD_PLANT_LABEL => $data['plant_label']));

				if($chk_lbl != NULL){
					echo json_encode(array('result' => FALSE, 'response'=>'lbl_exist'));
					return true;
				}

				$do = $this->_model->save_plant($data);
			}else{
				$do = $this->_model->update_plant($data);
			}

			echo json_encode($do);
			return true;

		}else{
			echo "error";
		}
	}

	public function remove_plant(){
		if ($this->input->is_ajax_request()) {
			$id = $this->input->post('kd_plant');

			$del = $this->_model->del_plant($id);

			if ($del) {
				echo json_encode(array('result' => true, 'msg' => 'Berhasil Menghapus Data'));
			}else{
				echo json_encode(array('result' => false, 'msg' => 'Terjadi kesalahan saat menghapus data'));

			}

		}else{
			echo "error";
		}
	}

}

/* End of file plant.php */
/* Location: ./application/controllers/plant.php */