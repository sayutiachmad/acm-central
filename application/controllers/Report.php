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

	public function penjualan($type = NULL){

		if(is_null($type)){
			show_404();
			return;
		}

		
		$this->layout->set_sidebar_collapse(true);
		
		$this->layout->set_style(base_url('assets/plugins/sensortower-daterangepicker/daterangepicker.min.css'));

		// $this->layout->set_style(base_url('assets/plugins/datatables/plugin/Buttons-1.5.2/css/buttons.bootstrap4.min.css'));
		$this->layout->set_style(base_url('assets/plugins/datatables/plugin/Buttons-1.5.2/css/buttons.bootstrap4.min.css'));
		$this->layout->set_style(base_url('assets/plugins/datatables/plugin/RowGroup-1.0.3/css/rowGroup.bootstrap4.min.css'));
		$this->layout->set_style(base_url('assets/plugins/datatables/plugin/FixedHeader-3.1.4/css/fixedHeader.bootstrap4.min.css'));
		

		$this->layout->set_script(base_url('assets/plugins/knockout/knockout.js'));
		$this->layout->set_script(base_url('assets/plugins/sensortower-daterangepicker/daterangepicker.min.js'));
		$this->layout->set_script(base_url('assets/plugins/numeraljs/min/numeral.min.js'));

		$this->layout->set_script(base_url('assets/plugins/datatables/plugin/extra/sum().js'));
		$this->layout->set_script(base_url('assets/plugins/datatables/plugin/FixedHeader-3.1.4/js/fixedHeader.bootstrap4.min.js'));
		$this->layout->set_script(base_url('assets/plugins/datatables/plugin/Buttons-1.5.2/js/buttons.bootstrap4.min.js'));
		$this->layout->set_script(base_url('assets/plugins/datatables/plugin/Buttons-1.5.2/js/buttons.flash.min.js'));
		$this->layout->set_script(base_url('assets/plugins/datatables/plugin/JSZip-2.5.0/jszip.min.js'));
		$this->layout->set_script(base_url('assets/plugins/datatables/plugin/pdfmake-0.1.36/pdfmake.js'));
		$this->layout->set_script(base_url('assets/plugins/datatables/plugin/pdfmake-0.1.36/vfs_fonts.js'));
		$this->layout->set_script(base_url('assets/plugins/datatables/plugin/Buttons-1.5.2/js/buttons.html5.min.js'));
		$this->layout->set_script(base_url('assets/plugins/datatables/plugin/Buttons-1.5.2/js/buttons.print.min.js'));
		$this->layout->set_script(base_url('assets/plugins/datatables/plugin/RowGroup-1.0.3/js/dataTables.rowGroup.min.js'));
		$this->layout->set_script(base_url('assets/plugins/datatables/plugin/RowGroup-1.0.3/js/rowGroup.bootstrap4.min.js'));
		$this->layout->set_script(base_url('assets/plugins/datatables/plugin/Buttons-1.5.2/js/buttons.colVis.min.js'));

		

		$data = array();
		$data['list_unit'] = $this->gm_->get_select_list(TABLE_PLANT, array(FIELD_PLANT_ID, FIELD_PLANT_NAME, FIELD_PLANT_LABEL));

		switch ($type) {
			case 'dg':
				
				$this->layout->set_header("Laporan Penjualan Harian");
				$this->layout->set_title("Laporan Penjualan Harian");

				$this->layout->set_script(base_url('assets/js/report/daily_global.js?t='.time()));
				$this->layout->set_breadcrumb('Laporan');
				$this->layout->set_breadcrumb('Harian Global');


				$this->layout->set_content('report/daily_global');

				break;

			case 'di':

				$this->layout->set_header("Laporan Penjualan Harian (Per Item)");
				$this->layout->set_title("Laporan Penjualan Harian (Per Item)");

				$this->layout->set_script(base_url('assets/js/report/daily_global_item.js?t='.time()));
				$this->layout->set_breadcrumb('Laporan');
				$this->layout->set_breadcrumb('Harian Global (Per Item)');


				$this->layout->set_content('report/daily_global_item');
				break;

			case 'mu':

				$this->layout->set_header("Laporan Penjualan Bulanan (Per Unit)");
				$this->layout->set_title("Laporan Penjualan Bulanan (Per Unit)");

				$this->layout->set_script(base_url('assets/js/report/monthly_unit.js?t='.time()));
				$this->layout->set_breadcrumb('Laporan');
				$this->layout->set_breadcrumb('Bulanan (Per Unit)');


				$this->layout->set_content('report/monthly_unit');
				break;

			case 'mg':

				$this->layout->set_header("Laporan Penjualan Bulanan");
				$this->layout->set_title("Laporan Penjualan Bulanan");

				$this->layout->set_script(base_url('assets/js/report/monthly_global.js?t='.time()));
				$this->layout->set_breadcrumb('Laporan');
				$this->layout->set_breadcrumb('Bulanan');


				$this->layout->set_content('report/monthly_global');

				break;
			
			default:
				show_404();
				return;
		}
		

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

	public function get_daily_global_item(){

		if($this->input->is_ajax_request()){

			$post = $this->input->post();

			$res = $this->model_report->select_daily_global_item($post);

			echo json_encode(array('data' => $res));
			return;

		}else{
			exit(NO_DIRECT_ACCESS);
		}

	}

	public function get_monthly_unit(){
		if($this->input->is_ajax_request()){

			$post = $this->input->post();

			$res = $this->model_report->select_monthly_unit($post);

			echo json_encode(array('data' => $res));
			return;

		}else{
			exit(NO_DIRECT_ACCESS);
		}
	}

	public function get_monthly_global(){
		if($this->input->is_ajax_request()){

			$post = $this->input->post();

			$res = $this->model_report->select_monthly_global($post);

			echo json_encode(array('data' => $res));
			return;

		}else{
			exit(NO_DIRECT_ACCESS);
		}
	}


}

/* End of file Report.php */
/* Location: ./application/controllers/Report.php */