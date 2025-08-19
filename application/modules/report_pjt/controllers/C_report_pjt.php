<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class C_report_pjt extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('t_logged') <> 1) {
            redirect(site_url('login'));
        }
        $this->dbpjt = $this->load->database('db_pjt', TRUE);
    }


    public function index() {

        $arraydata = array(
            'Current Stock' => 'Current Stock',
            'Stock' => 'Stock',            
            'Container In' => 'Container In',
            'Container Out' => 'Container Out'
        );
        $category = ComboNonDb($arraydata, 'category', '', '');

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
            'category' => $category,
            'id_container_in' => $id_container_in
        );

        $this->load->view('dashboard/index', $data);

    }

    function c_fetch_table_thead() {

        $category = $this->input->post('category');

        if($category == "Current Stock"){

            $field = " 'No','PBM','No Master BL','Tgl Master BL','No Container',  " ;
            $field.= " 'Uk','Tgl Masuk','Jam Masuk','No Surat incontainer','Tgl Surat incontainer',  " ;
            $field.= " 'No PLP','Tgl PLP','Vessel','Voyage','Call Sign','Tgl Tiba',  " ;
            $field.= " 'No BC11','Tgl BC11','NO. BOX / MARKING','Consignee','Jumlah Pakages', " ;
            $field.= " 'Satuan','Berat (Kg)','Volume' " ;

        }elseif($category == "Container In"){

            $field = " 'No','PBM','No Master BL','Tgl Master BL','No Container',  " ;
            $field.= " 'Uk','Tgl Masuk','Jam Masuk','No Surat incontainer','Tgl Surat incontainer',  " ;
            $field.= " 'No PLP','Tgl PLP','Vessel','Voyage','Call Sign','Tgl Tiba',  " ;
            $field.= " 'No BC11','Tgl BC11','NO. BOX / MARKING','Consignee','Jumlah Pakages', " ;
            $field.= " 'Satuan','Berat (Kg)','Volume','No DO','Tgl Keluar' " ;


        }elseif($category == "Container Out"){

            $field = " 'No','No Container','No DO','Tgl Masuk','Tgl Keluar','NO. BOX / MARKING',  " ;
            $field.= " 'Consignee','Jumlah Pakages','Satuan','Berat (Kg)','Volume'  " ;

        }elseif($category == "Stock"){

            $field = " 'No','PBM','No Master BL','Tgl Master BL','No Container',  " ;
            $field.= " 'Uk','Tgl Masuk','Jam Masuk','No Surat incontainer','Tgl Surat incontainer',  " ;
            $field.= " 'No PLP','Tgl PLP','Vessel','Voyage','Call Sign','Tgl Tiba',  " ;
            $field.= " 'No BC11','Tgl BC11','NO. BOX / MARKING','Consignee','Jumlah Pakages', " ;
            $field.= " 'Satuan','Berat (Kg)','Volume','No DO','Tgl Keluar' " ;

        }


        $this->dbpjt->select($field);
        $data['field_data'] = $this->dbpjt->get()->list_fields();
        echo json_encode($data['field_data']);
    }


    function c_fetch_table(){
        $tgl1 = $this->input->post('tgl1');
        $tgl2 = $this->input->post('tgl2');
        $category = $this->input->post('category');
        $id_container_in = $this->input->post('id_container_in');

        if($category == "Current Stock"){

            $query = "  SELECT 
                        a.pbm,a.no_master_bl,
                        date_format(a.tgl_master_bl,'%d-%m-%Y') as 'tgl_master_bl',a.no_container,a.size,
                        date_format(a.tgl_container_in,'%d-%m-%Y') as 'tgl_container_in',a.jam_masuk,
                        a.no_surat_plp,date_format(a.tgl_surat_plp,'%d-%m-%Y') as 'tgl_surat_plp',
                        a.no_plp,date_format(a.tgl_plp,'%d-%m-%Y') as 'tgl_plp',a.vessel,a.voyage,
                        a.call_sign,date_format(a.tgl_tiba,'%d-%m-%Y') as 'tgl_tiba',a.no_bc11,
                        date_format(a.tgl_bc11,'%d-%m-%Y') as 'tgl_bc11',
                        b.no_box_marking,b.consignee,b.jumlah,b.satuan,b.berat,b.volume
                        FROM tbl_pjt_container_in a
                        INNER JOIN tbl_pjt_container_in_detail b on a.id_container_in=b.id_container_in
                        where a.flag_data = 0 and b.flag_data = 0 and b.flag_keluar=0  " ;

            if($id_container_in != ""){
                $query.= " and a.id_container_in = '".$id_container_in."' " ;
            }


            $query.= " order by a.id_container_in desc " ;

        }elseif($category == "Container In"){

            $query = "  SELECT 
                        a.pbm,a.no_master_bl,
                        date_format(a.tgl_master_bl,'%d-%m-%Y') as 'tgl_master_bl',a.no_container,a.size,
                        date_format(a.tgl_container_in,'%d-%m-%Y') as 'tgl_container_in',a.jam_masuk,
                        a.no_surat_plp,date_format(a.tgl_surat_plp,'%d-%m-%Y') as 'tgl_surat_plp',
                        a.no_plp,date_format(a.tgl_plp,'%d-%m-%Y') as 'tgl_plp',a.vessel,a.voyage,
                        a.call_sign,date_format(a.tgl_tiba,'%d-%m-%Y') as 'tgl_tiba',a.no_bc11,
                        date_format(a.tgl_bc11,'%d-%m-%Y') as 'tgl_bc11',
                        b.no_box_marking,b.consignee,b.jumlah,b.satuan,b.berat,b.volume,
                        if(b.flag_keluar = 1 ,(SELECT getDistinctNoDoByBoxMarking(b.no_box_marking)),'' ) as 'nodo',
                        if(b.flag_keluar = 1 ,date_format((SELECT getDistinctTglOutByBoxMarking(b.no_box_marking)),'%d-%m-%Y'),'' ) as 'tglout'
                        FROM tbl_pjt_container_in a
                        INNER JOIN tbl_pjt_container_in_detail b on a.id_container_in=b.id_container_in
                        where a.flag_data = 0 and b.flag_data = 0   " ;

            if($tgl1 != ""){
                $query.= " and a.tgl_container_in >= '".date_db($tgl1)."'" ;
            }

            if($tgl2 != ""){
                $query.= " and a.tgl_container_in <= '".date_db($tgl2)."'" ;
            }

            if($id_container_in != ""){
                $query.= " and a.id_container_in = '".$id_container_in."' " ;
            }


            $query.= " order by a.id_container_in desc " ;

        }elseif($category == "Container Out"){

            $query = "  SELECT DISTINCT (SELECT GetNoContainer(a.id_container_in)) 'nocont',
                        a.no_do,(date_format((SELECT GetNoTglIn(a.id_container_in)),'%d-%m-%Y')) 'tglin',
                        date_format(b.tgl_out,'%d-%m-%Y') 'tgl_out',b.no_box_marking,
                        c.consignee,c.jumlah,c.satuan,c.berat,c.volume
                        FROM tbl_pjt_container_out a 
                        INNER JOIN tbl_pjt_container_out_detail b on a.id_out=b.id_out
                        INNER JOIN tbl_pjt_container_in_detail c on b.no_box_marking=c.no_box_marking
                        where a.flag_data=0 and b.flag_data= 0 and c.flag_data=0 and c.flag_keluar=1   " ;

            if($tgl1 != ""){
                $query.= " and b.tgl_out >= '".date_db($tgl1)."'" ;
            }

            if($tgl2 != ""){
                $query.= " and b.tgl_out <= '".date_db($tgl2)."'" ;
            }

            if($id_container_in != ""){
                $query.= " and a.id_container_in = '".$id_container_in."' " ;
            }


            $query.= " order by a.id_out desc " ;

        }elseif($category == "Stock"){

            $query = "  SELECT 
                        a.pbm,a.no_master_bl,
                        date_format(a.tgl_master_bl,'%d-%m-%Y') as 'tgl_master_bl',a.no_container,a.size,
                        date_format(a.tgl_container_in,'%d-%m-%Y') as 'tgl_container_in',a.jam_masuk,
                        a.no_surat_plp,date_format(a.tgl_surat_plp,'%d-%m-%Y') as 'tgl_surat_plp',
                        a.no_plp,date_format(a.tgl_plp,'%d-%m-%Y') as 'tgl_plp',a.vessel,a.voyage,
                        a.call_sign,date_format(a.tgl_tiba,'%d-%m-%Y') as 'tgl_tiba',a.no_bc11,
                        date_format(a.tgl_bc11,'%d-%m-%Y') as 'tgl_bc11',
                        b.no_box_marking,b.consignee,b.jumlah,b.satuan,b.berat,b.volume,
                        if(b.flag_keluar = 1 ,(SELECT getDistinctNoDoByBoxMarking(b.no_box_marking)),'' ) as 'nodo',
                        if(b.flag_keluar = 1 ,date_format((SELECT getDistinctTglOutByBoxMarking(b.no_box_marking)),'%d-%m-%Y'),'' ) as 'tglout'
                        from tbl_pjt_container_in a 
                        INNER JOIN tbl_pjt_container_in_detail b on a.id_container_in=b.id_container_in
                        LEFT JOIN  tbl_pjt_container_out_detail c on b.no_box_marking=c.no_box_marking
                        where ((a.flag_data=0 and b.flag_data=0 and b.flag_keluar=0 and a.tgl_container_in<='".date_db($tgl2)."')
                        or (c.tgl_out > '".date_db($tgl2)."' and b.flag_keluar=1 and a.tgl_container_in<='".date_db($tgl2)."' ))   " ;

            if($tgl2 == ""){
                $query.= " and a.id_container_in='00000000000' " ;    
            }

            if($id_container_in != ""){
                $query.= " and a.id_container_in = '".$id_container_in."' " ;
            }


            $query.= " ORDER BY a.tgl_container_in " ;

        }


            

        echo json_encode($this->dbpjt->query($query)->result_array());
    }


    function c_exportxls(){

        $data = base64_decode($_GET['data']);
        $data = explode(',', $data);

        $tgl1       = $data[0] ;
        $tgl2       = $data[1] ;
        $category   = $data[2] ;
        $id_container_in = $data[3] ;

        $nama_excel = "" ;
        $query = "" ;

        if($category == "Current Stock"){

            $query = "  SELECT 
                        'nomor' as 'No', a.pbm,a.no_master_bl,
                        date_format(a.tgl_master_bl,'%d-%m-%Y') as 'tgl_master_bl',a.no_container,a.size,
                        date_format(a.tgl_container_in,'%d-%m-%Y') as 'tgl_container_in',a.jam_masuk,
                        a.no_surat_plp,date_format(a.tgl_surat_plp,'%d-%m-%Y') as 'tgl_surat_plp',
                        a.no_plp,date_format(a.tgl_plp,'%d-%m-%Y') as 'tgl_plp',a.vessel,a.voyage,
                        a.call_sign,date_format(a.tgl_tiba,'%d-%m-%Y') as 'tgl_tiba',a.no_bc11,
                        date_format(a.tgl_bc11,'%d-%m-%Y') as 'tgl_bc11',
                        b.no_box_marking,b.consignee,b.jumlah,b.satuan,b.berat,b.volume
                        FROM tbl_pjt_container_in a
                        INNER JOIN tbl_pjt_container_in_detail b on a.id_container_in=b.id_container_in
                        where a.flag_data = 0 and b.flag_data = 0 and b.flag_keluar=0  " ;

            if($id_container_in != ""){
                $query.= " and a.id_container_in = '".$id_container_in."' " ;
            }

            $query.= " order by a.id_container_in desc " ;

        }elseif($category == "Container In"){

            $query = "  SELECT 
                        'nomor' as 'No' ,a.pbm,a.no_master_bl,
                        date_format(a.tgl_master_bl,'%d-%m-%Y') as 'tgl_master_bl',a.no_container,a.size,
                        date_format(a.tgl_container_in,'%d-%m-%Y') as 'tgl_container_in',a.jam_masuk,
                        a.no_surat_plp,date_format(a.tgl_surat_plp,'%d-%m-%Y') as 'tgl_surat_plp',
                        a.no_plp,date_format(a.tgl_plp,'%d-%m-%Y') as 'tgl_plp',a.vessel,a.voyage,
                        a.call_sign,date_format(a.tgl_tiba,'%d-%m-%Y') as 'tgl_tiba',a.no_bc11,
                        date_format(a.tgl_bc11,'%d-%m-%Y') as 'tgl_bc11',
                        b.no_box_marking,b.consignee,b.jumlah,b.satuan,b.berat,b.volume,
                        if(b.flag_keluar = 1 ,(SELECT getDistinctNoDoByBoxMarking(b.no_box_marking)),'' ) as 'nodo',
                        if(b.flag_keluar = 1 ,date_format((SELECT getDistinctTglOutByBoxMarking(b.no_box_marking)),'%d-%m-%Y'),'' ) as 'tglout'
                        FROM tbl_pjt_container_in a
                        INNER JOIN tbl_pjt_container_in_detail b on a.id_container_in=b.id_container_in
                        where a.flag_data = 0 and b.flag_data = 0   " ;

            if($tgl1 != ""){
                $query.= " and a.tgl_container_in >= '".date_db($tgl1)."'" ;
            }

            if($tgl2 != ""){
                $query.= " and a.tgl_container_in <= '".date_db($tgl2)."'" ;
            }

            if($id_container_in != ""){
                $query.= " and a.id_container_in = '".$id_container_in."' " ;
            }


            $query.= " order by a.id_container_in desc " ;

        }elseif($category == "Container Out"){

            $query = "  SELECT DISTINCT 'nomor' as 'No', (SELECT GetNoContainer(a.id_container_in)) 'nocont',
                        a.no_do,(date_format((SELECT GetNoTglIn(a.id_container_in)),'%d-%m-%Y')) 'tglin',
                        date_format(b.tgl_out,'%d-%m-%Y') 'tgl_out',b.no_box_marking,
                        c.consignee,c.jumlah,c.satuan,c.berat,c.volume
                        FROM tbl_pjt_container_out a 
                        INNER JOIN tbl_pjt_container_out_detail b on a.id_out=b.id_out
                        INNER JOIN tbl_pjt_container_in_detail c on b.no_box_marking=c.no_box_marking
                        where a.flag_data=0 and b.flag_data= 0 and c.flag_data=0 and c.flag_keluar=1   " ;

            if($tgl1 != ""){
                $query.= " and b.tgl_out >= '".date_db($tgl1)."'" ;
            }

            if($tgl2 != ""){
                $query.= " and b.tgl_out <= '".date_db($tgl2)."'" ;
            }

            if($id_container_in != ""){
                $query.= " and a.id_container_in = '".$id_container_in."' " ;
            }


            $query.= " order by a.id_out desc " ;

        }elseif($category == "Stock"){

            $query = "  SELECT 
                        'nomor' as 'No',a.pbm,a.no_master_bl,
                        date_format(a.tgl_master_bl,'%d-%m-%Y') as 'tgl_master_bl',a.no_container,a.size,
                        date_format(a.tgl_container_in,'%d-%m-%Y') as 'tgl_container_in',a.jam_masuk,
                        a.no_surat_plp,date_format(a.tgl_surat_plp,'%d-%m-%Y') as 'tgl_surat_plp',
                        a.no_plp,date_format(a.tgl_plp,'%d-%m-%Y') as 'tgl_plp',a.vessel,a.voyage,
                        a.call_sign,date_format(a.tgl_tiba,'%d-%m-%Y') as 'tgl_tiba',a.no_bc11,
                        date_format(a.tgl_bc11,'%d-%m-%Y') as 'tgl_bc11',
                        b.no_box_marking,b.consignee,b.jumlah,b.satuan,b.berat,b.volume,
                        if(b.flag_keluar = 1 ,(SELECT getDistinctNoDoByBoxMarking(b.no_box_marking)),'' ) as 'nodo',
                        if(b.flag_keluar = 1 ,date_format((SELECT getDistinctTglOutByBoxMarking(b.no_box_marking)),'%d-%m-%Y'),'' ) as 'tglout'
                        from tbl_pjt_container_in a 
                        INNER JOIN tbl_pjt_container_in_detail b on a.id_container_in=b.id_container_in
                        LEFT JOIN  tbl_pjt_container_out_detail c on b.no_box_marking=c.no_box_marking
                        where ((a.flag_data=0 and b.flag_data=0 and b.flag_keluar=0 and a.tgl_container_in<='".date_db($tgl2)."')
                        or (c.tgl_out > '".date_db($tgl2)."' and b.flag_keluar=1 and a.tgl_container_in<='".date_db($tgl2)."' ))   " ;

            if($tgl2 == ""){
                $query.= " and a.id_container_in='00000000000' " ;    
            }

            if($id_container_in != ""){
                $query.= " and a.id_container_in = '".$id_container_in."' " ;
            }

            $query.= " ORDER BY a.tgl_container_in " ;

        }

        if($this->dbpjt->query($query)->num_rows() == 0){
            echo 'data not found..';
            die;
        }


        //Setting Sheet Excel
        $nama_sheet = array(
            '0' => $category,
        );

        $data_all_sheet = array(
            '0' => $this->dbpjt->query($query)->result_array(),
        );

        $setting_xls = array(
            'jumlah_sheet' => 1 ,
            'nama_excel' => "Report_".$category."_".tanggal_sekarang(),
            'nama_sheet' => $nama_sheet,
            'data_all_sheet' => $data_all_sheet,
        );

        $this->m_function->generator_xls_phpexcel($setting_xls);

    }

}