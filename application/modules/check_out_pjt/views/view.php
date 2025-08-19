<link href="<?= base_url($this->session->userdata('t_assets')); ?>/select2/select2.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .select2-selection.select2-selection--single{
        height: 34px !important;
    }

    .resize_box{
        padding: 1px 5px 0px 3px !important;
        font-size: 12px !important;
        height: 25px !important;
        font-weight: bold;
    }
    .blmast {
        color: red;
        font-weight: bold;
    }
    .contnr {
        color: blue;
        font-weight: bold;
    }
</style>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                PJT Check Out Container
            </div>

            <div class="panel-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <!-- <div id="loading_proses_ajax"></div> -->

                            <div class="class_container">

                                <div class="col-md-6 col-sm-6 col-xs-12 boxshadow" style="margin-bottom: 2%">

                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:2%;margin-bottom: 1%;">
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;font-size: 19px;font-weight: bold;color: #ed1544;">
                                            <label>Create Header Transaksi</label>
                                        </div>                                            
                                    </div>
                                    
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:2%;margin-bottom: 1%;">
                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                            <div class="input-group">
                                                <label>Master BL / Container</label>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <?=$id;?>
                                        </div>                                            
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 1%;">
                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                            <div class="input-group">
                                                <label>Master BL</label>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" name="no_master_bl" id="no_master_bl" class="form-control blmast" readonly/>
                                        </div>                                            
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 1%;margin-bottom: 3%;">
                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                            <div class="input-group">
                                                <label>No Container</label>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <input type="text" name="no_container" id="no_container" class="form-control contnr" readonly/>
                                        </div>                                            
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: 1%;margin-bottom: 3%;">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <button style="width:100% !important;font-size: 18px !important" type="button" class="btn btn-primary btn-sm" id="BtnCreateH">Create Transaksi&nbsp;<i class='glyphicon glyphicon-folder-open'></i></button>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered display nowrap" id="tblChekOutHead" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>No</th>                                                 
                                                    <th>id_check</th>
                                                    <th>id_container_in</th>
                                                    <th>Master BL</th>
                                                    <th>Container</th>
                                                    <th>Tgl Create</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                
                                <div class="col-md-6 col-sm-6 col-xs-12 boxshadow1" style="margin-bottom: 2%">

                                    <input type="hidden" id="id_check">
                                    <input type="hidden" id="id_container_in">

                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:2%;margin-bottom: -0%;">
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;font-size: 19px;font-weight: bold;color: #ed1544;">
                                            <label>Create Detail Transaksi</label>
                                        </div>                                            
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:2%;margin-bottom: -0%;">
                                        <div class="col-md-3 col-sm-3 col-xs-12"></div>
                                        <div class="col-md-6 col-sm-6 col-xs-12" style="text-align: center;">
                                            <input type="text" id="tgl_check" name="tgl_check" class="form-control tanggal" value="<?php echo date('d-m-Y') ?>" data-date-format="dd-mm-yyyy" style="text-align: center;" readonly>
                                        </div>      
                                        <div class="col-md-3 col-sm-3 col-xs-12"></div>                                      
                                    </div>    
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:2%;margin-bottom: -0%;">
                                        <div class="col-md-3 col-sm-3 col-xs-12"></div>
                                        <div class="col-md-6 col-sm-6 col-xs-12" style="text-align: center;">
                                            <input type="text" id="jam_check" name="jam_check" class="form-control" style="text-align: center;" readonly>
                                        </div>      
                                        <div class="col-md-3 col-sm-3 col-xs-12"></div>                                      
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:2%;margin-bottom: -0%;">
                                        <div class="col-md-12 col-sm-12 col-xs-12 blmastercolor" style="text-align: center;">
                                            <label id="textblmaster" class="blmast">Master BL</label>
                                        </div>                                            
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -0%;">
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                                            <label id="textnocontainer" class="contnr">No Container</label>
                                        </div>                                            
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -0%;">
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                                            <label><i class='glyphicon glyphicon-arrow-down'></i>Scan Disini / Input Manual</label>
                                        </div>                                            
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -0%;display: block;" id="divBtnCamera1">
                                        <div class="col-md-6 col-sm-6 col-xs-12" style="text-align: center;">
                                            <label id="BukaCamera"><i class='glyphicon glyphicon-camera'></i> Buka Camera</label>
                                        </div>      
                                        <div class="col-md-6 col-sm-6 col-xs-12" style="text-align: center;">
                                            <label id="TutupCamera"><i class='glyphicon glyphicon-camera'></i> Tutup Camera</label>
                                        </div>                                       
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -0%;display: block;" id="divBtnCamera2">
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                                            <div id="reader"></div>
                                        </div>                                            
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom: -0%;">
                                        <div class="col-md-2 col-sm-2 col-xs-12"></div>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="text" name="nocn" id="nocn" style="text-align: center;" class="form-control" placeholder="Input BL MARKING/CN" />
                                        </div>    
                                        <div class="col-md-2 col-sm-2 col-xs-12"></div>                                      
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 1%;margin-bottom: 1%;">
                                        <div class="col-md-2 col-sm-2 col-xs-12"></div>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <button style="width:100% !important;font-size: 18px !important" type="button" class="btn btn-primary btn-sm" id="BtnCheckCN"><i class='glyphicon glyphicon-check'></i>&nbsp;Check</button>
                                        </div>    
                                        <div class="col-md-2 col-sm-2 col-xs-12"></div>                                       
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered display nowrap" id="tblCnChecked" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>No</th>       
                                                    <th>id_check_detail</th>                                    
                                                    <th>BL Marking / CN</th>
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
<script src="<?= site_url($this->session->userdata('t_assets')); ?>/js/html5-qrcode.min.js"></script>

