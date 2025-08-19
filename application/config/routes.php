<?php

defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'dashboard/c_dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'userlogin/c_userlogin';
$route['auth'] = 'userlogin/c_userlogin/auth';
$route['logout'] = 'userlogin/c_userlogin/logout';
$route['dashboard'] = 'dashboard/c_dashboard';

$route['data_in_pjt'] = 'data_in_pjt/c_data_in_pjt';
$route['data_in_pjt/fetch_table'] = 'data_in_pjt/c_data_in_pjt/c_fetch_table';
$route['data_in_pjt/upload_in_container'] = 'data_in_pjt/c_data_in_pjt/c_upload_in_container';
$route['data_in_pjt/proses_upload_incontainer'] = 'data_in_pjt/c_data_in_pjt/c_proses_upload_incontainer';
$route['data_in_pjt/simpan_incontainer_temporary'] = 'data_in_pjt/c_data_in_pjt/c_simpan_incontainer_temporary';
$route['data_in_pjt/simpan_incontainer'] = 'data_in_pjt/c_data_in_pjt/c_simpan_incontainer';
$route['data_in_pjt/detailincontainer'] = 'data_in_pjt/c_data_in_pjt/c_detailincontainer';
$route['data_in_pjt/fetch_table_detail'] = 'data_in_pjt/c_data_in_pjt/c_fetch_table_detail';

$route['upload_out_pjt'] = 'upload_out_pjt/c_upload_out_pjt';
$route['upload_out_pjt/fetch_table'] = 'upload_out_pjt/c_upload_out_pjt/c_fetch_table';
$route['upload_out_pjt/upload_out_container'] = 'upload_out_pjt/c_upload_out_pjt/c_upload_out_container';
$route['upload_out_pjt/proses_upload_outcontainer'] = 'upload_out_pjt/c_upload_out_pjt/c_proses_upload_outcontainer';
$route['upload_out_pjt/simpan_outcontainer_temporary'] = 'upload_out_pjt/c_upload_out_pjt/c_simpan_outcontainer_temporary';
$route['upload_out_pjt/simpan_outcontainer'] = 'upload_out_pjt/c_upload_out_pjt/c_simpan_outcontainer';
$route['upload_out_pjt/detailoutcontainer'] = 'upload_out_pjt/c_upload_out_pjt/c_detailoutcontainer';
$route['upload_out_pjt/fetch_table_detail'] = 'upload_out_pjt/c_upload_out_pjt/c_fetch_table_detail';
$route['upload_out_pjt/out_boxmarking'] = 'upload_out_pjt/c_upload_out_pjt/c_out_boxmarking';

$route['check_out_pjt'] = 'check_out_pjt/c_check_out_pjt';
$route['check_out_pjt/createcheck'] = 'check_out_pjt/c_check_out_pjt/c_createcheck';
$route['check_out_pjt/fetch_h_table'] = 'check_out_pjt/c_check_out_pjt/c_fetch_h_table';
$route['check_out_pjt/savecn'] = 'check_out_pjt/c_check_out_pjt/c_savecn';
$route['check_out_pjt/fetch_table'] = 'check_out_pjt/c_check_out_pjt/c_fetch_table';


$route['data_out_pjt'] = 'data_out_pjt/c_data_out_pjt';
$route['data_out_pjt/fetch_table'] = 'data_out_pjt/c_data_out_pjt/c_fetch_table';
$route['data_out_pjt/detailoutcontainer'] = 'data_out_pjt/c_data_out_pjt/c_detailoutcontainer';
$route['data_out_pjt/fetch_table_detail'] = 'data_out_pjt/c_data_out_pjt/c_fetch_table_detail';


$route['report_pjt'] = 'report_pjt/c_report_pjt';
$route['report_pjt/fetch_table_thead'] = 'report_pjt/c_report_pjt/c_fetch_table_thead';
$route['report_pjt/fetch_table'] = 'report_pjt/c_report_pjt/c_fetch_table';
$route['report_pjt/exportxls'] = 'report_pjt/c_report_pjt/c_exportxls';

$route['report_validasi'] = 'report_validasi/c_report_validasi';
$route['report_validasi/fetch_table'] = 'report_validasi/c_report_validasi/c_fetch_table';
$route['report_validasi/exportxls'] = 'report_validasi/c_report_validasi/c_exportxls';


