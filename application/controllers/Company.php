<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_company','_model');
	}

	public function index(){
		$this->layout->set_header("Manage Company");
		$this->layout->set_title("Manage Company");
		$this->layout->set_sidebar_collapse(true);
		
		$this->layout->set_script(base_url('assets/js/company/company.js'));

		$data = array();

		$this->layout->set_breadcrumb('Master');
		$this->layout->set_breadcrumb('Company');


		$this->layout->set_content('company/master_company');
		$this->layout->render($data);
	}

	public function get_company(){
		if ($this->input->is_ajax_request()) {
			
			$get = $this->_model->get_company();

			echo json_encode(array('data' => $get));

		}else{
			echo "error";
		}
	}

	public function save_company(){
		if ($this->input->is_ajax_request()) {
			$data = $this->input->post();

			$do = $this->_model->save_company($data);

			if ($do) {
				echo json_encode(array('result' => true));
			}else{
				echo json_encode(array('result' => false));

			}

		}else{
			echo "error";
		}
	}

	public function remove_company(){
		if ($this->input->is_ajax_request()) {
			$id = $this->input->post('kd_company');

			$del = $this->_model->del_company($id);

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

/* End of file Company.php */
/* Location: ./application/controllers/Company.php */