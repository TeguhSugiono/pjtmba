<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class C_data_out_pjt extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('t_logged') <> 1) {
            redirect(site_url('login'));
        }
        $this->dbpjt = $this->load->database('db_pjt', TRUE);
    }

    function index(){
        $data = array(
            'content' => 'view',
        );

        $this->load->view('dashboard/index', $data);
    }

    function c_fetch_table(){

        $Tgl_Out_Start = $this->input->post('Tgl_Out_Start');
        $Tgl_Out_End = $this->input->post('Tgl_Out_End');
        $NoCont = $this->input->post('NoCont');


        $query = "  SELECT a.id_out,a.id_container_in,a.no_do,(select GetNoContainer(a.id_container_in)) 'nocont' ,
                    date_format(b.tgl_out,'%d-%m-%Y') 'tgl_out' 
                    FROM tbl_pjt_container_out a
                    INNER JOIN tbl_pjt_container_out_detail b on a.id_out=b.id_out
                    where a.flag_data=0 and b.flag_data=0 " ;

        if($Tgl_Out_Start != ""){
            $query.= " and b.tgl_out >= '".date_db($Tgl_Out_Start)."'" ;
        }

        if($Tgl_Out_End != ""){
            $query.= " and b.tgl_out <= '".date_db($Tgl_Out_End)."'" ;
        }

        if($NoCont != ""){
            $query.= " and (select GetNoContainer(a.id_container_in)) like'%".$NoCont."%'" ;
        }

        $query.= " GROUP BY a.id_out,a.no_do,b.tgl_out " ;
        $query.= " order by a.id_out desc " ;

        echo json_encode($this->dbpjt->query($query)->result_array());
    }

    function c_detailoutcontainer(){
        $id_out = $this->input->post('id_out') ;
        $tgl_out = $this->input->post('tgl_out') ;

        $comp = array(
            'id_out' => $id_out,
            'tgl_out' => $tgl_out
        );

        $this->load->view('detail_out_container',$comp);
    }

    function c_fetch_table_detail(){
        $data_id_out = $this->input->post('data_id_out') ;
        $data_tgl_out = $this->input->post('data_tgl_out') ;

        $query = "  SELECT a.id_out,a.id_out_detail,a.no_box_marking,
                    DATE_FORMAT(a.tgl_out,'%d-%m-%Y') 'tgl_out'
                    FROM tbl_pjt_container_out_detail a
                    INNER JOIN tbl_pjt_container_out b on a.id_out=b.id_out
                    where a.flag_data <> 9 and b.flag_data <> 9  " ;

        $query.= " and a.id_out='".$data_id_out."' " ;

        $query.= " and DATE_FORMAT(a.tgl_out,'%Y-%m-%d') = '".date_db($data_tgl_out)."' " ;

        $query.= " ORDER BY a.id_out_detail " ;

        echo json_encode($this->dbpjt->query($query)->result_array());
    }

    
    

    

}