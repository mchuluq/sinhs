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
    if($nilai >= 93 AND $nilai <= 100){
        $huruf = 'A';
    }elseif($nilai >= 90 AND $nilai <= 92){
        $huruf = 'A-';
    }elseif($nilai >= 87 AND $nilai <= 89){
        $huruf = 'B+';
    }elseif($nilai >= 83 AND $nilai <= 86){
        $huruf = 'B';
    }elseif($nilai >= 80 AND $nilai <= 82){
        $huruf = 'B-';
    }elseif($nilai >= 77 AND $nilai <= 79){
        $huruf = 'C+';
    }elseif($nilai >= 73 AND $nilai <= 76){
        $huruf = 'C';
    }elseif($nilai >= 70 AND $nilai <= 72){
        $huruf = 'C-';
    }elseif($nilai >= 67 AND $nilai <= 69){
        $huruf = 'D+';
    }elseif($nilai >= 63 AND $nilai <= 66){
        $huruf = 'D';
    }elseif($nilai >= 60 AND $nilai <= 62){
        $huruf = 'D-';
    }elseif($nilai <= 59){
        $huruf = 'F';
    }else{
        $huruf =null;
    }
    return $huruf;
}