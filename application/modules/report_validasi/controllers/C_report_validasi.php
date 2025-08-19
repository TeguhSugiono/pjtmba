<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class C_report_validasi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('t_logged') <> 1) {
            redirect(site_url('login'));
        }
        $this->dbpjt = $this->load->database('db_pjt', TRUE);
    }


    public function index() {

        $arraydata = $this->dbpjt->query("  SELECT a.id_container_in 'id_container_in',
                        concat(a.no_do,' - ',(SELECT GetNoContainer(a.id_container_in))) 'blcontainer' 
                        FROM tbl_pjt_out_upload a 
                        INNER JOIN tbl_pjt_out_upload_detail b on a.id_upload = b.id_upload
                        where a.flag_data<>9 and b.flag_data<>9 
                        GROUP BY a.id_container_in ")->result_array();
        array_push($arraydata, array('id_container_in' => '' , 'blcontainer' => 'All Data'));
        $createcombo = array(
            'data' => array_reverse($arraydata,true),
            'set_data' => array('set_id' => ''),
            'attribute' => array('idname' => 'id_container_in', 'class' => 'select2 resize_box'),
        );
        $id_container_in = ComboDb($createcombo);


        $data = array(
            'content' => 'view',
            'id_container_in' => $id_container_in,
        );

        $this->load->view('dashboard/index', $data);

    }

    


    function c_fetch_table(){
        $tgl1 = $this->input->post('tgl1');
        $tgl2 = $this->input->post('tgl2');
        $id_container_in = $this->input->post('id_container_in');


        $query = "" ;
        $query.= " SELECT (SELECT GetNoContainer(a.id_container_in)) 'nocontainer', " ;
        $query.= " a.no_do, b.no_box_marking,c.consignee,date_format(b.tgl_check,'%d-%m-%Y') 'tgl_check',b.jam_check " ;
        $query.= " FROM tbl_pjt_out_check a  " ;
        $query.= " INNER JOIN tbl_pjt_out_check_detail b on a.id_check=b.id_check " ;
        $query.= " INNER JOIN tbl_pjt_container_in_detail c on b.no_box_marking=c.no_box_marking " ;
        $query.= " where a.flag_data=0 and b.flag_data=0 and c.flag_data=0 " ;

        if($id_container_in != ""){
            $query.= " and a.id_container_in = '".$id_container_in."' " ;
        }

        if($tgl1 != ""){
            $query.= " and date_format(b.tgl_check,'%Y-%m-%d') >= '".date_db($tgl1)."' " ;
        }

        if($tgl2 != ""){
            $query.= " and date_format(b.tgl_check,'%Y-%m-%d') <= '".date_db($tgl2)."' " ;
        }

        $query.= " GROUP BY a.no_do,(SELECT GetNoContainer(a.id_container_in)),b.no_box_marking " ;
        $query.= " ORDER BY b.tgl_check,b.jam_check " ;
            

        echo json_encode($this->dbpjt->query($query)->result_array());
    }


    function c_exportxls(){

        $data = base64_decode($_GET['data']);
        $data = explode(',', $data);

        $tgl1       = $data[0] ;
        $tgl2       = $data[1] ;
        $id_container_in = $data[2] ;

        $query = "" ;
        $query.= " SELECT 'nomor' as 'No',(SELECT GetNoContainer(a.id_container_in)) 'No Container', " ;
        $query.= " a.no_do 'No DO/MBL', b.no_box_marking 'No Box Marking',c.consignee 'Consignee', " ;
        $query.= " date_format(b.tgl_check,'%d-%m-%Y') 'Tgl Validasi',b.jam_check 'Jam Validasi' " ;
        $query.= " FROM tbl_pjt_out_check a  " ;
        $query.= " INNER JOIN tbl_pjt_out_check_detail b on a.id_check=b.id_check " ;
        $query.= " INNER JOIN tbl_pjt_container_in_detail c on b.no_box_marking=c.no_box_marking " ;
        $query.= " where a.flag_data=0 and b.flag_data=0 and c.flag_data=0 " ;

        if($id_container_in != ""){
            $query.= " and a.id_container_in = '".$id_container_in."' " ;
        }

        if($tgl1 != ""){
            $query.= " and date_format(b.tgl_check,'%Y-%m-%d') >= '".date_db($tgl1)."' " ;
        }

        if($tgl2 != ""){
            $query.= " and date_format(b.tgl_check,'%Y-%m-%d') <= '".date_db($tgl2)."' " ;
        }

        $query.= " GROUP BY a.no_do,(SELECT GetNoContainer(a.id_container_in)),b.no_box_marking " ;
        $query.= " ORDER BY b.tgl_check,b.jam_check " ;



        if($this->dbpjt->query($query)->num_rows() == 0){
            echo 'data not found..';
            die;
        }


        //Setting Sheet Excel
        $nama_sheet = array(
            '0' => "Report Validasi",
        );

        $data_all_sheet = array(
            '0' => $this->dbpjt->query($query)->result_array(),
        );

        $setting_xls = array(
            'jumlah_sheet' => 1 ,
            'nama_excel' => "Report_Validasi_".tanggal_sekarang(),
            'nama_sheet' => $nama_sheet,
            'data_all_sheet' => $data_all_sheet,
        );

        $this->m_function->generator_xls_phpexcel($setting_xls);

    }

}