<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    date_default_timezone_set('Asia/Jakarta'); 


if ( ! function_exists('CheckValidDate')){
    function CheckValidDate($tgl,$nmtanggal) {
        $tgl = trim($tgl);
        
        if ($tgl == "") {
            return $nmtanggal." Belum Diisi..!!";
        }
        
        $d = DateTime::createFromFormat('Ymd', $tgl);
        return $d && $d->format('Ymd') === $tgl ? "ok" : "Format Tanggal ".$nmtanggal." Salah..!!";
    }
}

if (!function_exists('CheckValidTime')) {
    function CheckValidTime($time, $nmwaktu) {
        $time = trim($time);
        
        // Cek jika time kosong
        if ($time == "") {
            return $nmwaktu . " Belum Diisi..!!";
        }
        
        // Cek format waktu
        if (preg_match('/^([01][0-9]|2[0-3])[0-5][0-9]$/', $time)) {
            return "ok";
        } else {
            return "Format " . $nmwaktu . " Salah..!!";
        }
    }
}




if ( ! function_exists('is_date')){
    function is_date($date, $format = 'Y-m-d') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
}

if ( ! function_exists('terbilang')){

    function terbilang($nilai) {
        if($nilai<0) {
            $hasil = "Minus ". trim(penyebut($nilai));
        } else {
            $hasil = trim(penyebut($nilai));
        }           
        return $hasil;
    }

    function penyebut($nilai){
        $nilai = abs($nilai);
        $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " ". $huruf[$nilai];
        } else if ($nilai <20) {
            $temp = penyebut($nilai - 10). " Belas";
        } else if ($nilai < 100) {
            $temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " Seratus" . penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " Seribu" . penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
        }     
        return $temp;
    }



}


