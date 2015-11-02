
<?php
	include "secret.php";	

	function iif($condion, $true, $false ) {
    return ($condition ? $true : $false);
}
 

function random_color()
{
    mt_srand((double)microtime()*1000000);
    $c = '';
    while(strlen($c)<6){
        $c .= sprintf("%02X", mt_rand(100, 255));
    }
    return "#".$c;
}


function urobSkupinu($id,$nazov,$pinned,$cntLinks)
{
	$cls="";
	switch ($pinned) {
    case 99:
        $cls="";
        break;
    case -1:
        $cls="pinned";
        break;
    case 0:
        $cls="unpinned";
        break;
		}
		echo "<tr><td colspan='2' class='grpSeparator'><a class='grpName' href='javascript:void(0)'>".$nazov."</a><span style='float:left;padding-left:10px;'>[".$cntLinks."]</span><input type='hidden' value='".$id."'/><span class='pushPin ".$cls."'>&nbsp;</span></td></tr>\n";
	return;
}

function dajPrislovie()
{
	global $uid;
	global $pwd;
	$ret="";
	$cn = odbc_connect($_SESSION['cn'],$uid,$pwd) or die('nie je mozne sa pripojit k DB');
	$strSQL="select CONVERT(TEXT(4000),DF_Private_Data.PP_dajPrislovie()) as pp";
	if (($rs = odbc_exec($cn, $strSQL)))
	{
		if(($sc=odbc_fetch_row($rs)))
	    {
			$ret=odbc_result($rs,"pp");
		}
	}
	odbc_close($cn);
    return $ret;
}

function generateTopTenToOneLine()
{
	/*
	$strSQL="select top 5 * from ";
	$strSQL.="( ";
	$strSQL.=" select ml.showInTop,ml.url as url,ml.id as id,ml.nazov as name,(select ObjGroup->pinned pinned from DF_MyLinks_Data.CrossTable where ObjGroup=1 and ClientIP='".$GLOBALS["clientIP"]."') as pinned, isnull(ml.objskupina,0) as grpid from DF_MyLinks_Data.myLinks ml where isnull(ml.showInTop,0)=1";
	$strSQL.=" union all";
	$strSQL.=" select ml.showInTop,ml.url as url,ml.id as id,ml.nazov as name,(select ObjGroup->pinned pinned from DF_MyLinks_Data.CrossTable where ObjGroup=1 and ClientIP='".$GLOBALS["clientIP"]."') as pinned, isnull(ml.objskupina,0) as grpid from DF_MyLinks_Data.myLinks ml where 1=1";
	$strSQL.=" )";
	*/
	$strSQL="select top 5 * from ";
		$strSQL.="( ";
		$strSQL.=" select ml.showInTop,ml.url as url,ml.id as id,ml.nazov as name,(select pinned pinned from DF_MyLinks_Data.MyLinksGroups where id=1) as pinned, isnull(ml.objskupina,0) as grpid from DF_MyLinks_Data.myLinks ml where isnull(ml.showInTop,0)=1";
		$strSQL.=" union all";
		$strSQL.=" select ml.showInTop,ml.url as url,ml.id as id,ml.nazov as name,(select pinned pinned from DF_MyLinks_Data.MyLinksGroups where id=1) as pinned, isnull(ml.objskupina,0) as grpid from DF_MyLinks_Data.myLinks ml where 1=1";
		$strSQL.=" )";
		
	
	$cn = odbc_connect($_SESSION['cn'],'','') or die('nie je mozne sa pripojit k DB');
	if (($rs = odbc_exec($cn, $strSQL)))
	{
		$a=0;
		echo "<div class=\"span12\">\n";
		echo "<table class=\"table table-hover\">\n";
		echo "<tr class=\"info\">\n<td><a href=\"http://www.google.sk\">google</a></td>\n<td><a href=\"http://localhost/csp/intraWORX/Doch.ui.csp.Home.cls\">IWX Local</a></td>\n<td><a href=\"http://localhost/csp/eSPOC/eSPOC.ui.csp.Home.cls\">eSPOC Local</a></td>\n";
		while (odbc_fetch_row($rs))
		{
			$url=odbc_result($rs,"url");
			$name=odbc_result($rs,"name");
			$a = $a+1;
			$ciarka = $a < 5 ? ',' : '';
			echo "<td><a href=\"$url\">$name</a></td>\n";
		}
		echo "<td><a href=\"http://www.topspravy.sk/\">TOP správy</a></td>\n";
		echo "<td><a href=\"inc\inc_radiotuna.php\" target=\"_new\">Radio TUNA</a></td>\n";
		echo "</tr>\n</table>\n</div>\n";
	}
	odbc_free_result ( $rs );
	odbc_close($cn);
    return;
}

