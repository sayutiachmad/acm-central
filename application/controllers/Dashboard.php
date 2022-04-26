<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	var $detect;

	public function __construct(){
		parent::__construct();
		//Do your magic here
		$this->load->model('Model_dashboard','_model');
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

		$data = array();
		
		
		if ($this->detect->isMobile() || $this->detect->isTablet()) {

			$this->layout->set_script(base_url('assets/js/dashboard/dashboard_sales_m.js?t='.time()));

			$this->layout->set_content('dashboard/dashboard_sales_m');

		}else{

			$this->layout->set_content('dashboard/dashboard_general');
		
		}
		$this->layout->render($data);

	}

	public function dashboard_produksi(){
		//judul tab/browser
		$this->layout->set_header("Dashboard");
		$this->layout->set_sidebar_collapse(true);
		
		//set judul halaman
		$this->layout->set_title("Dashboard");

		//set breadcrumb
		$this->layout->set_breadcrumb('Dashboard',base_url());

		$data = array();
	
		
		
		$this->layout->set_content('dashboard/dashboard_01');
		$this->layout->render($data);

	}

	public function dashboard_inventory(){

		$this->layout->set_header("Dashboard");
		$this->layout->set_sidebar_collapse(true);
		
		//set judul halaman
		$this->layout->set_title("Dashboard");

		//set breadcrumb
		$this->layout->set_breadcrumb('Dashboard',base_url());

		$data = array();
		
		
		$this->layout->set_content('dashboard/dashboard_inventory');
		$this->layout->render($data);
	}


}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */