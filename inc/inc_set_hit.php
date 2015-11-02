<?php
	include "../secret.php";
	if(!isset($_SESSION['cn']))
	{
		$_SESSION['cn']='DRIVER={InterSystems ODBC};server='.$server.';PORT=1972;PROTOCOL=TCP;DATABASE='.$db.';UID='.$uid.';PWD='.$pwd.';';
	}
	$urlId = $_GET["urlid"];
	$hits = $_GET["hits"];
	$hits=$hits + 1;
	$cn = odbc_connect($_SESSION['cn'],'','') or die('nie je mozne sa pripojit k DB');
	$strSQL="update DF_MyLinks_Data.myLinks set hits=".$hits." where id=".$urlId;
	$rs = odbc_exec($cn, $strSQL);
	header("Content-Type: application/json");
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
?>				
