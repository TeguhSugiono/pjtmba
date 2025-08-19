<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_userlogin extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index($error = NULL){      

        $comp = array(
            'aksi'  => site_url("auth"), 
            'error' => $error,
        );
        
        $this->load->view('userlogin/view',$comp);
    }
    
    public function auth() {
        
        $username = $this->input->post('username');
        $password = $this->input->post('password');
                
        $where = array(
            'username' => $username,
            'password' => md5($password)
        );
        
        $ceklogin = $this->m_function->cek_data("tbl_user",$where);
        
        if ($ceklogin->num_rows() == 1) {

            //ambil username
            $data_login = $this->m_function->cek_data("tbl_user",$where)->row();

            //ambil path assets
            $path_assets = $this->m_function->cek_data("tbl_m_assets",array('path_assets !=' => '' , 'nm_web' => 'tppmsa'))->row()->path_assets;

            //daftarkan session
            $data = array(
                't_logged'        => TRUE,
                't_username'    => $data_login->username,
                't_userid'      => $data_login->id_user,
                't_group'      => $data_login->id_group,
                't_assets'   => $path_assets,
            );


            $this->session->set_userdata($data);        

            $this->m_function->drop_temporary();

            $this->db->query("CREATE TABLE IF NOT EXISTS `tbl_log_simpan_error`  (
              `id_error` int NOT NULL,
              `nomor_invoice` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
              `posisi_error` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
              `user_input` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
              PRIMARY KEY (`id_error`) USING BTREE
            ) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic " ) ;

            redirect(site_url("dashboard"));

        }else{
            $error = 'Username / Password salah';
            $this->index($error);
        }
    }
    
    function logout() {

        $this->m_function->drop_temporary();

        $this->session->unset_userdata('t_username');
        $this->session->unset_userdata('t_userid');
        $this->session->unset_userdata('t_logged');
        $this->session->unset_userdata('t_group');
        $this->session->unset_userdata('t_assets');

        //$this->session->sess_destroy();

        redirect(site_url());
    }
    
}
