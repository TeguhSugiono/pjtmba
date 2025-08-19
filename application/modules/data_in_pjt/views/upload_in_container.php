<link href="<?= site_url($this->session->userdata('t_assets')); ?>/css/spinnermodal.css" rel="stylesheet" type="text/css" />   

<style type="text/css">
    .fontku{
        font-size: 12px !important ;
    }
</style>

<div class="loading_proses_ajax_modal"></div>
<div id="div_incontainer" class="modal fade" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body fontku">
                <div class="panel-body" style="margin-bottom: -6%">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                Form Upload In Container
                            </div>
                            <div class="panel-body">
                                <form id="submit" class="form-horizontal" method="post" action="#" enctype="multipart/form-data"> 

                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 1%">                                        
                                        <div class="input-group">
                                            <input type="file" name="fileexcel" id="fileexcel" class="btn btn-secondary text-left">
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 1%">
                                        <div class="col-md-2 col-sm-2 col-xs-12">                                            
                                            <button type="submit" class="btn btn-primary" id="btnsave" id="btnsave"><b><span class="icon-arrow-up-circle"></span>Upload</b></button>                      
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12">                                            
                                            <button class="btn btn-primary" type="button" data-dismiss="modal" aria-hidden="true" id="closemodal"><i class='glyphicon glyphicon-remove'></i> Close</button>                    
                                        </div>
                                    </div>
                                    
                                </form>
                                
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= site_url($this->session->userdata('t_assets')); ?>/select2/select2.min.js"></script>

<script type = "text/javascript" >

    $('#div_incontainer').on('shown.bs.modal', function () {
        $(".loading_proses_ajax_modal").hide();
    });
    $('#div_incontainer').on('hidden.bs.modal', function() {
        $(".loading_proses_ajax_modal").hide();
    });

    $('#closemodal').click(function () {
        $('#div_incontainer').modal('hide');
    });
    
    $('#submit').submit(function(e){
        e.preventDefault();           

        var file = document.getElementById('fileexcel').files[0];
        if (file === undefined || file === null) {
            alert('File Excel Belum di Attach...!!');
            return false;
        }

        var url = '<?php echo site_url('data_in_pjt/proses_upload_incontainer') ?>';
        var data = new FormData(this) ;
        var pesan = 'proses_upload_incontainer Error...';

        $(".loading_proses_ajax_modal").show();

        submit_ajax_proses_spinner(url, data, pesan)
            .then(function (dataok) {
                $(".loading_proses_ajax_modal").hide();

                //console.log(dataok) ;

                if(dataok.msg != "Ya"){
                    console.log(dataok) ;
                    alert('Proses Baca Excel Gagal..');
                    return;
                }
                
                //=================================================
                url1 = '<?php echo site_url('data_in_pjt/simpan_incontainer_temporary') ?>';
                data1 = {DataExcel:dataok.data} ;
                pesan1 = 'simpan_incontainer_temporary Error...';
                $(".loading_proses_ajax_modal").show();
                multi_ajax_proses_spinner(url1, data1, pesan1).then(function (dataok1){
                    $(".loading_proses_ajax_modal").hide();

                    if(dataok1.msg != "Ya"){
                        console.log(dataok1) ;
                        alert(dataok1.pesan);
                        return;
                    }
                    //console.log(dataok1) ;

                    //alert(dataok1.pesan);

                    //#############################################################################
                    url = '<?php echo site_url('data_in_pjt/simpan_incontainer') ?>';
                    data = {DataExcel:dataok.data} ;
                    pesan = 'simpan_incontainer Error...';
                    $(".loading_proses_ajax_modal").show();
                    multi_ajax_proses_spinner(url, data, pesan).then(function (dataok){
                        $(".loading_proses_ajax_modal").hide();

                        if(dataok.msg != "Ya"){
                            console.log(dataok) ;
                            alert('Simpan Data Error..!!');
                            return;
                        }

                        alert('Sukses Menyimpan Data incontainer...');
                        $('#div_incontainer').modal('hide');
                        headincontainer.ajax.reload();

                    })
                    .catch(function (error) {
                        $(".loading_proses_ajax_modal").hide();

                        alert(pesan) ;

                    });    
                    //#############################################################################



                })
                .catch(function (error) {
                    $(".loading_proses_ajax_modal").hide();

                    alert(pesan1) ;

                });    
                //=================================================


            })
            .catch(function (error) {
                $(".loading_proses_ajax_modal").hide();

                alert(pesan) ;

            });


    });
    
    
</script>