<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Navigation extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('navigation_model','nm_');

	}

	public function index(){

		$this->layout->set_header("Navigasi");
		$this->layout->set_title("Navigasi");

		$this->layout->set_script(base_url('assets/js/navigation/navigation.js'));

		$data = array();

		$this->layout->set_content('navigation/navigation');
		$this->layout->render($data);
	}

	public function get_navigation(){
		if($this->input->is_ajax_request()){

			$select = array(
				TABLE_NAVIGATION.".*", 
				"(SELECT a.".F_NAVIGATION_NAME." FROM ".TABLE_NAVIGATION." a WHERE ".TABLE_NAVIGATION.".".F_NAVIGATION_PARENT." = a.".F_NAVIGATION_ID." GROUP BY a.".F_NAVIGATION_PARENT.") as parent_name"
			);

			$order = array(
				array(
					'field'	=> F_NAVIGATION_ORDER,
					'order'	=> 'asc'
				)
			);

			$result = $this->nm_->select_navigation($select, null, $order);

			echo json_encode(array('data'=>$result));

		}else{
			exit('No direct access allowed!');
		}
	}

	public function save_navigation(){
		if($this->input->is_ajax_request()){

			$post = $this->input->post();

			$data = array(
				F_NAVIGATION_NAME		=> $post['nv_nama_navigasi_'],
				F_NAVIGATION_LINK		=> $post['nv_link_'],
				F_NAVIGATION_ICON		=> $post['nv_icon_'],
				F_NAVIGATION_PARENT		=> (isset($post['nv_parent_']) ? $post['nv_parent_'] : 0),
			);

			if($post['nv_code_']>0){
				$result = $this->nm_->update_navigation($post['nv_code_'],$data);
			}else{
				$result = $this->nm_->insert_navigation($data);
			}

			echo json_encode(array('result'=>$result));

		}else{
			exit("No direct access allowed!");
		}
	}

	public function remove_navigation(){
		if($this->input->is_ajax_request()){

			$post = $this->input->post();

			$result = $this->nm_->delete_navigation($post['nv_code_']);

			$msg = '';
			if($result){
				$msg = "Berhasil menghapus data!";
			}else{
				$msg = "Gagal menghapus data!";
			}

			echo json_encode(array('result'=>$result,'msg'=>$msg));

		}else{
			exit("No direct access allowed");
		}
	}

	public function get_navigation_parent(){
		if($this->input->is_ajax_request()){

			$select = array(F_NAVIGATION_ID,F_NAVIGATION_NAME,F_NAVIGATION_PARENT);
			$where = null;
			$order = array(
				array('field'=>F_NAVIGATION_ORDER,'order'=>'asc'),
			);

			$result = $this->nm_->select_navigation($select,$where,$order);

			echo json_encode(array('result'=>TRUE,'data'=>$result));


		}else{
			exit("No direct access allowed");
		}
	}


	////////////////////////////////////////
	// halaman untuk mengatur urutan menu //
	////////////////////////////////////////
	public function manage(){



		$this->layout->set_header("Navigasi");
		$this->layout->set_title("Navigasi");

		$this->layout->set_style(base_url('assets/plugins/nestable/jquery-nestable.css'));
		$this->layout->set_script(base_url('assets/plugins/nestable/jquery.nestable.js'));
		$this->layout->set_script(base_url('assets/js/navigation/navigation_order.min.js'));

		$data = array();

		$this->layout->set_content('navigation/navigation_order');
		$this->layout->render($data);
	}

	public function get_nestable_navigation(){
		if($this->input->is_ajax_request()){

			$result = $this->nm_->select_navigation_nestable();

			$btn_manage = '<a href="javascript:;" data-toggle="tooltip" data-placement="top" data-original-title="Hapus Navigasi" title="" class="btn btn-xs float-right btn-peep action-remove" style="margin-top:-5px;"><i class="fa fa-trash text-danger"></i></a>';
			$btn_manage .= '<a href="javascript:;" data-toggle="tooltip" data-placement="top" data-original-title="Ubah Navigasi" title="" class="btn btn-xs float-right btn-peep action-edit" style="margin-top:-5px;"><i class="fa fa-edit"></i></a>'; 

			$preloader = '<div class="preloader pl-size-xs float-right loader-nestable" style="display:none;"><div class="spinner-layer pl-red-grey"><div class="circle-clipper left"><div class="circle"></div></div><div class="circle-clipper right"><div class="circle"></div></div></div></div>';

			$nestable = '';
			$nestable .= '<ol class="dd-list">';
			foreach ($result as $key => $value) {
				if($value['child_count']>0){

					if($value['parent'] == 0){
						$nestable .= '<li class="dd-item dd3-item dd-parent-item" data-nav-code="'.$value[F_NAVIGATION_ID].'">';
						$nestable .= '<div class="dd-handle dd3-handle">drag</div>';
						$nestable .= '<div class="dd3-content" data-nav-code="'.$value[F_NAVIGATION_ID].'">';
						$nestable .= '<i class="'.$value[F_NAVIGATION_ICON].'"></i> ';
						$nestable .= '<span class="nest-label">'.$value[F_NAVIGATION_NAME].'</span>';
						$nestable .= $btn_manage;
						$nestable .= $preloader;
						$nestable .= '</div>';
						$nestable .= '<ol class="dd-list">';

						foreach ($result as $key_sub => $value_sub) {
							if($value[F_NAVIGATION_ID]==$value_sub[F_NAVIGATION_PARENT]){
								$nestable .= '<li class="dd-item dd3-item dd-child-item" data-nav-code="'.$value_sub[F_NAVIGATION_ID].'">';
								$nestable .= '<div class="dd-handle dd3-handle">drag</div>';
								$nestable .= '<div class="dd3-content" data-nav-code="'.$value_sub[F_NAVIGATION_ID].'">';
								$nestable .= '<i class="'.$value_sub[F_NAVIGATION_ICON].'"></i> <span class="nest-label">'.$value_sub[F_NAVIGATION_NAME].'</span>';
								$nestable .= $btn_manage;
								$nestable .= $preloader;
								$nestable .= '</div>';

								if($value_sub['child_count']>0){
									$nestable .= '<ol>';
								}

								foreach ($result as $key_sub2 => $value_sub2) {
									if($value_sub[F_NAVIGATION_ID]==$value_sub2[F_NAVIGATION_PARENT]){
										$nestable .= '<li class="dd-item dd3-item dd-child-item" data-nav-code="'.$value_sub2[F_NAVIGATION_ID].'">';
										$nestable .= '<div class="dd-handle dd3-handle">drag</div>';
										$nestable .= '<div class="dd3-content" data-nav-code="'.$value_sub[F_NAVIGATION_ID].'">';
										$nestable .= '<i class="'.$value_sub2[F_NAVIGATION_ICON].'"></i> <span class="nest-label">'.$value_sub2[F_NAVIGATION_NAME].'</span>';
										$nestable .= $btn_manage;
										$nestable .= $preloader;
										$nestable .= '</div>';
									}
								}

								if($value_sub['child_count']>0){
									$nestable .= '</ol>';
								}

								$nestable .= '</li>';
							}
						}
						$nestable .= '</ol>';
						$nestable .= '</li>';
					}
				}else{
					if($value['parent']==0){
						$nestable .= '<li class="dd-item dd3-item" data-nav-code="'.$value[F_NAVIGATION_ID].'">';
						$nestable .= '<div class="dd-handle dd3-handle">drag</div>';
						$nestable .= '<div class="dd3-content" data-nav-code="'.$value[F_NAVIGATION_ID].'">';
						$nestable .= '<i class="'.$value[F_NAVIGATION_ICON].'"></i> ';
						$nestable .= '<span class="nest-label">'.$value[F_NAVIGATION_NAME].'</span>';
						$nestable .= $btn_manage;
						$nestable .= $preloader;
						$nestable .= '</div>';
						$nestable .= '</li>';
					}
				}
			}
			$nestable .= '</ol>';

			echo json_encode(array('result'=>$nestable));

		}else{
			exit('No direct access allowed');
		}
	}

	public function change_menu_order(){
		if($this->input->is_ajax_request()){

			$post = $this->input->post();

			$position = 1;

			$data = array();
			foreach ($post['nav_nest'] as $key => $value) {

				

				$nav_item = array(
					F_NAVIGATION_ID		=> $value['navCode'],
					F_NAVIGATION_PARENT	=> 0,
					F_NAVIGATION_ORDER	=> $position++,
				);
				array_push($data, $nav_item);

				if(isset($value['children'])){
					foreach ($value['children'] as $key_child => $value_child) {
						$nav_child = array(
							F_NAVIGATION_ID		=> $value_child['navCode'],
							F_NAVIGATION_PARENT	=> $value['navCode'],
							F_NAVIGATION_ORDER	=> $position++,
						);

						array_push($data, $nav_child);

						if(isset($value_child['children'])){
							foreach ($value_child['children'] as $key_child2 => $value_child2) {
								# code...
							}
							$nav_child2 = array(
								F_NAVIGATION_ID		=> $value_child2['navCode'],
								F_NAVIGATION_PARENT	=> $value_child['navCode'],
								F_NAVIGATION_ORDER	=> $position++,
							);
							array_push($data, $nav_child2);
						}
					}
				}
			}

			$result = $this->nm_->update_navigation_order($data);

			echo json_encode(array('result'=>$result));
		}else{
			exit('No direct access allowed');
		}
	}

	public function get_navigation_detail(){
		if($this->input->is_ajax_request()){

			$id = $this->input->post('nav_code_', TRUE);

			$where = array(
				array(
					'field' 	=> F_NAVIGATION_ID,
					'value'		=> $id
				)
			);

			$result = $this->nm_->select_navigation('*',$where,null,1);

			echo json_encode(array('result' => $result));

		}else{
			exit('No direct access allowed');
		}
	}

	///////////////////////////////////////////////////////
	// Halaman setting permission untuk menampilkan menu //
	///////////////////////////////////////////////////////
	public function permission(){
		$this->layout->set_header("Hak Akses Navigasi");
		$this->layout->set_title("Hak Akses Navigasi");

		$this->layout->set_script(base_url('assets/js/navigation/navigation_permission.min.js'));

		$data = array();
		$data['list_role'] = $this->gm_->select_user_type();

		$this->layout->set_content('navigation/navigation_permission');
		$this->layout->render($data);
	}

	public function get_navigation_permission(){
		if($this->input->is_ajax_request()){

			$select = array(
				TABLE_NAVIGATION.".".F_NAVIGATION_ID,
				TABLE_NAVIGATION.".".F_NAVIGATION_NAME, 
				TABLE_NAVIGATION.".".F_NAVIGATION_ICON, 
				TABLE_NAVIGATION.".".F_NAVIGATION_PARENT, 
				TABLE_NAVIGATION.".".F_NAVIGATION_ORDER, 
				"(SELECT GROUP_CONCAT(CONCAT(b.".F_NAV_PERMISSION_NAVIGATION.",'-',b.".F_NAV_PERMISSION_ROLE.") SEPARATOR ',') FROM ".TABLE_NAV_PERMISSION." b WHERE ".TABLE_NAVIGATION.".".F_NAVIGATION_ID."= b.".F_NAV_PERMISSION_NAVIGATION.") as pcode"
			);
			$order = array(
				array('field'=>F_NAVIGATION_ORDER,'order'=>'asc'),
			);
			$result = $this->nm_->select_navigation($select,null,$order);

			echo json_encode(array('data'=>$result));

		}else{
			exit('No direct access allowed!');
		}
	}

	public function save_permission(){
		if($this->input->is_ajax_request()){

			$post = $this->input->post();

			list($nav_id,$role_id) = explode("-", $post['pcode']);
			$checked = $post['checked'];
			$data = array(
				F_NAV_PERMISSION_NAVIGATION	=> $nav_id,
				F_NAV_PERMISSION_ROLE		=> $role_id,
			);

			$result = 'true';
			if($checked==='true'){
				$result = $this->nm_->insert_navigation_permission($data);
			}else{
				$result = $this->nm_->delete_navigation_permission($data);
			}

			echo json_encode(array('result'=>$result));

		}else{
			exit('No direct access allowed');
		}
	}

	///////////////////////////////////////////////////////////
	//halaman untuk mengatur hak akses menu spesifik per user//
	///////////////////////////////////////////////////////////

	public function user_permission(){
		$this->layout->set_header("Hak Akses Navigasi User");
		$this->layout->set_title("Hak Akses Navigasi User");

		$this->layout->set_script(base_url('assets/js/navigation/user_navigation_permission.js'));

		$data = array();
		$data['list_role'] = $this->gm_->select_user_type();

		$this->layout->set_content('navigation/user_navigation_permission');
		$this->layout->render($data);
	}


	public function get_user_permission(){
		if($this->input->is_ajax_request()){

			$user_id = $this->input->post('user_code_');

			$result = '';
			if($user_id > 0){
				$where = array(
					F_UP_USER	=> $user_id
				);

				$result = $this->nm_->select_user_permission($where);
			}

			echo json_encode(array('data'=>$result));

		}else{
			exit(NO_DIRECT_ACCESS);
		}
	}

	public function save_user_permission(){
		if($this->input->is_ajax_request()){

			$post = $this->input->post();

			$data = array(
				F_UP_USER		=> $post['up_user_'],
				F_UP_NAME		=> $post['up_navigation_name_'],
				F_UP_LINK		=> $post['up_link_'],
				F_UP_PERMISSION	=> $post['up_permission_']
			);

			$result = false;
			if($post['up_code_'] > 0 ){

				$up_id = $post['up_code_'];
				$result = $this->nm_->update_user_permission($up_id, $data);

			}else{

				$result = $this->nm_->insert_user_permission($data);

			}

			echo json_encode(array('result'=>$result));

			return;

		}else{
			exit(NO_DIRECT_ACCESS);
		}
	}

	public function remove_user_permission(){
		if($this->input->is_ajax_request()){

			$id = $this->input->post('up_code_',TRUE);

			$result = $this->nm_->delete_user_permission($id);

			$msg = '';
			if($result){
				$msg = "Berhasil menghapus data!";
			}else{
				$msg = "Gagal menghapus data!";
			}

			echo json_encode(array('result'=>$result,'msg'=>$msg));

		}else{
			exit(NO_DIRECT_ACCESS);
		}
	}


	//user based navigation 

	public function user_navigation(){
		$this->layout->set_header("Hak Akses Navigasi User");
		$this->layout->set_title("Hak Akses Navigasi User");

		$this->layout->set_style(base_url('assets/plugins/jstree/themes/proton/style.min.css'));

		$this->layout->set_script(base_url('assets/plugins/jstree/jstree.min.js'));
		$this->layout->set_script(base_url('assets/js/navigation/user_navigation.js'));

		$data = array();
		$data['list_role'] = $this->gm_->select_user_type();
		$data['list_user'] = $this->gm_->get_select_list(TABLE_USER,array(F_USER_ID, F_USER_USERNAME),F_USER_USERNAME.' ASC',null);

		$this->layout->set_content('navigation/user_navigation');
		$this->layout->render($data);
	}

	public function get_nav_tree(){
		if($this->input->is_ajax_request()){

			$user = $this->input->post('user_code');

			$result = $this->nm_->select_user_navigation($user);

			$content = $this->generate_nav_tree($result, 0);

			echo json_encode(array('result'=>true, 'response'=>$content));

		}else{
			exit(NO_DIRECT_ACCESS);
		}
	}

	private function generate_nav_tree($navigation, $parent){
		$content = '<ul>';
		foreach ($navigation as $value) {

			if($value[F_NAVIGATION_PARENT] == $parent){

				$nav_permission = ($value[F_USER_NAV_ID] != "" ? "checked" : "unchecked");

				$content .= '<li data-nav-id="'.$value[F_NAVIGATION_ID].'" data-nav-parent="'.$value[F_NAVIGATION_PARENT].'" data-nav-permission="'.$nav_permission.'" data-nav-code="'.$value[F_USER_NAV_ID].'" data-jstree=\'{ "opened" : true }\'>';
				$content .= '<strong><i class="'.$value[F_NAVIGATION_ICON].'"></i> '.$value[F_NAVIGATION_NAME].'</strong>';


				
				if($value['child_count'] > 0){
					
					$content .= $this->generate_nav_tree($navigation, $value[F_NAVIGATION_ID]);

				}

				$content .= '</li>';

			}
		}
		$content .= '</ul>';

		return $content;

	}

	public function save_user_navigation(){
		if($this->input->is_ajax_request()){

			$post = $this->input->post();

			if($post['chk_state'] == "true"){
				$result = $this->nm_->delete_user_navigation($post['user_code'], $post['nav_code']);
				$response = "remove";
			}else{
				$result = $this->nm_->insert_user_navigation($post['user_code'], $post['nav_code']);
				$response = "add";
			}

			echo json_encode(array('result'=>$result, 'response'=>$response));
			return;

		}else{
			exit(NO_DIRECT_ACCESS);
		}
	}

	public function copy_user_navigation(){
		if($this->input->is_ajax_request()){

			$post = $this->input->post();

			$result = $this->nm_->duplicate_user_navigation($post['user_from'], $post['user_to']);

			if($result > 0){
				$result = true;
			}else{
				$result = false;
			}

			echo json_encode(array('result'=>$result, 'response'=>'copy'));
			return;

		}else{
			exit(NO_DIRECT_ACCESS);
		}
	}

}	

/* End of file Navigation.php */
/* Location: ./application/controllers/Navigation.php */