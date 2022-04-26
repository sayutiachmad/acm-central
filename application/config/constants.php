<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


/* Custom constant for table and field name*/


define('SESSION_USER','wmu_storage_auth');
define('SESSION_USER_ID','wmu_storage_id');
define('SESSION_USER_NAME','wmu_storage_username');
define('SESSION_USER_FULLNAME','wmu_storage_fullname');
define('SESSION_USER_ROLE','wmu_storage_role');
define('SESSION_USER_ROLE_NAME','wmu_storage_role_name');
define('SESSION_USER_PROFILE_PICTURE','wmu_storage_foto');

//table user
define('TABLE_USER','wmu_user');
define('F_USER_ID','id_user');
define('F_USER_FULLNAME','user_fullname');
define('F_USER_USERNAME','username');
define('F_USER_PASSWORD','password');
define('F_USER_TYPE','id_user_type');
define('F_USER_EMPLOYE','no_employe');
define('F_USER_COMPANY', 'id_company');
define('F_USER_UNIT', 'id_unit');
define('F_USER_DEPARTMENT','id_department');
define('F_USER_IMAGE','image');
define('F_USER_STATUS','status');

/*define untuk table user type*/
define('TABLE_USER_TYPE','wmu_user_type');
define('F_USER_TYPE_ID','id_user_type');
define('F_USER_TYPE_NAME','type_name');

/*define untuk table navigation*/
define('TABLE_NAVIGATION','wmu_navigation');
define('F_NAVIGATION_ID','id_navigation');
define('F_NAVIGATION_NAME','navigation_name');
define('F_NAVIGATION_LINK','link');
define('F_NAVIGATION_ICON','icon');
define('F_NAVIGATION_PARENT','parent');
define('F_NAVIGATION_ORDER','order_position');

/*define untuk table navigation permission*/
define('TABLE_NAV_PERMISSION','wmu_navigation_permission');
define('F_NAV_PERMISSION_ID','id_permission');
define('F_NAV_PERMISSION_NAVIGATION','id_navigation');
define('F_NAV_PERMISSION_ROLE','id_user_type');

/*define untuk table user permission*/
define('TABLE_USER_PERMISSION','hc_user_permission');
define('F_UP_ID','up_id');
define('F_UP_USER','id_user');
define('F_UP_NAME','navigation_name');
define('F_UP_LINK','navigation_link');
define('F_UP_PERMISSION','permission');

/*define untuk table page*/
define('TABLE_PAGE','wmu_page');
define('F_PAGE_ID','id_page');
define('F_PAGE_NAME','page_name');
define('F_PAGE_URL','page_url');

/*define untuk table page permission*/
define('TABLE_PAGE_PERMISSION','wmu_page_permission');
define('F_PAGE_PERMISSION_ID','id_permission');
define('F_PAGE_PERMISSION_PAGE','id_page');
define('F_PAGE_PERMISSION_ROLE','id_role');

define('TABLE_USER_NAVIGATION','wmu_user_navigation');
define('F_USER_NAV_ID','id_permission');
define('F_USER_NAV_NAVIGATION','id_navigation');
define('F_USER_NAV_USER','id_user');


define('TABLE_VENDOR_ADDRESS','vendor_address');
define('FIELD_VA_ID','address_id');
define('FIELD_VA_VENDOR','vendor_id');
define('FIELD_VA_DESCRIPTION','address_description');
define('FIELD_VA_ADDRESS','full_address');
define('FIELD_VA_CITY','city');
define('FIELD_VA_PHONE','phone');
define('FIELD_VA_FAX','fax');
define('FIELD_VA_ZIP_CODE','zip_code');
define('FIELD_VA_SEND_ADDRESS','send_address');
define('FIELD_VA_BILLING_ADDRESS','billing_address');

define('TABLE_VENDOR_CONTACT','vendor_contact');
define('FIELD_VC_ID','contact_id');
define('FIELD_VC_VENDOR','vendor_id');
define('FIELD_VC_NAME','contact_name');
define('FIELD_VC_POSITION','contact_position');
define('FIELD_VC_PHONE','contact_phone');
define('FIELD_VC_EMAIL','contact_email');

