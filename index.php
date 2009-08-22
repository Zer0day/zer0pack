<?php
include('include/config.php');
if(file_exists('install.php')) {
	die("Please delete <i>install.php</i> before logging in!");
}
session_start();
if($_COOKIE['zer0pack']!=session_id()) {
	$error="Please log in!";
} else {
	die('<meta http-equiv="Refresh" content="0;url=acp.php">');
}
if($_POST['login']=="Login") {
	if($_POST['password']==$acp_pass) {
		setcookie("zer0pack", session_id(), time()+3600);
		die('<meta http-equiv="Refresh" content="0;url=acp.php">');
	} else {
		$error="Wrong password!";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<meta name="robots" content="noindex" />
<link rel="stylesheet" type="text/css" href="login.css" media="screen"/>
<title>Zer0pack - ACP</title>
</head>

<body>
<div class="outer-container">
<div class="inner-container">

	<div class="header">

		<div class="title">

			<span class="headline"><a href="index.php">Zer0pack - Login</a></span><br><br>
			<font color=red><b><?php if(!isset($error)) { echo "<br>"; }else { echo $error; } ?></b></font>
			<div class="subtitle"><br>
			<form method=POST>
			<div align="center">
		User:	&nbsp;<input type=text value=Administrator disabled><br>
		Pass:	&nbsp;<input type=password name=password></div><br>
		</div>
		<input type=submit name=login value=Login>
		</form>
		</div>

	</div>

	</div>
</div>
</div>
</body>
</html>