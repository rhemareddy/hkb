<?php
include("../ADMIN/Utils.php");
include_once("security.php");

if(!isset($LANG)){
	echo "The language is not set!";
	exit();
}

mysql_connect($DBHost,$DBUser,$DBPass);
mysql_select_db($DBName);

$strCode= addslashes(str_replace("=\"../images/","=\"images/",stripslashes($strCode)));
$strCode=str_replace("border: 1px dotted rgb(191, 191, 191);","",$strCode);
$strCode=str_replace("style=\"border: 1px dashed #AAAAAA;\"","",$strCode);
$strCode=str_replace("border: 1px dashed #AAAAAA;","",$strCode);
$strCode=str_replace("BORDER-RIGHT: #bfbfbf 1px dotted; BORDER-TOP: #bfbfbf 1px dotted; BORDER-LEFT: #bfbfbf 1px dotted; BORDER-BOTTOM: #bfbfbf 1px dotted","",$strCode);
$strCode=str_replace("#bfbfbf 1px dotted","#bfbfbf 0px dotted",$strCode);
$strCode=str_replace("^","",$strCode);
ms_i($page);
mysql_query("UPDATE  $DBprefix"."user_pages
SET html_".trim($LANG)."='$strCode'
WHERE 
user='".$AuthUserName."' AND  
id=".$page) or die("<script>alert(\"".mysql_error()."\");</script>");

mysql_close();
?>

<script>
parent.pageSaved();
</script>
