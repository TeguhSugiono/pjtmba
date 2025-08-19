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
                PJT Upload Out Container
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
                                        <button type="button" class="btn btn-primary" id="btnUploadOutContainer"><i class='glyphicon glyphicon-upload'></i> Upload Out Container</button>  
                                        <button type="button" class="btn btn-primary" id="btnDetilOutContainer"><i class='glyphicon glyphicon-eye-open'></i> Detail Out Container</button>
                                        <button type="button" class="btn btn-primary" id="btnProsesOut"><i class='glyphicon glyphicon-log-out'></i> Proses Out Container</button>  
                                    </div>

                                    

                                    <div class="table-responsive">
                                        <table class="table table-bordered display nowrap" id="tblCnOut" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>id_upload</th>
                                                    <th>id_container_in</th>
                                                    <th>No DO/BL</th>
                                                    <th>No Container</th>
                                                    <th>Tgl Out</th>
                                                    <th>Jumlah Box</th>
                                                    <th>Jumlah Box Out</th>
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
    var tblCnOut ;
    var id_upload = "" ;

    $('#NoCont').on('keyup',function () {
        tblCnOut.ajax.reload();
    });

    $(document).ready(function() {
        $("#Tgl_Out_Start").change(function () {
            tblCnOut.ajax.reload();
        });
        $("#Tgl_Out_End").change(function () {
            tblCnOut.ajax.reload();
        });

        tblCnOut = $('#tblCnOut').DataTable({
            "ajax": {
                "url": "<?php echo site_url('upload_out_pjt/fetch_table'); ?>",
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
                { "data": "id_upload"},
                { "data": "id_container_in"},
                { "data": "no_do"},
                { "data": "no_container"},
                { "data": "tgl_out","className": "text-center"},
                { "data": "JmlBox","className": "text-right"},
                { "data": "JmlBoxOut","className": "text-right"}
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

    $('#tblCnOut').on('click', 'tr', function () {
        var data = tblCnOut.row(this).data();
        if ($(this).hasClass('selected')) {
            id_upload = "" ;
            $(this).removeClass('selected');
        } else {
            id_upload = data['id_upload'];
            tblCnOut.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });


    $('#btnUploadOutContainer').click(function () {
        $.post('<?php echo site_url() ?>upload_out_pjt/upload_out_container',
            {
                //T_IN_ID:T_IN_ID
            },
            function (xx) {
                //alert(xx);
                $('#div_modal').html(xx);

                $("#div_outcontainer").modal({show: true, backdrop: 'static'});
            });
    });

    $('#btnDetilOutContainer').click(function () {

        if(id_upload == ""){
            alert("Pilih Data Di Tabel Terlebih Dahulu ...!!");
            return ;
        }

        url = '<?php echo site_url('upload_out_pjt/detailoutcontainer') ?>';
        data = {id_upload:id_upload} ;
        divform = "#div_modal" ;
        idmodal = "#div_detail_outcontainer" ;        
        createmodal(url,data,divform,idmodal); 
    });

    $('#btnProsesOut').click(function () {

        url = '<?php echo site_url('upload_out_pjt/out_boxmarking') ?>';
        data = {
            Tgl_Out_Start:$('#Tgl_Out_Start').val(),
            Tgl_Out_End:$('#Tgl_Out_End').val(),
            NoCont:$('#NoCont').val()
        } ;
        pesan = 'out_boxmarking Error...';
        $(".loading_proses_ajax").show();
        multi_ajax_proses_spinner(url, data, pesan).then(function (dataok){
            $(".loading_proses_ajax").hide();

            console.log(dataok) ;

            if(dataok.msg != "Ya"){
                console.log(dataok) ;
                alert(dataok.pesan);
                return;
            }

            alert(dataok.pesan);
            tblCnOut.ajax.reload();

        })
        .catch(function (error) {
            $(".loading_proses_ajax").hide();

            alert(pesan) ;

        }); 
    });
   
</script>