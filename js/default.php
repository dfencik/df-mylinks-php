<?php
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
	header("Cache-Control: no-store, no-cache, must-revalidate"); 
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
	include "inc/inc_doctype.php";
	include "inc/inc_head.php";
	include "inc/inc_common.php"
?>
<body>
<div class="container-fluid">
 <div class="span12">
 <div class="span12" style="background-color:#d9edf7;"><p style="padding:5px;font-weight:bold;">
 <?php
$connection = mysqli_connect('localhost', );
if (!$connection) {
    die('Could not connect: ' . mysqli_error());
}
echo 'Connected successfully';
mysqli_close($connection);
?>
 </div>
 </div>
 </div>
</body>
</html>