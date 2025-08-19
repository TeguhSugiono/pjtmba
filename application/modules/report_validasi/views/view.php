<link href="<?= base_url($this->session->userdata('t_assets')); ?>/select2/select2.min.css" rel="stylesheet" type="text/css" />

<style type="text/css">
    .select2-selection.select2-selection--single{
        height: 34px !important;
    }

    .resize_box{
        padding: 1px 5px 0px 3px !important;
        font-size: 12px !important;
        height: 29px !important;
        font-weight: bold;
    }
</style>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

        <div class="panel panel-primary">
            <div class="panel-heading">
                Report Container Validasi PJT
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-default" style="margin-top: 1%">
                    <div class="panel-body">

                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                <label>Master BL / Container</label>
                                <?=$id_container_in;?>
                            </div>                            
                        </div>

                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                <label>Validasi Start</label>
                                <input type="text" id="tgl1" name="tgl1" class="form-control tanggal" data-date-format="dd-mm-yyyy" value="">
                            </div>                            
                        </div>

                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                <label>Validasi End</label>
                                <input type="text" id="tgl2" name="tgl2" class="form-control tanggal" data-date-format="dd-mm-yyyy" value="">
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
                    <table class="table-bordered display nowrap" id="tblvalidasipjt" style="width: 100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Container</th>
                                <th>No Do/MBL</th>
                                <th>No Box Marking</th>
                                <th>Consignee</th>
                                <th>Tgl Validasi</th>
                                <th>Jam Validasi</th>
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

    var tblvalidasipjt ;

    $(".select2").select2();

    $("#loading_proses_ajax").hide();
    
    setDateNow();

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

     $('#btnSearch').click(function () {
        tblvalidasipjt.ajax.reload();
     });


    $(document).ready(function() {
        tblvalidasipjt = $('#tblvalidasipjt').DataTable({
            "ajax": {
                "url": "<?php echo site_url('report_validasi/fetch_table'); ?>",
                "type": "POST",
                "cache": false,
                "beforeSend": function() {
                    $("#loading_proses_ajax").show();
                },
                "data": function(data) {
                    data.tgl1   = $('#tgl1').val();
                    data.tgl2   = $('#tgl2').val();
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
                { "data": "nocontainer"},
                { "data": "no_do"},
                { "data": "no_box_marking"},
                { "data": "consignee"},
                { "data": "tgl_check","className": "text-center"},
                { "data": "jam_check","className": "text-center"}
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

    });


    $('#btnExport').click(function() {

        var tgl1        = $('#tgl1').val() ;
        var tgl2        = $('#tgl2').val() ;
        var id_container_in    = $("#id_container_in").val() ;

        var data = [];
        data[0] = tgl1 ;
        data[1] = tgl2 ;
        data[2] = id_container_in ;

        var page = "<?php echo base_url(); ?>report_validasi/exportxls?data="+btoa(data) ;
        window.open(page);

    });

    


</script>