<script type = "text/javascript" >
    let html5QrCode = new Html5Qrcode("reader");
    let cameraStarted = false;

    function onScanSuccess(decodedText, decodedResult) {
        // Hasil scan barcode akan ditampilkan di input field dengan id nocn
        document.getElementById('nocn').value = decodedText;
    }

    function onScanError(errorMessage) {
        // Opsional: handle error scan
        console.log(errorMessage);
    }

    // Fungsi untuk membuka kamera saat tombol "Buka Camera" diklik
    document.getElementById('BukaCamera').addEventListener('click', function() {
        if (!cameraStarted) {
            document.getElementById('reader').style.display = 'block'; // Tampilkan elemen kamera
            html5QrCode.start(
                { facingMode: "environment" },  // Bisa diganti ke 'user' untuk kamera depan
                { fps: 10, qrbox: { width: 250, height: 250 } },
                onScanSuccess,
                onScanError
                ).then(() => {
                    cameraStarted = true;
                }).catch(err => {
                    console.log("Gagal membuka kamera: ", err);
                });
            }
        });

    // Fungsi untuk menutup kamera saat tombol "Tutup Camera" diklik
    document.getElementById('TutupCamera').addEventListener('click', function() {
        if (cameraStarted) {
            html5QrCode.stop().then(() => {
                console.log("Kamera berhasil dihentikan.");
                document.getElementById('reader').style.display = 'none'; // Sembunyikan elemen kamera
                cameraStarted = false;
            }).catch(err => {
                console.log("Gagal menghentikan kamera: ", err);
            });
        }
    });

</script>

<!-- <script type="text/javascript">
    navigator.mediaDevices.getUserMedia({ video: true })
    .then(function(stream) {
        // Izin berhasil diberikan, kamera dapat digunakan
        console.log("Akses kamera berhasil.");
    })
    .catch(function(err) {
        // Jika izin ditolak
        console.log("Akses kamera ditolak: " + err);
        alert("Izinkan akses kamera untuk menggunakan fitur ini.");
    });

    let html5QrCode = new Html5Qrcode("reader");

    function onScanSuccess(decodedText, decodedResult) {
        // Hasil scan barcode akan ditampilkan di input field dengan id nocn
        document.getElementById('nocn').value = decodedText;
    }

    function onScanError(errorMessage) {
        // Opsional: handle error scan
        console.log(errorMessage);
    }

    // Fungsi untuk membuka kamera saat tombol "Buka Camera" diklik
    document.getElementById('BukaCamera').addEventListener('click', function() {
        document.getElementById('reader').style.display = 'block'; // Tampilkan elemen kamera
        html5QrCode.start(
            { facingMode: "environment" },  // Bisa diganti ke 'user' untuk kamera depan
            { fps: 10, qrbox: { width: 250, height: 250 } },
            onScanSuccess,
            onScanError
        ).catch(err => {
            console.log("Gagal membuka kamera: ", err);
        });
    });

    // Fungsi untuk menutup kamera saat tombol "Tutup Camera" diklik
    document.getElementById('TutupCamera').addEventListener('click', function() {
        html5QrCode.stop().then(() => {
            console.log("Kamera berhasil dihentikan.");
            document.getElementById('reader').style.display = 'none'; // Sembunyikan elemen kamera
        }).catch(err => {
            console.log("Gagal menghentikan kamera: ", err);
        });
    });

