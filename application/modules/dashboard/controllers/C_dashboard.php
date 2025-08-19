<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class C_dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('t_logged') <> 1) {            
            redirect(site_url('login'));
        }
        $this->dblogin = $this->load->database('db_login_tpp', TRUE);
    }
    
    public function index(){


        // $queryUpload = " SELECT a.no_do,b.no_box_marking,b.tgl_out 
        //     from tbl_pjt_out_upload a 
        //     INNER JOIN tbl_pjt_out_upload_detail b on a.id_upload=b.id_upload
        //     where a.flag_data=0 and b.flag_data=0 
        //     and date_format(a.created_on,'%Y-%m-%d') >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) order by b.no_box_marking limit 20 " ;


        // $queryCheck = " SELECT a.no_do,b.no_box_marking,b.tgl_check
        //     FROM tbl_pjt_out_check a 
        //     INNER JOIN tbl_pjt_out_check_detail b on a.id_check=b.id_check
        //     where a.flag_data=0 and b.flag_data=0 
        //     and date_format(a.created_on,'%Y-%m-%d') >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) order by b.no_box_marking  limit 20 " ;


        // $dataUpload = $this->dbpjt->query($queryUpload)->result_array();
        // $dataCheck = $this->dbpjt->query($queryCheck)->result_array();

        // $matching_no_box_marking = [];

        // // Looping array pertama
        // foreach ($dataUpload as $item1) {
        //     // Looping array kedua
        //     foreach ($dataCheck as $item2) {
        //         // Jika no_box_marking sama, tambahkan ke dalam array hasil
        //         if ($item1['no_box_marking'] === $item2['no_box_marking']) {
        //             $matching_no_box_marking[] = $item1['no_box_marking'];
        //         }
        //     }
        // }


        // print("<pre>".print_r($matching_no_box_marking,true)."</pre>");
        // // echo '<br><br>' ;
        // // print("<pre>".print_r($dataCheck,true)."</pre>");

        // die;


        $folder_content = $this->get_folder();
        redirect($folder_content);
    }
    
    public function get_folder(){
        $id_user = $this->session->userdata('t_userid') ;

        $id_home = $this->dblogin->query("SELECT id_home FROM v_menu where id_user='".$id_user."'")->row()->id_home;

        $folder_content = $this->dblogin->query("SELECT route FROM tbl_mn_menu where id_menu='".$id_home."'")->row()->route;
        //print_r($folder_content);
        return $folder_content;
        
        // $where = array(
        //     'a.id_user' => $id_user,
        //     'b.home'    => 'Ya',
        // );
        // $this->dblogin->select('c.route');
        // $this->dblogin->from('tbl_user as a');
        // $this->dblogin->join('tbl_akses_menu as b','a.id_user=b.id_user','inner');
        // $this->dblogin->join('tbl_mn_menu as c','b.id_menu=c.id_menu','inner');
        // $this->dblogin->where($where);
        // $this->dblogin->order_by('b.id_akses','asc');
        // $data = $this->dblogin->get()->result_array();
        // $folder_content = '' ;
        // foreach ($data as $row){
        //     $folder_content = $row['route'] ;
        // }
        // return $folder_content;
    }




}
