<?php
session_start();
if($_COOKIE['zer0pack']!=session_id()) {
	die('<meta http-equiv="Refresh" content="0;url=index.php">');
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<meta name="robots" content="noindex" />
<link rel="stylesheet" type="text/css" href="style.css" media="screen"/>
<title>Zer0pack - ACP</title>
</head>
<body>
<div class="outer-container">
<div class="inner-container">
	<div class="header">
	
		<div class="title">
			<span class="headline"><a href="acp.php">Zer0pack</a></span>
			<div class="subtitle">An Open Source Webattack Toolkit</div>
		</div>		

	</div>

	<div class="main">
	
		<div class="content">

			<?php

			// lfi filter!

			$modules=array('global.php', 'countries.php', 'browsers.php', 'search.php', 'main.php', 'xss.php', 'exploits.php', 'payloads.php', 'platforms.php', 'add_exploit.php', 'add_payload.php', 'info.php', 'edit_payload.php', 'edit_exploit.php', 'news.php');

			$include=$_GET['modul'].".php";
			
			if($_GET['action']=="logout") {
				       setcookie("zer0pack", '', time()-3600);
					   session_destroy();
						die('<meta http-equiv="Refresh" content="0;url=index.php">');
			}
			
			if(in_array($include, $modules)) {

				include("modules/".$include);
				if(isset($error)) { echo "<br><font color=red><b>$error</b></font>"; }
				if(isset($msg)) { echo "<br><font color=green><b>$msg</b></font>"; }

			} else {

			echo 'Zer0pack 0.7.1 - alpha<br>

			Still in development!<br>

			Zer0day';

			}

			?>

		</div>
		<div class="navigation">

			<h2>Statistic</h2>

				<ul>
				<li><a href="?modul=global">=>&nbsp;global</a></li>
					<li><a href="?modul=platforms">=>&nbsp;platforms</a></li>
					<li><a href="?modul=countries">=>&nbsp;countries</a></li>
					<li><a href="?modul=browsers">=>&nbsp;browsers</a></li>
					<li><a href="?modul=search">=>&nbsp;search</a></li>
			</ul>

			<h2>Config</h2>
					
			<ul>
					<li><a href="?modul=main">=>&nbsp;main</a></li>
					<li><a href="?modul=xss">=>&nbsp;xss</a></li>
					<li><a href="?modul=info">=>&nbsp;info</a></li>
					<li><a href="?modul=news">=>&nbsp;news</a></li>
			</ul>
			<h2>Content Manager</h2>

			<ul>
					<li><a href="?modul=exploits">=>&nbsp;exploits</a></li>
					<li><a href="?modul=add_exploit">&nbsp;&nbsp;=>&nbsp;add exploit</a></li>
					<li><a href="?modul=payloads">=>&nbsp;payloads</a></li>
					<li><a href="?modul=add_payload">&nbsp;&nbsp;=>&nbsp;add payload</a></li>
			</ul>



		</div>
		<div class="clearer">&nbsp;</div>
	</div>
	<div class="footer">
		<span class="left">
			&copy; 2008 Zer0day.
		</span>
		<span class="right">For educational use only! &nbsp;|&nbsp;<a href="?action=logout">Logout</a></span>
		<div class="clearer"></div>
	</div>
</div>
</div>
</body>
</html>