</script> -->

<script type = "text/javascript" >
    var tblChekOutHead ;
    var tblCnChecked ;
    var id_container_in = "" ;
    let clockInterval;

    setInterval(function(){
        tblCnChecked.ajax.reload();
    }, 1000);

    $(".select2").select2();

    function updateClock() {
        const now = new Date();
        let hours = now.getHours();
        let minutes = now.getMinutes();
        let seconds = now.getSeconds();

        // Tambahkan 0 di depan jika angka kurang dari 10
        if (hours < 10) hours = '0' + hours;
        if (minutes < 10) minutes = '0' + minutes;
        if (seconds < 10) seconds = '0' + seconds;

        // Format jam sebagai "HH:MM:SS"
        const timeString = hours + ':' + minutes + ':' + seconds;

        // Tampilkan waktu pada input
        document.getElementById('jam_check').value = timeString;

        // Cek dan update tanggal jika sudah lewat jam 12 malam
        checkAndUpdateDate(hours);
    }

    function checkAndUpdateDate(currentHours) {
        // Ambil tanggal saat ini dari input
        let dateParts = document.getElementById('tgl_check').value.split('-');
        let day = parseInt(dateParts[0]);
        let month = parseInt(dateParts[1]) - 1; // Bulan dalam Date() dimulai dari 0 (Januari = 0)
        let year = parseInt(dateParts[2]);

        // Cek jika sudah lewat jam 12 malam
        if (currentHours === 0 && seconds === 0 && minutes === 0) { 
            // Tambah 1 hari
            let newDate = new Date(year, month, day + 1);

            // Format tanggal baru ke dd-mm-yyyy
            let newDay = ('0' + newDate.getDate()).slice(-2);
            let newMonth = ('0' + (newDate.getMonth() + 1)).slice(-2);
            let newYear = newDate.getFullYear();

            // Update nilai input dengan tanggal baru
            document.getElementById('tgl_check').value = `${newDay}-${newMonth}-${newYear}`;
        }
    }

    function startClock() {
        // Mulai interval untuk memperbarui jam setiap detik
        clockInterval = setInterval(updateClock, 1000);
    }

    function stopClock() {
        // Hentikan interval untuk menghentikan jam
        clearInterval(clockInterval);
    }

    // Mulai jam saat halaman dimuat
    startClock();


    $('#id').on('change',function () {
        // var value = $(this).val();
        // alert(value);

        var textblcont = $('#id option:selected').text();
        //alert(textblcont);

        var textsplit = textblcont.split(" - ");

        var bl = textsplit[0];
        var cont = textsplit[1];


        $('#no_master_bl').val(bl);
        $('#no_container').val(cont);

        id_container_in = $(this).val() ;
    });

    $('#BtnCreateH').on('click',function(){

        if(id_container_in == ""){
            alert('No Master Bl/Container Belum Dipilih..!!');
            return;
        }

        url = '<?php echo site_url('check_out_pjt/createcheck') ?>';
        data = {
            id_container_in:id_container_in,
            no_master_bl:$('#no_master_bl').val(),
            no_container:$('#no_container').val()
        } ;
        pesan = 'JavaScript savecn Error...';
        $("#loading_proses_ajax").show();
        multi_ajax_proses_spinner(url, data, pesan).then(function (dataok){
            $("#loading_proses_ajax").hide();
            if(dataok.msg != "Ya"){
                alert(dataok.pesan);
                return;
            }
            alert(dataok.pesan);



            tblChekOutHead.ajax.reload();
        })
        .catch(function (error) {
            $("#loading_proses_ajax").hide();

            alert(pesan) ;

        }); 


    });

    

    $('#BtnCheckCN').on('click',function(){

        if($('#nocn').val() == ""){
            alert('NO BL MARKING / CN Harus Diisi..!!');
            $('#nocn').focus();
            return;
        }

        if($('#id_check').val() == ""){
            alert('Pilih Data Di di Tabel Header Transaksi..!!');
            return;
        }

        url1 = '<?php echo site_url('check_out_pjt/savecn') ?>';
        data1 = {
            id_container_in:$('#id_container_in').val(),
            no_master_bl:$("#textblmaster").text(),
            no_container:$("#textnocontainer").text(),
            nocn:$('#nocn').val(),
            tgl_check:$('#tgl_check').val(),
            jam_check:$('#jam_check').val(),
            id_check:$('#id_check').val(),
        } ;
        pesan1 = 'JavaScript savecn Error...';
        $("#loading_proses_ajax").show();
        multi_ajax_proses_spinner(url1, data1, pesan1).then(function (dataok1){
            
            $("#loading_proses_ajax").hide();

            console.log(dataok1) ;

            if(dataok1.msg != "Ya"){
                alert(dataok1.pesan);
                return ;
            }

            alert(dataok1.pesan);
            tblCnChecked.ajax.reload();
            $('#nocn').val("");

        })
        .catch(function (error) {
            
            console.log(error) ;

            $("#loading_proses_ajax").hide();
            alert(pesan1) ;

        });             
    });

    $(document).ready(function() {
        tblChekOutHead = $('#tblChekOutHead').DataTable({
            "ajax": {
                "url": "<?php echo site_url('check_out_pjt/fetch_h_table'); ?>",
                "type": "POST",
                "cache": false,
                "beforeSend": function() {
                    $("#loading_proses_ajax").show();
                },
                "data": function(data) {

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
            { "data": "id_check"},
            { "data": "id_container_in"},
            { "data": "no_master_bl"},
            { "data": "no_container"},
            { "data": "tgl_create"},
            ],
            "pagingType": "simple",
            "pageLength": 15,
            "order": [],
            "ordering": false,
            "scrollX": true,
            "scrollY": "300px",
            "scrollCollapse": true,
            "searching"     : false,
            "bLengthChange" : false,
            "columnDefs": [
            { 
                    "targets": [1,2], // Menyembunyikan kolom kedua (id_container_in)
                    "visible": false
                }
                ],
        });

        $('#tblChekOutHead').on('click', 'tr', function () {
            var data = tblChekOutHead.row(this).data();
            $('#id_check').val("");
            $('#id_container_in').val("");
            $('#textblmaster').text("Master BL");
            $('#textnocontainer').text("No Container");

            if ($(this).hasClass('selected')) {
                $('#id_check').val("");
                $('#id_container_in').val("");
                $('#textblmaster').text("Master BL");
                $('#textnocontainer').text("No Container");
                $(this).removeClass('selected');
            } else {
                // $("#jmbox").text(" Jumlah Box = "+ data['jumlah_box']);
                // id_manifest = data['id_manifest'];

                $('#id_check').val(data['id_check']);
                $('#id_container_in').val(data['id_container_in']);
                $('#textblmaster').text(data['no_master_bl']);
                $('#textnocontainer').text(data['no_container']);

                tblCnChecked.ajax.reload();

                tblChekOutHead.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });

        tblCnChecked = $('#tblCnChecked').DataTable({
            "ajax": {
                "url": "<?php echo site_url('check_out_pjt/fetch_table'); ?>",
                "type": "POST",
                "cache": false,
                "beforeSend": function() {
                    $("#loading_proses_ajax").show();
                },
                "data": function(data) {
                    data.id_check = $('#id_check').val();
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
            { "data": "id_check_detail"},
            { "data": "boxmarking"},
            ],
            "pagingType": "simple",
            "pageLength": 15,
            "order": [],
            "ordering": false,
            "scrollX": true,
            "scrollY": "300px",
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




</script>