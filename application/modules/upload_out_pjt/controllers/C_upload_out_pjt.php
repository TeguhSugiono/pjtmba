<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class C_upload_out_pjt extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('t_logged') <> 1) {
            redirect(site_url('login'));
        }
        $this->dbpjt = $this->load->database('db_pjt', TRUE);
    }

    function index(){

        // $Qdet = "" ;

        // $queryUpload = " SELECT a.no_do,b.no_box_marking,b.tgl_out,a.id_container_in ,a.id_upload
        //     from tbl_pjt_out_upload a 
        //     INNER JOIN tbl_pjt_out_upload_detail b on a.id_upload=b.id_upload
        //     where a.flag_data=0 and b.flag_data=0 ";




        // $queryUpload.= " and  b.tgl_out >= '2024-01-01' " ;


      


        // $queryUpload.= " and  b.tgl_out <= '2024-12-31' " ;

        // $Qdet.= $queryUpload ;
        // $Qdet.= " ORDER BY a.id_upload " ;



        // $queryUpload.= " GROUP BY a.id_upload  order by b.no_box_marking " ;

        // $dataH = $this->dbpjt->query($queryUpload);


        
        // $this->dbpjt->select('IFNULL(MAX(id_out), 0) + 1 as id_out');
        // $id_out = $this->dbpjt->get('tbl_pjt_container_out')->row()->id_out; 

        // $this->dbpjt->select('IFNULL(MAX(id_out_detail), 0) + 1 as id_out_detail');
        // $id_out_detail = $this->dbpjt->get('tbl_pjt_container_out_detail')->row()->id_out_detail; 


        // $arrayBatchHeader = array();
        // $arrayBatchDetail = array();

        // $noH = 0 ;
        // $noD = 0 ;



        // foreach($dataH->result_array() as $resDataH){
            
        //     //Data out Header
        //     $arrayTempHeader = array();
        //     $arrayTempHeader = array(
        //         'id_out' => $id_out,
        //         'id_container_in' => $resDataH['id_container_in'],
        //         'no_do' => $resDataH['no_do'],
        //         'created_on' => tanggal_sekarang(),
        //         'created_by' => $this->session->userdata('t_username')
        //     );


        //     //Data Out Detail
            

            

        //     $dataD = $this->dbpjt->query($Qdet);

        //     if($dataD->num_rows() == 0){
        //         $pesan_data = array(
        //             'msg' => 'Tidak',
        //             'pesan' => 'Tidak Ditemukan Data Detail Yang Akan DiProses..!!'
        //         );
        //         echo json_encode($pesan_data); die;
        //     }else{


        //         foreach($dataD->result_array() as $resDataD){

        //             $arrayTempDetail = array();

        //             $arrayTempDetail = array(
        //                 'id_out' => $id_out,
        //                 'id_out_detail' => $id_out_detail,
        //                 'no_box_marking' => $resDataD['no_box_marking'],
        //                 'created_on' => tanggal_sekarang(),
        //                 'created_by' => $this->session->userdata('t_username')
        //             );

        //             array_push($arrayBatchDetail,$arrayTempDetail) ;

        //             //$noD++;
        //             $id_out_detail++;
        //         }


        //     }

            
        //     array_push($arrayBatchHeader,$arrayTempHeader) ;


        //     $id_out++;

        // }


        // print("<pre>".print_r($arrayBatchDetail,true)."</pre>"); die;















        // $queryUpload = " SELECT a.no_do,b.no_box_marking,b.tgl_out,a.id_container_in 
        //     from tbl_pjt_out_upload a 
        //     INNER JOIN tbl_pjt_out_upload_detail b on a.id_upload=b.id_upload
        //     where a.flag_data=0 and b.flag_data=0 
        //     and date_format(a.created_on,'%Y-%m-%d') >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) order by b.no_box_marking " ;


        // $queryCheck = " SELECT a.no_do,b.no_box_marking,b.tgl_check,a.id_container_in
        //     FROM tbl_pjt_out_check a 
        //     INNER JOIN tbl_pjt_out_check_detail b on a.id_check=b.id_check
        //     where a.flag_data=0 and b.flag_data=0 
        //     and date_format(a.created_on,'%Y-%m-%d') >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) order by b.no_box_marking " ;


        // $dataUpload = $this->dbpjt->query($queryUpload);
        // $dataCheck = $this->dbpjt->query($queryCheck);

        // $matching_no_box_marking = [];

        // // Looping array pertama
        // foreach ($dataUpload->result_array() as $item1) {
        //     // Looping array kedua
        //     foreach ($dataCheck->result_array() as $item2) {
        //         // Jika no_box_marking sama, tambahkan ke dalam array hasil
        //         if ($item1['no_box_marking'] === $item2['no_box_marking']) {
        //             $matching_no_box_marking[] = $item1['no_box_marking'];
        //         }
        //     }
        // }

        // print("<pre>".print_r($this->m_function->ArrayToInSql($matching_no_box_marking),true)."</pre>"); die;


        $data = array(
            'content' => 'view',
        );

        $this->load->view('dashboard/index', $data);
    }


    function c_fetch_table(){

        $Tgl_Out_Start = $this->input->post('Tgl_Out_Start');
        $Tgl_Out_End = $this->input->post('Tgl_Out_End');
        $NoCont = $this->input->post('NoCont');


        $query = " SELECT a.id_upload,a.id_container_in,a.no_do,(select GetNoContainer(a.id_container_in)) 'no_container',   " ;
        $query.= " date_format(b.tgl_out,'%d-%m-%Y') 'tgl_out', " ;
        $query.= " (SELECT GetSumBoxIn(a.id_container_in)) 'JmlBox', " ;
        $query.= " (SELECT GetSumBoxOut(a.id_container_in)) 'JmlBoxOut' " ;
        $query.= " FROM tbl_pjt_out_upload a " ;
        $query.= " INNER JOIN tbl_pjt_out_upload_detail b on a.id_upload=b.id_upload " ;
        $query.= " where a.flag_data=0 and b.flag_data=0  " ;

        if($Tgl_Out_Start != ""){
            $query.= " and b.tgl_out >= '".date_db($Tgl_Out_Start)."'" ;
        }

        if($Tgl_Out_End != ""){
            $query.= " and b.tgl_out <= '".date_db($Tgl_Out_End)."'" ;
        }

        if($NoCont != ""){
            $query.= " and (select GetNoContainer(a.id_container_in)) like'%".$NoCont."%'" ;
        }

        $query.= " GROUP BY a.id_upload,a.no_do,b.tgl_out " ;
        $query.= " order by a.id_upload desc " ;

        echo json_encode($this->dbpjt->query($query)->result_array());
    }


    function c_upload_out_container(){
        $this->load->view('upload_out_container');
    }


    function c_proses_upload_outcontainer() {
        
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


    function c_simpan_outcontainer_temporary(){

        $DataExcel = $this->input->post('DataExcel') ;

        $this->dbpjt->select('IFNULL(MAX(id_upload), 0) + 1 as id_upload');
        $id_upload = $this->dbpjt->get('tbl_pjt_out_upload')->row()->id_upload; 


        $this->dbpjt->select('IFNULL(MAX(id_upload_detail), 0) + 1 as id_upload_detail');
        $id_upload_detail = $this->dbpjt->get('tbl_pjt_out_upload_detail')->row()->id_upload_detail; 

        $no_do = trim($DataExcel[0][2]) ; 

        if($no_do == ""){
            $pesan_data = array(
                'msg' => 'Tidak',
                'pesan' => 'No MBL Tidak Boleh Kosong..!!' ,
            );

            echo json_encode($pesan_data); die; 
        }

        $no_container = trim($DataExcel[1][2]) ; 
        if($no_container == ""){
            $pesan_data = array(
                'msg' => 'Tidak',
                'pesan' => 'No Container Tidak Boleh Kosong..!!' ,
            );

            echo json_encode($pesan_data); die; 
        }


        //cek data kontainer in
        $where = array(
            'no_container' => $no_container,
            'flag_data' => 0
        );

        $datain = $this->dbpjt->get_where('tbl_pjt_container_in',$where);
        if($datain->num_rows() == 0 ){
            $pesan_data = array(
                'msg' => 'Tidak',
                'pesan' => 'No Container Tidak Ada Di Stock Atau Data In Container..!!' ,
            );

            echo json_encode($pesan_data); die; 
        }

        $id_container_in = "" ;
        foreach($datain->result_array() as $indata) {
            $id_container_in = $indata['id_container_in'] ;
        }

        if($this->dbpjt->get_where('tbl_pjt_out_upload',array('no_do' => $no_do,'id_container_in' => $id_container_in,'flag_data' => 0))->num_rows() > 0){
            $pesan_data = array(
                'msg' => 'Tidak',
                'pesan' => 'Data Container ini Sudah Ada di Upload Keluar Container...!!',
                'query' => $this->dbpjt->last_query()
            );

            echo json_encode($pesan_data); die;
        }

        $arrH = array(
            'id_upload' => $id_upload,
            'id_container_in' => $id_container_in,
            'no_do' => $no_do,
            'created_on' => tanggal_sekarang(),
            'created_by' => $this->session->userdata('t_username'),
        );

        $this->m_function->goto_temporary_out('tbl_pjt_out_upload_'.$this->session->userdata('t_username'));
        $this->dbpjt->query('CREATE TABLE testmsa.tbl_pjt_out_upload_'.$this->session->userdata('t_username').' LIKE db_pjt.tbl_pjt_out_upload');

        $exebatch = $this->dbpjt->insert('testmsa.tbl_pjt_out_upload_'.$this->session->userdata('t_username'), $arrH);
        if(!$exebatch >= 1){
            $pesan_data = array(
                'msg' => 'Tidak',
                'pesan' => 'Test Insert Header Ke Temporary Gagal...',
                'query' => $this->dbpjt->last_query()
            );
            echo json_encode($pesan_data); die;
        }



        $arraydata = array();
        for($a=3 ; $a < count($DataExcel)  ; $a++){

            if(trim($DataExcel[$a][1]) == "" || trim($DataExcel[$a][2]) == "" ){
                break;
            }



            $arrytemp = array();

            $no_box_marking = trim($DataExcel[$a][1]) ;
            

            if($no_box_marking == ""){
                $pesan_data = array(
                    'msg' => 'Tidak',
                    'pesan' => 'No Box Marking Tidak Boleh Kosong..!!' ,
                );

                echo json_encode($pesan_data); die; 
            }else{

                $datacn = $this->dbpjt->get_where('tbl_pjt_container_in_detail',array('flag_data' => 0,'flag_keluar' => 0,'no_box_marking' => $no_box_marking));

                if($datacn->num_rows() == 0){

                    $pesan_data = array(
                        'msg' => 'Tidak',
                        'pesan' => 'No Box Marking '.$no_box_marking.' Tidak Ada Di Stock Atau Data In Container..!!' ,
                    );

                    echo json_encode($pesan_data); die; 

                }


            }   

            $tgl_out = CheckValidDate(trim($DataExcel[$a][2]),"Tgl Out") ;
            if($tgl_out != "ok"){
                $pesan_data = array(
                    'msg' => 'Tidak',
                    'pesan' => $tgl_out ,
                );

                echo json_encode($pesan_data); die;
            }
            $tgl_out = date_db(trim($DataExcel[$a][2]));

            

            $arrytemp = array(
                'id_upload' => $id_upload,
                'id_upload_detail' => $id_upload_detail,
                'no_box_marking' => $no_box_marking,
                'tgl_out' => $tgl_out,
                'created_on' => tanggal_sekarang(),
                'created_by' => $this->session->userdata('t_username'),
            );
            

            array_push($arraydata, $arrytemp) ;
            $id_upload_detail++ ;

        }


        $this->m_function->goto_temporary_out('tbl_pjt_out_upload_detail_'.$this->session->userdata('t_username'));
        $this->dbpjt->query('CREATE TABLE testmsa.tbl_pjt_out_upload_detail_'.$this->session->userdata('t_username').' LIKE db_pjt.tbl_pjt_out_upload_detail');

        $exebatch = $this->dbpjt->insert_batch('testmsa.tbl_pjt_out_upload_detail_'.$this->session->userdata('t_username'), $arraydata);
        if(!$exebatch >= 1){
            $pesan_data = array(
                'msg' => 'Tidak',
                'pesan' => 'Test Insert Detail Ke Temporary Gagal...',
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


    function c_simpan_outcontainer(){

        $DataExcel = $this->input->post('DataExcel') ;

        $this->dbpjt->select('IFNULL(MAX(id_upload), 0) + 1 as id_upload');
        $id_upload = $this->dbpjt->get('tbl_pjt_out_upload')->row()->id_upload; 


        $this->dbpjt->select('IFNULL(MAX(id_upload_detail), 0) + 1 as id_upload_detail');
        $id_upload_detail = $this->dbpjt->get('tbl_pjt_out_upload_detail')->row()->id_upload_detail; 

        $no_do = trim($DataExcel[0][2]) ; 

        $no_container = trim($DataExcel[1][2]) ; 

        //cek data kontainer in
        $where = array(
            'no_container' => $no_container,
            'flag_data' => 0
        );

        $datain = $this->dbpjt->get_where('tbl_pjt_container_in',$where);

        $id_container_in = "" ;
        foreach($datain->result_array() as $indata) {
            $id_container_in = $indata['id_container_in'] ;
        }

        $arrH = array(
            'id_upload' => $id_upload,
            'id_container_in' => $id_container_in,
            'no_do' => $no_do,
            'created_on' => tanggal_sekarang(),
            'created_by' => $this->session->userdata('t_username'),
        );

        $exebatch = $this->dbpjt->insert('tbl_pjt_out_upload', $arrH);
        if(!$exebatch >= 1){
            $pesan_data = array(
                'msg' => 'Tidak',
                'pesan' => 'Insert Header Gagal...',
                'query' => $this->dbpjt->last_query()
            );
            echo json_encode($pesan_data); die;
        }


        $arraydata = array();
        for($a=3 ; $a < count($DataExcel)  ; $a++){

            if(trim($DataExcel[$a][1]) == "" || trim($DataExcel[$a][2]) == "" ){
                break;
            }

            $arrytemp = array();

            $no_box_marking = trim($DataExcel[$a][1]) ;

            $tgl_out = date_db(trim($DataExcel[$a][2]));


            $arrytemp = array(
                'id_upload' => $id_upload,
                'id_upload_detail' => $id_upload_detail,
                'no_box_marking' => $no_box_marking,
                'tgl_out' => $tgl_out,
                'created_on' => tanggal_sekarang(),
                'created_by' => $this->session->userdata('t_username'),
            );
            

            array_push($arraydata, $arrytemp) ;
            $id_upload_detail++ ;

        }


        $exebatch = $this->dbpjt->insert_batch('tbl_pjt_out_upload_detail', $arraydata);
        if(!$exebatch >= 1){
            $pesan_data = array(
                'msg' => 'Tidak',
                'pesan' => 'Insert Detail Gagal...',
                'query' => $this->dbpjt->last_query()
            );
            echo json_encode($pesan_data); die;
        }



        $pesan_data = array(
            'msg' => 'Ya',
            //'arraydata' => $arraydata,
            'pesan' => 'Insert Data Out Berhasil...',
        );

        echo json_encode($pesan_data); 


    }


    function c_detailoutcontainer(){
        $id_upload = $this->input->post('id_upload') ;

        $comp = array(
            'id_upload' => $id_upload
        );

        $this->load->view('detail_out_container',$comp);
    }


    function c_fetch_table_detail(){
        $data_id_upload = $this->input->post('data_id_upload') ;

        $query = "  SELECT a.id_upload,a.id_upload_detail,a.no_box_marking,
                    DATE_FORMAT(a.tgl_out,'%d-%m-%Y') 'tgl_out'
                    FROM tbl_pjt_out_upload_detail a
                    INNER JOIN tbl_pjt_out_upload b on a.id_upload=b.id_upload
                    where a.flag_data <> 9 and b.flag_data <> 9  " ;

        $query.= " and a.id_upload='".$data_id_upload."' " ;

        $query.= " ORDER BY a.id_upload_detail " ;

        echo json_encode($this->dbpjt->query($query)->result_array());
    }

    function CekHeaderOut($no_do,$id_container_in){
        $cekdataout = $this->dbpjt->get_where('tbl_pjt_container_out',array('no_do' => $no_do , 'id_container_in' => $id_container_in));

        $head = array(
            'jmldata' => 0,
            'id_out' => '',
        ) ;

        if($cekdataout->num_rows() > 0){

            foreach($cekdataout->result_array() as $dt){
                $head = array(
                    'jmldata' => 1,
                    'id_out' => $dt['id_out'],
                ) ;
            }
        }

        return $head ;
    }

    function c_out_boxmarking(){

        $Tgl_Out_Start = $this->input->post('Tgl_Out_Start');
        $Tgl_Out_End = $this->input->post('Tgl_Out_End');
        
        $query = "  SELECT ifnull(GetBoxMarkingUpload('".date_db($Tgl_Out_Start)."','".date_db($Tgl_Out_End)."'),'') as StringBoxMarking " ;

        $StringBoxMarking = $this->dbpjt->query($query)->row()->StringBoxMarking ;

        if($StringBoxMarking != ""){

            $MatchBoxMarking =  " SELECT ifnull(GetBoxMarkingCheck('".$StringBoxMarking."'),'') as MatchBoxMarking " ;

            $StringMatchBoxMarking = $this->dbpjt->query($MatchBoxMarking)->row()->MatchBoxMarking ;

            if($StringMatchBoxMarking == ""){
                $pesan_data = array(
                    'msg' => 'Tidak',
                    'pesan' => 'Tidak Ditemukan Data Yang Sama Antara Data Upload dan Data Check..!!',
                ); echo json_encode($pesan_data); die;
            }


            //cek ke table
            $QueryInData = " SELECT a.id_container_in,b.no_box_marking  FROM tbl_pjt_container_in a 
                INNER JOIN tbl_pjt_container_in_detail b on a.id_container_in=b.id_container_in
                where a.flag_data=0 and b.flag_data=0 and b.flag_keluar=0 and b.no_box_marking in (".$StringMatchBoxMarking.")
                GROUP BY b.no_box_marking ORDER BY a.id_container_in  " ;

            $cekdataIn = $this->dbpjt->query($QueryInData);

            if($cekdataIn->num_rows() == 0){

                $pesan_data = array(
                    'msg' => 'Tidak',
                    'pesan' => 'Data Dengan Periode Tanggal ini Sudah Di Proses..!!',
                ); echo json_encode($pesan_data); die;

            }    

            $dataArrayIn = $this->m_function->query_to_tag_dimension($QueryInData,'dbpjt');
            

            $this->dbpjt->select('IFNULL(MAX(id_out), 0) + 1 as id_out');
            $id_out = $this->dbpjt->get('tbl_pjt_container_out')->row()->id_out; 

            $this->dbpjt->select('IFNULL(MAX(id_out_detail), 0) + 1 as id_out_detail');
            $id_out_detail = $this->dbpjt->get('tbl_pjt_container_out_detail')->row()->id_out_detail; 

            $qupload = "" ;
            $ArrayBatchDetail = array();
            $ArrayBatchHeader = array();
            $cekidupload = 0 ;
            $SetIdUpload = "" ;
            $IdUpload = "" ;

            $no_do = "" ;

            for($b=0 ; $b < count($dataArrayIn) ; $b++ ){

                $id_container_in = $dataArrayIn[$b]['id_container_in'] ;
                $no_box_marking = $dataArrayIn[$b]['no_box_marking'] ;

                $qupload = "    SELECT a.*,b.*,'end' as 'end' from tbl_pjt_out_upload a inner join tbl_pjt_out_upload_detail b on a.id_upload=b.id_upload
                                where a.flag_data=0 and b.flag_data=0 and a.id_container_in='".$id_container_in."'
                                and b.no_box_marking='".$no_box_marking."' GROUP BY b.no_box_marking   " ;

                $dataout = $this->dbpjt->query($qupload)->result_array();


                $arraytempdet = array();

                foreach($dataout as $dtout){


                    if($dtout['end'] == 'end'){

                    

                        $IdUpload = $dtout['id_upload'] ;
                        $no_do  = $dtout['no_do'] ;

                        $arrayOut = $this->CekHeaderOut($no_do,$id_container_in) ;

                        // $pesan_data = array(
                        //     'msg' => 'Tidak',
                        //     'pesan' => 'Test Insert Detail Ke Temporary Gagal...',
                        //     'arrayOut' => $arrayOut
                        // );
                        // echo json_encode($pesan_data); die;

                        if( intval($arrayOut['jmldata']) > 0 ){

                            // Jika Sudah ada headernya

                            $arraytempdet = array(
                                'id_out' => intval($arrayOut['id_out']),
                                'id_out_detail' => intval($id_out_detail),
                                'no_box_marking' => $no_box_marking,
                                'tgl_out' => $dtout['tgl_out'],
                                'created_on' => tanggal_sekarang(),
                                'created_by' => $this->session->userdata('t_username')
                            );

                            array_push($ArrayBatchDetail,$arraytempdet) ;

                            $id_out_detail++;

                        }else{



                            // Jika Belum ada headernya

                            if($cekidupload == 0){

                                $SetIdUpload = $IdUpload ;

                                $arraytempdet = array(
                                    'id_out' => $id_out,
                                    'id_out_detail' => intval($id_out_detail),
                                    'no_box_marking' => $no_box_marking,
                                    'tgl_out' => $dtout['tgl_out'],
                                    'created_on' => tanggal_sekarang(),
                                    'created_by' => $this->session->userdata('t_username')
                                );

                                array_push($ArrayBatchDetail,$arraytempdet) ;

                                $arraytemphed = array(
                                    'id_out' => intval($id_out),
                                    'created_on' => tanggal_sekarang(),
                                    'created_by' => $this->session->userdata('t_username'),
                                    'id_container_in' => $id_container_in,
                                    'no_do' => $no_do,

                                );

                                array_push($ArrayBatchHeader, $arraytemphed) ;

                                $id_out_detail++;
                                $cekidupload++;

                            }else{


                                if($SetIdUpload == $IdUpload){

                                    $arraytempdet = array(
                                        'id_out' => $id_out,
                                        'id_out_detail' => intval($id_out_detail),
                                        'no_box_marking' => $no_box_marking,
                                        'tgl_out' => $dtout['tgl_out'],
                                        'created_on' => tanggal_sekarang(),
                                        'created_by' => $this->session->userdata('t_username')
                                    );

                                    array_push($ArrayBatchDetail,$arraytempdet) ;

                                    $id_out_detail++;

                                }else{

                                    $id_out++;

                                    $arraytempdet = array(
                                        'id_out' => $id_out,
                                        'id_out_detail' => intval($id_out_detail),
                                        'no_box_marking' => $no_box_marking,
                                        'tgl_out' => $dtout['tgl_out'],
                                        'created_on' => tanggal_sekarang(),
                                        'created_by' => $this->session->userdata('t_username')
                                    );

                                    array_push($ArrayBatchDetail,$arraytempdet) ;

                                    $id_out_detail++;

                                    $SetIdUpload = $IdUpload ;

                                    $arraytemphed = array(
                                        'id_out' => intval($id_out),
                                        'created_on' => tanggal_sekarang(),
                                        'created_by' => $this->session->userdata('t_username'),
                                        'id_container_in' => $id_container_in,
                                        'no_do' => $no_do,

                                    );

                                    array_push($ArrayBatchHeader, $arraytemphed) ;


                                }



                            }

                            // end Jika Belum ada headernya
                            
                        }

                    }

                }


                
            }


            //menyiapkan table dummy tbl_pjt_container_out_detail untuk test input data
            $this->m_function->goto_temporary_out('tbl_pjt_container_out_detail_'.$this->session->userdata('t_username'));
            $this->dbpjt->query('CREATE TABLE testmsa.tbl_pjt_container_out_detail_'.$this->session->userdata('t_username').' LIKE db_pjt.tbl_pjt_container_out_detail');

            $exebatch = $this->dbpjt->insert_batch('testmsa.tbl_pjt_container_out_detail_'.$this->session->userdata('t_username'), $ArrayBatchDetail);
            if(!$exebatch >= 1){
                $pesan_data = array(
                    'msg' => 'Tidak',
                    'pesan' => 'Test Insert Detail Ke Temporary Gagal...',
                    'query' => $this->dbpjt->last_query()
                );
                echo json_encode($pesan_data); die;
            }


            if(count($ArrayBatchHeader) > 0){
                //menyiapkan table dummy tbl_pjt_container_out untuk test input data
                $this->m_function->goto_temporary_out('tbl_pjt_container_out_'.$this->session->userdata('t_username'));
                $this->dbpjt->query('CREATE TABLE testmsa.tbl_pjt_container_out_'.$this->session->userdata('t_username').' LIKE db_pjt.tbl_pjt_container_out');

                $exebatch = $this->dbpjt->insert_batch('testmsa.tbl_pjt_container_out_'.$this->session->userdata('t_username'), $ArrayBatchHeader);
                if(!$exebatch >= 1){
                    $pesan_data = array(
                        'msg' => 'Tidak',
                        'pesan' => 'Test Insert Header Ke Temporary Gagal...',
                        'query' => $this->dbpjt->last_query()
                    );
                    echo json_encode($pesan_data); die;
                }


                $exebatch = $this->dbpjt->insert_batch('tbl_pjt_container_out', $ArrayBatchHeader);

            }
                

            if(count($ArrayBatchDetail) > 0){
                for($p=0 ; $p < count($ArrayBatchDetail) ; $p++ ){

                    $exe = $this->db->update('tbl_pjt_container_in_detail', 
                        array('flag_keluar' => 1,'edited_by' => $this->session->userdata('t_username')." Out" , 'edited_on' => tanggal_sekarang()), 
                        array('no_box_marking' => $ArrayBatchDetail[$p]['no_box_marking']));

                    if(!$exe >= 1){
                        $pesan_data = array(
                            'msg' => 'Tidak',
                            'pesan' => 'Update Data In Detail No Box Marking Gagal..!!',
                            'query' => $this->dbpjt->last_query()
                        );
                        echo json_encode($pesan_data); die;
                    }

                }


                $exebatch = $this->dbpjt->insert_batch('tbl_pjt_container_out_detail', $ArrayBatchDetail);
            }
            


            $pesan_data = array(
                'msg' => 'Ya',
                'pesan' => 'Proses Out '.count($ArrayBatchDetail).' Data Sukses..',
                'StringBoxMarking' => $StringBoxMarking,
                'MatchBoxMarking' => $MatchBoxMarking,
                'StringMatchBoxMarking' => $StringMatchBoxMarking,
                'QueryInData' => $QueryInData,
                'query' => $this->dbpjt->last_query(),
                'qupload' => $qupload,
                'ArrayBatchDetail' => $ArrayBatchDetail,
                'ArrayBatchHeader' => $ArrayBatchHeader,
                //'dataArrayIn' => $dataArrayIn,
            );

            echo json_encode($pesan_data); die;














        }else{
            $pesan_data = array(
                'msg' => 'Tidak',
                'pesan' => 'Tidak Ditemukan Data Yang Akan DiProses..!!',
            ); echo json_encode($pesan_data); die;
        }

        

    }

}
        //$NoCont = $this->input->post('NoCont');
        // if($NoCont != ""){
        //     $ssql = "   SELECT a.id_container_in from tbl_pjt_container_in a 
        //             INNER JOIN tbl_pjt_container_in_detail b on a.id_container_in=b.id_container_in
        //             where a.flag_data=0 and b.flag_data=0 and b.flag_keluar=0 and a.no_container='".$NoCont."'
        //             GROUP BY a.id_container_in " ;
        //     $id_container_in = $this->dbpjt->query($ssql)->row()->id_container_in ;

        //     $queryUpload.= " and a.id_container_in ='".$id_container_in."' " ;
        // }