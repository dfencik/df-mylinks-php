<?php
	include "../secret.php";
	if(!isset($_SESSION['cn']))
	{
		$_SESSION['cn']='DRIVER={InterSystems ODBC};server='.$server.';PORT=1972;PROTOCOL=TCP;DATABASE='.$db.';UID='.$uid.';PWD='.$pwd.';';
	}
	$grpid    = $_GET["grpID"];
	$grpname  = $_GET["grpName"];
	$urlname  = $_GET["lnkName"];
	$urllink  = str_replace("~","&",trim($_GET["lnkUrl"]));
	$urlid    = $_GET["lnkID"];
	
	header("Content-Type: application/json");
	//test premennych
	if (($grpname=="") || ($urllink=="") || ($urlname=="") || ($grpid==""))
	{
		echo "Nevyplnené povinné hodnoty.~";
		if($grpid=="" || $grpname=="") { echo "Skupina~";}
		if($urlname=="") { echo "Názov~"; }
		if($urllink=="") { echo "URL~"; }
		echo "{\"err\": \"Nie je možné uloži záznam...\"}";
		exit();
	}

	//test na skupinu ak nie je vytvorime
	$cn = odbc_connect($_SESSION['cn'],'','') or die('Chyba~nie je mozne sa pripojit k DB');
	//$sth = odbc_prepare($cn,"SELECT DF_MyLinks_Data.myLinks_saveNewGroup(?) as skupinaID");
	$rs = odbc_exec($cn, "SELECT DF_MyLinks_Data.myLinks_saveNewGroup('".$grpname."') as skupinaID");
	while(odbc_fetch_row($rs))
	{
  		$grpid=odbc_result($rs,'skupinaID');
	}
	odbc_free_result ($rs);
	odbc_close($cn);
	if($grpid=="")
	{
		echo "{\"err\": \"".odbc_errormsg($cn)."\"}";
		exit();
	}
	//ulozenie linky
	$cn = odbc_connect($_SESSION['cn'],'','') or die('Chyba~nie je mozne sa pripojit k DB');
	if($urlid == "")
	{
		$rs = odbc_exec($cn,"insert into DF_MyLinks_Data.myLinks (url,nazov,objskupina) values ('".$urllink."','".$urlname."','".$grpid."')");
	}
	else
	{
		$rs = odbc_exec($cn, "update DF_MyLinks_Data.myLinks set url='".$urllink."', nazov='".$urlname."', objskupina=".$grpid." where id=".$urlid);
	}
	if(odbc_error())
	{ 
		echo "{\"err\": \"".odbc_errormsg($cn)."\"}";
	}
	else
	{
		echo "{\"err\": \"1\"}";
	}
	odbc_free_result ( $rs );
	odbc_close($cn);
?>