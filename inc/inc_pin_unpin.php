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
	$pin=$_POST["pin"];
	$grpId = $_POST["grpid"];
	$cn = odbc_connect($_SESSION['cn'],'','') or die('nie je mozne sa pripojit k DB');
	$strSQL="CALL DF_MyLinks_Data.myLinksGroups_pinUnpin($grpId,$pin)";
	$rs = odbc_exec($cn, $strSQL);
	odbc_free_result ($rs);
	odbc_close($cn);
	return;
?>				
