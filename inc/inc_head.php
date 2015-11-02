<?php
  echo "  <head>
	<title>MyLinks @ Bootstrap</title>\n
	<meta http-equiv=\"content-type\" content=\"text/html;charset=utf-8\">
	<meta http-equiv=\"content-language\" content=\"sk\" />
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<meta name='description' content=''>
	<meta name='author' content=''>
	<link href='bootstrap/css/bootstrap.css' rel='stylesheet'>
	<link href='bootstrap/css/bootstrap-responsive.css' rel='stylesheet'>
	<link href='bootstrap/css/jquery.dialog2.css' rel='stylesheet'>
	<link rel='stylesheet' href='facebook_searchengine/lib/autosuggest/autosuggest_inquisitor.css' type='text/css' media='screen' charset='utf-8'>
	<!--[if lt IE 9]>
		<script src='http://html5shim.googlecode.com/svn/trunk/html5.js'></script>
	<![endif]-->
	<style type='text/css' media='screen'>
		#embedded_css{background:#eee;border-radius: 5px;color:#444;font-size:12px;height:200px;padding:20px 20px;overflow:auto;text-shadow: none;white-space:pre}
		#instructions{background:#444;border-radius: 10px;color:#ccc;margin-top:-20px;text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.5);}
		#plug{border-top: 1px solid #DDD;clear:both;margin-top:20px;padding-top: 22px;}
		.ui-slider {clear:left;cursor:pointer;float:left;margin: 0 0 15px;width: 99%;}
		#plug a, #plug a:hover{color:hsl(0, 100%, 62%);}
		button{clear:left;display:block;float:left;margin:15px auto 22px;width:100%}
		#instructions h2, #instructions h3{color:#eee}
		#plug h4{background:#DCEAF4;border-radius: 10px;padding:15px;}
		#instructions strong{color:#fff;}
		ul.incontainer {margin: 0 0 10px 5px;}
		li.incontainer {list-style:none;}
		.search_example {
		margin:0px 20px 0px 10px;
	}
	.search_bar {
		position:relative;	
		color:#000000;
		font-weight:bold;
		margin:8px 0px;
		padding:0px 5px;
		height:20px;
	}
	.search_bar form {
		display:inline;
	}	
	.search_bar input {
		font-family:Arial,Helvetica,sans-serif;
		font-size:12px;
	}	
	.search_bar ul {
		line-height:19px;
		list-style-image:none;
		list-style-position:outside;
		list-style-type:none;
		margin:3px 0pt 0pt;
		padding:0pt;
		z-index:10000000;
	}	
	.search_bar li {
		color:#333333;
		float:left;
		font-family:Arial,Helvetica,sans-serif;
		font-size:12px;
		font-weight:bold;
		margin-left:5px;
		margin-right:0px;
		width:auto;
	}	
	.search_bar  input.search_txt {
		background:white url(facebook_searchengine/img/searchglass.png) no-repeat scroll 3px 4px;
		border:1px solid #95A5C6;
		color:#000000;
		font-weight:normal;
		padding:2px 0px 2px 17px;
	}	
	.search_bar input.searchBtnOK {
		background:white none repeat scroll 0%;
		border:1px solid #95A5C6;
		color:#000000;
		font-weight:bold;
		padding:1px;
	}	
	
	.search_response {
		position:relative;
		border:2px solid #f8e89d;
		padding:10px;
		padding-left:50px;
		margin:0px;
		background:#ffffff url(facebook_searchengine/img/kghostview.png) no-repeat 0px 10px;
	}
	
	/* 2.2.5 =Comments
	---------------------------------------------------------------------- */
	#comment_list {
		padding-bottom: 20px;
		margin: 0px 10px 0px 10px;
	}
	
	#comment_list h2 { margin: 50px 0 0; }
	#comment_list form input { margin-bottom: 4px; }
	#comment_list form textarea { width: 80%; padding: 7px 5px; margin-top:6px; }
	#comment_list form a {
		color: #555;
		text-decoration: none;
		border-bottom: 1px dotted #fff;
	}
	#comment_list form a:hover { color: #fff; }
	
	#comment_list ul {
		padding: 0;
		margin: 0;
	}
	#comment_list li {
		position: relative;
		display: block;
		padding: 10px 3px;
		margin: 10px 2px;
		background: #fefefe;
		font-family: Verdana;
		font-size: 13px;
		border: 1px solid #ccc;
		-webkit-box-shadow: 0px 0px 5px #000;
		-moz-box-shadow: 0px 0px 5px #000;
		box-shadow: 0px 0px 5px #000;
	}
	
	#comment_list li img.avatar {
		float: left;
		padding: 2px;
		background: #ccc;
		-webkit-box-shadow: 0 0 5px #000;
		-moz-box-shadow: 0 0 5px #000;
		box-shadow: 0 0 5px #000;
		margin: 3px 15px 3px 10px;
		width: 60px;
		height: 50px;
	}
	
	#comment_list li cite,
	#comment_list li cite a {
		font-weight: bold;
		color: #555;
		text-decoration: none;
		font-size: 14px;
	}
	
	#comment_list li p {
		font-size: 13px;
		line-height: 17px;
		padding: 7px 10px;
	}
	
	#comment_list li p a {
		color: #bf697f;
		text-decoration: none;
		border-bottom: 1px dotted #A839B2;
	}
	
	#comment_list li p a:visited { color: #9e3c80; }
	#comment_list li p a:hover { color: #A839B2; }
	
	#comment_list li p.date {
		position: absolute;
		top: 0px;
		right: 10px;
		text-transform: capitalize;
		font-size: 10px;
		padding: 2px 5px 0;
	}
	
	#comment_list li p.edit {
		position: absolute;
		bottom: 3px;
		right: 10px;
	}
	
	#comment_list li code, #comment_list li pre {
		position: relative;
		display: block;
		color: #262626;
		padding:  0 15px;
	}
	
	.pink { background-color:#d91e4e; color:#FFFFFF; border-color:#d91e4e; }
	</style>
	<script type='text/javascript' src='bootstrap/js/jquery-1.8.2.min.js'></script>
	<script type='text/javascript' src='bootstrap/js/jquery-ui-1.8.24.custom.min.js'></script>
	<script type='text/javascript' src='bootstrap/js/bootstrap.js'></script>
	<script type='text/javascript' src='bootstrap/js/bootstrap.min.js'></script>
	<script type='text/javascript' src='js/jquery.jec.js'></script>
	<script type='text/javascript' src='js/main.js'></script>
	<script type='text/javascript' src='js/bootbox.js'></script>
	<script type='text/javascript' src='facebook_searchengine/lib/autosuggest/bsn.AutoSuggest_2.1.3.js'></script>
	<script type='text/javascript'>

	/** Init autosuggest on Search Input **/
	jQuery(function() {

	//==================== Search With all plugins =================================================
	// Unbind form submit
	$('.home_searchEngine').bind('submit', function() {return false;} ) ;
	
	var options = {
		script:'facebook_searchengine/AjaxSearch/_doAjaxSearch.action.php?&json=true&limit=20&',
		json:true,
		varname:'input',
		shownoresults:true,				// If disable, display nothing if no results
		noresults:'No Results',			// String displayed when no results
		maxresults:20,					// Max num results displayed
		cache:false,					// To enable cache
		minchars:2,						// Start AJAX request with at leat 2 chars
		timeout:100000,					// AutoHide in XX ms
		callback: function (obj) { 		// Callback after click or selection
			var html = 'ID : ' + obj.id + '<br>Main Text : ' + obj.value + '<br>Info : ' + obj.info;
			document.location.href=obj.info;
			//$('#input_search_all_response').html(html).show() ;
		}
	};
	// Init autosuggest
	var as_json = new bsn.AutoSuggest('input_search_all', options);
	
	// Display a little watermak	
	try
	{
		$('#input_search_all').Watermark('áno paòe...');
	}
	catch(ex){}	
});
</script>
  </head>\n";
  ?>