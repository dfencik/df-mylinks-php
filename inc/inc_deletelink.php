<?php
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
	header("Cache-Control: no-store, no-cache, must-revalidate"); 
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	include "../secret.php";
	if(!isset($_SESSION['cn']))
	{
		$_SESSION['cn']='DRIVER={InterSystems ODBC};server='.$server.';PORT=1972;PROTOCOL=TCP;DATABASE='.$db.';UID='.$uid.';PWD='.$pwd.';';
	}
	$urlid    = $_GET["lnkID"];
	
	header("Content-Type: application/json");
	//test premennych
	if ($urlid == "")
	{
		echo "{\"err\": \"Nevyplnené povinné hodnoty.\"}";
	}
	else
	{
		$cn = odbc_connect($_SESSION['cn'],'','') or die('Chyba~nie je mozne sa pripojit k DB');
		$rs = odbc_exec($cn, "DELETE FROM DF_MyLinks_Data.myLinks where id=".$urlid);
		if(odbc_error())
		{ 
			echo "{\"err\": \"".odbc_errormsg($cn)."\"}";
		}
		else
		{
			echo "{\"err\": \"1\"}";
		}
	}
	odbc_free_result($rs);
	odbc_close($cn);
?>