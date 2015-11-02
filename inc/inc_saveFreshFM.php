<?php
	include "../secret.php";
	if(!isset($_SESSION['cn']))
	{
		$_SESSION['cn']='DRIVER={InterSystems ODBC};server='.$server.';PORT=1972;PROTOCOL=TCP;DATABASE='.$db.';UID='.$uid.';PWD='.$pwd.';';
	}
	$songname = $_GET["songname"];
	$songname = str_replace("&","^",$songname);
	if(isset($_GET["songtime"]))
	{
		$songtime  = $_GET["songtime"];
	}
	if(isset($_GET["songurl"]))
	{	
		$songurl  = $_GET["songurl"];
		$songurl = str_replace("&","^",$songurl);
	}
	header("Content-Type: application/json");
	$cn = odbc_connect($_SESSION['cn'],'','') or die('Chyba~nie je mozne sa pripojit k DB');
	$rs = odbc_exec($cn, "SELECT DF_MyLinks_Data.FreshFMsongs_SaveSongs('".rawurlencode($songtime)."','".rawurlencode($songname)."','".rawurlencode($songurl)."') as skupinaID");
	while(odbc_fetch_row($rs))
	{
  		$grpid=odbc_result($rs,'skupinaID');
	}
	if(odbc_error())
	{ 
		echo "{\"err\": \"".odbc_errormsg($cn)."\"}";
	}
	else
	{
		echo "{\"err\": \"1\"}";
	}
	odbc_free_result ($rs);
	odbc_close($cn);
	exit();
?>