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
                PJT Out Container
            </div>

            <div class="panel-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div id="loading_proses_ajax"></div>
                            
                            <div class="class_container">
                                <div class="col-md-2 col-sm-2 col-xs-12 boxshadowOne" style="margin-bottom: 2%">                                
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Tgl Out Start</label>
                                            <input type="text" id="Tgl_Out_Start" name="Tgl_Out_Start" class="form-control tanggal" value="<?php echo date('01-m-Y') ?>" data-date-format="dd-mm-yyyy">
                                        </div>   
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label>Tgl Out End</label>
                                            <input type="text" id="Tgl_Out_End" name="Tgl_Out_End" class="form-control tanggal" value="<?php echo date('d-m-Y') ?>" data-date-format="dd-mm-yyyy">
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
                                        <!-- <button type="button" class="btn btn-primary" id="btnUploadInContainer"><i class='glyphicon glyphicon-upload'></i> Upload In Container</button>   -->
                                        <button type="button" class="btn btn-primary" id="btnDetilOutContainer"><i class='glyphicon glyphicon-eye-open'></i> Detail Out Container</button>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered display nowrap" id="headoutcontainer" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>id_out</th>
                                                    <th>id_container_in</th>
                                                    <th>No DO</th>
                                                    <th>No Container</th>
                                                    <th>Tgl Out</th>
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
    var headoutcontainer ;
    var id_out = "" ;
    var tgl_out = "" ;

    $('#NoCont').on('keyup',function () {
        headoutcontainer.ajax.reload();
    });

    $(document).ready(function() {
        $("#Tgl_Out_Start").change(function () {
            headoutcontainer.ajax.reload();
        });
        $("#Tgl_Out_End").change(function () {
            headoutcontainer.ajax.reload();
        });

        headoutcontainer = $('#headoutcontainer').DataTable({
            "ajax": {
                "url": "<?php echo site_url('data_out_pjt/fetch_table'); ?>",
                "type": "POST",
                "cache": false,
                "beforeSend": function() {
                    $("#loading_proses_ajax").show();
                },
                "data": function(data) {
                    data.Tgl_Out_Start   = $('#Tgl_Out_Start').val();
                    data.Tgl_Out_End   = $('#Tgl_Out_End').val();
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
                { "data": "id_out"},
                { "data": "id_container_in"},
                { "data": "no_do"},
                { "data": "nocont"},
                { "data": "tgl_out","className": "text-center"},                
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
                    "targets": [1,2],
                    "visible": false
                }
            ],
        });

    });

    $('#headoutcontainer').on('click', 'tr', function () {
        var data = headoutcontainer.row(this).data();
        if ($(this).hasClass('selected')) {
            id_out = "" ;
            tgl_out = "" ;
            $(this).removeClass('selected');
        } else {
            id_out = data['id_out'];
            tgl_out = data['tgl_out'];
            headoutcontainer.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    $('#btnDetilOutContainer').click(function () {

        if(id_out == ""){
            alert("Pilih Data Di Tabel Terlebih Dahulu ...!!");
            return ;
        }

        url = '<?php echo site_url('data_out_pjt/detailoutcontainer') ?>';
        data = {id_out:id_out,tgl_out:tgl_out} ;
        divform = "#div_modal" ;
        idmodal = "#div_detail_outcontainer" ;        
        createmodal(url,data,divform,idmodal); 
    });
   
</script>