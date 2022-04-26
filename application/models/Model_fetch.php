<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_fetch extends CI_Model {

	public function __construct(){
		parent::__construct();
		
	}

	private function initDatabase($res_db, $pwd){

		$config['hostname'] = $res_db[FIELD_PLANT_HOSTNAME];
		$config['username'] = $res_db[FIELD_PLANT_HOST_USERNAME];
		$config['password'] = $pwd;
		$config['database'] = $res_db[FIELD_PLANT_HOST_DB];
		$config['dbdriver'] = $this->db->dbdriver;
		$config['dbprefix'] = $this->db->dbprefix;
		$config['pconnect'] = $this->db->pconnect;
		$config['db_debug'] = $this->db->db_debug;
		$config['cache_on'] = $this->db->cache_on;
		$config['cachedir'] = $this->db->cachedir;
		$config['char_set'] = $this->db->char_set;
		$config['dbcollat'] = $this->db->dbcollat;
		$config['cache_on'] = $this->db->cache_on;
		$config['cachedir'] = $this->db->cachedir;
		$config['char_set'] = $this->db->char_set;
		$config['dbcollat'] = $this->db->dbcollat;
		$config['swap_pre'] = $this->db->swap_pre;
		$config['encrypt'] = $this->db->encrypt;
		$config['compress'] = $this->db->compress;
		$config['stricton'] = $this->db->stricton;
		$config['save_queries'] = $this->db->save_queries;

		return $this->load->database($config, TRUE);
	}

	public function selectTransaction($identifier, $where = NULL){

		$this->db->trans_start();

		$this->db->select(array(
			FIELD_PLANT_HOSTNAME,
			FIELD_PLANT_HOST_USERNAME,
			FIELD_PLANT_HOST_PWD,
			FIELD_PLANT_HOST_DB,
			FIELD_PLANT_LABEL,
			FIELD_PLANT_ID
		));
		$this->db->where(FIELD_PLANT_LABEL, $identifier);
		$res_db = $this->db->get(TABLE_PLANT,1)->row_array();

		if(!$res_db){
			return FALSE;
		}

		$pwd = "";
		if($res_db !== NULL){
			$this->load->library('encryption');
			$this->encryption->initialize(
		        array(
	                'cipher' => 'aes-256',
	                'mode' => 'ctr',
		        )
			);


			$pwd = $this->encryption->decrypt($res_db[FIELD_PLANT_HOST_PWD]);
		}

		$lastTrxDate = $this->selectLastTrxDate($res_db[FIELD_PLANT_ID]);


		$db2 = $this->initDatabase($res_db, $pwd);


		$db2->select(array(
			'"'.$res_db[FIELD_PLANT_LABEL].'" AS source_unit',
			'a.*',
			'b.mitra_name',
			'c.customer_code',
			'c.customer_nama AS customer_name',
			'CONCAT(d.bank_name, "_", TRIM(d.bank_account_name), "_", d.bank_account_number) AS jm_bank_detail'
		));
		$db2->from('tbl_jual_mitra a');
		$db2->join('tbl_mitra b','b.mitra_id = a.jm_mitra','left');
		$db2->join('tbl_customer c','c.customer_id = a.jm_customer','left');
		$db2->join('tbl_bank d','d.bank_id = a.jm_bank_tujuan','left');
		
		if($lastTrxDate['tanggal_trx'] !== NULL){
			$db2->where(array(
				'jm_tanggal >' => $lastTrxDate['tanggal_trx']
			));

		}
		
		$res = $db2->get();

		if($res->num_rows() > 0){

			$data = $res->result_array();

			$transaction = array();
			foreach ($data as $value) {
				
				$source = array(

					'tp_unit'						=> $res_db[FIELD_PLANT_ID],
					'tp_nofak'						=> $value['jm_nofak'],
					'tp_rtype'						=> 'M',
					'tp_mitra'						=> $value['jm_mitra'],
					'tp_mitra_name'					=> $value['mitra_name'],
					'tp_tanggal'					=> $value['jm_tanggal'],
					'tp_diskon'						=> $value['jm_diskon'],
					'tp_pajak'						=> $value['jm_pajak'],
					'tp_ongkir'						=> $value['jm_ongkir'],
					'tp_subtotal'					=> $value['jm_subtotal'],
					'tp_total'						=> $value['jm_total'],
					'tp_jml_uang'					=> $value['jm_jml_uang'],
					'tp_kembalian'					=> $value['jm_kembalian'],
					'tp_metode_pembayaran'			=> $value['jm_metode_pembayaran'],
					'tp_currency'					=> $value['jm_currency'],
					'tp_customer'					=> $value['jm_customer'],
					'tp_customer_code'				=> $value['customer_code'],
					'tp_customer_name'				=> $value['customer_name'],
					'tp_bank_tujuan'				=> $value['jm_bank_tujuan'],
					'tp_bank_detail'				=> $value['jm_bank_detail'],
					'tp_status'						=> $value['jm_status'],
					'tp_status_pembayaran'			=> $value['jm_status_pembayaran'],
					'tp_non_type'					=> $value['jm_non_type'],
					'tp_tanggal_pembayaran'			=> $value['jm_tanggal_pembayaran'],
					'tp_bukti_pembayaran'			=> $value['jm_bukti_pembayaran'],
					'tp_bukti_pembayaran_full_path'	=> $value['jm_bukti_pembayaran_full_path'],
					'tp_user_acc_pembayaran'		=> $value['jm_user_acc_pembayaran'],
					'tp_datetime_acc_pembayaran'	=> $value['jm_datetime_acc_pembayaran'],
					'tp_keterangan'					=> $value['jm_keterangan'],
					'tp_notes'						=> $value['jm_notes'],
				);
				array_push($transaction, $source);

			}

			$ins = $this->db->insert_batch('trx_penjualan', $transaction);

		}

		$db2->select(array(
			'"'.$res_db[FIELD_PLANT_LABEL].'" AS source_unit',
			'a.*',
			'b.mitra_name',
		));
		$db2->from('tbl_detail_jual_mitra a');
		$db2->join('tbl_jual_mitra a2','a2.jm_nofak = a.dm_jual_nofak','left');
		$db2->join('tbl_mitra b','b.mitra_id = a.dm_mitra','left');
		
		if($lastTrxDate['tanggal_trx'] !== NULL){
			$db2->where(array(
				'a2.jm_tanggal >' => $lastTrxDate['tanggal_trx']
			));
		}
		
		$res = $db2->get();

		if($res->num_rows() > 0){
			

			$data = $res->result_array();

			$transaction_det = array();
			foreach ($data as $key => $value) {

				$source = array(
					'dp_unit'					=> $res_db[FIELD_PLANT_ID],
					'dp_nofak'					=> $value['dm_jual_nofak'],
					'dp_seq'					=> $value['dm_seq'],
					'dp_mitra'					=> $value['dm_mitra'],
					'dp_mitra_name'				=> $value['mitra_name'],
					'dp_barang_id'				=> $value['dm_jual_barang_id'],
					'dp_barang_nama'			=> $value['dm_jual_barang_nama'],
					'dp_barang_satuan'			=> $value['dm_jual_barang_satuan'],
					'dp_barang_harpok'			=> $value['dm_jual_barang_harpok'],
					'dp_barang_harjul'			=> $value['dm_jual_barang_harjul'],
					'dp_qty'					=> $value['dm_jual_qty'],
					'dp_diskon'					=> $value['dm_jual_diskon'],
					'dp_diskon_persen'			=> $value['dm_jual_diskon_persen'],
					'dp_tax'					=> $value['dm_tax'],
					'dp_tax_persen'				=> $value['dm_tax_persen'],
					'dp_subtotal'				=> $value['dm_jual_subtotal'],
					'dp_total'					=> $value['dm_jual_total'],
					'dp_barang_mitra_id'		=> $value['dm_barang_mitra_id'],				
				);
				
				array_push($transaction_det, $source);

			}

			$ins_det = $this->db->insert_batch('trx_penjualan_detail', $transaction_det);

		}


		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){
			return FALSE;
		}

		return TRUE;
	}

	public function selectTransactionStokis($identifier, $where = NULL){

		$this->db->trans_start();

		$this->db->select(array(
			FIELD_PLANT_HOSTNAME,
			FIELD_PLANT_HOST_USERNAME,
			FIELD_PLANT_HOST_PWD,
			FIELD_PLANT_HOST_DB,
			FIELD_PLANT_LABEL,
			FIELD_PLANT_ID
		));
		$this->db->where(FIELD_PLANT_LABEL, $identifier);
		$res_db = $this->db->get(TABLE_PLANT,1)->row_array();

		if(!$res_db){
			return FALSE;
		}

		$pwd = "";
		if($res_db !== NULL){
			$this->load->library('encryption');
			$this->encryption->initialize(
		        array(
	                'cipher' => 'aes-256',
	                'mode' => 'ctr',
		        )
			);


			$pwd = $this->encryption->decrypt($res_db[FIELD_PLANT_HOST_PWD]);
		}

		$lastTrxDate = $this->selectLastTrxDate($res_db[FIELD_PLANT_ID]);


		$db2 = $this->initDatabase($res_db, $pwd);

		$db2->select(array(
			'"'.$res_db[FIELD_PLANT_LABEL].'" AS source_unit',
			'a.*',
			'c.customer_code',
			'c.customer_nama AS customer_name',
			'CONCAT(d.bank_name, "_", TRIM(d.bank_account_name), "_", d.bank_account_number) AS jual_bank_detail'
		));
		$db2->from('tbl_jual a');
		$db2->join('tbl_customer c','c.customer_id = a.jual_customer','left');
		$db2->join('tbl_bank d','d.bank_id = a.jual_bank_tujuan','left');
		
		if($lastTrxDate['tanggal_trx'] !== NULL){
			$db2->where(array(
				'jual_tanggal >' => $lastTrxDate['tanggal_trx']
			));

		}
		
		$res = $db2->get();

		if($res->num_rows() > 0){

			$data = $res->result_array();

			$transaction = array();
			foreach ($data as $value) {
				
				$source = array(

					'tp_unit'						=> $res_db[FIELD_PLANT_ID],
					'tp_nofak'						=> $value['jual_nofak'],
					'tp_rtype'						=> 'M',
					'tp_mitra'						=> "0",
					'tp_mitra_name'					=> "Stokis",
					'tp_tanggal'					=> $value['jual_tanggal'],
					'tp_diskon'						=> $value['jual_diskon'],
					'tp_pajak'						=> $value['jual_pajak'],
					'tp_ongkir'						=> $value['jual_ongkir'],
					'tp_subtotal'					=> $value['jual_subtotal'],
					'tp_total'						=> $value['jual_total'],
					'tp_jml_uang'					=> $value['jual_jml_uang'],
					'tp_kembalian'					=> $value['jual_kembalian'],
					'tp_metode_pembayaran'			=> $value['metode_pembayaran'],
					'tp_currency'					=> $value['currency'],
					'tp_customer'					=> $value['jual_customer'],
					'tp_customer_code'				=> $value['customer_code'],
					'tp_customer_name'				=> $value['customer_name'],
					'tp_bank_tujuan'				=> $value['jual_bank_tujuan'],
					'tp_bank_detail'				=> $value['jual_bank_detail'],
					'tp_status'						=> $value['jual_status'],
					'tp_status_pembayaran'			=> $value['jual_status_pembayaran'],
					'tp_non_type'					=> $value['jual_non_type'],
					'tp_tanggal_pembayaran'			=> $value['tanggal_pembayaran'],
					'tp_bukti_pembayaran'			=> $value['bukti_pembayaran'],
					'tp_bukti_pembayaran_full_path'	=> $value['bukti_pembayaran_full_path'],
					'tp_user_acc_pembayaran'		=> $value['user_acc_pembayaran'],
					'tp_datetime_acc_pembayaran'	=> $value['datetime_acc_pembayaran'],
					'tp_keterangan'					=> $value['jual_keterangan'],
					'tp_notes'						=> $value['jual_notes'],
				);
				array_push($transaction, $source);

			}

			$ins = $this->db->insert_batch('trx_penjualan', $transaction);

		}


		$db2->select(array(
			'"'.$res_db[FIELD_PLANT_LABEL].'" AS source_unit',
			'a.*',
		));
		$db2->from('tbl_detail_jual a');
		$db2->join('tbl_jual a2','a2.jual_nofak = a.d_jual_nofak','left');
		
		if($lastTrxDate['tanggal_trx'] !== NULL){
			$db2->where(array(
				'a2.jual_tanggal >' => $lastTrxDate['tanggal_trx']
			));
		}
		
		$res = $db2->get();

		if($res->num_rows() > 0){
			

			$data = $res->result_array();

			$transaction_det = array();
			$seq = 1;
			$last_nofak = "";
			foreach ($data as $key => $value) {

				if($value['d_jual_nofak'] !== $last_nofak){
					$seq = 1;
					$last_nofak = $value['d_jual_nofak'];
				}else{
					$seq++;
				}

				$source = array(
					'dp_unit'					=> $res_db[FIELD_PLANT_ID],
					'dp_nofak'					=> $value['d_jual_nofak'],
					'dp_seq'					=> $seq,
					'dp_mitra'					=> "0",
					'dp_mitra_name'				=> "Stokis",
					'dp_barang_id'				=> $value['d_jual_barang_id'],
					'dp_barang_nama'			=> $value['d_jual_barang_nama'],
					'dp_barang_satuan'			=> $value['d_jual_barang_satuan'],
					'dp_barang_harpok'			=> $value['d_jual_barang_harpok'],
					'dp_barang_harjul'			=> $value['d_jual_barang_harjul'],
					'dp_qty'					=> $value['d_jual_qty'],
					'dp_diskon'					=> $value['d_jual_diskon'],
					'dp_diskon_persen'			=> $value['d_jual_diskon_persen'],
					'dp_tax'					=> 0,
					'dp_tax_persen'				=> 0,
					'dp_subtotal'				=> $value['d_jual_subtotal'],
					'dp_total'					=> $value['d_jual_total'],
					'dp_barang_mitra_id'		=> NULL,				
				);
				
				array_push($transaction_det, $source);

			}

			$ins_det = $this->db->insert_batch('trx_penjualan_detail', $transaction_det);

		}


		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){
			return FALSE;
		}

		return TRUE;

	}
	
	private function selectLastTrxDate($unit){

		$this->db->select(array(
			'MAX(tp_tanggal) AS tanggal_trx'
		));
		$this->db->from('trx_penjualan');
		$this->db->limit(1);
		return $this->db->get()->row_array();

	}

}

/* End of file Model_fetch.php */
/* Location: ./application/models/Model_fetch.php */