// $route['data_manifest'] = 'data_manifest/c_data_manifest';
// $route['data_manifest/fetch_table'] = 'data_manifest/c_data_manifest/c_fetch_table';
// $route['data_manifest/upload_manifest'] = 'data_manifest/c_data_manifest/c_upload_manifest';
// $route['data_manifest/proses_upload_manifest'] = 'data_manifest/c_data_manifest/c_proses_upload_manifest';
// $route['data_manifest/simpan_manifest_temporary'] = 'data_manifest/c_data_manifest/c_simpan_manifest_temporary';
// $route['data_manifest/simpan_manifest'] = 'data_manifest/c_data_manifest/c_simpan_manifest';
// $route['data_manifest/detailmanifest'] = 'data_manifest/c_data_manifest/c_detailmanifest';
// $route['data_manifest/fetch_table_detail'] = 'data_manifest/c_data_manifest/c_fetch_table_detail';




// $route['data_out_pjt'] = 'data_out_pjt/c_data_out_pjt';
// $route['data_out_pjt/fetch_table'] = 'data_out_pjt/c_data_out_pjt/c_fetch_table';
// $route['data_out_pjt/upload_in_container'] = 'data_out_pjt/c_data_out_pjt/c_upload_out_container';









// $route['report_weekly'] = 'report_weekly/c_report_weekly';
// $route['report_weekly/table_thead'] = 'report_weekly/c_report_weekly/table_thead';
// $route['report_weekly/value_table'] = 'report_weekly/c_report_weekly/value_table';
// $route['report_weekly/exportxls'] = 'report_weekly/c_report_weekly/exportxls';
// $route['report_weekly/gettps'] = 'report_weekly/c_report_weekly/gettps';

// $route['report_terminal'] = 'report_terminal/c_report_terminal';
// $route['report_terminal/table_thead'] = 'report_terminal/c_report_terminal/table_thead';
// $route['report_terminal/value_table'] = 'report_terminal/c_report_terminal/value_table';
// $route['report_terminal/exportxls'] = 'report_terminal/c_report_terminal/exportxls';

// $route['report_beacukai'] = 'report_beacukai/c_report_beacukai';
// $route['report_beacukai/table_thead'] = 'report_beacukai/c_report_beacukai/table_thead';
// $route['report_beacukai/value_table'] = 'report_beacukai/c_report_beacukai/value_table';
// $route['report_beacukai/exportxls'] = 'report_beacukai/c_report_beacukai/exportxls';

// $route['report_invoice'] = 'report_invoice/c_report_invoice';
// $route['report_invoice/exportxls'] = 'report_invoice/c_report_invoice/exportxls';

// $route['mst_tarif'] = 'mst_tarif/c_mst_tarif';
// $route['mst_tarif/table_thead'] = 'mst_tarif/c_mst_tarif/table_thead';
// $route['mst_tarif/value_table'] = 'mst_tarif/c_mst_tarif/value_table';
// $route['mst_tarif/gotemp'] = 'mst_tarif/c_mst_tarif/gotemp';
// $route['mst_tarif/addnewflag'] = 'mst_tarif/c_mst_tarif/addnewflag';
// $route['mst_tarif/combo_alokasi_refresh'] = 'mst_tarif/c_mst_tarif/combo_alokasi_refresh';
// $route['mst_tarif/combo_kdtarif_refresh'] = 'mst_tarif/c_mst_tarif/combo_kdtarif_refresh';
// $route['mst_tarif/add'] = 'mst_tarif/c_mst_tarif/add';
// $route['mst_tarif/CboNamaTarif'] = 'mst_tarif/c_mst_tarif/CboNamaTarif';
// $route['mst_tarif/save_temporary'] = 'mst_tarif/c_mst_tarif/save_temporary';
// $route['mst_tarif/delete'] = 'mst_tarif/c_mst_tarif/delete';
// $route['mst_tarif/saveall'] = 'mst_tarif/c_mst_tarif/saveall';
// $route['mst_tarif/cekadd'] = 'mst_tarif/c_mst_tarif/cekadd';
// $route['mst_tarif/create_table'] = 'mst_tarif/c_mst_tarif/create_table';

