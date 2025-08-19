<style type="text/css">
    #detcontainer tbody tr td{
        font-size: 10px !important;
    }
</style>

<div id="div_detail_outcontainer" class="modal fade" tabindex="-1">
    <div class="modal-dialog" role="document" style="width: 45%">
        <div class="modal-content">

            <form id="detmanifest" class="form-horizontal" method="post" action="#">
                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 1%"> 
                    <div class="panel panel-primary">
                        <div class="panel-heading ctrl-panel-heading">
                            Data Detail Out Container
                        </div>
                    
                        <div class="panel-body ctrl-panel-body">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive" style="margin-top: -0%">                                            
                                    <table class="table table-bordered display nowrap" id="detcontainer" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>id_upload</th>
                                                <th>id_upload_detail</th>
                                                <th>NO. BOX / MARKING</th>
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
                

            </form>

            <div class="modal-footer">
                <button class="btn btn-primary btn-sm" type="button" data-dismiss="modal" aria-hidden="true" id="closemodal"><i class='glyphicon glyphicon-remove'></i> Close</button>  
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var detcontainer ;
    var data_id_out = "<?=$id_out;?>" ;
    var data_tgl_out = "<?=$tgl_out;?>" ;

    $('#div_detail_outcontainer').on('shown.bs.modal', function () {
       detcontainer = $('#detcontainer').DataTable();
       detcontainer.columns.adjust();
    });

    $(document).ready(function() {
        detcontainer = $('#detcontainer').DataTable({
            "ajax": {
                "url": "<?php echo site_url('data_out_pjt/fetch_table_detail'); ?>",
                "type": "POST",
                "data": function(data) {
                    data.data_id_out = data_id_out ;
                    data.data_tgl_out = data_tgl_out ;
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
                { "data": "id_out_detail"},
                { "data": "no_box_marking"},
                { "data": "tgl_out","className": "text-center"},
            ],
            "pagingType": "simple",
            "pageLength": 1000,
            "order": [],
            "ordering": true,
            "scrollX": true,
            "scrollY": "300px",
            "scrollCollapse": true,
            "searching"     : true,
            "bLengthChange" : false,
            "columnDefs": [
                { 
                    "targets": [1,2],
                    "visible": false
                }
            ],
        });

    });

    // $('#detcontainer').on('click', 'tr', function () {
    //     var data = detcontainer.row(this).data();
    //     if ($(this).hasClass('selected')) {
    //         $(this).removeClass('selected');
    //     } else {
    //         detcontainer.$('tr.selected').removeClass('selected');
    //         $(this).addClass('selected');
    //     }
    // });

    

    

</script>
