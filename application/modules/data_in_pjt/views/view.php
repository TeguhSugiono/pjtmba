<link href="<?= base_url($this->session->userdata('t_assets')); ?>/select2/select2.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .select2-selection.select2-selection--single{
        height: 34px !important;
    }
</style>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                PJT In Container
            </div>

            <div class="panel-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div id="loading_proses_ajax"></div>
                            
                            <div class="class_container">
                                <div class="col-md-2 col-sm-2 col-xs-12 boxshadow" style="margin-bottom: 2%">                                
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Tgl In Start</label>
                                            <input type="text" id="Tgl_In_Start" name="Tgl_In_Start" class="form-control tanggal" value="<?php echo date('01-m-Y') ?>" data-date-format="dd-mm-yyyy">
                                        </div>   
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Tgl In End</label>
                                            <input type="text" id="Tgl_In_End" name="Tgl_In_End" class="form-control tanggal" value="<?php echo date('d-m-Y') ?>" data-date-format="dd-mm-yyyy">
                                        </div>   
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label>No Container</label>
                                            <input type="text" id="NoCont" name="NoCont" class="form-control">
                                        </div>   
                                    </div>
                                </div>

                                <div class="col-md-10 col-sm-10 col-xs-12 boxshadow1" style="margin-bottom: 2%">
                                    <div style="float: left;margin-bottom: 1%">
                                        <button type="button" class="btn btn-primary" id="btnUploadInContainer"><i class='glyphicon glyphicon-upload'></i> Upload In Container</button>  
                                        <button type="button" class="btn btn-primary" id="btnDetilInContainer"><i class='glyphicon glyphicon-eye-open'></i> Detail In Container</button>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered display nowrap" id="headincontainer" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>id_container_in</th>
                                                    <th>PBM</th>
                                                    <th>No Master BL</th>
                                                    <th>Tgl Master BL</th>
                                                    <th>No Container</th>
                                                    <th>Uk</th>
                                                    <th>Tgl Masuk</th>
                                                    <th>Jam Masuk</th>
                                                    <th>No Surat incontainer</th>
                                                    <th>Tgl Surat incontainer</th>
                                                    <th>No incontainer</th>
                                                    <th>Tgl incontainer</th>
                                                    <th>Vessel</th>
                                                    <th>Voyage</th>
                                                    <th>Call Sign</th>
                                                    <th>Tgl Tiba</th>
                                                    <th>No BC11</th>
                                                    <th>Tgl BC11</th>
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
                </div>
            </div>
            
            
            
        </div>
    </div>

</div>

<div id="div_modal"></div>

<script src="<?= site_url($this->session->userdata('t_assets')); ?>/js/jquery-1.10.2.js"></script>
<script src="<?= site_url($this->session->userdata('t_assets')); ?>/select2/select2.min.js"></script>

<script type = "text/javascript" >
    var headincontainer ;
    var id_container_in = "" ;

    $('#NoCont').on('keyup',function () {
        headincontainer.ajax.reload();
    });

    $(document).ready(function() {
        $("#Tgl_In_Start").change(function () {
            headincontainer.ajax.reload();
        });
        $("#Tgl_In_End").change(function () {
            headincontainer.ajax.reload();
        });

        headincontainer = $('#headincontainer').DataTable({
            "ajax": {
                "url": "<?php echo site_url('data_in_pjt/fetch_table'); ?>",
                "type": "POST",
                "cache": false,
                "beforeSend": function() {
                    $("#loading_proses_ajax").show();
                },
                "data": function(data) {
                    data.Tgl_In_Start   = $('#Tgl_In_Start').val();
                    data.Tgl_In_End   = $('#Tgl_In_End').val();
                    data.NoCont   = $('#NoCont').val();
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
                { "data": "id_container_in"},
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
                { "data": "tgl_bc11","className": "text-center"}
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
            "columnDefs": [
                { 
                    "targets": [1], // Menyembunyikan kolom kedua (id_container_in)
                    "visible": false
                }
            ],
        });

    });

    $('#headincontainer').on('click', 'tr', function () {
        var data = headincontainer.row(this).data();
        if ($(this).hasClass('selected')) {
            id_container_in = "" ;
            $(this).removeClass('selected');
        } else {
            id_container_in = data['id_container_in'];
            headincontainer.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });


    $('#btnUploadInContainer').click(function () {
        $.post('<?php echo site_url() ?>data_in_pjt/upload_in_container',
            {
                //T_IN_ID:T_IN_ID
            },
            function (xx) {
                //alert(xx);
                $('#div_modal').html(xx);

                $("#div_incontainer").modal({show: true, backdrop: 'static'});
            });
    });

    $('#btnDetilInContainer').click(function () {

        if(id_container_in == ""){
            alert("Pilih Data Di Tabel Terlebih Dahulu ...!!");
            return ;
        }

        url = '<?php echo site_url('data_in_pjt/detailincontainer') ?>';
        data = {id_container_in:id_container_in} ;
        divform = "#div_modal" ;
        idmodal = "#div_detail_incontainer" ;        
        createmodal(url,data,divform,idmodal); 
    });
   
</script>