// $route['bytps'] = 'bytps/c_bytps';
// $route['bytps/table_thead'] = 'bytps/c_bytps/table_thead';
// $route['bytps/value_table'] = 'bytps/c_bytps/value_table';
// $route['bytps/gotemp_search'] = 'bytps/c_bytps/gotemp_search';
// $route['bytps/table_container'] = 'bytps/c_bytps/table_container';
// $route['bytps/addbiaya'] = 'bytps/c_bytps/addbiaya';
// $route['bytps/table_thead_bayar'] = 'bytps/c_bytps/table_thead_bayar';
// $route['bytps/value_table_bayar'] = 'bytps/c_bytps/value_table_bayar';
// $route['bytps/gotemp_bayar'] = 'bytps/c_bytps/gotemp_bayar';
// $route['bytps/add'] = 'bytps/c_bytps/add';
// $route['bytps/add_bayar'] = 'bytps/c_bytps/add_bayar';
// $route['bytps/delete_bayar'] = 'bytps/c_bytps/delete_bayar';
// $route['bytps/save'] = 'bytps/c_bytps/save';

// $route['report_bytps'] = 'report_bytps/c_report_bytps';
// $route['report_bytps/table_thead'] = 'report_bytps/c_report_bytps/table_thead';
// $route['report_bytps/value_table'] = 'report_bytps/c_report_bytps/value_table';
// $route['report_bytps/addbukti'] = 'report_bytps/c_report_bytps/addbukti';
// $route['report_bytps/save'] = 'report_bytps/c_report_bytps/save';
// $route['report_bytps/exportxls'] = 'report_bytps/c_report_bytps/exportxls';

// $route['mst_alo_tarif'] = 'mst_alo_tarif/c_mst_alo_tarif';
// $route['mst_alo_tarif/table_thead'] = 'mst_alo_tarif/c_mst_alo_tarif/table_thead';
// $route['mst_alo_tarif/value_table'] = 'mst_alo_tarif/c_mst_alo_tarif/value_table';
// $route['mst_alo_tarif/save'] = 'mst_alo_tarif/c_mst_alo_tarif/save';
// $route['mst_alo_tarif/delete'] = 'mst_alo_tarif/c_mst_alo_tarif/delete';



// $route['invout'] 							= 'invout/c_invout';
// $route['invout/table_thead'] 				= 'invout/c_invout/table_thead';
// $route['invout/CmdSearchNew'] 				= 'invout/c_invout/c_CmdSearchNew';
// $route['invout/CmdSearch_proses'] 			= 'invout/c_invout/c_CmdSearch_proses';
// $route['invout/InsertHeader'] 				= 'invout/c_invout/c_InsertHeader';
// $route['invout/InsertContainer'] 			= 'invout/c_invout/c_InsertContainer';
// $route['invout/ProcessContainer'] 			= 'invout/c_invout/c_ProcessContainer';
// $route['invout/ProcessPreview'] 			= 'invout/c_invout/c_ProcessPreview';
// $route['invout/ProcessPreviewCacah'] 		= 'invout/c_invout/c_ProcessPreviewCacah';
// $route['invout/ProcessSimpan'] 				= 'invout/c_invout/c_ProcessSimpan';
// $route['invout/Validation_ProcessSimpan'] 	= 'invout/c_invout/c_Validation_ProcessSimpan';
// $route['invout/CekBarcodeSPPB'] 			= 'invout/c_invout/c_CekBarcodeSPPB';
// $route['invout/UpdateBarcodeSPPB'] 			= 'invout/c_invout/c_UpdateBarcodeSPPB';
// $route['invout/ProcessContainerCacah'] 		= 'invout/c_invout/c_ProcessContainerCacah';
// $route['invout/CekSudahCacah'] 				= 'invout/c_invout/c_CekSudahCacah';
// $route['invout/ProcessPreviewCargo'] 		= 'invout/c_invout/c_ProcessPreviewCargo';
// $route['invout/ProcessContainerCargo'] 		= 'invout/c_invout/c_ProcessContainerCargo';
// $route['invout/ProcessSimpanCacah'] 		= 'invout/c_invout/c_ProcessSimpanCacah';
// $route['invout/ProcessSimpanCargo'] 		= 'invout/c_invout/c_ProcessSimpanCargo';


// $route['invtable'] = 'invtable/c_invoice';
// $route['invtable/fetch_table'] = 'invtable/c_invoice/c_fetch_table';
// $route['invtable/cetakinvoice'] 		= 'invtable/c_invoice/c_cetakinvoice';
// $route['invtable/cetakbuktilunas'] 		= 'invtable/c_invoice/c_cetakbukti';
// $route['invtable/getconsignee'] 		= 'invtable/c_invoice/c_getconsignee';
// $route['invtable/saveconsignee'] 		= 'invtable/c_invoice/c_saveconsignee';
// $route['invtable/goto_ar_invoice'] 		= 'invtable/c_invoice/c_goto_ar_invoice';


