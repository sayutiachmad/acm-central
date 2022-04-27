<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_report extends CI_Model {

	public function __construct(){
		parent::__construct();
		
	}

	public function select_daily_global($data){


		$this->db->select(array(
			'SUM( (trxd.dp_barang_harpok * trxd.dp_qty) ) AS total_harpok',
			'SUM( (trxd.dp_barang_harjul * trxd.dp_qty) ) AS total_harjul',
			'SUM(trxd.dp_diskon) AS total_diskon',
			'SUM(trxd.dp_total) AS total_jual',
			'trx.*',
			'DATE(trx.tp_tanggal) AS tanggal_transaksi',
			'un.'.FIELD_PLANT_NAME.' AS unit_name'
		));
		$this->db->from('trx_penjualan_detail trxd');
		$this->db->join('trx_penjualan trx', 'trx.tp_unit = trxd.dp_unit AND trx.tp_nofak = trxd.dp_nofak', 'left');
		$this->db->join(TABLE_PLANT.' un', 'un.'.FIELD_PLANT_ID.' = trx.tp_unit', 'left');


		if($data['fl_unit']){
			$this->db->where('trx.tp_unit', $data['fl_unit']);
		}

		if($data['fl_nofak']){
			$this->db->where('trx.tp_nofak', $data['fl_nofak']);
		}

		if($data['fl_tanggal']){
			[$start, $end] = explode(' - ', $data['fl_tanggal']);
			$where['trx.tp_tanggal >='] = date('Y-m-d', strtotime($start));
			$where['trx.tp_tanggal <='] = date('Y-m-d', strtotime($end));
			$this->db->where($where);
		}

		$this->db->where('trx.tp_keterangan !=', "SMP");
		$this->db->where('trx.tp_status', '0');

		$this->db->group_by('trx.tp_unit');
		$this->db->group_by('trx.tp_nofak');

		$this->db->order_by('trx.tp_tanggal', 'desc');
		$this->db->order_by('trx.tp_nofak', 'asc');
		return $this->db->get()->result_array();
	}
	

}

/* End of file Model_report.php */
/* Location: ./application/models/Model_report.php */