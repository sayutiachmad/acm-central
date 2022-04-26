<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Navigation_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		
	}

	public function select_navigation($select="*",$where=null,$order=null,$limit=0){

		$this->db->select($select);
		$this->db->from(TABLE_NAVIGATION);

		if(!is_null($where)){
			foreach ($where as $key => $where_val) {
				$this->db->where($where_val['field'], $where_val['value']);
			}
		}

		if(!is_null($order)){
			foreach ($order as $key => $order_val) {
				$this->db->order_by($order_val['field'], $order_val['order']);
			}
		}

		if($limit>0){
			$this->db->limit($limit);
		}

		if($limit==1){
			return $this->db->get()->row_array();
		}

		return $this->db->get()->result_array();

	}

	public function insert_navigation($data){
		$this->db->set($data);
		$this->db->set(F_NAVIGATION_ORDER,'(SELECT MAX('.F_NAVIGATION_ORDER.')+1 FROM '.TABLE_NAVIGATION.' a)',FALSE);
		return $this->db->insert(TABLE_NAVIGATION);
	}
	
	public function update_navigation($id,$data){
		$this->db->where(F_NAVIGATION_ID, $id);
		return $this->db->update(TABLE_NAVIGATION, $data);
	}


	public function delete_navigation($id){
		$this->db->where(F_NAVIGATION_ID, $id);
		return $this->db->delete(TABLE_NAVIGATION);
	}

	public function select_navigation_nestable(){
		$this->db->select(array(
			'a.'.F_NAVIGATION_ID,
			'a.'.F_NAVIGATION_NAME,
			'a.'.F_NAVIGATION_LINK,
			'a.'.F_NAVIGATION_ICON,
			'a.'.F_NAVIGATION_PARENT,
			'a.'.F_NAVIGATION_ORDER,
			'(SELECT COUNT(*) FROM '.TABLE_NAVIGATION.' c WHERE a.'.F_NAVIGATION_ID.' = c.'.F_NAVIGATION_PARENT.') as child_count'
		),false);
		$this->db->from(TABLE_NAVIGATION." a");
		$this->db->group_by('a.'.F_NAVIGATION_ID);
		$this->db->order_by('a.'.F_NAVIGATION_ORDER, 'asc');
		return $this->db->get()->result_array();
	}


	public function update_navigation_order($data){
		return $this->db->update_batch(TABLE_NAVIGATION, $data, F_NAVIGATION_ID);
	}

	public function select_user_navigation($user){
		$this->db->select(array(
			'a.'.F_NAVIGATION_ID,
			'a.'.F_NAVIGATION_NAME,
			'a.'.F_NAVIGATION_LINK,
			'a.'.F_NAVIGATION_ICON,
			'a.'.F_NAVIGATION_PARENT,
			'a.'.F_NAVIGATION_ORDER,
			'(SELECT COUNT(*) FROM '.TABLE_NAVIGATION.' c WHERE a.'.F_NAVIGATION_ID.' = c.'.F_NAVIGATION_PARENT.') as child_count',
			'b.'.F_USER_NAV_ID
		),false);
		$this->db->from(TABLE_NAVIGATION." a");
		$this->db->join(TABLE_USER_NAVIGATION.' b', 'b.'.F_USER_NAV_NAVIGATION.' = a.'.F_NAVIGATION_ID.' AND b.'.F_USER_NAV_USER.' = '.$user, 'left');
		$this->db->group_by('a.'.F_NAVIGATION_ID);
		$this->db->order_by('a.'.F_NAVIGATION_ORDER, 'asc');
		return $this->db->get()->result_array();
	}

	public function insert_user_navigation($user, $navigation){
		return $this->db->insert(TABLE_USER_NAVIGATION, array(F_USER_NAV_NAVIGATION => $navigation, F_USER_NAV_USER => $user));
	}

	public function delete_user_navigation($user, $navigation){
		$this->db->where(F_USER_NAV_NAVIGATION, $navigation);
		$this->db->where(F_USER_NAV_USER, $user);
		return $this->db->delete(TABLE_USER_NAVIGATION);
	}

	public function duplicate_user_navigation($user_from, $user_to){

		$this->db->where(F_USER_NAV_USER, $user_from);
		$res_from = $this->db->get(TABLE_USER_NAVIGATION)->result_array();

		$this->db->where(F_USER_NAV_USER, $user_to);
		$del_to = $this->db->delete(TABLE_USER_NAVIGATION);

		if($del_to){

			$nav = array();
			foreach ($res_from as $value) {
				$data = array(
					F_USER_NAV_USER			=> $user_to,
					F_USER_NAV_NAVIGATION	=> $value[F_USER_NAV_NAVIGATION]
				);

				array_push($nav, $data);
			}

			return $this->db->insert_batch(TABLE_USER_NAVIGATION, $nav);

		}

		return false;

	}

	//////////////////////////////////////////////
	//model untuk halaman navigation permission //
	//////////////////////////////////////////////

	public function insert_navigation_permission($data){
		return $this->db->insert(TABLE_NAV_PERMISSION, $data);
	}

	public function delete_navigation_permission($data){
		$this->db->where(F_NAV_PERMISSION_NAVIGATION, $data[F_NAV_PERMISSION_NAVIGATION]);
		$this->db->where(F_NAV_PERMISSION_ROLE, $data[F_NAV_PERMISSION_ROLE]);
		return $this->db->delete(TABLE_NAV_PERMISSION);
	}

	//model untuk halaman user permission

	public function select_user_permission($where = null){
		if($where != null){
			$this->db->where($where);
		}
		return $this->db->get(TABLE_USER_PERMISSION)->result_array();
	}

	public function insert_user_permission($data){
		return $this->db->insert(TABLE_USER_PERMISSION, $data);
	}

	public function update_user_permission($id, $data){
		$this->db->where(F_UP_ID, $id);
		return $this->db->update(TABLE_USER_PERMISSION, $data);
	}

	public function delete_user_permission($id){
		$this->db->where(F_UP_ID, $id);
		return $this->db->delete(TABLE_USER_PERMISSION);
	}


}

/* End of file Navigation_model.php */
/* Location: ./application/models/Navigation_model.php */