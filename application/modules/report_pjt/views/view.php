<link href="<?= base_url($this->session->userdata('t_assets')); ?>/select2/select2.min.css" rel="stylesheet" type="text/css" />
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

        <div class="panel panel-primary">
            <div class="panel-heading">
                Report Container Detail PJT
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-default" style="margin-top: 1%">
                    <div class="panel-body">

                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                <label>Category</label>
                                <?=$category;?>
                            </div>                            
                        </div>

                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                <label>Tanggal Start</label>
                                <input type="text" id="tgl1" name="tgl1" class="form-control tanggal" data-date-format="dd-mm-yyyy" value="">
                            </div>                            
                        </div>

                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                <label>Tanggal End</label>
                                <input type="text" id="tgl2" name="tgl2" class="form-control tanggal" data-date-format="dd-mm-yyyy" value="">
                            </div>                 
                        </div>

                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                <label>Master BL / Container</label>
                                <?=$id_container_in;?>
                            </div> 


                            <div style="text-align: right">
                                <button type="button" class="btn btn-primary" id="btnSearch"><i class='glyphicon glyphicon-search'></i> Search</button>  
                                <button type="button" class="btn btn-primary" id="btnExport"><i class='glyphicon glyphicon-export'></i> Export</button>
                            </div>   

                        </div>
                        

                    </div>
                </div>
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <div id="loading_proses_ajax"></div>

                    <div id="paramcategory"></div>
                    <table class="table-bordered display nowrap" id="tblreportpjt" style="width: 100%">
                        <thead>
                            <tr>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>



                </div>

            </div>
        </div>

    </div>

</div>

<script src="<?= site_url($this->session->userdata('t_assets')); ?>/js/jquery-1.10.2.js"></script>
<script src="<?= site_url($this->session->userdata('t_assets')); ?>/select2/select2.min.js"></script>
<script src="<?= site_url($this->session->userdata('t_assets')); ?>/datepicker/bootstrap-datepicker.js"></script>


