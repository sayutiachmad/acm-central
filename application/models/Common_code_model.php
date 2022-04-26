<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_code_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		
	}

	public function select_head(){
		$this->db->select(array(
			'a.'.FIELD_COMMON_CODE_HEAD,
			'a.'.FIELD_COMMON_CODE_PARENT,
			'a.'.FIELD_COMMON_CODE_NAME,
			'a.'.FIELD_COMMON_CODE_DESCRIPTION_1,
			'a.'.FIELD_COMMON_CODE_SORT,
			'a.'.FIELD_COMMON_CODE_STATUS,
		),FALSE);
		$this->db->where('a.'.FIELD_COMMON_CODE_PARENT, '0');
		$this->db->or_where('a.'.FIELD_COMMON_CODE_PARENT,'1');
		$this->db->or_where('(SELECT COUNT(*) FROM '.TABLE_COMMON_CODE.' b WHERE b.'.FIELD_COMMON_CODE_PARENT.' = a.'.FIELD_COMMON_CODE_HEAD.')');
		$this->db->order_by('a.'.FIELD_COMMON_CODE_SORT, 'asc');
		return $this->db->get(TABLE_COMMON_CODE.' a')->result_array();
	}

	public function insert_head($data){
		$this->db->where('BINARY '.FIELD_COMMON_CODE_HEAD.' = "'.$data[FIELD_COMMON_CODE_HEAD].'"', NULL, FALSE);
		$this->db->where('BINARY '.FIELD_COMMON_CODE_PARENT.' = "0"',NULL, FALSE);
		$check_code = $this->db->get(TABLE_COMMON_CODE)->num_rows();

		if($check_code > 0){
			return DATA_EXIST;
		}

		$this->db->set($data);
		$this->db->set(FIELD_COMMON_CODE_SORT,'(SELECT IFNULL(MAX(a.'.FIELD_COMMON_CODE_SORT.'),0)+1 FROM '.TABLE_COMMON_CODE.' a WHERE BINARY a.'.FIELD_COMMON_CODE_PARENT.' = "0")',FALSE);
		return $this->db->insert(TABLE_COMMON_CODE);
	}
	
	public function update_common_code($id, $data){
		
		$this->db->where(FIELD_COMMON_CODE_HEAD, $id);
		$this->db->where(FIELD_COMMON_CODE_PARENT, $data[FIELD_COMMON_CODE_PARENT]);
		return $this->db->update(TABLE_COMMON_CODE, $data);
	}

	public function delete_common_code($id,$parent){
		$this->db->where(FIELD_COMMON_CODE_HEAD, $id);
		$this->db->where(FIELD_COMMON_CODE_PARENT, $parent);
		return $this->db->delete(TABLE_COMMON_CODE);
	}

	public function select_detail($parent){
		$this->db->select(array(
			'a.*',
			'(SELECT MAX(cc.'.FIELD_COMMON_CODE_SORT.') FROM '.TABLE_COMMON_CODE.' cc WHERE cc.'.FIELD_COMMON_CODE_PARENT.'=a.'.FIELD_COMMON_CODE_PARENT.') AS max_sort'
		),FALSE);
		$this->db->where('BINARY '.FIELD_COMMON_CODE_PARENT."= '". $parent."'", null, FALSE);
		$this->db->order_by(FIELD_COMMON_CODE_SORT, 'asc');
		return $this->db->get(TABLE_COMMON_CODE.' a')->result_array();
	}

	public function insert_code_detail($data){

		$this->db->where('BINARY '.FIELD_COMMON_CODE_HEAD.' = "'.$data[FIELD_COMMON_CODE_HEAD].'"', NULL, FALSE);
		$this->db->where('BINARY '.FIELD_COMMON_CODE_PARENT.' = "'.$data[FIELD_COMMON_CODE_PARENT].'"', NULL, FALSE);
		$check_code = $this->db->get(TABLE_COMMON_CODE)->num_rows();

		if($check_code > 0){
			return DATA_EXIST;
		}


		$this->db->set($data);
		$this->db->set(FIELD_COMMON_CODE_SORT,'(SELECT IFNULL(MAX('.FIELD_COMMON_CODE_SORT.'),0)+1 FROM '.TABLE_COMMON_CODE.' a WHERE BINARY '.FIELD_COMMON_CODE_PARENT.' = "'.$data[FIELD_COMMON_CODE_PARENT].'")',FALSE);
		$result = $this->db->insert(TABLE_COMMON_CODE);
		return $result;
	}

	public function update_common_code_status($post){
		$this->db->where(array(
			FIELD_COMMON_CODE_HEAD		=>	$post['cc_head_'],
			FIELD_COMMON_CODE_PARENT	=> 	$post['cc_parent_'],
		));


		$this->db->set(FIELD_COMMON_CODE_STATUS, ($post['cc_checked_']=='true' ? 1 : 0));
		return $this->db->update(TABLE_COMMON_CODE);
	}

	public function update_common_code_sort($head, $parent, $direction, $last_pos){


			$this->db->where(FIELD_COMMON_CODE_PARENT, $parent);
			if($direction == "down"){
				$this->db->where(FIELD_COMMON_CODE_SORT, $last_pos+1);
				$this->db->set(FIELD_COMMON_CODE_SORT,($last_pos+1)-1);
			}else{
				$this->db->where(FIELD_COMMON_CODE_SORT, $last_pos-1);
				$this->db->set(FIELD_COMMON_CODE_SORT,($last_pos-1)+1);
			}
			$res = $this->db->update(TABLE_COMMON_CODE);
			// echo $this->db->last_query();

			if(!$res){
				return array('result'=>FALSE,'response'=>"");
			}

			$this->db->where(FIELD_COMMON_CODE_HEAD, $head);
			$this->db->where(FIELD_COMMON_CODE_PARENT, $parent);
			if($direction=="down"){
				$res = $this->db->update(TABLE_COMMON_CODE, array(FIELD_COMMON_CODE_SORT=>$last_pos+1));
			}else{
				$res = $this->db->update(TABLE_COMMON_CODE, array(FIELD_COMMON_CODE_SORT=>$last_pos-1));
			}

			if(!$res){
				return array('result'=>FALSE,'response'=>"");
			}

			return array('result'=>TRUE,'response'=>"");
	}

	public function select_item_group(){
		$this->db->select(array(
			'a.'.FIELD_COMMON_CODE_HEAD,
			'a.'.FIELD_COMMON_CODE_PARENT,
			'a.'.FIELD_COMMON_CODE_NAME,
			'a.'.FIELD_COMMON_CODE_DESCRIPTION_3,
			'IFNULL((SELECT COUNT(b.'.FIELD_COMMON_CODE_HEAD.') FROM '.TABLE_COMMON_CODE.' b WHERE a.'.FIELD_COMMON_CODE_HEAD.'=b.'.FIELD_COMMON_CODE_PARENT.' GROUP BY b.'.FIELD_COMMON_CODE_PARENT.'), 0) AS total_child'
		),FALSE);
		$this->db->order_by(FIELD_COMMON_CODE_SORT, 'asc');
		$this->db->from(TABLE_COMMON_CODE.' a');


		return $this->db->get()->result_array();
	}

}

/* End of file Common_code_model.php */
/* Location: ./application/models/Common_code_model.php */