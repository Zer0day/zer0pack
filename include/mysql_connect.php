<?php
include('config.php');
mysql_connect($mysql_server,$mysql_user,$mysql_password);
mysql_select_db($mysql_db);

function EntryExists($ip) {
$time=date("j.n.Y");
$mysql_table=$mysql_prefix."visitors";
$result = mysql_query("SELECT * FROM `"._PREFIX_."visitors` WHERE ip = '$ip' AND date = '$time'");
$NumNames = @mysql_num_rows($result);
if($NumNames==0) {
return false;
} else{
return true;
}
}

function ModuleExists($filename) {
$time=date("j.n.Y");
$result = mysql_query("SELECT * FROM `"._PREFIX_."xmodules` WHERE filename = '$filename'");
$NumNames = @mysql_num_rows($result);
if($NumNames==0) {
return false;
} else{
return true;
}
}

function SettingTrue($name, $ret=0) {
	$sql="SELECT `status` FROM `"._PREFIX_."settings` WHERE `name` = '$name'";
	$result=mysql_query($sql) OR die(mysql_error());
	$status=mysql_fetch_assoc($result);
	
	if($status['status']=="true") {
		return true;
	} else {
		if($ret) {
			return $status['status'];
		} else {
			return false;
		}
	}
}
?>