// $route['invlain'] 							= 'invlain/c_invlain';
// $route['invlain/fetch_table_lain2'] 		= 'invlain/c_invlain/c_fetch_table_lain2';
// $route['invlain/proses_lelang'] 			= 'invlain/c_invlain/c_proses_lelang';
// $route['invlain/get_proses_lelang'] 		= 'invlain/c_invlain/c_get_proses_lelang';
// $route['invlain/getparty'] 					= 'invlain/c_invlain/c_getparty';
// $route['invlain/gettemp_lelang'] 			= 'invlain/c_invlain/c_gettemp_lelang';
// $route['invlain/preview_lelang'] 			= 'invlain/c_invlain/c_preview_lelang';
// $route['invlain/simpanlelang'] 				= 'invlain/c_invlain/c_simpanlelang';
// //hehehe

// $route['function/GetPPn'] 		= 'function/C_function/c_GetPPn';


// //=============================================================================
// $route['invout/InvoiceStd'] 			= 'invout/c_invout/c_InvoiceStd';
// $route['invout/InsertDokTPP'] 			= 'invout/c_invout/c_InsertDokTPP';
// $route['invout/caridokumentsppb'] 		= 'invout/c_invout/c_caridokumentsppb';
// $route['invout/savedokumentsppb'] 		= 'invout/c_invout/c_savedokumentsppb';
// $route['invout/FrmCekSPPB'] 			= 'invout/c_invout/c_FrmCekSPPB';
// //=============================================================================
// $route['invout/Customers'] 				= 'invout/c_invout/c_Customers';
// $route['invout/value_table_consignee'] 	= 'invout/c_invout/c_value_table_consignee';
// $route['invout/save_cust'] 				= 'invout/c_invout/c_save_cust';
// //=============================================================================



// $route['chart_pie'] = 'chart_pie/c_chart_pie';
// $route['chart_pie/show_pie_tipe_category'] = 'chart_pie/c_chart_pie/c_show_pie_tipe_category';
// $route['chart_pie/show_pie_status_barang_container'] = 'chart_pie/c_chart_pie/c_show_pie_status_barang_container';
// $route['chart_pie/show_pie_status_barang_lcl'] = 'chart_pie/c_chart_pie/c_show_pie_status_barang_lcl';
// $route['chart_pie/show_pie_status_barang_bb1'] = 'chart_pie/c_chart_pie/c_show_pie_status_barang_bb1';
// $route['chart_pie/show_peruntukan'] = 'chart_pie/c_chart_pie/c_show_peruntukan';
// $route['chart_pie/show_in_out_day'] = 'chart_pie/c_chart_pie/c_show_in_out_day';
// $route['chart_pie/show_container_terminal'] = 'chart_pie/c_chart_pie/c_show_container_terminal';
// $route['chart_pie/show_lcl_terminal'] = 'chart_pie/c_chart_pie/c_show_lcl_terminal';
// $route['chart_pie/show_cargo_terminal'] = 'chart_pie/c_chart_pie/c_show_cargo_terminal';


// $route['report_tegahan'] = 'report_tegahan/c_report_tegahan';
// $route['report_tegahan/exportxls'] = 'report_tegahan/c_report_tegahan/exportxls';

// $route['report_error_data'] = 'report_error_data/c_report_error_data';
// $route['report_error_data/table_thead'] = 'report_error_data/c_report_error_data/table_thead';
// $route['report_error_data/value_table'] = 'report_error_data/c_report_error_data/value_table';
// $route['report_error_data/edit_container_cargo'] = 'report_error_data/c_report_error_data/edit_container_cargo';
// $route['report_error_data/save'] = 'report_error_data/c_report_error_data/save';
// $route['report_error_data/otomatissave'] = 'report_error_data/c_report_error_data/otomatissave';


// $route['search_container_all_detail'] 			= 'search_container_all_detail/c_search_container_all_detail';
// $route['search_container_all_detail/exportxls/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'search_container_all_detail/c_search_container_all_detail/exportxls/$1/$2/$3/$4/$5';
// $route['search_container_all_detail/cetak/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'search_container_all_detail/c_search_container_all_detail/cetak/$1/$2/$3/$4/$5';


// $route['search_container_all_detail/exportxlsbackground'] = 'search_container_all_detail/c_search_container_all_detail/exportxlsbackground' ;

