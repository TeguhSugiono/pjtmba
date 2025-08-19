<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>TPP.MSA</title>
        <link rel="shortcut icon" href="<?php echo base_url() . 'assets/icon/'; ?>MSA_Logo.bmp" />
        <link href="<?= site_url(); ?>assets/css/bootstrap.css" rel="stylesheet" />
        <link href="<?= site_url(); ?>assets/css/font-awesome.css" rel="stylesheet" />
        <link href="<?= site_url(); ?>assets/DataTables-1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?= site_url(); ?>assets/css/style.css" rel="stylesheet" />
        <link href="<?= site_url(); ?>assets/css/style_table.css" rel="stylesheet" />
        <link href="<?= site_url(); ?>assets/css/font-google.css" rel='stylesheet' type='text/css' />
        <link href="<?= base_url(); ?>assets/css/spinner.css" rel="stylesheet" type="text/css" />            
        <link href="<?= base_url(); ?>assets/datepicker/datepicker.min.css" rel="stylesheet"/>



        <style type="text/css">
            div.dataTables_wrapper {
                width: 100% !important;
                margin: 0 auto !important;
            }
            .bottom-margin-content{
                margin-top: -2% !important;
            }
            th { 
                font-size: 11px !important; 
            }
            td { font-size: 11px !important; }
            input:focus {
                background-color: #66f9ff !important;
            }    
            button:focus {
                background-color: #66f9ff !important;
            }
            select:focus {
                background-color: #66f9ff !important;
            } 
            
        </style>

    </head>
    <body>
        
        <div class="navbar navbar-inverse set-radius-zero" >
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= site_url(); ?>">
                        <div style="color: black;margin-top: 3%;text-align: center;font-weight: bold">
                            <p>TPP</p>
                            <p>PT. Multi Sejahtera Abadi</p>
                        </div>
                    </a>
                </div>

                <div class="right-div">
                    <a href="<?= site_url(); ?>logout" class="btn btn-info pull-right">LOGOUT</a>
                </div>
            </div>
        </div>
        
        <!-- Cari Akses Login -->
        <?php
        $this->dblogin = $this->load->database('db_login_tpp', TRUE);
        $menu_aktif = $this->uri->segment(1);

        $id_user = $this->session->userdata('t_userid');
        $this->dblogin->from('v_menu');
        $this->dblogin->where(array('id_user' => $id_user, 'is_main_menu' => 0));
        $datamenu = $this->dblogin->get();

        $hasil = '';
        foreach ($datamenu->result_array() as $menusatu) {

            $this->dblogin->from('v_menu');
            $this->dblogin->where(array('id_user' => $id_user, 'is_main_menu' => $menusatu['id_menu']));
            $datamenudua = $this->dblogin->get();
            //echo '</br>'.$datamenudua->num_rows() ;
            if ($datamenudua->num_rows() > 0) {

                //echo $menusatu['route'];
                //cek dropdown aktif
                $this->dblogin->from('v_menu');
                $this->dblogin->where(array('id_user' => $id_user, 'is_main_menu' => $menusatu['id_menu'], 'route' => $menu_aktif));
                $cekdropdown = $this->dblogin->get();
                //echo "</br>".$this->dblogin->last_query(); 
                $class = "";
                if ($cekdropdown->num_rows() > 0) {
                    $class = 'class="dropdown-toggle menu-top-active"';
                } else {
                    $class = 'class="dropdown-toggle"';
                }
                //die;
                //cek dropdown aktif

                $hasil.= '<li>';
                $hasil.= '<a href="#" ' . $class . ' id="ddlmenuItem" data-toggle="dropdown">' . $menusatu['judul_menu'] . '<i class="fa fa-angle-down"></i></a>';
                $hasil.= '<ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">';
                foreach ($datamenudua->result_array() as $menudua) {
                    $hasil.= '<li role="presentation"><a role="menuitem" tabindex="-1" href="' . site_url() . $menudua['route'] . '">' . $menudua['judul_menu'] . '</a></li>';
                }
                $hasil.= '</ul>';
                $hasil.= '</li>';
            } else {
                $class = "";
                if ($menu_aktif == $menusatu['route']) {
                    $class = 'class="menu-top-active"';
                }
                $hasil.= '<li><a href="' . site_url() . $menusatu['route'] . '"  ' . $class . '>' . $menusatu['judul_menu'] . '</a></li>';
            }
        }
        
//        $hasil.= '<li><a href="'.  site_url('logout').'" >LogOut</a></li>' ;

//            print_r($hasil);
//            die;
        ?>



        <!-- LOGO HEADER END-->
        <section class="menu-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="navbar-collapse collapse ">
                            <ul id="menu-top" class="nav navbar-nav navbar-right">
                                <?php print_r($hasil); ?>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- MENU SECTION END-->

        <div class="content-wrapper">
            <div class="container">
                <div class="bottom-margin-content">
                    <?php $this->load->view($content); ?>
                </div>
            </div>
        </div>
        <!-- CONTENT-WRAPPER SECTION END-->
        <section class="footer-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!--                        &copy; 2014 Yourdomain.com |<a href="http://www.binarytheme.com/" target="_blank"  > Designed by : binarytheme.com</a> -->
                        <p>Copyright &#169; IT MSA. Template by |<a href="http://www.binarytheme.com/" target="_blank"  > Designed by : binarytheme.com</a>.</p>
                    </div>

                </div>
            </div>
        </section>

        <script src="<?= site_url(); ?>assets/js/jquery.js"></script>
        <script src="<?= site_url(); ?>assets/js/bootstrap.js"></script>
        <script src="<?= site_url(); ?>assets/DataTables-1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="<?= site_url(); ?>assets/js/custom.js"></script>
        <script src="<?= site_url(); ?>assets/datepicker/bootstrap-datepicker.js"></script>
        
        
        <script type = "text/javascript" >
            $(document).ajaxStart(function() {
                $("#loading_proses_ajax").show();
            }).ajaxStop(function() {
                $("#loading_proses_ajax").hide();
            });
            
            $(document).ready(function () {
                $(".tanggal").datepicker({
                    dateFormat: 'dd-mm-yyyy',
                    autoclose: true,
                })
            })
        </script>


    </body>

</html>
