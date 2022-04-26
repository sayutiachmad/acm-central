<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fetch extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_fetch');
	}

	public function transaction($identifier = NULL){

		if($this->input->is_cli_request()){

			$chk_ident = $this->checkIdentifier($identifier);

			if($chk_ident){
				$this->getTransaction($identifier);
			}else{
				exit("Unrecognized request : ".$identifier);
			}


		}else{
			exit("Request Not Allowed");
		}

	}

	private function getTransaction($identifier){

		$res = $this->model_fetch->selectTransaction($identifier);
		$res = $this->model_fetch->selectTransactionStokis($identifier);

		return $res;

	}

	private function checkIdentifier($identifier){

		$res = $this->gm_->get_single_data(TABLE_PLANT, array(FIELD_PLANT_ID), array(FIELD_PLANT_LABEL => strtoupper($identifier)));

		if($res == NULL){
			return FALSE;
		}

		return TRUE;

	}

}

/* End of file Fetch.php */
/* Location: ./application/controllers/Fetch.php */