<?php 	
	header("Content-Type: text/html; charset=windows-1250");
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
	header("Cache-Control: no-store, no-cache, must-revalidate"); 
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	$host=$_SERVER['REMOTE_ADDR'];
	$clientIP="unknown";
	if(strpos(":",$host)!="")
	{
		$clientIP=$host;
	}
	else
	{
		$clientIP="127.0.0.1";
	}	
	$GLOBALS["clientIP"]=$clientIP;
	include "/secret.php";
	if(!isset($_SESSION['cn']))
	{
		$_SESSION['cn']='DRIVER={InterSystems ODBC};server='.$server.';PORT=1972;PROTOCOL=TCP;DATABASE='.$db.';UID='.$uid.';PWD='.$pwd.';CharSet=utf8;';
	}
?>