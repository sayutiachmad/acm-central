<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_code extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('common_code_model','ccm_');
	}

	public function index(){

		$this->layout->set_header("Master Data | Common Code");
		$this->layout->set_title("Master Data");

		$this->layout->set_breadcrumb('Dashboard',base_url());
		$this->layout->set_breadcrumb('Master Data');
		$this->layout->set_breadcrumb('Common Code');
		$this->layout->set_sidebar_collapse(true);

		$this->layout->set_script(base_url('assets/js/common_code/common_code.js'));

		$data = array();

		$this->layout->set_content('common_code/common_code');
		$this->layout->render($data);
		
	}

	public function get_head(){
		if($this->input->is_ajax_request()){

			$result = $this->ccm_->select_head();

			echo json_encode(array('data'=>$result));

		}else{
			exit(NO_DIRECT_ACCESS);
		}
	}

	public function save_head(){
		if($this->input->is_ajax_request()){

			$post = $this->input->post();

			$data = array(
				FIELD_COMMON_CODE_NAME				=> $post['cc_head_code_name_'],
				FIELD_COMMON_CODE_DESCRIPTION_1		=> $post['cc_head_desc_'],
			);

			$result = FALSE;
			if(strlen($post['cc_code_sub_'])>0){
				$result = $this->ccm_->update_common_code($post['cc_code_sub_'], $data);
			}else{
				$data[FIELD_COMMON_CODE_HEAD] = $post['cc_head_code_'];
				$result = $this->ccm_->insert_head($data);
			}

			echo json_encode(array('result'=>$result));

		}else{
			exit(NO_DIRECT_ACCESS);
		}
	}

	public function remove_common(){
		if($this->input->is_ajax_request()){

			$id = $this->input->post('cc_code_',TRUE);
			$parent = $this->input->post('cc_parent_',TRUE);

			$result = $this->ccm_->delete_common_code($id, $parent);

			$msg = 'Berhasil Menghapus Data Common Code!';
			if(!$result){
				$msg = 'Gagal Menghapus Data Common Code!';
			}

			echo json_encode(array('result'=>$result,'msg'=>$msg));

		}else{
			exit(NO_DIRECT_ACCESS);
		}
	}

	public function save_data(){
		if($this->input->is_ajax_request()){

			$post = $this->input->post();

			$data = array(
				FIELD_COMMON_CODE_PARENT			=> $post['cc_parent_'],
				FIELD_COMMON_CODE_NAME				=> $post['cc_code_name_'],
				FIELD_COMMON_CODE_DESCRIPTION_1		=> $post['cc_desc_1_'],
				FIELD_COMMON_CODE_DESCRIPTION_2		=> $post['cc_desc_2_'],
				FIELD_COMMON_CODE_DESCRIPTION_3		=> $post['cc_desc_3_'],
				FIELD_COMMON_CODE_AMOUNT_1			=> $post['cc_amt_1_'],
				FIELD_COMMON_CODE_AMOUNT_2			=> $post['cc_amt_2_'],
				FIELD_COMMON_CODE_AMOUNT_3			=> $post['cc_amt_3_'],
			);

			$result = FALSE;
			if($post['cc_code_']!=''){
				$result = $this->ccm_->update_common_code($post['cc_code_'], $data);
			}else{
				
				$data[FIELD_COMMON_CODE_HEAD] = $post['cc_det_code_'];
				$result = $this->ccm_->insert_code_detail($data);
			}

			echo json_encode(array('result'=>$result));

		}else{
			exit(NO_DIRECT_ACCESS);
		}
	}

	public function get_detail(){
		if($this->input->is_ajax_request()){

			$parent = $this->input->post('cc_parent_');

			$result = false;
			if($parent!='0'){
				$result = $this->ccm_->select_detail($parent);
			}

			echo json_encode(array('data'=>$result));

		}else{
			exit(NO_DIRECT_ACCESS);
		}
	}

	public function save_status_code(){
		if($this->input->is_ajax_request()){

			$post = $this->input->post();

			$result = $this->ccm_->update_common_code_status($post);

			echo json_encode(array('result'=>$result));

		}else{
			exit(NO_DIRECT_ACCESS);
		}
	}

	public function move_sort(){
		if($this->input->is_ajax_request()){

			$post = $this->input->post();

			$result = $this->ccm_->update_common_code_sort($post['cc_head_'], $post['cc_parent_'],$post['cc_direction_'],$post['cc_last_position_']);

			echo json_encode(array('result'=>$result['result'],'response'=>$result['response']));

		}else{
			exit(NO_DIRECT_ACCESS);
		}
	}

	public function item_group(){
		$this->layout->set_header("Master Data | Item Group");
		$this->layout->set_title("Item Group");

		$this->layout->set_breadcrumb('Dashboard',base_url());
		$this->layout->set_breadcrumb('Master Data');
		$this->layout->set_breadcrumb('Item Group');
		$this->layout->set_sidebar_collapse(true);

		$this->layout->set_style(base_url('assets/plugins/jstree/themes/proton/style.min.css'));

		$this->layout->set_script(base_url('assets/plugins/jstree/jstree.min.js'));

		$this->layout->set_script(base_url('assets/js/common_code/item_group.js'));

		$data = array();
		$data['item_group'] = $this->ccm_->select_item_group();

		$this->layout->set_content('common_code/item_group');
		$this->layout->render($data);
	}

	public function partner_group(){
		$this->layout->set_header("Master Data | Partner Group");
		$this->layout->set_title("Mitra Bisnis Group");

		$this->layout->set_breadcrumb('Dashboard',base_url());
		$this->layout->set_breadcrumb('Master Data');
		$this->layout->set_breadcrumb('Partner Group');
		$this->layout->set_sidebar_collapse(true);

		$this->layout->set_style(base_url('assets/plugins/jstree/themes/proton/style.min.css'));

		$this->layout->set_script(base_url('assets/plugins/jstree/jstree.min.js'));

		$this->layout->set_script(base_url('assets/js/common_code/item_group.js'));

		$data = array();
		$data['item_group'] = $this->ccm_->select_item_group();

		$this->layout->set_content('common_code/partner_group');
		$this->layout->render($data);
	}

}

/* End of file Common_code.php */
/* Location: ./application/controllers/Common_code.php */