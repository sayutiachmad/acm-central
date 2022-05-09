<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	var $detect;

	public function __construct(){
		parent::__construct();
		//Do your magic here
		// $this->load->model('Model_dashboard','_model');
		$this->load->model('Model_dashboard_chart', 'mdc');
		$this->detect = new Mobile_Detect();
	}

	public function index(){
		//judul tab/browser
		$this->layout->set_header("Dashboard");
		$this->layout->set_sidebar_collapse(true);
		
		//set judul halaman
		// $this->layout->set_title("Dashboard");

		//set breadcrumb
		// $this->layout->set_breadcrumb('Dashboard',base_url());

		$this->layout->set_script(base_url('assets/plugins/numeraljs/min/numeral.min.js'));
		$this->layout->set_script(base_url('assets/js/dashboard/dashboard.js'));

		$data = array();
		
		
		$this->layout->set_content('dashboard/dashboard');
		$this->layout->render($data);

	}

	public function get_sell_unit_chart_data(){

		if($this->input->is_ajax_request()){

			$post = $this->input->post();

			$res = $this->mdc->select_sell_unit_chart_data($post);


			$chart = array('labels' => array(), 'datasets' => array());
			$holder = array('unit_name' => array(), 'data'=>array());
			foreach ($res as $value) {

				if(!in_array($value['bulan_penjualan'], $chart['labels'])){
					$chart['labels'][] = $value['bulan_penjualan'];
				}

				if(!in_array($value['unit_name'], $holder['unit_name'])){
					$holder['unit_name'][] = $value['unit_name'];
				}

				$holder['data'][$value['unit_name']][] = $value['total_jual_harjul'];
				
			}

			for ($i = 0; $i < count($holder['unit_name']) ; $i++) {

				$color = rand_color();

				$chart['datasets'][] = array(
					'label'	=> $holder['unit_name'][$i],
					'data'	=> $holder['data'][$holder['unit_name'][$i]],
					'borderColor' => $color,
			     	'backgroundColor' => $color,
				); 
				
			}

			echo json_encode($chart);
			return;

		}else{
			exit(NO_DIRECT_ACCESS);
		}

	}
	


}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */