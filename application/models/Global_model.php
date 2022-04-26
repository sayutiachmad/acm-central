<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Global_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
	}
	
	public function select_navigation_by_role($role){

		$this->db->select('GROUP_CONCAT('.F_NAV_PERMISSION_NAVIGATION.') as nav_list',false);
		$nav_permission = $this->db->get_where(TABLE_NAV_PERMISSION, array(F_NAV_PERMISSION_ROLE => $role))->row_array();

		// echo $nav_permission['nav_list'];

		$this->db->select(array(
			'b.'.F_NAVIGATION_ID,
			'b.'.F_NAVIGATION_NAME,
			'b.'.F_NAVIGATION_LINK,
			'b.'.F_NAVIGATION_ICON,
			'b.'.F_NAVIGATION_PARENT,
			'(SELECT COUNT(*) FROM '.TABLE_NAVIGATION.' c WHERE b.'.F_NAVIGATION_ID.' = c.'.F_NAVIGATION_PARENT.' AND c.'.F_NAVIGATION_ID.' IN('.$nav_permission['nav_list'].')) as child_count'
		),false);
		$this->db->from(TABLE_NAV_PERMISSION." a");
		$this->db->join(TABLE_NAVIGATION." b", 'a.'.F_NAV_PERMISSION_NAVIGATION.' = b.'.F_NAVIGATION_ID, 'left');
		$this->db->where('a.'.F_NAV_PERMISSION_ROLE, $role);

		$this->db->where('b.'.F_NAVIGATION_ID." IS NOT NULL");
		$this->db->order_by('b.'.F_NAVIGATION_ORDER, 'asc');
		return $this->db->get()->result_array();
	}

	public function select_user_navigation($user_id){

		$this->db->select(array(
			'b.'.F_NAVIGATION_ID,
			'b.'.F_NAVIGATION_NAME,
			'b.'.F_NAVIGATION_LINK,
			'b.'.F_NAVIGATION_ICON,
			'b.'.F_NAVIGATION_PARENT,
			'(SELECT COUNT(*) FROM '.TABLE_NAVIGATION.' c WHERE b.'.F_NAVIGATION_ID.' = c.'.F_NAVIGATION_PARENT.') as child_count'
		));
		$this->db->from(TABLE_USER_NAVIGATION.' a');
		$this->db->join(TABLE_NAVIGATION.' b', 'b.'.F_NAVIGATION_ID.' = a.'.F_USER_NAV_NAVIGATION, 'left');
		$this->db->where('a.'.F_USER_NAV_USER, $user_id);

		$this->db->where('b.'.F_NAVIGATION_ID." IS NOT NULL");
		$this->db->order_by('b.'.F_NAVIGATION_ORDER, 'asc');
		return $this->db->get()->result_array();

	}

	public function select_user_type($id=0){
		if($id>0){
			$this->db->where(F_USER_TYPE_ID, $id);
		}
		$this->db->order_by(F_USER_TYPE_ID, 'asc');
		$result = $this->db->get(TABLE_USER_TYPE);

		if($id>0){
			return $result->row_array();
		}else{
			return $result->result_array();
		}

		return FALSE;
	}

	public function check_page_permission($page,$role){

		$this->db->select(F_PAGE_ID);
		$this->db->where('LOWER('.F_PAGE_URL.')', strtolower($page));
		$row = $this->db->get(TABLE_PAGE, 1);
		if($row->num_rows()>0){

			$data = $row->row_array();

			$this->db->where(F_PAGE_PERMISSION_PAGE, $data['id_page']);
			$this->db->where(F_PAGE_PERMISSION_ROLE, $role);
			$result = $this->db->get(TABLE_PAGE_PERMISSION,1);

			if($result->num_rows()>0){
				return true;
			}else{
				return false;
			}

		}else{
			return true;
		}

	}


	public function select_user_login_detail($user_id, $role){

		$user_type = $this->select_user_type($role);

		return array();

	}

	public function get_single_data($table,$col="*",$where = null){
		$this->db->select($col);
		if($where != null){
			$this->db->where($where);
		}

		return $this->db->get($table,1)->row_array();
	}

	public function get_select_list($table,$col="*",$order=null,$where=null, $like = null, $limit = null){
		$this->db->select($col);
		if($where != null){
			$this->db->where($where);
		}
		if($like != null){
			$this->db->like($like);
		}
		if($order!=null){
			$this->db->order_by($order);
		}
		if($limit != null){
			if(is_array($limit)){

				$this->db->limit($limit['limit'], $limit['offset']);

			}else{
				$this->db->limit($limit);
			}
		}
		return $this->db->get($table)->result_array();
	}

	public function check_page_permission_by_navigation($page,$role){

		$this->db->select(array(
			F_NAVIGATION_ID,
		));
		$this->db->where('LOWER('.F_NAVIGATION_LINK.')', strtolower($page));
		$row = $this->db->get(TABLE_NAVIGATION, 1);
		if($row->num_rows()>0){

			$data = $row->row_array();

			$this->db->where(F_NAV_PERMISSION_NAVIGATION, $data[F_NAVIGATION_ID]);
			$this->db->where(F_NAV_PERMISSION_ROLE, $role);
			$result = $this->db->get(TABLE_NAV_PERMISSION,1);

			$this->db->select(array(
				F_UP_PERMISSION
			));
			$this->db->where('LOWER('.F_UP_LINK.')', strtolower($page));
			$row_permission = $this->db->get(TABLE_USER_PERMISSION);

			$data_permission = $row_permission->row_array();

			if($result->num_rows()>0){
				if($row_permission->num_rows() > 0){
					if( $data_permission[F_UP_PERMISSION] == 1){
						return TRUE;
					}else{
						return FALSE;
					}
				}

				return TRUE;
			}else{
				if($row_permission->num_rows() > 0){
					if( $data_permission[F_UP_PERMISSION] == 1){
						return TRUE;
					}else{
						return FALSE;
					}
				}

				return FALSE;
			}

		}else{
			return FALSE;
		}

	}

}

/* End of file Global_model.php */
/* Location: ./application/models/Global_model.php */