<script type = "text/javascript" >

    var tblreportpjt ;

    DisableText();
    $("#loading_proses_ajax").hide();
    
    function DisableText(){
        $('#tgl1').attr('readonly', true);
        $('#tgl2').attr('readonly', true);

        $('#tgl1').removeClass('tanggal');
        $('#tgl2').removeClass('tanggal');


        if ($('#tgl1').is('[readonly]')) {
            $('#tgl1').datepicker('destroy');
        }

        if ($('#tgl2').is('[readonly]')) {
            $('#tgl2').datepicker('destroy');
        }

        $('#tgl1').val("");
        $('#tgl2').val("");
    }
    
    function EnableText(){
        $('#tgl1').removeAttr('readonly');
        $('#tgl2').removeAttr('readonly');

        $('#tgl1').addClass('tanggal');
        $('#tgl2').addClass('tanggal');

        $(".tanggal").datepicker({
            dateFormat: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
        }); 

        setDateNow();
    }

    $("#category").change(function() {

        if($("#category").val() == "Current Stock"){

            DisableText();

        } else if($("#category").val() == "Stock"){

            DisableText();
            EnableText();
            $('#tgl1').attr('readonly', true);
            $('#tgl1').removeClass('tanggal');
            if ($('#tgl1').is('[readonly]')) {
                $('#tgl1').datepicker('destroy');
            }
            $('#tgl1').val("");

        } else if($("#category").val() == "Container In"){

            DisableText();
            EnableText();

        } else if($("#category").val() == "Container Out"){    

            DisableText();
            EnableText();

        }


    });

    $('#btnExport').click(function() {

        var tgl1        = $('#tgl1').val() ;
        var tgl2        = $('#tgl2').val() ;
        var category    = $("#category").val() ;
        var id_container_in = $('#id_container_in').val();


        var data = [];
        data[0] = tgl1 ;
        data[1] = tgl2 ;
        data[2] = category ;
        data[3] = id_container_in ;

        var page = "<?php echo base_url(); ?>report_pjt/exportxls?data="+btoa(data) ;
        window.open(page);

    });

    $('#btnSearch').click(function () {

        if($("#category").val() == "Current Stock"){


            $('#paramcategory').text(" Category : " + $("#category").val()) ;

            // Hancurkan instance DataTable yang lama
            if ( $.fn.DataTable.isDataTable('#tblreportpjt') ) {
                tblreportpjt.destroy();  // Destroy DataTable
            }

            // Hapus thead dan tbody dari tabel
            $('#tblreportpjt thead').remove();
            $('#tblreportpjt tbody').remove();

            // Panggil fungsi untuk menambahkan kembali thead baru
            thead($("#category").val());

            tblreportpjt = $('#tblreportpjt').DataTable({
                "ajax": {
                    "url": "<?php echo site_url('report_pjt/fetch_table'); ?>",
                    "type": "POST",
                    "cache": false,
                    "beforeSend": function() {
                        $("#loading_proses_ajax").show();
                    },
                    "data": function(data) {
                        data.tgl1   = $('#tgl1').val();
                        data.tgl2   = $('#tgl2').val();
                        data.category = $('#category').val();
                        data.id_container_in = $('#id_container_in').val();
                    },  
                    "complete": function(){
                        $("#loading_proses_ajax").hide();
                    },
                    "dataSrc": ""
                },
                "columns": [
                    { "data": null, 
                        "render": function (data, type, row, meta) {
                        // Menggunakan meta.row untuk mengambil nomor urut
                        return meta.row + 1;
                        } 
                    },
                    { "data": "pbm"},
                    { "data": "no_master_bl"},
                    { "data": "tgl_master_bl","className": "text-center"},
                    { "data": "no_container"},
                    { "data": "size"},
                    { "data": "tgl_container_in","className": "text-center"},
                    { "data": "jam_masuk","className": "text-center"},
                    { "data": "no_surat_plp"},
                    { "data": "tgl_surat_plp","className": "text-center"},
                    { "data": "no_plp"},
                    { "data": "tgl_plp","className": "text-center"},
                    { "data": "vessel"},
                    { "data": "voyage"},
                    { "data": "call_sign"},
                    { "data": "tgl_tiba","className": "text-center"},
                    { "data": "no_bc11"},
                    { "data": "tgl_bc11","className": "text-center"},
                    { "data": "no_box_marking"},
                    { "data": "consignee"},
                    { "data": "jumlah"},
                    { "data": "satuan"},
                    { "data": "berat"},
                    { "data": "volume"}
                ],
                "pagingType": "simple",
                "pageLength": 15,
                "order": [],
                "ordering": true,
                "scrollX": true,
                "scrollY": "1000px",
                "scrollCollapse": true,
                "searching"     : false,
                "bLengthChange" : false,
            });

        } else if($("#category").val() == "Stock"){

            $('#paramcategory').text(" Category : " + $("#category").val()) ;
            // Logic untuk kategori Container In

            // Hancurkan instance DataTable yang lama
            if ( $.fn.DataTable.isDataTable('#tblreportpjt') ) {
                tblreportpjt.destroy();  // Destroy DataTable
            }

            // Hapus thead dan tbody dari tabel
            $('#tblreportpjt thead').remove();
            $('#tblreportpjt tbody').remove();

            // Panggil fungsi untuk menambahkan kembali thead baru
            thead($("#category").val());

            tblreportpjt = $('#tblreportpjt').DataTable({
                "ajax": {
                    "url": "<?php echo site_url('report_pjt/fetch_table'); ?>",
                    "type": "POST",
                    "cache": false,
                    "beforeSend": function() {
                        $("#loading_proses_ajax").show();
                    },
                    "data": function(data) {
                        data.tgl1   = $('#tgl1').val();
                        data.tgl2   = $('#tgl2').val();
                        data.category = $('#category').val();
                        data.id_container_in = $('#id_container_in').val();
                    },  
                    "complete": function(){
                        $("#loading_proses_ajax").hide();
                    },
                    "dataSrc": ""
                },
                "columns": [
                    { "data": null, 
                        "render": function (data, type, row, meta) {
                        // Menggunakan meta.row untuk mengambil nomor urut
                        return meta.row + 1;
                        } 
                    },
                    { "data": "pbm"},
                    { "data": "no_master_bl"},
                    { "data": "tgl_master_bl","className": "text-center"},
                    { "data": "no_container"},
                    { "data": "size"},
                    { "data": "tgl_container_in","className": "text-center"},
                    { "data": "jam_masuk","className": "text-center"},
                    { "data": "no_surat_plp"},
                    { "data": "tgl_surat_plp","className": "text-center"},
                    { "data": "no_plp"},
                    { "data": "tgl_plp","className": "text-center"},
                    { "data": "vessel"},
                    { "data": "voyage"},
                    { "data": "call_sign"},
                    { "data": "tgl_tiba","className": "text-center"},
                    { "data": "no_bc11"},
                    { "data": "tgl_bc11","className": "text-center"},
                    { "data": "no_box_marking"},
                    { "data": "consignee"},
                    { "data": "jumlah"},
                    { "data": "satuan"},
                    { "data": "berat"},
                    { "data": "volume"},
                    { "data": "nodo"},
                    { "data": "tglout","className": "text-center"}
                ],
                "pagingType": "simple",
                "pageLength": 15,
                "order": [],
                "ordering": true,
                "scrollX": true,
                "scrollY": "1000px",
                "scrollCollapse": true,
                "searching"     : false,
                "bLengthChange" : false,
            });


        } else if($("#category").val() == "Container In"){

            $('#paramcategory').text(" Category : " + $("#category").val()) ;
            // Logic untuk kategori Container In

            // Hancurkan instance DataTable yang lama
            if ( $.fn.DataTable.isDataTable('#tblreportpjt') ) {
                tblreportpjt.destroy();  // Destroy DataTable
            }

            // Hapus thead dan tbody dari tabel
            $('#tblreportpjt thead').remove();
            $('#tblreportpjt tbody').remove();

            // Panggil fungsi untuk menambahkan kembali thead baru
            thead($("#category").val());

            tblreportpjt = $('#tblreportpjt').DataTable({
                "ajax": {
                    "url": "<?php echo site_url('report_pjt/fetch_table'); ?>",
                    "type": "POST",
                    "cache": false,
                    "beforeSend": function() {
                        $("#loading_proses_ajax").show();
                    },
                    "data": function(data) {
                        data.tgl1   = $('#tgl1').val();
                        data.tgl2   = $('#tgl2').val();
                        data.category = $('#category').val();
                        data.id_container_in = $('#id_container_in').val();
                    },  
                    "complete": function(){
                        $("#loading_proses_ajax").hide();
                    },
                    "dataSrc": ""
                },
                "columns": [
                    { "data": null, 
                        "render": function (data, type, row, meta) {
                        // Menggunakan meta.row untuk mengambil nomor urut
                        return meta.row + 1;
                        } 
                    },
                    { "data": "pbm"},
                    { "data": "no_master_bl"},
                    { "data": "tgl_master_bl","className": "text-center"},
                    { "data": "no_container"},
                    { "data": "size"},
                    { "data": "tgl_container_in","className": "text-center"},
                    { "data": "jam_masuk","className": "text-center"},
                    { "data": "no_surat_plp"},
                    { "data": "tgl_surat_plp","className": "text-center"},
                    { "data": "no_plp"},
                    { "data": "tgl_plp","className": "text-center"},
                    { "data": "vessel"},
                    { "data": "voyage"},
                    { "data": "call_sign"},
                    { "data": "tgl_tiba","className": "text-center"},
                    { "data": "no_bc11"},
                    { "data": "tgl_bc11","className": "text-center"},
                    { "data": "no_box_marking"},
                    { "data": "consignee"},
                    { "data": "jumlah"},
                    { "data": "satuan"},
                    { "data": "berat"},
                    { "data": "volume"},
                    { "data": "nodo"},
                    { "data": "tglout","className": "text-center"}
                ],
                "pagingType": "simple",
                "pageLength": 15,
                "order": [],
                "ordering": true,
                "scrollX": true,
                "scrollY": "1000px",
                "scrollCollapse": true,
                "searching"     : false,
                "bLengthChange" : false,
            });
            

            

        } else if($("#category").val() == "Container Out"){    

            $('#paramcategory').text(" Category : " + $("#category").val()) ;
            // Logic untuk kategori Container Out

            // Hancurkan instance DataTable yang lama
            if ( $.fn.DataTable.isDataTable('#tblreportpjt') ) {
                tblreportpjt.destroy();  // Destroy DataTable
            }

            // Hapus thead dan tbody dari tabel
            $('#tblreportpjt thead').remove();
            $('#tblreportpjt tbody').remove();

            // Panggil fungsi untuk menambahkan kembali thead baru
            thead($("#category").val());

            tblreportpjt = $('#tblreportpjt').DataTable({
                "ajax": {
                    "url": "<?php echo site_url('report_pjt/fetch_table'); ?>",
                    "type": "POST",
                    "cache": false,
                    "beforeSend": function() {
                        $("#loading_proses_ajax").show();
                    },
                    "data": function(data) {
                        data.tgl1   = $('#tgl1').val();
                        data.tgl2   = $('#tgl2').val();
                        data.category = $('#category').val();
                        data.id_container_in = $('#id_container_in').val();
                    },  
                    "complete": function(){
                        $("#loading_proses_ajax").hide();
                    },
                    "dataSrc": ""
                },
                "columns": [
                    { "data": null, 
                        "render": function (data, type, row, meta) {
                        // Menggunakan meta.row untuk mengambil nomor urut
                        return meta.row + 1;
                        } 
                    },
                    { "data": "nocont"},
                    { "data": "no_do"},
                    { "data": "tglin","className": "text-center"},
                    { "data": "tgl_out","className": "text-center"},
                    { "data": "no_box_marking"},
                    { "data": "consignee"},
                    { "data": "jumlah"},
                    { "data": "satuan"},
                    { "data": "berat"},
                    { "data": "volume"}
                ],
                "pagingType": "simple",
                "pageLength": 15,
                "order": [],
                "ordering": true,
                "scrollX": true,
                "scrollY": "1000px",
                "scrollCollapse": true,
                "searching"     : false,
                "bLengthChange" : false,
            });
        }

    });

    // Fungsi untuk mengganti thead berdasarkan kategori
    function thead(category) {
        var url = '<?php echo site_url('report_pjt/fetch_table_thead') ?>';
        var data = {
            category: category
        };
        var pesan = 'function fetch_table_thead gagal';
        
        // Ambil data thead dengan AJAX
        var dataok = multi_ajax_proses(url, data, pesan);
        var thead = dataok;

        var html_table = '';

        // Loop untuk menggabungkan elemen thead berdasarkan data yang diterima
        for (var i = 0; i < thead.length; i++) {
            html_table += "<th>" + thead[i] + "</th>";
        }

        // Bersihkan elemen thead dan tambahkan yang baru
        $('#tblreportpjt thead').empty(); 
        $('#tblreportpjt').append('<thead><tr>' + html_table + '</tr></thead>');
        $('#tblreportpjt').append('<tbody></tbody>'); // Tambahkan tbody baru yang kosong
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

    function setDateNow() {
        // Dapatkan tanggal sekarang
        var today = new Date();

        // Format tanggal menjadi d-m-Y
        var day = String(today.getDate()).padStart(2, '0');
        var month = String(today.getMonth() + 1).padStart(2, '0'); // Month dimulai dari 0
        var year = today.getFullYear();

        var formattedDate = day + '-' + month + '-' + year;

        // Set nilai input text dengan tanggal sekarang
        $('#tgl1').val(formattedDate);
        $('#tgl2').val(formattedDate);
    }


</script>