<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_dashboard_chart extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function select_sell_unit_chart_data($data){


		$this->db->select(array(
			'DATE_FORMAT(trx.tp_tanggal, "%b %Y") AS bulan_penjualan',
		    'SUM(IF(trx.tp_status = 0, (trxd.dp_barang_harjul*trxd.dp_qty), 0)) AS total_jual_harjul',
		    'SUM(IF(trx.tp_status = 0, ( ((trxd.dp_barang_harjul-trxd.dp_barang_harpok)*trxd.dp_qty)-trxd.dp_diskon ), 0)) AS total_jual_margin',
			'un.'.FIELD_PLANT_NAME.' AS unit_name',
			'trx.tp_unit'
		));
		$this->db->from('trx_penjualan_detail trxd');
		$this->db->join('trx_penjualan trx', 'trx.tp_unit = trxd.dp_unit AND trx.tp_nofak = trxd.dp_nofak', 'left');
		$this->db->join(TABLE_PLANT.' un', 'un.'.FIELD_PLANT_ID.' = trx.tp_unit', 'left');


		if($data['fl_tanggal']){
			$start = date('Y-m-01', strtotime($data['fl_tanggal']));
			$end = date('Y-m-t', strtotime($data['fl_tanggal']));
			$where['trx.tp_tanggal >='] = $start;
			$where['trx.tp_tanggal <='] = $end;
			$this->db->where($where);
		}

		$this->db->where('trx.tp_keterangan !=', "SMP");
		$this->db->where('trx.tp_status', '0');

		$this->db->group_by('trx.tp_unit');
		$this->db->group_by('YEAR(trx.tp_tanggal)');
		$this->db->group_by('MONTH(trx.tp_tanggal)');


		$this->db->order_by('YEAR(trx.tp_tanggal)', 'desc');
		$this->db->order_by('MONTH(trx.tp_tanggal)', 'desc');
		return $this->db->get()->result_array();

	}

	public function select_sell_unit_daily_chart_data($data){


		$this->db->select(array(
			'SUM( (trxd.dp_barang_harpok * trxd.dp_qty) ) AS total_harpok',
			'SUM( (trxd.dp_barang_harjul * trxd.dp_qty) ) AS total_harjul',
			'SUM(trxd.dp_diskon) AS total_diskon',
			'SUM(trxd.dp_total) AS total_jual',
			'trx.*',
			'DATE_FORMAT(trx.tp_tanggal, "%d-%b-%Y") AS tanggal_transaksi',
			'un.'.FIELD_PLANT_NAME.' AS unit_name'
		));
		$this->db->from('trx_penjualan_detail trxd');
		$this->db->join('trx_penjualan trx', 'trx.tp_unit = trxd.dp_unit AND trx.tp_nofak = trxd.dp_nofak', 'left');
		$this->db->join(TABLE_PLANT.' un', 'un.'.FIELD_PLANT_ID.' = trx.tp_unit', 'left');

		if($data['fl_tanggal']){
			[$start, $end] = explode(' - ', $data['fl_tanggal']);
			$where['trx.tp_tanggal >='] = date('Y-m-d', strtotime($start));
			$where['trx.tp_tanggal <='] = date('Y-m-d', strtotime($end));
			$this->db->where($where);
		}

		$this->db->where('trx.tp_keterangan !=', "SMP");
		$this->db->where('trx.tp_status', '0');

		$this->db->group_by('trx.tp_unit');
		$this->db->group_by('DATE(trx.tp_tanggal)');

		$this->db->order_by('DATE(trx.tp_tanggal)', 'desc');
		$this->db->order_by('trx.tp_unit', 'asc');
		return $this->db->get()->result_array();

	}


}

/* End of file Model_dashboard_chart.php */
/* Location: ./application/models/Model_dashboard_chart.php */