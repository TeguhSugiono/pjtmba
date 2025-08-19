<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class C_function extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('t_logged') <> 1) {
            redirect(site_url('login'));
        }
    }

    function c_GetPPn(){
        $tglinv = date_db($this->input->post('tglinv'));
        $data['jml_ppn'] = $this->m_function->get_ppn_used($tglinv)/100; 
        //return $data;
        echo json_encode($data);
    }

}