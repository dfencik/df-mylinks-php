<?php
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
	header("Cache-Control: no-store, no-cache, must-revalidate"); 
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header("Content-Type: text/html; charset=windows-1250");
	include "../secret.php";
	if(!isset($_SESSION['cn']))
	{
		$_SESSION['cn']='DRIVER={InterSystems ODBC};server='.$server.';PORT=1972;PROTOCOL=TCP;DATABASE='.$db.';UID='.$uid.';PWD='.$pwd.';CharSet=windows-1250;';
	}
	$linkid  = $_GET["linkid"];
	$grpid   = $_GET["grpid"];
	$grpname = $_GET["grpname"];
	$murl    = $_GET["mUrl"];
	//$cn = odbc_connect($_SESSION['cn'],'','') or die('nie je mozne sa pripojit k DB');
	//$strSQL="CALL DF_MyLinks_Data.myLinksGroups_pinUnpin($grpId,$pin)";
	//$rs = odbc_exec($cn, $strSQL);
	//odbc_free_result ($rs);
	//odbc_close($cn);
?>
<div class="newGroup">
<table cellpadding="1" cellspacing="1" border="0" class="mainList">
<tbody>
 <tr>
  <td width="70">Skupina:</td><td>
  <select id="cmbGroup" name="cmbGroup">
  <?php
  	$strSQL='SELECT id as id,nazov as nazov FROM DF_MyLinks_Data.myLinksGroups';
  	$cn = odbc_connect($_SESSION['cn'],'','') or die('nie je mozne sa pripojit k DB');
  	if (($rs = odbc_exec($cn, $strSQL)))
	{
		while (odbc_fetch_row($rs))
  		{
  			$id=odbc_result($rs,'id');
			$name=odbc_result($rs,'nazov');
			echo '<option value=\''.$id.'\''.($grpid==$id ? ' selected=\'selected\'' : '').'>'.$name.'</option>';
  		}
  	}
  	odbc_free_result ( $rs );
  	odbc_close($cn);
  ?>
  </select>
  </td>
 </tr>
 <tr>
  <td width="70">Názov:</td><td><input type="text" name="nazov" id="nazov" value="<?php echo $grpname ?>" style="width: 200px;" /></td>
 </tr>
 <tr>
  <td>URL:</tD><td><input type="text" name="murl" id="murl" style="width: 400px;" value="<?php echo $murl ?>" />
  </td>
 </tr>
</tbody>
 </table>
</div>