// table code

define('TABLE_CODE', 'code');
define('FIELD_CODE_ID', 'id_code');
define('FIELD_CODE_HEAD', 'head_code');
define('FIELD_CODE', 'code');
define('FIELD_CODE_NAME', 'name_code');

/*define untuk table master common code*/
define('TABLE_COMMON_CODE', 'common_code');
define('FIELD_COMMON_CODE_HEAD', 'code');
define('FIELD_COMMON_CODE_PARENT', 'parent_code');
define('FIELD_COMMON_CODE_NAME', 'code_name');
define('FIELD_COMMON_CODE_DESCRIPTION_1', 'description1');
define('FIELD_COMMON_CODE_DESCRIPTION_2', 'description2');
define('FIELD_COMMON_CODE_DESCRIPTION_3', 'description3');
define('FIELD_COMMON_CODE_AMOUNT_1', 'amt1');
define('FIELD_COMMON_CODE_AMOUNT_2', 'amt2');
define('FIELD_COMMON_CODE_AMOUNT_3', 'amt3');
define('FIELD_COMMON_CODE_SORT', 'sort');
define('FIELD_COMMON_CODE_STATUS', 'status');

//table log transaction
define('TABLE_LOG_TRANSACTION', 'log_transaction');
define('FIELD_LOG_TRANS_ID','log_id');
define('FIELD_LOG_TRANS_CATEGORY','transaction_category');
define('FIELD_LOG_TRANS_TYPE','transaction_type');
define('FIELD_LOG_TRANS_REF','ref_no');
define('FIELD_LOG_TRANS_BATCH_REF','batch_ref');
define('FIELD_LOG_TRANS_ITEM','item_code');
define('FIELD_LOG_TRANS_QTY_PCS','qty_pcs');
define('FIELD_LOG_TRANS_QTY_KG','qty_kg');
define('FIELD_LOG_TRANS_QTY_PCS_OLD','old_qty_pcs');
define('FIELD_LOG_TRANS_QTY_KG_OLD','old_qty_kg');
define('FIELD_LOG_TRANS_QTY_PCS_NEW','new_qty_pcs');
define('FIELD_LOG_TRANS_QTY_KG_NEW','new_qty_kg');

//table log action
define('TABLE_LOG_ACTIVITY', 'log_activity');
define('FIELD_LOG_ACTIVITY_ID','log_id');
define('FIELD_LOG_ACTIVITY_TYPE','activity_type');
define('FIELD_LOG_ACTIVITY_CATEGORY','activity_category');
define('FIELD_LOG_ACTIVITY_REF','ref_no');
define('FIELD_LOG_ACTIVITY_DESC','description');


//log transaction category
define('LOG_TRANS_CAT_IN','IN');
define('LOG_TRANS_CAT_OUT','OUT');
define('LOG_TRANS_CAT_ADJUST','ADJ');
define('LOG_TRANS_CAT_SYS_ADJUST','SDJ');
define('LOG_TRANS_CAT_APPROVAL','APR');

// log transaction type
define('LOG_TRANS_TYPE_RECEIVE_NEW','RN');
define('LOG_TRANS_TYPE_RECEIVE_EDIT','RE');
define('LOG_TRANS_TYPE_STOCK_BATCH_ADJUST','SA');
define('LOG_TRANS_TYPE_DO_NEW','DN');
define('LOG_TRANS_TYPE_DO_UPATE','DU');
define('LOG_TRANS_TYPE_DO_DELETE','DD');
define('LOG_TRANS_TYPE_RETUR','RT');
define('LOG_TRANS_TYPE_MUTASI_OUT','MO');
define('LOG_TRANS_TYPE_MUTASI_IN','MI');
define('LOG_TRANS_TYPE_CHECKER_APPROVAL','CA');
define('LOG_TRANS_TYPE_CHECKER_REJECTTION','CR');

