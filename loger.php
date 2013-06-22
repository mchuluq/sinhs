<?php
error_reporting(0);
$log_ip = $_SERVER['REMOTE_ADDR'];
$log_time = date("F j, Y, H:i:s");
$log_agent = $_SERVER['HTTP_USER_AGENT'];
$log_request = $_SERVER['REQUEST_URI'];
$log_all = $log_ip." # ".$log_time." # ".$log_request." # ".$log_agent ;
$_logfilename = "app/application/logs/url_request/log_".date("Y-m");
if(!file_exists($_logfilename)){
    $_logfilehandler = fopen($_logfilename,'w');
    fwrite($_logfilehandler, "/* Log File for 'Sistem Informasi Nilai Hasil Studi' */\n");
	fwrite($_logfilehandler,$log_all."\n");
    fclose($_logfilehandler);
}else{
    $_logfilehandler = fopen($_logfilename,'a');
	fwrite($_logfilehandler,$log_all."\n");
	fclose($_logfilehandler);
} 


