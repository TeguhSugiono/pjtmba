<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class C_check_out_pjt extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('t_logged') <> 1) {
            redirect(site_url('login'));
        }
        $this->dbpjt = $this->load->database('db_pjt', TRUE);
    }

    function index(){

        $arraydata = $this->dbpjt->query("  SELECT a.id_container_in 'id',
                        concat(a.no_do,' - ',(SELECT GetNoContainer(a.id_container_in))) 'blcontainer' 
                        FROM tbl_pjt_out_upload a 
                        INNER JOIN tbl_pjt_out_upload_detail b on a.id_upload = b.id_upload
                        where a.flag_data<>9 and b.flag_data<>9 
                        GROUP BY a.id_container_in ")->result_array();


        // print("<pre>".print_r($arraydata,true)."</pre>"); die;
        // die;

        array_push($arraydata, array('id' => '' , 'blcontainer' => 'No BL - No Container'));
        $createcombo = array(
            'data' => array_reverse($arraydata,true),
            'set_data' => array('set_id' => ''),
            'attribute' => array('idname' => 'id', 'class' => 'select2 resize_box'),
        );
        $id = ComboDb($createcombo);


        $data = array(
            'content' => 'view',
            'id' => $id,
        );

        $this->load->view('dashboard/index', $data);
    }

    function c_createcheck(){
        $id_container_in = $this->input->post('id_container_in');
        $no_master_bl = $this->input->post('no_master_bl');
        $no_container = $this->input->post('no_container');


        //cek data header check
        if($this->dbpjt->get_where('tbl_pjt_out_check',array('id_container_in' => $id_container_in,'tgl_create' => date_db(tanggal_sekarang())))->num_rows() > 0){
            $pesan_data = array(
                'msg' => 'Tidak',
                'pesan' => 'Transaksi No Container '.$no_container.' dan Master BL '.$no_master_bl.' Untuk Hari Ini Sudah Di Buat',
                'queri' => $this->dbpjt->last_query(),
            );
            echo json_encode($pesan_data); die;
        }


        $datainsert = array(
            'id_container_in' => $id_container_in,
            'no_do' => $no_master_bl,
            'tgl_create' => tanggal_sekarang(),
            'created_on' => tanggal_sekarang(),
            'created_by' => $this->session->userdata('t_username'),
        );

        $exequery = $this->dbpjt->insert('tbl_pjt_out_check', $datainsert);
        if(!$exequery >= 1){
            $pesan_data = array(
                'msg' => 'Tidak',
                'pesan' => 'Insert Check Header Gagal..!!',
            );
            echo json_encode($pesan_data); die;
        }

        $pesan_data = array(
            'msg' => 'Ya',
            'pesan' => 'Create Transaksi Sukses..',
        );

        echo json_encode($pesan_data); 
    }

    function c_fetch_h_table(){

        $query = "  SELECT a.id_check,a.id_container_in,b.no_master_bl,b.no_container,
                    date_format(a.tgl_create,'%d-%m-%Y') 'tgl_create'
                    FROM tbl_pjt_out_check a 
                    INNER JOIN tbl_pjt_container_in b on a.id_container_in=b.id_container_in
                    where a.flag_data=0  and b.flag_data=0 and a.tgl_create >= DATE_SUB(CURDATE(), INTERVAL 1 DAY) " ;

        $query.= "  ORDER BY a.id_check desc  " ;

        echo json_encode($this->dbpjt->query($query)->result_array());
    }

    function c_fetch_table(){

        $id_check = $this->input->post('id_check');

        $query = "  SELECT id_check_detail,
                    no_box_marking 'boxmarking'
                    FROM tbl_pjt_out_check_detail
                    where flag_data=0 " ;

        if($id_check != ""){
            $query.= " and id_check='".$id_check."' " ;
        }else{
            $query.= " and id_check='AAAAAAAAAA' " ;
        }

        $query.= "  ORDER BY id_check_detail desc  " ;

        echo json_encode($this->dbpjt->query($query)->result_array());
    }


    function c_savecn(){
        $id_container_in = $this->input->post('id_container_in');
        $no_master_bl = $this->input->post('no_master_bl');
        $no_container = $this->input->post('no_container');
        $nocn = $this->input->post('nocn');
        $tgl_check = $this->input->post('tgl_check');
        $jam_check = $this->input->post('jam_check');
        $id_check = $this->input->post('id_check');


        //cek data stock
        $datacn = $this->dbpjt->get_where('tbl_pjt_container_in_detail',array('flag_data' => 0,'flag_keluar' => 0,'no_box_marking' => $nocn));
        if($datacn->num_rows() == 0){
            $pesan_data = array(
                'msg' => 'Tidak',
                'pesan' => 'No Box Marking '.$nocn.' Tidak Ada Di Stock Atau Data In Container..!!' ,
            );

            echo json_encode($pesan_data); die; 
        }

        //cek data upload out
        $datacn = $this->dbpjt->get_where('tbl_pjt_out_upload_detail',array('flag_data' => 0,'no_box_marking' => $nocn));
        if($datacn->num_rows() == 0){
            $pesan_data = array(
                'msg' => 'Tidak',
                'pesan' => 'No Box Marking '.$nocn.' Tidak Ada Di Upload Out Container..!!' ,
                //'pesan' => $this->dbpjt->last_query()
            );

            echo json_encode($pesan_data); die; 
        }

        //cek data box mark sudah add di transaksi lain atau sebelumnya
        $datacn = $this->dbpjt->get_where('tbl_pjt_out_check_detail',array('flag_data' => 0,'no_box_marking' => $nocn,'id_check <>' => $id_check));
        if($datacn->num_rows() > 0){
            $pesan_data = array(
                'msg' => 'Tidak',
                'pesan' => 'No Box Marking Sudah Di Check di Transaksi Lain..!!' ,
                'pesan' => $this->dbpjt->last_query()
            );

            echo json_encode($pesan_data); die; 
        }

        //cek data box marking harus sesuai containernya
        $query = " SELECT * FROM tbl_pjt_container_in_detail a 
            INNER JOIN tbl_pjt_container_in b on a.id_container_in=b.id_container_in
            where a.flag_data=0 and b.flag_data=0 and flag_keluar=0
            and a.id_container_in='".$id_container_in."' and a.no_box_marking='".$nocn."' " ;
        $datacn = $this->dbpjt->query($query);
        if($datacn->num_rows() == 0){
            $pesan_data = array(
                'msg' => 'Tidak',
                'pesan' => 'No Box Marking '.$nocn.' Bukan Kepunyaan Container '.$no_container.' ..!!' ,
            );

            echo json_encode($pesan_data); die; 
        }


        $datainsert = array(
            'tgl_check' => date_db($tgl_check),
            'jam_check' => $jam_check,
            'created_on' => tanggal_sekarang(),
            'created_by' => $this->session->userdata('t_username'),
            'id_container_in' => $id_container_in,
            'id_check' => $id_check,
            'no_box_marking' => $nocn,
        );

        $exequery = $this->dbpjt->insert('tbl_pjt_out_check_detail', $datainsert);
        if(!$exequery >= 1){
            $pesan_data = array(
                'msg' => 'Tidak',
                'pesan' => 'Insert BL MARKING / CN Marking Error..!!',
                'query' => $this->dbpjt->last_query()
            );
            echo json_encode($pesan_data); die;
        }

        $pesan_data = array(
            'msg' => 'Ya',
            'pesan' => 'Check BL MARKING / CN '. $nocn .' Berhasil..',
        );
         echo json_encode($pesan_data); die;

        // $pesan_data = array(
        //     'msg' => 'Ya',
        //     'id_container_in' => $id_container_in,
        //     'no_master_bl' => $no_master_bl,
        //     'no_container' => $no_container,
        //     'nocn' => $nocn,
        //     'tgl_check' => $tgl_check,
        //     'jam_check' => $jam_check,
        //     'id_check' => $id_check,
        // );

        // echo json_encode($pesan_data); die;

        // $customselect = "id_manifest_detail" ;
        // $fieldvalue = "id_manifest_detail" ;
        // $where = array(
        //     'no_box_marking' => trim($nocn),
        //     'flag_data' => 0,
        //     'flag_transfer >' => 0
        // );
        // $id_manifest_detail =  $this->m_function->GetFieldValue($customselect,$fieldvalue,"dbpjt",$where,'tbl_manifest_detail') ;

        // if($id_manifest_detail == ""){
        //     $pesan_data = array(
        //         'msg' => 'Tidak',
        //         'pesan' => 'Data BL MARKING / CN Tidak Ada Di Dalam Manifest Detail Barang..!!',
        //     );

        //     echo json_encode($pesan_data); die;
        // }

        // $customselect = "flag_transfer" ;
        // $fieldvalue = "flag_transfer" ;
        // $id_container_in_detail =  $this->m_function->GetFieldValue($customselect,$fieldvalue,"dbpjt",$where,'tbl_manifest_detail') ;
        // if($id_container_in_detail == ""){
        //     $pesan_data = array(
        //         'msg' => 'Tidak',
        //         'pesan' => 'Data BL MARKING / CN Ini Tidak Terdeteksi Di Manifest Detail Barang..!!',
        //     );

        //     echo json_encode($pesan_data); die;
        // }


        // $customselect = "id_container_in_detail" ;
        // $fieldvalue = "id_container_in_detail" ;
        // $where = array(
        //     'id_container_in' => $id_container_in,
        //     'id_manifest_detail' => $id_manifest_detail,
        //     'id_container_in_detail' => $id_container_in_detail,
        //     'flag_data' => 0,
        //     'flag_keluar' => 0
        // );
        // $id_container_in_detail =  $this->m_function->GetFieldValue($customselect,$fieldvalue,"dbpjt",$where,'tbl_pjt_container_in_detail') ;
        // if($id_container_in_detail == ""){
        //     $pesan_data = array(
        //         'msg' => 'Tidak',
        //         'pesan' => 'Data BL MARKING / CN Ini Tidak Terdeteksi Di PJT In Container..!!',
        //     );

        //     echo json_encode($pesan_data); die;
        // }

        // //cek data yang sama di iinput
        // if($this->dbpjt->get_where('tbl_pjt_out_check_detail',array('flag_data' => 0, 'id_container_in_detail' => $id_container_in_detail))->num_rows() > 0 ){
        //     $pesan_data = array(
        //         'msg' => 'Tidak',
        //         'pesan' => 'Data BL MARKING / CN Ini Sudah Diinput..!!',
        //     );

        //     echo json_encode($pesan_data); die;
        // }

        // $datainsert = array(
        //     'id_container_in_detail'    => $id_container_in_detail,
        //     'tgl_check' => date_db($tgl_check),
        //     'jam_check' => $jam_check,
        //     'created_on' => tanggal_sekarang(),
        //     'created_by' => $this->session->userdata('t_username'),
        //     'id_container_in' => $id_container_in,
        //     'id_check' => $id_check,
        // );

        // $exequery = $this->dbpjt->insert('tbl_pjt_out_check_detail', $datainsert);
        // if(!$exequery >= 1){
        //     $pesan_data = array(
        //         'msg' => 'Tidak',
        //         'pesan' => 'Insert BL MARKING / CN Marking Error..!!',
        //         'query' => $this->dbpjt->last_query()
        //     );
        //     echo json_encode($pesan_data); die;
        // }

        // $pesan_data = array(
        //     'msg' => 'Ya',
        //     'pesan' => 'Check BL MARKING / CN '. $nocn .' Berhasil..',
        //     'datainsert' => $datainsert,
        //     'query' => $this->dbpjt->last_query(),
        //     'id_manifest_detail' => $id_manifest_detail,
        //     'id_container_in_detail' => $id_container_in_detail,
        // );

        // echo json_encode($pesan_data); 


    }



    
        // function GetBLMarking(){

    //     $id_container_in_detail = $this->input->post('id_container_in_detail');

    //     $customselect = "id_manifest_detail" ;
    //     $fieldvalue = "id_manifest_detail" ;
    //     $where = array(
    //         'id_container_in_detail' => $id_container_in_detail,
    //         'flag_data' => 0,
    //         'flag_transfer >' => 0
    //     );
    //     $id_manifest_detail =  $this->m_function->GetFieldValue($customselect,$fieldvalue,"dbpjt",$where,'tbl_manifest_detail') ;

    //     if($id_manifest_detail == ""){
    //         //no_box_marking
    //     }


    // }
    

    

    

}