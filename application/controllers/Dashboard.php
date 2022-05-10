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

		$this->layout->set_style(base_url('assets/plugins/sensortower-daterangepicker/daterangepicker.min.css'));

		$this->layout->set_script(base_url('assets/plugins/numeraljs/min/numeral.min.js'));
		$this->layout->set_script(base_url('assets/plugins/knockout/knockout.js'));
		$this->layout->set_script(base_url('assets/plugins/sensortower-daterangepicker/daterangepicker.min.js'));
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

				$color = $this->chartColor();

				$chart['datasets'][] = array(
					'label'	=> $holder['unit_name'][$i],
					'data'	=> $holder['data'][$holder['unit_name'][$i]],
					'borderColor' => $color[$i],
			     	'backgroundColor' => $color[$i],
			     	'borderRadius' => 5,

				); 
				
			}

			echo json_encode($chart);
			return;

		}else{
			exit(NO_DIRECT_ACCESS);
		}

	}

	public function get_sell_unit_daily_chart_data(){

		if($this->input->is_ajax_request()){

			$post = $this->input->post();

			$res = $this->mdc->select_sell_unit_daily_chart_data($post);

			$chart = array('labels' => array(), 'datasets' => array());
			$holder = array('unit_name' => array(), 'data'=>array());
			foreach ($res as $value) {

				if(!in_array($value['tanggal_transaksi'], $chart['labels'])){
					$chart['labels'][] = $value['tanggal_transaksi'];
				}

				if(!in_array($value['unit_name'], $holder['unit_name'])){
					$holder['unit_name'][] = $value['unit_name'];
				}

				$holder['data'][$value['unit_name']][] = $value['total_harjul'];
				
			}

			for ($i = 0; $i < count($holder['unit_name']) ; $i++) {

				$color = $this->chartColor();

				$chart['datasets'][] = array(
					'label'	=> $holder['unit_name'][$i],
					'data'	=> $holder['data'][$holder['unit_name'][$i]],
					'borderColor' => $color[$i],
			     	'backgroundColor' => $color[$i],
			     	'borderRadius' => 15,
				); 
				
			}

			echo json_encode($chart);
			return;

		}else{
			exit(NO_DIRECT_ACCESS);
		}

	}

	private function chartColor(){

		$color = array(
			'rgb(255, 99, 132)', //red
			'rgb(255, 159, 64)', //orange
			'rgb(255, 205, 86)', //yellow
			'rgb(75, 192, 192)', //green
			'rgb(54, 162, 235)', //blue
			'rgb(153, 102, 255)', //purple
			'rgb(201, 203, 207)' //grey
		);

		return $color;

	}


}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */