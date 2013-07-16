<?php
/**
 * sinhs.
 * User: mochammad c. chuluq
 * Date: 07/06/13
 * Time: 19:29
 * Chraven Systems dev. labs.
 */
function safeInput($data) {
    $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
    $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
    $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
    $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');
    $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);
    $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);
    do {
        $old_data = $data;
        $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
    }
    while ($old_data !== $data);
    return mysql_real_escape_string($data);
}
function mysql_to_human($date=null){
    $thn = substr($date,0,-6);
    $bln = substr($date,5,-3);
    $tgl = substr($date,8);
    switch ($bln){
        case "01":
            $bulan = 'January';
            break;
        case "02":
            $bulan = 'February';
            break;
        case "03":
            $bulan = 'March';
            break;
        case "04":
            $bulan = 'April';
            break;
        case "05":
            $bulan = 'May';
            break;
        case "06":
            $bulan = 'June';
            break;
        case "07":
            $bulan = 'July';
            break;
        case "08":
            $bulan = 'August';
            break;
        case "09":
            $bulan = 'September';
            break;
        case "10":
            $bulan = 'October';
            break;
        case "11":
            $bulan = 'November';
            break;
        case "12":
            $bulan = 'December';
            break;
    }
    return ((isset($bulan)) ? $bulan." ".$tgl.", ".$thn : "unknown");
}
function createMkGrup($smtr,$thn='2013/2014',$fp){
    $thn1 = substr($thn,2,2);
    $thn2 = substr($thn,7,2);
    $gg = ($smtr % 2 == 0) ? 'gnp':'gnj';
    $prod = explode('/',$fp);
    return  $smtr.'-'.$gg.'-'.$thn1.'/'.$thn2.'-'.$prod[1];
}
function createFrsGrup($nim,$smtr,$thn,$fp){
    $thn1 = substr($thn,2,2);
    $thn2 = substr($thn,7,2);
    $prod = explode('/',$fp);
    return $nim.'-'.$thn1.'/'.$thn2.'-'.$smtr.'-'.$prod[1];
}
function nilaiHuruf($nilai){
    if($nilai >= 86 AND $nilai <= 100){
        $huruf = 'A';
    }elseif($nilai >= 81 AND $nilai <= 85){
        $huruf = 'A-';
    }elseif($nilai >= 76 AND $nilai <= 80){
        $huruf = 'B+';
    }elseif($nilai >= 70 AND $nilai <= 75){
        $huruf = 'B';
    }elseif($nilai >= 66 AND $nilai <= 69){
        $huruf = 'B-';
    }elseif($nilai >= 61 AND $nilai <= 65){
        $huruf = 'C+';
    }elseif($nilai >= 56 AND $nilai <= 60){
        $huruf = 'C';
    }elseif($nilai >= 41 AND $nilai <= 55){
        $huruf = 'D';
    }elseif($nilai <= 41){
        $huruf = 'E';
    }else{
        $huruf =null;
    }
    return $huruf;
}
function nilaiSksn($huruf,$sks){
    switch($huruf){
        case 'A' :
            $sksn = '4';
            break;
        case 'A-' :
            $sksn = '3.7';
            break;
        case 'B+' :
            $sksn = '3.3';
            break;
        case 'B' :
            $sksn = '3';
            break;
        case 'B-' :
            $sksn = '2.7';
            break;
        case 'C+' :
            $sksn = '2.3';
            break;
        case 'C' :
            $sksn = '2';
            break;
        case 'D' :
            $sksn = '1';
            break;
        case 'E' :
            $sksn = '0';
            break;
        default :
            $sksn = null;
            break;
    }
    return $sksn * $sks;
}

function countIpK($data){
    $t_sksn = 0;
    $t_sks = 0;
    foreach($data as $frs):
        if($frs['frs_status'] == '1'){
            $t_sksn = $t_sksn + nilaiSksn($frs['frs_nilai_huruf'],$frs['mk_sks']);
            $t_sks = $t_sks + $frs['mk_sks'];
        }
    endforeach;
    $ipm = round($t_sksn,2) / $t_sks;
    $ip = round($ipm,2);
    return array('total_sks'=>$t_sks,'total_sksn'=>$t_sksn,'ip'=>$ip);
}
function countIpS($data){
    $t_sksn = 0;
    $t_sks = 0;
    foreach($data as $frs):
        $t_sksn = $t_sksn + nilaiSksn($frs['frs_nilai_huruf'],$frs['mk_sks']);
        $t_sks = $t_sks + $frs['mk_sks'];
    endforeach;
    $ipm = round($t_sksn,2) / $t_sks;
    $ip = round($ipm,2);
    return array('total_sks'=>$t_sks,'total_sksn'=>$t_sksn,'ip'=>$ip);
}

function tingkatKelulusan($ipk){
    if($ipk >= 3.5 and $ipk <= 4){
        $tk = "Cumlaude";
    }elseif($ipk < 3.5 and $ipk >= 3){
        $tk = "Sangat Memuaskan";
    }elseif($ipk < 3 and $ipk >= 2.5){
        $tk = "Baik";
    }elseif($ipk < 2.5 and $ipk >= 2){
        $tk = "Cukup";
    }elseif($ipk < 2){
        $tk = "Kurang";
    }else{
        $tk = "tidak diketahui";
    }
    return $tk;
}