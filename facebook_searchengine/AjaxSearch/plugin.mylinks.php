<?php

 /**
  *		Plugin for search_engine
  *		Do search on world countries
  *		
  */
  
	#@ Detect if loaded by search_engine
	if ( ! SEARCHENGINE_LOADED ) return false;
	
	#@ Category Name
	$searchCat_name = 'Countries' ;
	$db="DF";
	$uid="myLinks";
	$pwd="myLinks";
	$server="localhost";
	#@ Do search
	$cn = odbc_connect('DRIVER={InterSystems ODBC};server='.$server.';PORT=1972;PROTOCOL=TCP;DATABASE='.$db.';UID='.$uid.';PWD='.$pwd.';CharSet=utf8;',$uid,$pwd) or die('nie je mozne sa pripojit k DB');
	$sql = "SELECT TOP 20 ID as id,hits as hits,nazov as nazov,objskupina->nazov as snazov,url as url FROM DF_MyLinks_Data.myLinks where";
	$sql = $sql." for some %ELEMENT(DF_MyLinks_Data.myLinks.SearchIndex) (%value [ '".strtolower($search_engine['options']['input'])."')";
	if (($rs = odbc_exec($cn, $sql)))
	{
		while (odbc_fetch_row($rs))
		{
			//ID,SearchIndex,hits,nazov,objskupina,showInTop,skupina,url
			$linkid=odbc_result($rs,"id");
			$hits=odbc_result($rs,"hits");
			$nazov=odbc_result($rs,"nazov");
			$snazov=odbc_result($rs,"snazov");
			$url=odbc_result($rs,"url");
			$id="linky_".$linkid;
			$results['value'] = utf8_encode(trim($nazov))." (".utf8_encode(trim($snazov)).")";
			$results['info'] = utf8_encode(trim($url)) ;	
			$search_engine['results'][$searchCat_name][$id] = $results ;
		}
	}
	odbc_free_result ( $rs );
	odbc_close($cn);
?>