// log action category 
define('LOG_ACT_CAT_NEW','NEW');
define('LOG_ACT_CAT_EDIT','MOD');
define('LOG_ACT_CAT_DELETE','DEL');
define('LOG_ACT_CAT_APPROVAL','APV');
define('LOG_ACT_CAT_RESTORE','RES');
define('LOG_ACT_CAT_GENERATE','GEN');
define('LOG_ACT_CAT_PREVIEW','PRE');

// log action type
define('LOG_ACT_TYPE_PO','PO');
define('LOG_ACT_TYPE_DO','DO');
define('LOG_ACT_TYPE_SJ','SJ');
define('LOG_ACT_TYPE_SC','SC');
define('LOG_ACT_TYPE_INVOICE','INV');
define('LOG_ACT_TYPE_MASTER','MTR');
define('LOG_ACT_TYPE_MUTASI','MTS');
define('LOG_ACT_TYPE_OPNAME','OPN');
define('LOG_ACT_TYPE_BEGINING','BEG');

// table plant

define('TABLE_PLANT', 'plant');
define('FIELD_PLANT_PK', 'id_plant');
define('FIELD_PLANT_PERUSAHAAN', 'PPerusahaan_ID');
define('FIELD_PLANT_ID', 'Plant_ID');
define('FIELD_PLANT_NAME', 'Plant_Name');
define('FIELD_PLANT_ALAMAT_1', 'Address1');
define('FIELD_PLANT_ALAMAT_2', 'Address2');
define('FIELD_PLANT_LABEL','Label');
define('FIELD_PLANT_PHONE','Phone');
define('FIELD_PLANT_SEQUENCE','Plant_Seq');
define('FIELD_PLANT_HOSTNAME','data_hostname');
define('FIELD_PLANT_HOST_USERNAME','data_username');
define('FIELD_PLANT_HOST_PWD','data_pwd');
define('FIELD_PLANT_HOST_DB','data_db');

// table perusahaan

define('TABLE_PERUSAHAAN', 'company');
define('FIELD_PERUSAHAAN_ID','Perusahaan_ID');
define('FIELD_PERUSAHAAN_NAME','Perusahaan_Name');


// purchase order term of payment
define('PO_TOP_COD','COD');
define('PO_TOP_CBD','CBD');
define('PO_TOP_14DAYS','14D');

// delivery order goods type
define('DO_GOODS_TYPE_FROZEN','FRZ');
define('DO_GOODS_TYPE_FRESH','FRS');
define('DO_GOODS_TYPE_RETAIL','RET');

//global field
define('FIELD_CREATE_DATE','create_date');
define('FIELD_UPDATE_DATE','update_date');

/*define common field*/
define('FIELD_DELETE_FLAG','delete_flag');
define('FIELD_DELETE_USER','delete_user');
define('FIELD_DELETE_DATETIME','delete_datetime');
define('FIELD_CREATE_USER','create_user');
define('FIELD_CREATE_DATETIME','create_datetime');
define('FIELD_UPDATE_USER','update_user');
define('FIELD_UPDATE_DATETIME','update_datetime');

/*define common string*/
define('DATA_EXIST','exist');
define('ERROR_INSERT','ins_err');
define('ERROR_UPDATE','upd_err');
define('NO_DIRECT_ACCESS','No Direct Access Allowed');
define('DELETE_SUCCESS','Berhasil menghapus data!');
define('DELETE_FAIL','Gagal menghapus data!');
define('DATA_PRINTED','printed');
define('DATA_ALL','all');
define('LEGAL_CODE_WMU','WMU');
define('BUTTON_LINK','button_link');
define('BUTTON_TEXT','button_text');
define('ERROR_GENERAL_TITLE','egt');
define('ERROR_GENERAL_CONTENT','egc');
define('DEFAULT_ERROR_GENERAL_MESSAGE','Halaman atau data yang anda cari tidak ditemukan');

define('FIELD_CHECKER_APPROVAL', 'checker_approval');
define('FIELD_CHECKER_APPROVAL_BY','checker_approval_by');
define('FIELD_CHECKER_APPROVAL_AT','checker_approval_at');

define('UNDELETED','deleted IS NULL');
define('DELETED','deleted IS NOT NULL');
define('BLANK_PROFILE_PICTURE','blank_pic.png');