<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity_log extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_activity');
	}

	public function index(){
		redirect(base_url('activity/transaction'),'refresh');
	}

	public function transaction(){
		$this->layout->set_header("Log Transaksi");
		$this->layout->set_title("Log Transaksi");

		$this->layout->set_style(base_url('assets/plugins/sensortower-daterangepicker/daterangepicker.min.css'));

		$this->layout->set_script(base_url('assets/plugins/knockout/knockout.js'));
		$this->layout->set_script(base_url('assets/plugins/sensortower-daterangepicker/daterangepicker.min.js'));
		$this->layout->set_script(base_url('assets/plugins/numeraljs/min/numeral.min.js'));
		$this->layout->set_script(base_url('assets/js/activity_log/transaction_log.js'));

		$this->layout->set_breadcrumb('Home',base_url());
		$this->layout->set_breadcrumb('Log Transaksi');

		$this->layout->set_sidebar_collapse(TRUE);

		$data = array();
		$data['list_user'] = $this->gm_->get_select_list(TABLE_USER,array(F_USER_ID,F_USER_USERNAME),F_USER_USERNAME.' asc');
		$data['list_item'] = $this->gm_->get_select_list(TABLE_ITEM,array(FIELD_ITEM_ID,FIELD_ITEM_NAME),FIELD_ITEM_NAME.' asc');

		$this->layout->set_content('activity/transaction');
		$this->layout->render($data);
	}

	public function activity(){
		$this->layout->set_header("Log Activity");
		$this->layout->set_title("Log Activity");

		$this->layout->set_style(base_url('assets/plugins/sensortower-daterangepicker/daterangepicker.min.css'));

		$this->layout->set_script(base_url('assets/plugins/knockout/knockout.js'));
		$this->layout->set_script(base_url('assets/plugins/sensortower-daterangepicker/daterangepicker.min.js'));
		$this->layout->set_script(base_url('assets/plugins/numeraljs/min/numeral.min.js'));
		$this->layout->set_script(base_url('assets/js/activity_log/activity_log.js'));

		$this->layout->set_breadcrumb('Home',base_url());
		$this->layout->set_breadcrumb('Log Activity');

		$this->layout->set_sidebar_collapse(TRUE);

		$data = array();
		$data['list_user'] = $this->gm_->get_select_list(TABLE_USER,array(F_USER_ID,F_USER_USERNAME),F_USER_USERNAME.' asc');

		$this->layout->set_content('activity/activity');
		$this->layout->render($data);
	}

	public function get_transaction_log(){
		if($this->input->is_ajax_request()){

			$post = $this->input->post();

			$where = array();
			$where_like = array();

			if($post['fl_category'] != 'all'){
				$where['a.'.FIELD_LOG_TRANS_CATEGORY] = $post['fl_category'];
			}

			if($post['fl_type'] != 'all'){
				$where['a.'.FIELD_LOG_TRANS_TYPE] = $post['fl_type'];
			}

			if($post['fl_item'] != 'all'){
				$where['a.'.FIELD_LOG_TRANS_ITEM] = $post['fl_item'];
			}

			if($post['fl_user'] != "all"){
				$where['a.'.FIELD_CREATE_USER] = $post['fl_user'];
			}

			if($post['fl_trans_date'] != ""){
				[$start, $end] = explode(' - ', $post['fl_trans_date']);
				$where['DATE(a.'.FIELD_CREATE_DATETIME.") >="] = date('Y-m-d', strtotime($start));
				$where['DATE(a.'.FIELD_CREATE_DATETIME.") <="] = date('Y-m-d', strtotime($end));
			}

			$res = $this->model_activity->select_log_transaction($where);

			echo json_encode(array('data'=>$res));
			return;

		}else{
			exit(NO_DIRECT_ACCESS);
		}
	}

	public function get_activity_log(){
		if($this->input->is_ajax_request()){

			$post = $this->input->post();

			$where = array();
			$where_like = array();

			if($post['fl_category'] != 'all'){
				$where['a.'.FIELD_LOG_ACTIVITY_CATEGORY] = $post['fl_category'];
			}

			if($post['fl_type'] != 'all'){
				$where['a.'.FIELD_LOG_ACTIVITY_TYPE] = $post['fl_type'];
			}

			if($post['fl_user'] != "all"){
				$where['a.create_by'] = $post['fl_user'];
			}

			if($post['fl_trans_date'] != ""){
				[$start, $end] = explode(' - ', $post['fl_trans_date']);
				$where['DATE(a.create_at) >='] = date('Y-m-d', strtotime($start));
				$where['DATE(a.create_at) <='] = date('Y-m-d', strtotime($end));
			}

			$res = $this->model_activity->select_log_activity($where);

			echo json_encode(array('data'=>$res));
			return;

		}else{
			exit(NO_DIRECT_ACCESS);
		}
	}

	public function redirect_detail(){
		if($this->input->is_ajax_request()){

			$post = $this->input->post();

			$link = null;
			if( strtolower($post['re_type']) == 'po'){

				$this->load->model('model_purchase_order');
				$res = $this->model_purchase_order->select_po_master(array(FIELD_PM_PO_NO => $post['re_no']), TRUE, NULL, 1);

				if($res){
					$link = 'purchase_order/view/'.$res[FIELD_PM_FISCAL_YEAR]."-".$res[FIELD_PM_PO_ID];
				}

			}else if(strtolower($post['re_type']) == 'do'){

				$this->load->model('model_delivery_order');
				$res = $this->model_delivery_order->select_do_master(array('a.'.FIELD_DOM_NO => $post['re_no']), TRUE);

				if($res){
					$link = 'delivery_order/view/'.$res[FIELD_DOM_PLANT]."-".$res[FIELD_DOM_FISCAL_YEAR]."-".$res[FIELD_DOM_ID];
				}

			}else if(strtolower($post['re_type']) == 'sj'){
				$this->load->model('model_delivery_order');
				$res = $this->model_delivery_order->select_do_master(array('d.'.FIELD_SJM_NO => $post['re_no']), TRUE);

				if($res){
					$link = 'delivery_order/view_print_sj/'.$res[FIELD_DOM_PLANT]."-".$res[FIELD_DOM_FISCAL_YEAR]."-".$res[FIELD_DOM_ID];
				}
			}else if(strtolower($post['re_type']) == 'sc'){
				$this->load->model('model_sales_confirmation');
				$res = $this->model_sales_confirmation->select_sc_master(array(FIELD_SCM_NO => $post['re_no']), TRUE);

				if($res){
					$link = 'sales_confirmation/view/'.$res[FIELD_SCM_PLANT].'-'.$res[FIELD_SCM_FISCAL_YEAR].'-'.$res[FIELD_SCM_ID];
				}

			}else if(strtolower($post['re_type']) == 'inv'){
				$this->load->model('model_invoice');
				$res = $this->model_invoice->select_invoice_master(array(FIELD_INVM_NO => $post['re_no']), TRUE);

				if($res){
					$link = 'invoice/view/'.$res[FIELD_INVM_PLANT].'-'.$res[FIELD_INVM_FISCAL_YEAR].'-'.$res[FIELD_INVM_ID];
				}
			}

			if(!$link){
				echo json_encode(array('result' => false, 'response'=>array('msg' => 'something wrong happen while collection data')));
				return;
			}

			echo json_encode(array('result'=>true, 'response'=>array('link' => $link)));
			return;

		}else{
			exit(NO_DIRECT_ACCESS);
		}
	}
}

/* End of file Activity.php */
/* Location: ./application/controllers/Activity.php */