function trunkateText($txt)
{
	$ret=$txt;
	if(strlen($txt) > 28 )
	{
		$ret=substr($txt,0,25)."...";
	}
	return $ret;
}

function kresliWidget($tmp)
{
	$cnt=0;
	$display="block";
	$pieces=explode('@',$tmp);
	$grpId=$pieces[0];
	$srot=$pieces[1];
	$strSQL="select grp.id as grpid,isnull(grp.pinned,0) as pinned,isnull(grp.nazov,'') as grpname,ml.hits as hits,ml.id as id,ml.url as url, ml.nazov as name, ml.skupina as skupina from DF_MyLinks_Data.myLinks ml 
	left join DF_MyLinks_Data.myLinksGroups grp on grp.id=ml.objskupina 
	where grp.id=$grpId
	order by created desc,".(intval($srot) == 1 ? "hits desc, ":"")."ml.nazov";
	$cn = odbc_connect($_SESSION['cn'],'','') or die('nie je mozne sa pripojit k DB');
	$rs="";
	if (($rs = odbc_exec($cn, $strSQL)))
	{
		while (odbc_fetch_row($rs))
		{
			$cnt = $cnt+1;
			$url=odbc_result($rs,"url");
			$urlid=odbc_result($rs,"id");
			$name=odbc_result($rs,"name");
			$hits=odbc_result($rs,"hits");
			$grpName=odbc_result($rs,"grpname");
			$pinned=odbc_result($rs,"pinned");
			if($cnt==1)
			{
				$color="#c0c0c0";
				echo "<div class=\"span3 groups\" style=\"background:".($pinned==1 ? $color : random_color() ).";\">\n";
				echo "<span>$grpName</span><span style=\"float:right;\"><input type=\"hidden\" name=\"grpIdHolder\" value=\"$grpId\" /><i class=\"icon-bookmark ".($pinned==1 ? "icon-black" : "icon-white") ."\" style=\"cursor:pointer;\"></i><i class=\"icon-plus-sign ".($pinned==1 ? "icon-black" : "icon-white") ."\" style=\"cursor:pointer;\"></i></span>";
				echo "<div class=\"innergroups\" style=\"display:".($pinned==1 ? "block" : "none")."\">";
				echo "<ul class=\"incontainer\">\n";
			}
			$path_info = pathinfo($url);
			$fimg="";
			if(array_key_exists('extension',$path_info))
			{
				if($path_info['extension']=="gif")
				{
					$fimg=$url;
				}
			}
			echo "<li class=\"incontainer\">\n".chr(9)."<p class=\"grpline\" style=\"display:inline;\"><input class=\"idholder\" type=\"hidden\" value=\"$urlid\" /><a href=\"javascript:void(0);\" onclick=\"clik('$urlid',".intval($hits).",this);\" title=\"$url\">".trunkateText($name)."</a><input class=\"urlholder\" type=\"hidden\" value=\"$url\" />".($fimg !="" ? "<img style=\"height:35px;width:35px;\" src=\"".$fimg."\" />" : "").(intval($hits)>0 ? "<sup style=\"color:silver;padding-left:5px;\">".($hits)."</sup>" : "")."</p><p class=\"edit-container\" style=\"display:none;cursor:pointer;\"><i style=\"float:right;\" class=\"icon-remove\"></i><i style=\"float:right;\" class=\"icon-pencil\"></i></p>\n";
			echo chr(9)."<input type=\"hidden\" value=\"$urlid\" />\n</li>\n";
		}	
		echo "</ul>\n</div></div>\n";
	}
	odbc_close($cn);
	return;
}
?>