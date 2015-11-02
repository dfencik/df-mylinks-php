<?php
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
	header("Cache-Control: no-store, no-cache, must-revalidate"); 
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
  	include "inc/inc_session.php";
	include "inc/inc_doctype.php";
	include "inc/inc_head.php";
	include "inc/inc_common.php";
	include "inc/soap.php";
?>
<body>
<div class="container-fluid">
 <div class="span12">
 <div class="span12" style="background-color:#d9edf7;"><p style="padding:5px;font-weight:bold;"><?php 
 $prislovie = dajPrislovie();
 echo $prislovie;
 ?></p></div>
 <div id="playlist"></div> 
 <?php 
	generateTopTenToOneLine();
?>
<div class="search_example span12" style="margin-left:20px;"> 
	<div class="search_bar">
	<form method="post" action="/search_engine/" class="home_searchEngine" id="form_search_all">
	<input type="hidden" id="search_all_value" name="search_value">
	<ul>			
	<li><input type="text" name="search_txt" id="input_search_all" class="search_txt" style="width:500px;"></li>
	<li><input type="submit" class="searchBtnOK" value="Vymaž" onclick="$('#input_search_all').val('');$('#input_search_all').Watermark('áno paòe...');" style="width:50px;"></li>
	</ul>
	</form>		
	</div>
	
	<div style="clear:both;margin:0px 10px;height:5px;"></div>
			
	<div style="margin-top:0px;">
		<div class="search_response" style="display:none;" id="input_search_all_response"></div>
	</div>
</div>
<?php
	$strSQL="select * from 
		(select sortByHits as sbh,isnull(ml.pinned,0) pinned,id as grpId,nazov as grpNazov, (select COUNT(id) from DF_MyLinks_Data.myLinks where objskupina=ml.id) as pocetOdkazov from DF_MyLinks_Data.myLinksGroups ml)
		where pocetOdkazov > 0	
		order by pinned desc,3 asc";
	$cn = odbc_connect($_SESSION['cn'],'','') or die('nie je mozne sa pripojit k DB');
	$grpIds=array();
	if (($rs = odbc_exec($cn, $strSQL)))
	{
		while (odbc_fetch_row($rs))
		{
			$grpid=odbc_result($rs,"grpId");
			$sbh=odbc_result($rs,"sbh");
			array_push($grpIds,($grpid.'@'.$sbh));
		}
	}
	odbc_free_result ( $rs );
	odbc_close($cn);
	foreach ($grpIds as &$grpid) 
	{
		kresliWidget($grpid);
	}
?>
</div>
</div>
<script type='text/javascript' src='facebook_searchengine/lib/jquery.watermarkinput.js'></script>	
<script type='text/javascript' src='facebook_searchengine/lib/autosuggest/bsn.AutoSuggest_2.1.3.js'></script>	
</body>
</html>