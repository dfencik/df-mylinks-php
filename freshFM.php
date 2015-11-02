<html lang="sk" xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <meta http-equiv="content-type" content="text/html;charset=utf-8">
	<meta http-equiv="content-language" content="sk" />
	<meta http-equiv="refresh" content="300" />
	<script type='text/javascript' src='bootstrap/js/jquery-1.8.2.min.js'></script>
  </head>
<script type='text/javascript'>
	$(document).ready(function(){
	time=new Array();
	skladba=new Array();
	url=new Array();
	$div=$("<div>");
	$div.appendTo("body");
	$src=$("<div>");
	$src.load('http://playlist.flitskikker.com/ ul.songs', function(){
		$ul=$(this).html();
		$uul=$div.append("<ul>");
		$("li",$ul).each(function(){
			$li=$(this);
			$time=$("span.time",$li);
			$skladba=$("h4",$li);
			$trubka=$skladba.next("a");
			trubka="<span>&nbsp;</span>";
			if(typeof($trubka.html())!="undefined")
			{
				trubka=$trubka;
			}
			$lli=$("<li>"+$time.html()+"<span style=\"padding-left:5px;\">"+$skladba.html()+"<\/span><\/li>");
			$span=$("<span style=\"padding-left:5px;\"><\/span>");
			$span.append(trubka);
			$lli.append($span);
			$uul.append($lli);

			time.push(encodeURI($time.html()));
			skladba.push(encodeURI($("a",$skladba).html()).replace("&amp;","^"));
			if(typeof(trubka)=="object")
			{
				url.push(encodeURI(trubka.attr("href")).replace("&amp;","^"));
			}
			else
			{
				url.push("");
			}
		})
			
			$.ajax({
			  contentType: 'application/x-www-form-urlencoded; charset=windows-1250',
			  url: "inc/inc_saveFreshFM.php",
			  data: "songname="+ skladba.join("~") +"&songtime=" + time.join("~") + "&songurl=" + url.join("~"),
			  success: function(data){
			     msg=eval(data);
				 if(msg.err.toString() != "1")
	     			{
						alert(msg.err);
	     			}
	     		  },
			  async: false
			});
		});
	});
</script>
</body>
</html>