if (!function_exists('tgl_indo')) {

    function date_indo($tgl) {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tanggal = $pecah[2];
        $bulan = bulan($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal . ' ' . $bulan . ' ' . $tahun;
    }

}

if (!function_exists('bulan')) {

    function bulan($bln) {
        switch ($bln) {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
        }
    }

}

//Format Shortdate
if (!function_exists('shortdate_indo')) {

    function shortdate_indo($tgl) {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tanggal = $pecah[2];
        $bulan = short_bulan($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal . '/' . $bulan . '/' . $tahun;
    }

}

if (!function_exists('short_bulan')) {

    function short_bulan($bln) {
        switch ($bln) {
            case 1:
                return "01";
                break;
            case 2:
                return "02";
                break;
            case 3:
                return "03";
                break;
            case 4:
                return "04";
                break;
            case 5:
                return "05";
                break;
            case 6:
                return "06";
                break;
            case 7:
                return "07";
                break;
            case 8:
                return "08";
                break;
            case 9:
                return "09";
                break;
            case 10:
                return "10";
                break;
            case 11:
                return "11";
                break;
            case 12:
                return "12";
                break;
        }
    }

}

//Format Medium date
if (!function_exists('mediumdate_indo')) {

    function mediumdate_indo($tgl) {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tanggal = $pecah[2];
        $bulan = medium_bulan($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal . '-' . $bulan . '-' . $tahun;
    }

}

if (!function_exists('medium_bulan')) {

    function medium_bulan($bln) {
        switch ($bln) {
            case 1:
                return "Jan";
                break;
            case 2:
                return "Feb";
                break;
            case 3:
                return "Mar";
                break;
            case 4:
                return "Apr";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Jun";
                break;
            case 7:
                return "Jul";
                break;
            case 8:
                return "Ags";
                break;
            case 9:
                return "Sep";
                break;
            case 10:
                return "Okt";
                break;
            case 11:
                return "Nov";
                break;
            case 12:
                return "Des";
                break;
        }
    }

}

//Long date indo Format
if (!function_exists('longdate_indo')) {

    function longdate_indo($tanggal) {
        $ubah = gmdate($tanggal, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tgl = $pecah[2];
        $bln = $pecah[1];
        $thn = $pecah[0];
        $bulan = bulan($pecah[1]);

        $nama = date("l", mktime(0, 0, 0, $bln, $tgl, $thn));
        $nama_hari = "";
        if ($nama == "Sunday") {
            $nama_hari = "Minggu";
        } else if ($nama == "Monday") {
            $nama_hari = "Senin";
        } else if ($nama == "Tuesday") {
            $nama_hari = "Selasa";
        } else if ($nama == "Wednesday") {
            $nama_hari = "Rabu";
        } else if ($nama == "Thursday") {
            $nama_hari = "Kamis";
        } else if ($nama == "Friday") {
            $nama_hari = "Jumat";
        } else if ($nama == "Saturday") {
            $nama_hari = "Sabtu";
        }
        return $nama_hari . ',' . $tgl . ' ' . $bulan . ' ' . $thn;
    }

}

if (!function_exists('getNamaHari')) {
        function getNamaHari($tanggal) {
        $hari = array(
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        );
        
        $nama_hari = date('l', strtotime($tanggal));
        return $hari[$nama_hari];
    }
}

if (!function_exists('getBulanIndonesia')) {
    function getBulanIndonesia($monthNumber) {
        $bulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];

        return $bulan[$monthNumber];
    }

}



if (!function_exists('tanggal_sekarang')) {

    function tanggal_sekarang() {
        return date('Y-m-d H:i:s');
    }

}


if (!function_exists('date_ymd')) {

    function date_ymd() {
        return date('Y-m-d');
    }

}

if (!function_exists('jam_sekarang')) {

    function jam_sekarang() {
        return date('H:i');
    }

}

if (!function_exists('jam_sekarang_i')) {

    function jam_sekarang_i() {
        return date('H:i:s');
    }

}

if (!function_exists('tanggal_load')) {

    function tanggal_load() {
        return date('d-m-Y');
    }

}

if (!function_exists('showdate_download')) {

    function showdate_download() {
        return date('d F Y H:i:s');
    }

}

if (!function_exists('tgl_ttd')) {

    function tgl_ttd() {
        return date('d M Y');
    }

}

if (!function_exists('showdate_inv2')) {

    function showdate_inv2($tgl) {

        $tgl = date_db($tgl);

        $bulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];

        $date = DateTime::createFromFormat('Y-m-d', $tgl);
        if (!$date) {
            return "Invalid date format!";
        }

        $day = $date->format('d');
        $monthNumber = $date->format('m');
        $year = $date->format('Y');

        return $day . ' ' . $bulan[$monthNumber] . ' ' . $year;
    }

}

if (!function_exists('tgl_ttd_new')) {

    function tgl_ttd_new() {

        $bulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];

        $date = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
        if (!$date) {
            return "Invalid date format!";
        }

        $day = $date->format('d');
        $monthNumber = $date->format('m');
        $year = $date->format('Y');

        return $day . ' ' . $bulan[$monthNumber] . ' ' . $year;


    }

}


if (!function_exists('date_db')) {

    function date_db($tgl) {
        if ($tgl == '' || $tgl == NULL || $tgl == '0000:00:00' || $tgl == '0000:00:00 00:00:00') {
            return Null;
        } else {
            return date("Y-m-d", strtotime($tgl));
        }
    }

}

if (!function_exists('datetime_db')) {

    function datetime_db($tgl) {
        if ($tgl == '' || $tgl == NULL || $tgl == '0000:00:00' || $tgl == '0000:00:00 00:00:00') {
            return Null;
        } else {
            return date("Y-m-d H:i:s", strtotime($tgl));
        }
    }

}

if (!function_exists('date_db_custom')) {

    function date_db_custom($tgl) {
        return date("Y-m-d 00:00:00", strtotime($tgl));
    }

}

if (!function_exists('date_db_custom_end')) {

    function date_db_custom_end($tgl) {
        return date("Y-m-d 23:59:59", strtotime($tgl));
    }

}

if (!function_exists('showdate')) {

    function showdate($tgl) {
        return date('d F Y', strtotime($tgl));
    }

}

if (!function_exists('showdate_inv')) {

    function showdate_inv($tgl) {
        //return date('d-m-Y', strtotime($tgl));
        if ($tgl == '' || $tgl == NULL || $tgl == '0000:00:00' || $tgl == '0000:00:00 00:00:00') {
            return '';
        } else {
            return date('d F Y', strtotime($tgl));
        }
    }

}

if (!function_exists('showdate_inv3')) {

    function showdate_inv3($tgl) {
        //return date('d-m-Y', strtotime($tgl));
        if ($tgl == '' || $tgl == NULL || $tgl == '0000:00:00' || $tgl == '0000:00:00 00:00:00') {
            return '';
        } else {
            return date('d-F-Y', strtotime($tgl));
        }
    }

}

if (!function_exists('showdate_indo')) {

    function showdate_indo($tgl) {
        //return date('d-m-Y', strtotime($tgl));
        if ($tgl == '' || $tgl == NULL || $tgl == '0000:00:00' || $tgl == '0000:00:00 00:00:00') {
            return '';
        } else {
            return date('d-m-Y', strtotime($tgl));
        }
    }

}



if (!function_exists('showdate_indobc')) {

    function showdate_indobc($tgl) {
        //return date('d-m-Y', strtotime($tgl));
        if ($tgl == '' || $tgl == NULL || $tgl == '0000:00:00' || $tgl == '0000:00:00 00:00:00') {
            return '';
        } else {
            return date('d/m/Y', strtotime($tgl));
        }
    }

}

if (!function_exists('showdate_supervisi')) {

    function showdate_supervisi($tgl) {
        //return date('d-m-Y', strtotime($tgl));
        if ($tgl == '' || $tgl == NULL || $tgl == '0000:00:00' || $tgl == '0000:00:00 00:00:00') {
            return '';
        } else {
            return date('d M Y', strtotime($tgl));
        }
    }

}


if (!function_exists('selisih_tanggal')) {

    function selisih_tanggal($tgl1, $tgl2) {
        $date1 = date_create($tgl1);
        $date2 = date_create($tgl2);
        $diff = date_diff($date1, $date2)->format("%a");
        //return $diff+1;
        return $diff;
    }

}

if (!function_exists('format_uang1')) {

    function format_uang1($number) {
        return number_format($number, 0, ',', '.');
    }

}

if (!function_exists('format_dolar')) {

    function format_dolar($number) {
        return number_format($number, 2, '.', ',');
    }

}

if (!function_exists('format_dolar_nol')) {

    function format_dolar_nol($number) {
        return number_format($number, 0, '.', ',');
    }

}

if (!function_exists('format_dolar_nol1')) {

    function format_dolar_nol1($number) {
        return number_format($number, 1, '.', ',');
    }

}

if (!function_exists('format_dolar_roundup')) {

    function format_dolar_roundup($number) {
        return number_format($number, 0, '.', ',');
    }

}

if (!function_exists('format_uang2')) {

    function format_uang2($number) {
        return number_format($number, 0, ',', '.');
    }

}

if (!function_exists('ComboNonDb')) {
    function ComboNonDb($arraydata, $namecbo, $setname, $setclass) {
        $data['$namecbo'] = form_dropdown($namecbo, $arraydata, $setname, 'id="' . $namecbo . '" class="form-control ' . $setclass . '" style="width: 100%"');
        return $data['$namecbo'];
    }
}

if (!function_exists('ComboDb')) {
    function ComboDb($createcombo) {
        foreach ($createcombo['data'] as $row) {
            $arraydata[array_values($row)[0]] = array_values($row)[1];
        }
        $combo = form_dropdown($createcombo['attribute']['idname'], $arraydata, $createcombo['set_data']['set_id'], 'id="' . $createcombo['attribute']['idname'] . '" class="form-control ' . $createcombo['attribute']['class'] . '" style="width: 100%;"');
        return $combo;
    }

}

// $valCategory = $data_qgroup['Category'] ;            
// $namecategory = getNameOnArrayByID($array_category,$valCategory,'Tarif_Category_ID','NamaCategory'); 
if (!function_exists('getNameOnArrayByID')) {
    function getNameOnArrayByID($arraydata, $idsearch , $name_idsearch, $valuesearch) {
      $key = array_search($idsearch, array_column($arraydata, $name_idsearch));
      if ($key !== false) {
        return $arraydata[$key][$valuesearch];
      }
      return null;
    }
}

if (!function_exists('cariDataOnArray')) {
    function cariDataOnArray($array, $target) {
        if (in_array($target, $array)) {
            return "ya";
        } else {
            return "no";
        }
    }
}

if (!function_exists('getFridayInWeek')) {
    function getFridayInWeek($date, $week) {
        // Convert the date string to a timestamp
        $timestamp = strtotime($date);
        
        // Get the year and month from the timestamp
        $year = date('Y', $timestamp);
        $month = date('m', $timestamp);

        // Set the initial date to the first day of the month
        $firstOfMonth = strtotime("$year-$month-01");

        // Get the day of the week of the first day of the month
        $firstDayOfWeek = date('N', $firstOfMonth); // 1 (Monday) to 7 (Sunday)

        // Calculate the offset to the first Friday
        $offset = (5 - $firstDayOfWeek + 7) % 7;

        // Calculate the timestamp for the desired Friday
        $desiredFriday = strtotime("+$offset days", $firstOfMonth);
        $desiredFriday = strtotime("+" . ($week - 1) * 7 . " days", $desiredFriday); // Add 7 days * (week - 1) to get the desired Friday

        return date('Y-m-d', $desiredFriday);
    }
}

if (!function_exists('getLastDayOfMonth')) {
    function getLastDayOfMonth($date) {
        // Convert the date string to a timestamp
        $timestamp = strtotime($date);
        
        // Get the year and month from the timestamp
        $year = date('Y', $timestamp);
        $month = date('m', $timestamp);
        
        return date('Y-m-d', strtotime("last day of $year-$month"));
    }
}

if (!function_exists('GetDataSupervisi')) {
    function GetDataSupervisi($cboOption,$cboParam,$cboPeriode,$startdate,$enddate){
        $query = " SELECT a.Status_Brg_Msk as STATUS_BARANG_MASUK,a.NoBCF,a.TglBCF,a.NoBAP,a.TglBAP,a.no_sprint,a.tgl_sprint,a.KdBC, " ;
        $query.= " a.Vessel,a.voyage,a.Consignee,a.alamat_consignee,a.NoBC1,a.PosBC1,c.Keterangan AS TPS ,b.NoKontainer, " ;
        $query.= " b.ex_kontainer,b.KdCtr,b.Status,b.Tipe_Cargo,b.NamaBrg1,b.NamaBrg2,b.TglTiba,b.TglMasuk,b.TglCacah,b.Pencacahan, " ;
        $query.= " b.TglStripping, CASE WHEN b.KdOut = 'd' THEN 'D' ELSE b.KdOut END AS `KdOut`,b.TglKeluar,b.OverWeight,b.Sling, " ;
        $query.= " b.Low_Bed,b.UkuranCargo,b.measure, b.Category,b.CatLoc,b.Location,b.Keterangan,a.status_brg,a.no_surat, " ;
        $query.= " a.tgl_surat,a.jenis_peruntukan,b.no_segel_merah,b.tgl_segel_merah,b.no_buka_segel_merah, " ;
        $query.= " b.tgl_buka_segel_merah,b.JnsDokTPP,b.NoDok_1,b.TglDok_1,b.TujuanDok_1,b.NoDok_2,b.TglDok_2, " ;
        $query.= " b.TujuanDok_2,b.Storage,b.invtps,b.tglinvtps,b.ContStatus,b.qty,b.satuan,b.no_nhp,b.tgl_nhp, " ;
        $query.= " IFNULL(a.surat_keputusan,'') as 'surat_keputusan',IFNULL(a.tgl_keputusan,'') as 'tgl_keputusan', " ;
        $query.= " a.t_in_id FROM tpp_t_bap AS a  INNER JOIN tpp_t_bap_detail AS b on a.T_In_ID=b.T_In_ID " ;
        $query.= " INNER JOIN tpp_m_tps AS c on a.KdTPS=c.KdTPS " ;
        $query.= " WHERE a.T_In_ID = b.T_In_ID AND a.KdTPS = c.KdTPS AND a.RecID = '0' AND b.RecID <> '9'  " ;

        if($cboPeriode != "Stock"){
            $query.= " AND a.RecID = '0' AND b.RecID <> '9' " ;
        }

        if($cboOption == "Container"){
            $query.= " AND b.Status = 'K' " ;
        }elseif($cboOption == "BBulk 1"){
            $query.= " AND b.Tipe_Cargo = 'B' " ;
        }elseif($cboOption == "BBulk 2"){
            $query.= " AND b.Tipe_Cargo = 'B2' " ;
        }elseif($cboOption == "LCL"){ 
            $query.= " AND b.Tipe_Cargo = 'L' " ;
        }

        if($cboParam == "Container atau Cargo"){

        }elseif($cboParam == "Jns. Brg. BCF 1.5"){

        }elseif($cboParam == "KPU"){
        
        }elseif($cboParam == "No. BAP"){

        }elseif($cboParam == "No. BCF"){

        }elseif($cboParam == "No. Segel Merah"){

        }elseif($cboParam == "No. Surat"){

        }elseif($cboParam == "No. Surat Kep"){

        }elseif($cboParam == "Status Barang"){

        }elseif($cboParam == "STATUS BARANG MASUK"){

        }elseif($cboParam == "TPS"){    

        }elseif($cboParam == "Vessel"){    
        
        }elseif($cboParam == "Consignee"){

        }elseif($cboParam == "Status Cont."){

        }elseif($cboParam == "No. NHP"){    

        }elseif($cboParam == "No. SPRINT"){        

        }


        if($cboPeriode == "Tgl. Masuk"){

            if($enddate != ""){

                if($startdate != ""){
                    $query.= " AND date_format(b.TglMasuk,'%Y-%m-%d') >= '".date_db($startdate)."' " ;
                    $query.= " AND date_format(b.TglMasuk,'%Y-%m-%d') <= '".date_db($enddate)."' " ;
                }else{
                    $query.= " AND date_format(b.TglMasuk,'%Y-%m-%d') <= '".date_db($enddate)."' " ;
                }

            }elseif($startdate != ""){
                $query.= " AND date_format(b.TglMasuk,'%Y-%m-%d') >= '".date_db($startdate)."' " ;
            }

        }elseif($cboPeriode == "Tgl. BCF"){

        }elseif($cboPeriode == "Tgl. SPRINT"){
        
        }elseif($cboPeriode == "Tgl. Keluar"){

        }elseif($cboPeriode == "Tgl. Masuk atau Keluar"){

        }elseif($cboPeriode == "Tgl. Cacah"){

        }elseif($cboPeriode == "Tgl. Stripping"){

        }elseif($cboPeriode == "Tgl. Cacah atau Stripping"){

        }elseif($cboPeriode == "Tgl. Tiba"){

        }elseif($cboPeriode == "Current Stock"){

        }elseif($cboPeriode == "Tgl. Surat"){

        }elseif($cboPeriode == "Stock"){

        }elseif($cboPeriode == "Stock Per Tahun"){    

        }elseif($cboPeriode == "Tgl. NHP"){   

        }
        $query.= " Order By b.TglMasuk,a.NoBCF,a.NoBAP " ;

        return $query ;
    }
}

if (!function_exists('GetDataContainerOut')) {
    function GetDataContainerOut($cboOption,$cboParam,$cboPeriode,$startdate,$enddate){
        $q_contout = " SELECT a.cont_number,a.reff_code,concat(a.vessel,' ',a.voyage) 'vessel_voyage',a.shipper, " ;
        $q_contout.= " a.truck_number,a.do_number,a.seal_number,a.destination,a.cont_date_in,a.cont_date_out " ;
        $q_contout.= " FROM t_t_entry_cont_out a  " ;
        $q_contout.= " inner join t_t_stock b on a.bon_bongkar_number = b.bon_bongkar_number " ;
        $q_contout.= " WHERE date_format(a.cont_date_out,'%Y-%m-%d') >= '".date_db($startdate)."' " ;
        $q_contout.= " AND date_format(a.cont_date_out,'%Y-%m-%d') <= '".date_db($enddate)."' " ;
        $q_contout.= " AND a.code_principal = 'TPP' AND b.cont_condition = 'AV' " ;
        $q_contout.= " AND b.cont_status = 'Full' AND a.rec_id = 0 AND b.rec_id = 1 " ;
        $q_contout.= " GROUP BY a.cont_number " ;
        $q_contout.= " order by a.cont_date_out asc " ;

        return $q_contout ;
    }
}

if (!function_exists('GetDataCargoOut')) {
    function GetDataCargoOut($cboOption,$cboParam,$cboPeriode,$startdate,$enddate){
        $q_cargoout = " SELECT b.Date_Trans,a.NoBCF,a.TglBCF,b.Vehicle,a.Consignee,a.Good_Status,a.ExCont,a.SizeCont, " ;
        $q_cargoout.= " a.Time_Out,a.Destination,a.NoInvoice,a.NoSIPB,b.DescGood,b.Qty,b.Satuan,b.Trans_Number_Detail " ;
        $q_cargoout.= " FROM t_t_cargo_out a, t_t_cargo_out_detail b  " ;
        $q_cargoout.= " WHERE a.Trans_Number = b.Trans_Number and a.RecId = 0  " ;
        $q_cargoout.= " and b.RecID = 0 and date_format(b.Date_Trans,'%Y-%m-%d')  >= '".date_db($startdate)."'  " ;
        $q_cargoout.= " AND date_format(b.Date_Trans,'%Y-%m-%d')  <= '".date_db($enddate)."' " ;
        $q_cargoout.= " AND a.Consignee like '%%' " ;
        $q_cargoout.= " ORDER BY a.Trans_Number " ;

        return $q_cargoout ;
    }
}

if (!function_exists('GetDataContainerOutEmpty')) {
    function GetDataContainerOutEmpty($cboOption,$cboParam,$cboPeriode,$startdate,$enddate){
        $q_cont_empty_out = "" ;
        $q_cont_empty_out.= " SELECT a.cont_number,a.reff_code,a.truck_number,a.seal_number,a.cont_date_out,a.vessel,a.voyage, " ;
        $q_cont_empty_out.= " a.cont_time_out,b.cont_status,b.cont_condition,b.location,b.block_loc " ;
        $q_cont_empty_out.= " FROM t_t_entry_cont_out a " ;
        $q_cont_empty_out.= " inner join t_t_stock b on a.bon_bongkar_number = b.bon_bongkar_number " ;
        $q_cont_empty_out.= " WHERE a.cont_date_out >= '".date_db($startdate)."' AND a.cont_date_out <= '".date_db($enddate)."' " ;
        $q_cont_empty_out.= " AND b.cont_status = 'Empty' AND a.rec_id = 0 AND b.rec_id = 1 " ;
        $q_cont_empty_out.= " order by a.id_cont_out DESC  " ;

        return $q_cont_empty_out ;
    }
}

if (!function_exists('GetDataContainerIn')) {
    function GetDataContainerIn($cboOption,$cboParam,$cboPeriode,$startdate,$enddate){
        $queryContainerIn = "" ;
        $queryContainerIn.= " SELECT  a.TglMasuk, a.NoKontainer,  a.KdCtr, " ;
        $queryContainerIn.= " CASE WHEN a.Tipe_Cargo = 'L' THEN 'LCL' WHEN a.Tipe_Cargo = 'C' THEN 'Container' " ;
        $queryContainerIn.= " WHEN a.Tipe_Cargo = 'B' THEN 'BB1' WHEN a.Tipe_Cargo = 'B2' THEN 'BB2' ELSE '' END AS Tipe, " ;
        $queryContainerIn.= " a.TglCacah,a.TglStripping,a.Category,b.NoBAP,b.NoBCF,c.Keterangan AS TPS,b.KdBC " ;
        $queryContainerIn.= " FROM tpp_t_bap_detail a INNER JOIN tpp_t_bap b ON a.T_IN_ID = b.T_IN_ID " ;
        $queryContainerIn.= " INNER JOIN tpp_m_tps c ON b.KdTPS = c.KdTPS " ;
        $queryContainerIn.= " WHERE date_format(a.TglMasuk,'%Y-%m-%d') >='".date_db($startdate)."'   " ;
        $queryContainerIn.= " and date_format(a.TglMasuk,'%Y-%m-%d') <='".date_db($enddate)."' " ;
        $queryContainerIn.= " AND Tipe_Cargo <> 'L' AND a.RecID <> '9' AND b.RecID <> '9' and a.Tipe_Cargo not in('B','B2') " ;
        $queryContainerIn.= " ORDER BY TglMasuk,NoBAP,NoBCF,NoKontainer " ;

        return $queryContainerIn ;
    }
}

if (!function_exists('GetDataCargoIn')) {
    function GetDataCargoIn($cboOption,$cboParam,$cboPeriode,$startdate,$enddate){
        $queryContainerIn = "" ;
        $queryContainerIn.= " SELECT  a.TglMasuk, a.NoKontainer,  a.KdCtr, " ;
        $queryContainerIn.= " CASE WHEN a.Tipe_Cargo = 'L' THEN 'LCL' WHEN a.Tipe_Cargo = 'C' THEN 'Container' " ;
        $queryContainerIn.= " WHEN a.Tipe_Cargo = 'B' THEN 'BB1' WHEN a.Tipe_Cargo = 'B2' THEN 'BB2' ELSE '' END AS Tipe, " ;
        $queryContainerIn.= " a.TglCacah,a.TglStripping,a.Category,b.NoBAP,b.NoBCF,c.Keterangan AS TPS,b.KdBC,a.UkuranCargo,a.measure,a.NamaBrg1 " ;
        $queryContainerIn.= " FROM tpp_t_bap_detail a INNER JOIN tpp_t_bap b ON a.T_IN_ID = b.T_IN_ID " ;
        $queryContainerIn.= " INNER JOIN tpp_m_tps c ON b.KdTPS = c.KdTPS " ;
        $queryContainerIn.= " WHERE date_format(a.TglMasuk,'%Y-%m-%d') >='".date_db($startdate)."'   " ;
        $queryContainerIn.= " and date_format(a.TglMasuk,'%Y-%m-%d') <='".date_db($enddate)."' " ;
        $queryContainerIn.= " AND Tipe_Cargo <> 'L' AND a.RecID <> '9' AND b.RecID <> '9' and a.Tipe_Cargo in('B','B2') " ;
        $queryContainerIn.= " ORDER BY TglMasuk,NoBAP,NoBCF,NoKontainer " ;

        return $queryContainerIn ;
    }
}

if (!function_exists('GetDataCargoLclIn')) {
    function GetDataCargoLclIn($cboOption,$cboParam,$cboPeriode,$startdate,$enddate){

        $sql = " SELECT a.Status_Brg_Msk as STATUS_BARANG_MASUK,a.NoBCF,a.TglBCF,a.NoBAP,a.TglBAP,a.no_sprint,a.tgl_sprint,a.KdBC,a.Vessel, " ;
        $sql.= " a.voyage,a.Consignee,a.alamat_consignee,a.NoBC1,a.PosBC1,c.Keterangan AS TPS ,b.NoKontainer,b.ex_kontainer,b.KdCtr,b.Status, " ;
        $sql.= " b.Tipe_Cargo,b.NamaBrg1,b.NamaBrg2,b.TglTiba,b.TglMasuk,b.TglCacah,b.Pencacahan,b.TglStripping,  " ;
        $sql.= " CASE WHEN b.KdOut = 'd' THEN 'D' ELSE b.KdOut END AS `KdOut`,b.TglKeluar,b.OverWeight,b.Sling,b.Low_Bed,b.UkuranCargo,b.measure,  " ;
        $sql.= " b.Category,b.CatLoc,b.Location,b.Keterangan,a.status_brg,a.no_surat,a.tgl_surat,a.jenis_peruntukan,b.no_segel_merah, " ;
        $sql.= " b.tgl_segel_merah,b.no_buka_segel_merah,b.tgl_buka_segel_merah,b.JnsDokTPP,b.NoDok_1,b.TglDok_1,b.TujuanDok_1, " ;
        $sql.= " b.NoDok_2,b.TglDok_2,b.TujuanDok_2,b.Storage,b.invtps,b.tglinvtps,b.ContStatus,b.qty,b.satuan,b.no_nhp,b.tgl_nhp, " ;
        $sql.= " IFNULL(a.surat_keputusan,'') as 'surat_keputusan',IFNULL(a.tgl_keputusan,'') as 'tgl_keputusan',a.t_in_id  " ;
        $sql.= " FROM tpp_t_bap AS a  INNER JOIN tpp_t_bap_detail AS b on a.T_In_ID=b.T_In_ID   " ;
        $sql.= " INNER JOIN tpp_m_tps AS c on a.KdTPS=c.KdTPS  " ;
        $sql.= " WHERE a.T_In_ID = b.T_In_ID AND a.KdTPS = c.KdTPS AND a.RecID = '0' AND b.RecID <> '9'   " ;
        $sql.= " AND b.Tipe_Cargo in ('B','B2','L')  " ;
        $sql.= " AND date_format(b.TglMasuk,'%Y-%m-%d') >= '".date_db($startdate)."' AND date_format(b.TglMasuk,'%Y-%m-%d') <= '".date_db($enddate)."'  " ;
        $sql.= " Order By b.TglMasuk,a.NoBCF,a.NoBAP  " ;

        return $sql ;
    }
}


if (!function_exists('GetDataCargoLclOut')) {
    function GetDataCargoLclOut($cboOption,$cboParam,$cboPeriode,$startdate,$enddate){

        $sql = " SELECT a.Status_Brg_Msk as STATUS_BARANG_MASUK,a.NoBCF,a.TglBCF,a.NoBAP,a.TglBAP,a.no_sprint,a.tgl_sprint, " ;
        $sql.= " a.KdBC,a.Vessel,a.voyage,a.Consignee,a.alamat_consignee,a.NoBC1,a.PosBC1,c.Keterangan AS TPS ,b.NoKontainer, " ;
        $sql.= " b.ex_kontainer,b.KdCtr,b.Status,b.Tipe_Cargo,b.NamaBrg1,b.NamaBrg2,b.TglTiba,b.TglMasuk,b.TglCacah,b.Pencacahan, " ;
        $sql.= " b.TglStripping, CASE WHEN b.KdOut = 'd' THEN 'D' ELSE b.KdOut END AS `KdOut`,b.TglKeluar,b.OverWeight,b.Sling, " ;
        $sql.= " b.Low_Bed,b.UkuranCargo,b.measure, b.Category,b.CatLoc,b.Location,b.Keterangan,a.status_brg,a.no_surat, " ;
        $sql.= " a.tgl_surat,a.jenis_peruntukan,b.no_segel_merah,b.tgl_segel_merah,b.no_buka_segel_merah,b.tgl_buka_segel_merah, " ;
        $sql.= " b.JnsDokTPP,b.NoDok_1,b.TglDok_1,b.TujuanDok_1,b.NoDok_2,b.TglDok_2,b.TujuanDok_2,b.Storage,b.invtps,b.tglinvtps, " ;
        $sql.= " b.ContStatus,b.qty,b.satuan,b.no_nhp,b.tgl_nhp,IFNULL(a.surat_keputusan,'') as 'surat_keputusan', " ;
        $sql.= " IFNULL(a.tgl_keputusan,'') as 'tgl_keputusan',a.t_in_id " ;
        $sql.= " FROM tpp_t_bap AS a " ;
        $sql.= " INNER JOIN tpp_t_bap_detail AS b on a.T_In_ID=b.T_In_ID  " ;
        $sql.= " INNER JOIN tpp_m_tps AS c on a.KdTPS=c.KdTPS  " ;
        $sql.= " WHERE a.T_In_ID = b.T_In_ID AND a.KdTPS = c.KdTPS AND a.RecID = '0' AND b.RecID <> '9'  " ;
        $sql.= " AND b.Tipe_Cargo in ('B','B2','L')  AND date_format(b.TglKeluar,'%Y-%m-%d') >= '".date_db($startdate)."' " ;
        $sql.= " AND date_format(b.TglKeluar,'%Y-%m-%d')  <= '".date_db($enddate)."'   Order By b.TglMasuk,a.NoBCF,a.NoBAP " ;
        return $sql ;
    }
}


if (!function_exists('GetDataStockContainer')) {
    function GetDataStockContainer($cboOption,$cboParam,$cboPeriode,$startdate,$enddate){
        $sql = " SELECT a.Status_Brg_Msk as STATUS_BARANG_MASUK,a.NoBCF,a.TglBCF,a.NoBAP,a.TglBAP,a.no_sprint, " ;
        $sql.= " a.tgl_sprint,a.KdBC,a.Vessel,a.voyage,a.Consignee,a.alamat_consignee,a.NoBC1,a.PosBC1,c.Keterangan AS TPS , " ;
        $sql.= " b.NoKontainer,b.ex_kontainer,b.KdCtr,b.Status,b.Tipe_Cargo,b.NamaBrg1,b.NamaBrg2,b.TglTiba,b.TglMasuk,b.TglCacah, " ;
        $sql.= " b.Pencacahan,b.TglStripping, CASE WHEN b.KdOut = 'd' THEN 'D' ELSE b.KdOut END AS `KdOut`,b.TglKeluar,b.OverWeight, " ;
        $sql.= " b.Sling,b.Low_Bed,b.UkuranCargo,b.measure, b.Category,b.CatLoc,b.Location,b.Keterangan,a.status_brg,a.no_surat, " ;
        $sql.= " a.tgl_surat,a.jenis_peruntukan,b.no_segel_merah,b.tgl_segel_merah,b.no_buka_segel_merah,b.tgl_buka_segel_merah, " ;
        $sql.= " b.JnsDokTPP,b.NoDok_1,b.TglDok_1,b.TujuanDok_1,b.NoDok_2,b.TglDok_2,b.TujuanDok_2,b.Storage,b.invtps,b.tglinvtps, " ;
        $sql.= " b.ContStatus,b.qty,b.satuan,b.no_nhp,b.tgl_nhp,IFNULL(a.surat_keputusan,'') as 'surat_keputusan', " ;
        $sql.= " IFNULL(a.tgl_keputusan,'') as 'tgl_keputusan',a.t_in_id  " ;
        $sql.= " FROM tpp_t_bap AS a  " ;
        $sql.= " INNER JOIN tpp_t_bap_detail AS b on a.T_In_ID=b.T_In_ID  " ;
        $sql.= " INNER JOIN tpp_m_tps AS c on a.KdTPS=c.KdTPS  " ;
        $sql.= " WHERE a.T_In_ID = b.T_In_ID AND a.KdTPS = c.KdTPS AND b.Status = 'K'  " ;
        $sql.= " AND ((a.RecID = '0' And b.RecID = '0' and date_format(b.TglMasuk,'%Y-%m-%d') <= '".date_db($enddate)."' )  " ;
        $sql.= " or (a.RecId <> '9' And b.RecId <> '9' and date_format(b.TglMasuk,'%Y-%m-%d') <= '".date_db($enddate)."' " ;
        $sql.= " and date_format(b.TglKeluar,'%Y-%m-%d') > '".date_db($enddate)."' ))  " ;
        $sql.= " Order By b.TglMasuk,a.NoBCF,a.NoBAP " ;

        return $sql ;
    }
}


if (!function_exists('GetDataStockCargoLcl')) {
    function GetDataStockCargoLcl($cboOption,$cboParam,$cboPeriode,$startdate,$enddate){
        $sql = " SELECT a.Status_Brg_Msk as STATUS_BARANG_MASUK,a.NoBCF,a.TglBCF,a.NoBAP,a.TglBAP,a.no_sprint,a.tgl_sprint, " ;
        $sql.= " a.KdBC,a.Vessel,a.voyage,a.Consignee,a.alamat_consignee,a.NoBC1,a.PosBC1,c.Keterangan AS TPS ,b.NoKontainer, " ;
        $sql.= " b.ex_kontainer,b.KdCtr,b.Status,b.Tipe_Cargo,b.NamaBrg1,b.NamaBrg2,b.TglTiba,b.TglMasuk,b.TglCacah,b.Pencacahan, " ;
        $sql.= " b.TglStripping, CASE WHEN b.KdOut = 'd' THEN 'D' ELSE b.KdOut END AS `KdOut`,b.TglKeluar,b.OverWeight, " ;
        $sql.= " b.Sling,b.Low_Bed,b.UkuranCargo,b.measure, b.Category,b.CatLoc,b.Location,b.Keterangan,a.status_brg, " ;
        $sql.= " a.no_surat,a.tgl_surat,a.jenis_peruntukan,b.no_segel_merah,b.tgl_segel_merah,b.no_buka_segel_merah, " ;
        $sql.= " b.tgl_buka_segel_merah,b.JnsDokTPP,b.NoDok_1,b.TglDok_1,b.TujuanDok_1,b.NoDok_2,b.TglDok_2,b.TujuanDok_2, " ;
        $sql.= " b.Storage,b.invtps,b.tglinvtps,b.ContStatus,b.qty,b.satuan,b.no_nhp,b.tgl_nhp, " ;
        $sql.= " IFNULL(a.surat_keputusan,'') as 'surat_keputusan',IFNULL(a.tgl_keputusan,'') as 'tgl_keputusan',a.t_in_id " ;
        $sql.= " FROM tpp_t_bap AS a  " ;
        $sql.= " INNER JOIN tpp_t_bap_detail AS b on a.T_In_ID=b.T_In_ID  " ;
        $sql.= " INNER JOIN tpp_m_tps AS c on a.KdTPS=c.KdTPS  " ;
        $sql.= " WHERE a.T_In_ID = b.T_In_ID AND a.KdTPS = c.KdTPS AND b.Tipe_Cargo in ('B','B2','L')  " ;
        $sql.= " AND ((a.RecID = '0' And b.RecID = '0' and date_format(b.TglMasuk,'%Y-%m-%d') <= '".date_db($enddate)."' )  " ;
        $sql.= " or (a.RecId <> '9' And b.RecId <> '9' and date_format(b.TglMasuk,'%Y-%m-%d') <= '".date_db($enddate)."'  " ;
        $sql.= " and date_format(b.TglKeluar,'%Y-%m-%d') > '".date_db($enddate)."' ))  " ;
        $sql.= " Order By b.TglMasuk,a.NoBCF,a.NoBAP " ;

        return $sql ;
    }
}


if (!function_exists('GetDataContainerOutTPP')) {
    function GetDataContainerOutTPP($cboOption,$cboParam,$cboPeriode,$startdate,$enddate){
        $q_contout = " SELECT DATEDIFF(b.TglKeluar,b.TglMasuk) + 1 'selisih' " ;
        $q_contout.= " FROM tpp_t_bap AS a  " ;
        $q_contout.= " INNER JOIN tpp_t_bap_detail AS b on a.T_In_ID=b.T_In_ID " ;
        $q_contout.= " INNER JOIN tpp_m_tps AS c on a.KdTPS=c.KdTPS  " ;
        $q_contout.= " WHERE a.T_In_ID = b.T_In_ID AND a.KdTPS = c.KdTPS AND a.RecID = '0' AND b.RecID <> '9'  " ;
        $q_contout.= " AND b.Status = 'K'  AND date_format(b.TglKeluar,'%Y-%m-%d') >= '".date_db($startdate)."' " ;
        $q_contout.= " AND date_format(b.TglKeluar,'%Y-%m-%d') <= '".date_db($enddate)."' " ;
        $q_contout.= " Order By b.TglMasuk,a.NoBCF,a.NoBAP " ;

        return $q_contout ;
    }
}

if (!function_exists('convertUkuranCargo')) {
    function convertUkuranCargo($array) {
        // Memeriksa apakah $data null atau bukan array
        if (!is_array($array) || empty($array)) {
            return $array;
        }

        foreach ($array as &$entry) {
            // Jika UkuranCargo kosong, set nilai menjadi 0
            if (empty($entry['UkuranCargo'])) {
                $entry['UkuranCargo'] = '0';
            } else {
                // Memeriksa dan mengubah nilai yang dalam format 3.000, 13.000, 76.000.000 menjadi 3000, 13000, 76000000
                if (preg_match('/^\d{1,3}(\.\d{3})*(,\d+)?$/', $entry['UkuranCargo'])) {
                    // Menghapus titik sebagai pemisah ribuan
                    $entry['UkuranCargo'] = str_replace('.', '', $entry['UkuranCargo']);
                    // Mengganti koma dengan titik jika ada
                    $entry['UkuranCargo'] = str_replace(',', '.', $entry['UkuranCargo']);
                }
            }
        }
        return $array;
    }
}

if (!function_exists('convertUkuranCargoTunggal')) {
    function convertUkuranCargoTunggal($parameter) {
        // Jika parameter kosong, set nilai menjadi 0
        if (empty($parameter)) {
            return '0';
        } else {
            // Memeriksa dan mengubah nilai yang dalam format 3.000, 13.000, 76.000.000 menjadi 3000, 13000, 76000000
            if (preg_match('/^\d{1,3}(\.\d{3})*(,\d+)?$/', $parameter)) {
                // Menghapus titik sebagai pemisah ribuan
                $parameter = str_replace('.', '', $parameter);
                // Mengganti koma dengan titik jika ada
                $parameter = str_replace(',', '.', $parameter);
            }
            return $parameter;
        }
    }
}

if (!function_exists('calculateTotalUkuranCargo')) {
    function calculateTotalUkuranCargo($array) {
        $total = 0;
        foreach ($array as $item) {
            if (isset($item['UkuranCargo']) && is_numeric(str_replace(',', '', $item['UkuranCargo']))) {
                $total += floatval(str_replace(',', '', $item['UkuranCargo']));
            }
        }
        return $total;
    }
}   

if (!function_exists('getUnitCount')) {
    // Fungsi untuk mendapatkan angka dari string
    function getUnitCount($string) {
        // Pola regex untuk mencari angka yang berada sebelum kata 'Unit', 'unit', atau 'UNIT' di akhir kalimat
        $pattern = '/(\d+)\s*unit\s*$/i';
        preg_match($pattern, $string, $matches);
        return isset($matches[1]) ? $matches[1] : 1; // Jika tidak ada kata 'unit', set nilai menjadi 1
    }
}





    // function getFridayInWeek($date, $week) {
    //     // Convert the date string to a timestamp
    //     $timestamp = strtotime($date);
        
    //     // Get the year and month from the timestamp
    //     $year = date('Y', $timestamp);
    //     $month = date('m', $timestamp);

    //     // Set the initial date to the first day of the month
    //     $firstOfMonth = strtotime("$year-$month-01");

    //     // Get the day of the week of the first day of the month
    //     $firstDayOfWeek = date('N', $firstOfMonth); // 1 (Monday) to 7 (Sunday)

    //     // Calculate the offset to the first Friday
    //     $offset = (5 - $firstDayOfWeek + 7) % 7;

    //     // Calculate the timestamp for the desired Friday
    //     $desiredFriday = strtotime("+$offset days", $firstOfMonth);
    //     $desiredFriday = strtotime("+" . ($week - 1) * 7 . " days", $desiredFriday); // Add 7 days * (week - 1) to get the desired Friday

    //     return date('Y-m-d', $desiredFriday);
    // }

    // function getLastDayOfMonth($date) {
    //     // Convert the date string to a timestamp
    //     $timestamp = strtotime($date);
        
    //     // Get the year and month from the timestamp
    //     $year = date('Y', $timestamp);
    //     $month = date('m', $timestamp);
        
    //     return date('Y-m-d', strtotime("last day of $year-$month"));
    // }

    // // Example usage
    // $date = '01-05-2024';

    // // Get the second, third, and fourth Fridays of the month
    // $secondFriday = getFridayInWeek($date, 2);
    // $thirdFriday = getFridayInWeek($date, 3);
    // $fourthFriday = getFridayInWeek($date, 4);

    // // Get the last day of the month
    // $lastDayOfMonth = getLastDayOfMonth($date);

    // echo "Second Friday: $secondFriday\n";
    // echo "Third Friday: $thirdFriday\n";
    // echo "Fourth Friday: $fourthFriday\n";
    // echo "Last Day of Month: $lastDayOfMonth\n";


    

// number_format($field->BiayaTPS,0,',','.') ;

// if (!function_exists('formatdolar')) {
//     function formatdolar($createcombo) {
//         foreach ($createcombo['data'] as $row) {
//             $arraydata[array_values($row)[0]] = array_values($row)[1];
//         }
//         $combo = form_dropdown($createcombo['attribute']['idname'], $arraydata, $createcombo['set_data']['set_id'], 'id="' . $createcombo['attribute']['idname'] . '" class="form-control ' . $createcombo['attribute']['class'] . '" style="width: 100%;"');
//         return $combo;
//     }

// }