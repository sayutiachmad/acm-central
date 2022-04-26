<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity
{
	protected $CI;
    protected $actionPerformed = null;
    
    // object can be the name of the page or the name of the table.
    protected $object = '';
    
    // object id must store the id of the table if user perform some things that involved database manipulation
    // otherwise, leave it null
    protected $object_id = null;
    
	private $_auth = true;
    private $_sess = '';

	public function __construct()
	{
        $this->CI =& get_instance();
        $this->sess = $this->CI->session->userdata(SESSION_USER);
        $this->_auth = (!empty($this->sess) ? true : false);
        $this->CI->load->model('Model_activity', 'act');
        $this->act = $this->CI->act;


	}
    
    //setter
    
    public function log_transaction($trans_cat, $trans_type, $ref_number, $batch_ref, $item, $qty_pcs, $qty_kg, $old_qty_pcs, $old_qty_kg, $sys_adj = FALSE) {
        
        $data = array(
            FIELD_LOG_TRANS_CATEGORY        => (!$sys_adj ? $trans_cat : $trans_cat."S"),
            FIELD_LOG_TRANS_TYPE            => $trans_type,
            FIELD_LOG_TRANS_REF             => $ref_number,
            FIELD_LOG_TRANS_BATCH_REF       => $batch_ref,
            FIELD_LOG_TRANS_ITEM            => $item,
            FIELD_LOG_TRANS_QTY_PCS         => remove_comma($qty_pcs),
            FIELD_LOG_TRANS_QTY_KG          => remove_comma($qty_kg),
            FIELD_LOG_TRANS_QTY_PCS_OLD     => remove_comma($old_qty_pcs),
            FIELD_LOG_TRANS_QTY_KG_OLD      => remove_comma($old_qty_kg),
            FIELD_CREATE_USER               => $this->sess[SESSION_USER_ID],
        );

        if($trans_cat == LOG_TRANS_CAT_IN){
            $data[FIELD_LOG_TRANS_QTY_PCS_NEW] = (remove_comma($old_qty_pcs) + remove_comma($qty_pcs));
            $data[FIELD_LOG_TRANS_QTY_KG_NEW] = (remove_comma($old_qty_kg) + remove_comma($qty_kg));
        }else if($trans_cat == LOG_TRANS_CAT_OUT){
            $data[FIELD_LOG_TRANS_QTY_PCS_NEW] = (remove_comma($old_qty_pcs) - remove_comma($qty_pcs));
            $data[FIELD_LOG_TRANS_QTY_KG_NEW] = (remove_comma($old_qty_kg) - remove_comma($qty_kg));
        }else if($trans_cat == LOG_TRANS_CAT_ADJUST){
            $data[FIELD_LOG_TRANS_QTY_PCS_NEW] = remove_comma($qty_pcs);
            $data[FIELD_LOG_TRANS_QTY_KG_NEW] = remove_comma($qty_kg);
        }else{
            $data[FIELD_LOG_TRANS_QTY_PCS_NEW] = remove_comma($qty_pcs);
            $data[FIELD_LOG_TRANS_QTY_KG_NEW] = remove_comma($qty_kg);
        }

        $this->act->store($data);

    }

    public function log_activity($act_cat, $act_type, $ref_number, $desc = NULL){

        $data = array(
            FIELD_LOG_ACTIVITY_CATEGORY   => $act_cat,
            FIELD_LOG_ACTIVITY_TYPE       => $act_type,
            FIELD_LOG_ACTIVITY_REF        => $ref_number,
            FIELD_LOG_ACTIVITY_DESC       => $desc,
            'create_by'                 => $this->sess[SESSION_USER_ID],
        );

        return $this->act->store_log_action($data);
    }

}

/* End of file Activity.php */
/* Location: ./application/libraries/Activity.php */
