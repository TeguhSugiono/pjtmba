<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class C_data_in_pjt extends CI_Controller {

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

        $Tgl_In_Start = $this->input->post('Tgl_In_Start');
        $Tgl_In_End = $this->input->post('Tgl_In_End');
        $NoCont = $this->input->post('NoCont');


        $query = "  SELECT 
                    a.id_container_in,a.pbm,a.no_master_bl,
                    date_format(a.tgl_master_bl,'%d-%m-%Y') as 'tgl_master_bl',a.no_container,a.size,
                    date_format(a.tgl_container_in,'%d-%m-%Y') as 'tgl_container_in',a.jam_masuk,
                    a.no_surat_plp,date_format(a.tgl_surat_plp,'%d-%m-%Y') as 'tgl_surat_plp',
                    a.no_plp,date_format(a.tgl_plp,'%d-%m-%Y') as 'tgl_plp',a.vessel,a.voyage,
                    a.call_sign,date_format(a.tgl_tiba,'%d-%m-%Y') as 'tgl_tiba',a.no_bc11,
                    date_format(a.tgl_bc11,'%d-%m-%Y') as 'tgl_bc11'
                    FROM tbl_pjt_container_in a
                    INNER JOIN tbl_pjt_container_in_detail b on a.id_container_in=b.id_container_in
                    where a.flag_data <> 9 and b.flag_data <> 9  " ;

        if($Tgl_In_Start != ""){
            $query.= " and a.tgl_container_in >= '".date_db($Tgl_In_Start)."'" ;
        }

        if($Tgl_In_End != ""){
            $query.= " and a.tgl_container_in <= '".date_db($Tgl_In_End)."'" ;
        }

        if($NoCont != ""){
            $query.= " and a.no_container like'%".$NoCont."%'" ;
        }

        $query.= " group by a.id_container_in order by a.id_container_in desc " ;

        echo json_encode($this->dbpjt->query($query)->result_array());
    }

    function c_fetch_table_detail(){
        $data_id_container_in = $this->input->post('data_id_container_in') ;

        $query = "  SELECT a.id_container_in,a.id_container_in_detail, 
                    a.no_box_marking,a.consignee,DATE_FORMAT(a.tgl_stripping,'%d-%m-%Y') 'tgl_stripping',
                    a.jumlah,a.satuan,a.berat,volume
                    FROM tbl_pjt_container_in_detail a
                    INNER JOIN tbl_pjt_container_in b on a.id_container_in=b.id_container_in
                    where a.flag_data<>9 and b.flag_data<>9  " ;

        $query.= " and a.id_container_in='".$data_id_container_in."' " ;

        $query.= " order by a.id_container_in_detail " ;

        echo json_encode($this->dbpjt->query($query)->result_array());
    }

    function c_upload_in_container(){
        $this->load->view('upload_in_container');
    }

    function c_detailincontainer(){
        $id_container_in = $this->input->post('id_container_in') ;

        $comp = array(
            'id_container_in' => $id_container_in
        );

        $this->load->view('detail_in_container',$comp);
    }

    function c_proses_upload_incontainer() {
        
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';

        $file = pathinfo($_FILES['fileexcel']['name']);

        $allowedExtension = ['xlsx', 'xls'];
        if (!in_array($file['extension'], $allowedExtension)) {
            $pesan_data = array('pesan' => 'File extension yang diijinkan .xlsx .xls ...');
            echo json_encode($pesan_data); 
            die;
        }

        if ($file['extension'] == 'xlsx') {
            $reader = PHPExcel_IOFactory::createReader('Excel2007');
        } else {
            $reader = PHPExcel_IOFactory::createReader('Excel5');
        }

        $reader->setReadDataOnly(true);
        $excel = $reader->load($_FILES['fileexcel']['tmp_name']);

        $sheetNames = $excel->getSheetNames()[0];
        $worksheet = $excel->getSheet(0);
        $rows = $worksheet->toArray();

        $pesan_data = array(
            'msg' => 'Ya',
            'data' => $rows,
            'name_sheet_excel' => $sheetNames
        );

        echo json_encode($pesan_data); 
    }


    function c_simpan_incontainer_temporary(){

        $DataExcel = $this->input->post('DataExcel') ;

        $this->dbpjt->select('IFNULL(MAX(id_container_in), 0) + 1 as id_container_in');
        $id_container_in = $this->dbpjt->get('tbl_pjt_container_in')->row()->id_container_in; 

        $this->dbpjt->select('IFNULL(MAX(id_container_in_detail), 0) + 1 as id_container_in_detail');
        $id_container_in_detail = $this->dbpjt->get('tbl_pjt_container_in_detail')->row()->id_container_in_detail; 

        $pbm = "" ;
        $no_master_bl = "" ;
        $tgl_master_bl = "" ;
        $no_container = "" ;
        $size = "" ;
        $tgl_container_in = "" ;
        $jam_masuk = "" ;
        $no_surat_plp = "" ;
        $tgl_surat_plp = "" ;
        $no_plp = "" ;
        $tgl_plp = "" ;
        $vessel = "" ;
        $voyage = "" ;
        $call_sign = "" ;
        $tgl_tiba = "" ;
        $no_bc11 = "" ;
        $tgl_bc11 = "" ;


        $arraydata = array();
        for($a=1 ; $a < count($DataExcel)  ; $a++){
            $arrytemp = array();

            $detecthead = 0 ;

            if($a==1){

                $pbm = $DataExcel[$a][1] ;
                $no_master_bl = $DataExcel[$a][2] ;
                $tgl_master_bl = $DataExcel[$a][3] ;
                $no_container = $DataExcel[$a][4] ;
                $size = $DataExcel[$a][5] ;
                $tgl_container_in = $DataExcel[$a][6] ;
                $jam_masuk = $DataExcel[$a][7] ;
                $no_surat_plp = $DataExcel[$a][8] ;
                $tgl_surat_plp = $DataExcel[$a][9] ;
                $no_plp = $DataExcel[$a][10] ;
                $tgl_plp = $DataExcel[$a][11] ;
                $vessel = $DataExcel[$a][12] ;
                $voyage = $DataExcel[$a][13] ;
                $call_sign = $DataExcel[$a][14] ;
                $tgl_tiba = $DataExcel[$a][15] ;
                $no_bc11 = $DataExcel[$a][16] ;
                $tgl_bc11 = $DataExcel[$a][17] ;

            }else{


                // $pesan_data = array(
                //     'msg' => 'Tidak',
                //     'pesan' => 'Format Data Header Tidak Sesuai',
                //     'DataExcel' => $DataExcel,
                //     'a' => $a
                // );

                // echo json_encode($pesan_data); die;

                if($DataExcel[$a][1] == "" || $DataExcel[$a][2] == "" || $DataExcel[$a][3] == ""){
                    break;
                }


                if($pbm != $DataExcel[$a][1]){$detecthead = 1 ;}

                if($no_master_bl != $DataExcel[$a][2]){$detecthead = 1 ;}

                if($tgl_master_bl != $DataExcel[$a][3]){$detecthead = 1 ;}

                if($no_container != $DataExcel[$a][4]){$detecthead = 1 ;}

                if($size != $DataExcel[$a][5]){$detecthead = 1 ;}

                if($tgl_container_in != $DataExcel[$a][6]){$detecthead = 1 ;}

                if($jam_masuk != $DataExcel[$a][7]){$detecthead = 1 ;}

                if($no_surat_plp != $DataExcel[$a][8]){$detecthead = 1 ;}

                if($tgl_surat_plp != $DataExcel[$a][9]){$detecthead = 1 ;}

                if($no_plp != $DataExcel[$a][10]){$detecthead = 1 ;}

                if($tgl_plp != $DataExcel[$a][11]){$detecthead = 1 ;}

                if($vessel != $DataExcel[$a][12]){$detecthead = 1 ;}

                if($voyage != $DataExcel[$a][13]){$detecthead = 1 ;}

                if($call_sign != $DataExcel[$a][14]){$detecthead = 1 ;}

                if($tgl_tiba != $DataExcel[$a][15]){$detecthead = 1 ;}

                if($no_bc11 != $DataExcel[$a][16]){$detecthead = 1 ;}

                if($tgl_bc11 != $DataExcel[$a][17]){$detecthead = 1 ;}


            }


            if($detecthead > 0){
                $pesan_data = array(
                    'msg' => 'Tidak',
                    'pesan' => 'Format Data Header Tidak Sesuai',
                );

                echo json_encode($pesan_data); die;
            }

            $pbm = $DataExcel[$a][1] ;
            $no_master_bl = $DataExcel[$a][2] ;
            $tgl_master_bl = $DataExcel[$a][3] ;
            $no_container = $DataExcel[$a][4] ;
            $size = $DataExcel[$a][5] ;
            $tgl_container_in = $DataExcel[$a][6] ;
            $jam_masuk = $DataExcel[$a][7] ;
            $no_surat_plp = $DataExcel[$a][8] ;
            $tgl_surat_plp = $DataExcel[$a][9] ;
            $no_plp = $DataExcel[$a][10] ;
            $tgl_plp = $DataExcel[$a][11] ;
            $vessel = $DataExcel[$a][12] ;
            $voyage = $DataExcel[$a][13] ;
            $call_sign = $DataExcel[$a][14] ;
            $tgl_tiba = $DataExcel[$a][15] ;
            $no_bc11 = $DataExcel[$a][16] ;
            $tgl_bc11 = $DataExcel[$a][17] ;

            $whereHead = array(
                'pbm' => trim($pbm),
                'no_master_bl' => trim($no_master_bl),
                'tgl_master_bl' => date_db(trim($tgl_master_bl)),
                'no_container' => trim($no_container),
                'size' => trim($size),
                'tgl_container_in' => date_db(trim($tgl_container_in)),
                'jam_masuk' => substr($jam_masuk, 0, 2).":".substr($jam_masuk, 2, 2),
                'no_surat_plp' => trim($no_surat_plp),
                'tgl_surat_plp' => date_db(trim($tgl_surat_plp)),
                'no_plp' => trim($no_plp),
                'tgl_plp' => date_db(trim($tgl_plp)),
                'vessel' => trim($vessel),
                'voyage' => trim($voyage),
                'call_sign' => trim($call_sign),
                'tgl_tiba' => date_db(trim($tgl_tiba)),
                'no_bc11' => trim($no_bc11),
                'tgl_bc11' => date_db(trim($tgl_bc11)),
                'flag_data' => 0
            );
            if($this->dbpjt->get_where('tbl_pjt_container_in',$whereHead)->num_rows() > 0){
                $pesan_data = array(
                    'msg' => 'Tidak',
                    'pesan' => 'Data Container In Sudah Ada...!!',
                    'query' => $this->dbpjt->last_query()
                );

                echo json_encode($pesan_data); die;
            }

            $tgl_stripping = CheckValidDate(trim($DataExcel[$a][19]),"Tgl Stripping") ;
            if($tgl_stripping != "ok"){
                $pesan_data = array(
                    'msg' => 'Tidak',
                    'pesan' => $tgl_stripping ,
                );

                echo json_encode($pesan_data); die;
            }
            $tgl_stripping = date_db(trim($DataExcel[$a][19]));

            $no_box_marking = trim($DataExcel[$a][20]) ;
            if($no_box_marking == ""){
                $pesan_data = array(
                    'msg' => 'Tidak',
                    'pesan' => 'No Box Marking Tidak Boleh Kosong..!!' ,
                );

                echo json_encode($pesan_data); die;
            }

            $jumlah = trim($DataExcel[$a][22]) ;
            if($jumlah == ""){
                $pesan_data = array(
                    'msg' => 'Tidak',
                    'pesan' => 'Jumlah Packing Tidak Boleh Kosong..!!' ,
                );

                echo json_encode($pesan_data); die;
            }
            $berat = 0 ;
            if(trim($DataExcel[$a][23])  != ""){
                $berat = trim($DataExcel[$a][23]) ;
            }

            $arrytemp = array(
                'id_container_in' => $id_container_in,
                'id_container_in_detail' => $id_container_in_detail,
                'no_box_marking' => $no_box_marking,
                'consignee' => trim($DataExcel[$a][21]),
                'tgl_stripping' => $tgl_stripping,
                'jumlah' => $jumlah,
                'berat' => $berat,
                'volume' => floatval(trim($DataExcel[$a][24])),
                'created_on' => tanggal_sekarang(),
                'created_by' => $this->session->userdata('t_username'),
            );

            array_push($arraydata, $arrytemp) ;
            $id_container_in_detail++ ;
        }

        //menyiapkan table dummy tbl_pjt_container_in_detail untuk test input data
        $this->m_function->goto_temporary_out('tbl_pjt_container_in_detail_'.$this->session->userdata('t_username'));
        $this->dbpjt->query('CREATE TABLE testmsa.tbl_pjt_container_in_detail_'.$this->session->userdata('t_username').' LIKE db_pjt.tbl_pjt_container_in_detail');

        $exebatch = $this->dbpjt->insert_batch('testmsa.tbl_pjt_container_in_detail_'.$this->session->userdata('t_username'), $arraydata);
        if(!$exebatch >= 1){
            $pesan_data = array(
                'msg' => 'Tidak',
                'pesan' => 'Test Insert Detail Ke Temporary Gagal...',
                'query' => $this->dbpjt->last_query()
            );
            echo json_encode($pesan_data); die;
        }

        //menyiapkan table dummy tbl_pjt_container_in untuk test input data
        $this->m_function->goto_temporary_out('tbl_pjt_container_in_'.$this->session->userdata('t_username'));
        $this->dbpjt->query('CREATE TABLE testmsa.tbl_pjt_container_in_'.$this->session->userdata('t_username').' LIKE db_pjt.tbl_pjt_container_in');

        $tgl_master_blx = CheckValidDate(trim($tgl_master_bl),"Tgl Master BL") ;
        if($tgl_master_blx != "ok"){
            $pesan_data = array(
                'msg' => 'Tidak',
                'pesan' => $tgl_master_blx ,
            );
            echo json_encode($pesan_data); die;
        }
        $tgl_master_bl = date_db(trim($tgl_master_bl)) ;

        $tgl_container_inx = CheckValidDate(trim($tgl_container_in),"Tgl Container In") ;
        if($tgl_container_inx != "ok"){
            $pesan_data = array(
                'msg' => 'Tidak',
                'pesan' => $tgl_container_inx ,
            );
            echo json_encode($pesan_data); die;
        }
        $tgl_container_in = date_db(trim($tgl_container_in)) ;
        
        $tgl_surat_plpx = CheckValidDate(trim($tgl_surat_plp),"Tgl Surat PLP") ;
        if($tgl_surat_plpx != "ok"){
            $pesan_data = array(
                'msg' => 'Tidak',
                'pesan' => $tgl_surat_plpx ,
            );
            echo json_encode($pesan_data); die;
        }
        $tgl_surat_plp = date_db(trim($tgl_surat_plp)) ;

        $tgl_plpx = CheckValidDate(trim($tgl_plp),"Tgl PLP") ;
        if($tgl_plpx != "ok"){
            $pesan_data = array(
                'msg' => 'Tidak',
                'pesan' => $tgl_plpx ,
            );
            echo json_encode($pesan_data); die;
        }
        $tgl_plp = date_db(trim($tgl_plp)) ;

        $tgl_tibax = CheckValidDate(trim($tgl_tiba),"Tgl Tiba") ;
        if($tgl_tibax != "ok"){
            $pesan_data = array(
                'msg' => 'Tidak',
                'pesan' => $tgl_tibax ,
            );
            echo json_encode($pesan_data); die;
        }
        $tgl_tiba = date_db(trim($tgl_tiba)) ;

        $tgl_bc11x = CheckValidDate(trim($tgl_bc11),"Tgl BC11") ;
        if($tgl_bc11x != "ok"){
            $pesan_data = array(
                'msg' => 'Tidak',
                'pesan' => $tgl_bc11x ,
            );
            echo json_encode($pesan_data); die;
        }
        $tgl_bc11 = date_db(trim($tgl_bc11)) ;

        $jam_masukx = CheckValidTime(trim($jam_masuk),"Jam Masuk") ;
        if($jam_masukx != "ok"){
            $pesan_data = array(
                'msg' => 'Tidak',
                'pesan' => $jam_masukx ,
            );
            echo json_encode($pesan_data); die;
        }
        $jam_masuk = substr($jam_masuk, 0, 2).":".substr($jam_masuk, 2, 2) ;

        $arrayH = array(
            'id_container_in' => $id_container_in,
            'pbm' => $pbm,
            'no_master_bl' => $no_master_bl,
            'tgl_master_bl' => $tgl_master_bl,
            'no_container' => $no_container,
            'size' => $size,
            'tgl_container_in' => $tgl_container_in,
            'jam_masuk' => $jam_masuk,
            'no_surat_plp' => $no_surat_plp,
            'tgl_surat_plp' =>$tgl_surat_plp,
            'no_plp' => $no_plp,
            'tgl_plp' => $tgl_plp,
            'vessel' => $vessel,
            'voyage' => $voyage,
            'call_sign' => $call_sign,
            'tgl_tiba' => $tgl_tiba,
            'no_bc11' => $no_bc11,
            'tgl_bc11' => $tgl_bc11,
            'created_on' => tanggal_sekarang(),
            'created_by' => $this->session->userdata('t_username'),
        );

        $exebatch = $this->dbpjt->insert('testmsa.tbl_pjt_container_in_'.$this->session->userdata('t_username'), $arrayH);
        if(!$exebatch >= 1){
            $pesan_data = array(
                'msg' => 'Tidak',
                'pesan' => 'Test Insert Header Ke Temporary Gagal...',
                'query' => $this->dbpjt->last_query()
            );
            echo json_encode($pesan_data); die;
        }


        $pesan_data = array(
            'msg' => 'Ya',
            'arraydata' => $arraydata,
            'pesan' => 'Insert Detail Temporary Berhasil...',
        );

        echo json_encode($pesan_data); 

    }


    function c_simpan_incontainer(){

        $DataExcel = $this->input->post('DataExcel') ;

        $this->dbpjt->select('IFNULL(MAX(id_container_in), 0) + 1 as id_container_in');
        $id_container_in = $this->dbpjt->get('tbl_pjt_container_in')->row()->id_container_in; 

        //mencari id detail manifest
        $this->dbpjt->select('IFNULL(MAX(id_container_in_detail), 0) + 1 as id_container_in_detail');
        $id_container_in_detail = $this->dbpjt->get('tbl_pjt_container_in_detail')->row()->id_container_in_detail; 

        $pbm = "" ;
        $no_master_bl = "" ;
        $tgl_master_bl = "" ;
        $no_container = "" ;
        $size = "" ;
        $tgl_container_in = "" ;
        $jam_masuk = "" ;
        $no_surat_plp = "" ;
        $tgl_surat_plp = "" ;
        $no_plp = "" ;
        $tgl_plp = "" ;
        $vessel = "" ;
        $voyage = "" ;
        $call_sign = "" ;
        $tgl_tiba = "" ;
        $no_bc11 = "" ;
        $tgl_bc11 = "" ;


        $arraydata = array();
        for($a=1 ; $a < count($DataExcel)  ; $a++){
            $arrytemp = array();

            $pbm = $DataExcel[$a][1] ;
            $no_master_bl = $DataExcel[$a][2] ;
            $tgl_master_bl = $DataExcel[$a][3] ;
            $no_container = $DataExcel[$a][4] ;
            $size = $DataExcel[$a][5] ;
            $tgl_container_in = $DataExcel[$a][6] ;
            $jam_masuk = $DataExcel[$a][7] ;
            $no_surat_plp = $DataExcel[$a][8] ;
            $tgl_surat_plp = $DataExcel[$a][9] ;
            $no_plp = $DataExcel[$a][10] ;
            $tgl_plp = $DataExcel[$a][11] ;
            $vessel = $DataExcel[$a][12] ;
            $voyage = $DataExcel[$a][13] ;
            $call_sign = $DataExcel[$a][14] ;
            $tgl_tiba = $DataExcel[$a][15] ;
            $no_bc11 = $DataExcel[$a][16] ;
            $tgl_bc11 = $DataExcel[$a][17] ;


            $tgl_stripping = date_db(trim($DataExcel[$a][19]));

            $no_box_marking = trim($DataExcel[$a][20]) ;

            $jumlah = trim($DataExcel[$a][22]) ;

            $berat = 0 ;
            if(trim($DataExcel[$a][23])  != ""){
                $berat = trim($DataExcel[$a][23]) ;
            }

            $arrytemp = array(
                'id_container_in' => $id_container_in,
                'id_container_in_detail' => $id_container_in_detail,
                'no_box_marking' => $no_box_marking,
                'consignee' => trim($DataExcel[$a][21]),
                'tgl_stripping' => $tgl_stripping,
                'jumlah' => $jumlah,
                'berat' => $berat,
                'volume' => floatval(trim($DataExcel[$a][24])),
                'created_on' => tanggal_sekarang(),
                'created_by' => $this->session->userdata('t_username'),
            );

            array_push($arraydata, $arrytemp) ;
            $id_container_in_detail++ ;
        }

        $exebatch = $this->dbpjt->insert_batch('tbl_pjt_container_in_detail', $arraydata);
        if(!$exebatch >= 1){
            $pesan_data = array(
                'msg' => 'Tidak',
                'pesan' => 'Insert Data Detail Gagal...',
                'query' => $this->dbpjt->last_query()
            );
            echo json_encode($pesan_data); die;
        }

        $tgl_master_bl = date_db(trim($tgl_master_bl)) ;

        $tgl_container_in = date_db(trim($tgl_container_in)) ;
        
        $tgl_surat_plp = date_db(trim($tgl_surat_plp)) ;

        $tgl_plp = date_db(trim($tgl_plp)) ;

        $tgl_tiba = date_db(trim($tgl_tiba)) ;

        $tgl_bc11 = date_db(trim($tgl_bc11)) ;

        $jam_masuk = substr($jam_masuk, 0, 2).":".substr($jam_masuk, 2, 2) ;

        $arrayH = array(
            'id_container_in' => $id_container_in,
            'pbm' => $pbm,
            'no_master_bl' => $no_master_bl,
            'tgl_master_bl' => $tgl_master_bl,
            'no_container' => $no_container,
            'size' => $size,
            'tgl_container_in' => $tgl_container_in,
            'jam_masuk' => $jam_masuk,
            'no_surat_plp' => $no_surat_plp,
            'tgl_surat_plp' =>$tgl_surat_plp,
            'no_plp' => $no_plp,
            'tgl_plp' => $tgl_plp,
            'vessel' => $vessel,
            'voyage' => $voyage,
            'call_sign' => $call_sign,
            'tgl_tiba' => $tgl_tiba,
            'no_bc11' => $no_bc11,
            'tgl_bc11' => $tgl_bc11,
            'created_on' => tanggal_sekarang(),
            'created_by' => $this->session->userdata('t_username'),
        );

        $exebatch = $this->dbpjt->insert('tbl_pjt_container_in', $arrayH);
        if(!$exebatch >= 1){
            $pesan_data = array(
                'msg' => 'Tidak',
                'pesan' => 'Insert Data Header Gagal...',
                'query' => $this->dbpjt->last_query()
            );
            echo json_encode($pesan_data); die;
        }


        $pesan_data = array(
            'msg' => 'Ya',
            'arraydata' => $arraydata,
            'arrayH' => $arrayH,
        );

        echo json_encode($pesan_data); 

    }

    

}