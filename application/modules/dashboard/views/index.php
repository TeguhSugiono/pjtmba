<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>PJT.MBA</title>
        <link href="<?= site_url($this->session->userdata('t_assets')); ?>/img/logo_PTMBA.png" rel="shortcut icon" />
        <link href="<?= site_url($this->session->userdata('t_assets')); ?>/css/bootstrap.css" rel="stylesheet" />
        <link href="<?= site_url($this->session->userdata('t_assets')); ?>/css/font-awesome.css" rel="stylesheet" />
        <link href="<?= site_url($this->session->userdata('t_assets')); ?>/css/poppins.css" rel="stylesheet" type='text/css' />
        <link href="<?= site_url($this->session->userdata('t_assets')); ?>/datatables/css/jquery.dataTables.min.css" rel="stylesheet"/>
        <link href="<?= site_url($this->session->userdata('t_assets')); ?>/css/style.css" rel="stylesheet" />
        <link href="<?= site_url($this->session->userdata('t_assets')); ?>/css/style_table.css" rel="stylesheet" />
        <link href="<?= site_url($this->session->userdata('t_assets')); ?>/css/font-google.css" rel='stylesheet' type='text/css' />
        <link href="<?= site_url($this->session->userdata('t_assets')); ?>/css/spinner.css" rel="stylesheet" type="text/css" />            
        <link href="<?= site_url($this->session->userdata('t_assets')); ?>/datepicker/datepicker.min.css" rel="stylesheet"/>

        <style>
            body{font-family: Cambria,Georgia,serif;}
            th {font-size: 13px !important;}
            td {font-size: 12px !important;}
            .bottom-margin-content{margin-top: -2% !important;}

            .class_container {
                display: flex;
                gap: 1%;
            }

            .boxshadow, .boxshadow1 {
                flex: 1;
                /*min-height: 550px;*/
                height: auto;
                padding: 15px;
                background-color: #fff;
            }

            .boxshadow {
                box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2), 0px 12px 24px rgba(0, 0, 0, 0.2);
                border-radius: 10px;
            }

            .boxshadow1 {
                box-shadow: 4px 4px 6px rgba(0, 0, 0, 0.15), 0px 8px 12px rgba(0, 0, 0, 0.3);
                border-radius: 20px;
            }

            @media (max-width: 767px) {
                .class_container {
                    flex-direction: column;
                }
            }
            .boxshadowModal {
                padding: 15px;
                box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2), 
                            0px 12px 24px rgba(0, 0, 0, 0.2);
                border-radius: 2px;
                background-color: #fff;
            }
            .boxshadowOne {
                padding: 15px;
                box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2), 
                            0px 12px 24px rgba(0, 0, 0, 0.2);
                border-radius: 10px;
                background-color: #fff;
            }




        </style>



    </head>
    
    
    <body>
        
        <div class="navbar navbar-inverse set-radius-zero" id="header_small">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?=site_url();?>">
                         <img src="<?= site_url($this->session->userdata('t_assets').'/img/logo_PTMBA.png') ?>" style="height: 380%;width: 60%"/>
                    </a>
                </div>                
            </div>
        </div>


        <?php
            $this->dblogin = $this->load->database('db_login_tpp', TRUE);
            $menu_aktif = $this->uri->segment(1);

            $id_user = $this->session->userdata('t_userid');
            $this->dblogin->from('v_menu');
            $this->dblogin->where(array('id_user' => $id_user, 'link_id_menu' => 0));
            $datamenu = $this->dblogin->get();

            $hasil = '';
            foreach ($datamenu->result_array() as $menusatu) {

                $this->dblogin->from('v_menu');
                $this->dblogin->where(array('id_user' => $id_user, 'link_id_menu' => $menusatu['id_menu']));
                $datamenudua = $this->dblogin->get();

                if ($datamenudua->num_rows() > 0) {

   
                    $this->dblogin->from('v_menu');
                    $this->dblogin->where(array('id_user' => $id_user, 'link_id_menu' => $menusatu['id_menu'], 'link_route' => $menu_aktif));
                    $cekdropdown = $this->dblogin->get();

                    $class = "";
                    if ($cekdropdown->num_rows() > 0) {
                        $class = 'class="dropdown-toggle menu-top-active"';
                    } else {
                        $class = 'class="dropdown-toggle"';
                    }


                    $hasil.= '<li>';
                    $hasil.= '<a href="#" ' . $class . ' id="ddlmenuItem" data-toggle="dropdown">'.$menusatu['icon_menu'].''. $menusatu['judul_menu'] . '<i class="fa fa-angle-down"></i></a>';
                    $hasil.= '<ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">';
                    foreach ($datamenudua->result_array() as $menudua) {
                        $hasil.= '<li role="presentation"><a role="menuitem" tabindex="-1" href="' . site_url() . $menudua['link_route'] . '">' . $menudua['judul_menu'] . '</a></li>';
                    }
                    $hasil.= '</ul>';
                    $hasil.= '</li>';
                } else {
                    $class = "";
                    if ($menu_aktif == $menusatu['link_route']) {
                        $class = 'class="menu-top-active"';
                    }
                    $hasil.= '<li><a href="' . site_url() . $menusatu['link_route'] . '"  ' . $class . '>'.$menusatu['icon_menu'].'' . $menusatu['judul_menu'] . '</a></li>';
                }
            }
            
            $hasil.= '<li>
                        <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> '.$this->session->userdata('t_username').' <i class="fa fa-angle-down"></i></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="'.  site_url('logout').'"><i class="glyphicon glyphicon-log-out"></i> LogOut</a></li>
                        </ul>
                    </li>' ;
            
        ?>


        <section class="menu-section">
            <div class="container">

                <div class="row">
                    <div class="col-md-1" style="margin-top: -1.2%;margin-left: -2%;" id="header_large">
                        <div class="navbar-collapse collapse">
                            <a class="navbar-brand" href="<?=site_url();?>">
                                <!-- <img src="<?= site_url($this->session->userdata('t_assets').'/img/ptmsa.png') ?>" style="height: 270%;width: 1200%;"/> -->
                                <img src="<?= site_url($this->session->userdata('t_assets').'/img/logo_PTMBA.png') ?>" style="height: 320%;width: 1300%;"/>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-11">
                        <div class="navbar-collapse collapse ">
                            <ul id="menu-top" class="nav navbar-nav navbar-right">                                
                                <?php print_r($hasil); ?>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <div class="content-wrapper">
            <div class="container bottom-margin-content" >
                <?php $this->load->view($content); ?>
            </div>
        </div>


        

        <!-- CONTENT-WRAPPER SECTION END-->
        <section class="footer-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p>Copyright &#169; Teguh. Template by |<a href="http://www.binarytheme.com/" target="_blank"  > Designed by : binarytheme.com</a>.</p>
                    </div>
                </div>
            </div>
        </section>

        <script src="<?= site_url($this->session->userdata('t_assets')); ?>/js/jquery.js"></script>
        <script src="<?= site_url($this->session->userdata('t_assets')); ?>/js/bootstrap.js"></script>
        <script src="<?= site_url($this->session->userdata('t_assets')); ?>/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?= site_url($this->session->userdata('t_assets')); ?>/datatables/js/dataTables.select.min.js"></script>
        <script src="<?= site_url($this->session->userdata('t_assets')); ?>/datatables/js/ColReorderWithResize.js"></script>
        <script src="<?= site_url($this->session->userdata('t_assets')); ?>/js/custom.js"></script>
        <script src="<?= site_url($this->session->userdata('t_assets')); ?>/datepicker/bootstrap-datepicker.js"></script>

        <script type = "text/javascript" >
            
            var width = screen.width;
            var height = screen.height;

            
            if(parseFloat(width) > 800 && parseFloat(height) > 600){
                $("#header_small").removeAttr("style").hide();
                $("#header_large").show();
                $("#menu-top a").css('padding', '25px 5px 25px 10px;');                
            }else{
                $("#header_small").show();
                $("#header_large").removeAttr("style").hide();                
                $("#menu-top a").css('padding', '10px 5px 10px 10px');
            }


            // $(document).ajaxStart(function () {
            //     $("#loading_proses_ajax").show();
            // }).ajaxStop(function () {
            //     $("#loading_proses_ajax").hide();
            // });

            $(document).ready(function () {
                $(".tanggal").datepicker({
                    dateFormat: 'dd-mm-yyyy',
                    autoclose: true,
                    todayHighlight: true,
                });                
            });

            function submit_ajax_proses(url, data, pesan) {
                var result = "";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: data,
                    dataType: "JSON",
                    async: false,                    
                    processData:false,
                    contentType:false,
                    cache:false,                   
                    success: function (data) {
                        result = data;
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        var dataError = {
                            pesan: pesan
                        };
                        result = dataError;
                    }
                });

                return result;
            }

            function submit_ajax_proses_spinner(url, data, pesan) {
                return new Promise(function(resolve, reject) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: data,
                        dataType: "JSON",
                        async: true, // Menggunakan async true untuk Promise
                        processData: false,
                        contentType: false,
                        cache: false,
                        success: function(data) {
                            // Sembunyikan spinner setelah berhasil
                            resolve(data); // Mengembalikan data ke Promise
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            // Sembunyikan spinner jika terjadi error
                            var dataError = {
                                pesan: pesan
                            };
                            reject(dataError); // Menolak Promise dengan error
                        }
                    });
                });
            }

            function multi_ajax_proses_spinner(url, data, pesan) {
                return new Promise(function (resolve, reject) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: data,
                        dataType: "JSON",
                        success: function (data) {
                            resolve(data);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            var dataError = {
                                pesan: pesan
                            };
                            reject(dataError);
                        }
                    });
                });
            }

            function AngkaAjah(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode

                if(charCode == 46){ //code char 46 = titik .
                    return true;
                }else if(charCode > 31 && (charCode < 48 || charCode > 57)){
                    return false;
                }else{
                    return true;    
                }
                
            }

            function formatNumberSeparator(num) {
                var angkadesimal = num.split('.')[1] ;
                if(angkadesimal === undefined ){
                    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')+'.00' ;
                }else{
                    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') ;
                }
            }

            function formatNumberNotSeparator(num) {
                var angkadesimal = num.split('.')[1] ;
                if(angkadesimal === undefined ){
                    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') ;
                }else{
                    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') ;
                }
            }
            function readTableData(tableId) {
                var table = $('#' + tableId).DataTable();
                var data = [];

                table.rows().every(function() {
                    data.push(this.data());
                });

                return data;
            }

            function GetUsingPPn(tglinv){
                
                //alert(tglinv) ;

                url = '<?php echo site_url('function/GetPPn') ?>';
                data = {tglinv:tglinv};
                pesan = 'JavaScript get_ppn Error...';
                dataok = multi_ajax_proses(url, data, pesan);

                //console.log(dataok) ;

                return dataok.jml_ppn ;
            }


            function convertUkuranCargoTunggal(parameter) {

              if (parameter === "") {
                return "0";
              } else {
                if (/^\d{1,3}(\.\d{3})*(,\d+)?$/.test(parameter)) {
                  parameter = parameter.replace(".", "").replace(",", ".");
                  //console.log("llll "+parameter);
                  if (parameter.startsWith("0")) {
                    //parameter = parameter.replace(/^0+/, "");
                    parameter = 0 ;
                  }else{
                    parameter = parseFloat(parameter) / 1000 ;
                  }
                }
                return parameter;
              }
            }

            function multi_ajax_proses(url, data, pesan) {
                var result = "";
                $.ajax({
                    url: url,
                    type: "POST",
                    data: data,
                    dataType: "JSON",
                    async: false,
                    success: function (data) {
                        result = data;
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        var dataError = {
                            pesan: pesan
                        };
                        result = dataError;
                    }
                });

                return result;
            }

            function createmodal(url,data,divform,idmodal){
                $.post(url,data,
                function (xx) {
                    $(divform).html(xx);
                    $(idmodal).modal({show: true, backdrop: 'static'});
                }); 
            }

            
        </script>
    </body>
</html>