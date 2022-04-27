<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_report');
	}

	public function index(){
		redirect(base_url(),'refresh');
	}

	public function daily_global(){

		$this->layout->set_header("Laporan Harian Global");
		$this->layout->set_title("Laporan Harian Global");
		$this->layout->set_sidebar_collapse(true);
		
		$this->layout->set_style(base_url('assets/plugins/sensortower-daterangepicker/daterangepicker.min.css'));
		$this->layout->set_style(base_url('assets/plugins/datatables/plugin/FixedHeader-3.1.4/css/fixedHeader.bootstrap4.min.css'));

		$this->layout->set_script(base_url('assets/plugins/knockout/knockout.js'));
		$this->layout->set_script(base_url('assets/plugins/sensortower-daterangepicker/daterangepicker.min.js'));
		$this->layout->set_script(base_url('assets/plugins/numeraljs/min/numeral.min.js'));

		$this->layout->set_script(base_url('assets/plugins/datatables/plugin/extra/sum().js'));
		$this->layout->set_script(base_url('assets/plugins/datatables/plugin/FixedHeader-3.1.4/js/fixedHeader.bootstrap4.min.js'));
		$this->layout->set_script(base_url('assets/js/report/daily_global.js?t='.time()));

		$data = array();
		$data['list_unit'] = $this->gm_->get_select_list(TABLE_PLANT, array(FIELD_PLANT_ID, FIELD_PLANT_NAME, FIELD_PLANT_LABEL));
		

		$this->layout->set_breadcrumb('Laporan');
		$this->layout->set_breadcrumb('Daily Global');


		$this->layout->set_content('report/daily_global');
		$this->layout->render($data);

	}

	public function get_daily_global(){

		if($this->input->is_ajax_request()){

			$post = $this->input->post();

			$res = $this->model_report->select_daily_global($post);

			echo json_encode(array('data' => $res));
			return;

		}else{
			exit(NO_DIRECT_ACCESS);
		}

	}

}

/* End of file Report.php */
/* Location: ./application/controllers/Report.php */