<?php
include('include/addpayload.php');
if(isset($_POST['submit'])) {
	if(empty($_POST['name']) OR empty($_POST['description']) OR empty($_POST['platform']) OR empty($_POST['code'])) {
		$error="You have to fill all fields out!";
	} elseif($_POST['name']!=mysql_escape_string(htmlspecialchars($_POST['name']))) {	
		$error="Illegal character in field 'name'!";
	} else {
		$sql="DELETE FROM `"._PREFIX_."payloads` WHERE `name` = '".$_POST['name']."'";
		mysql_query($sql);
		AddPayload($_POST['name'], $_POST['description'], $_POST['type'], $_POST['platform'], $_POST['code'], $_POST['active']);
		$msg="Settings saved!";
	}
}
if(isset($_GET['edit'])) {
	$sql="SELECT * FROM `"._PREFIX_."payloads` WHERE `name` = '".mysql_escape_string($_GET['edit'])."'";
	$check=mysql_query($sql) OR die(mysql_error());
	$row=mysql_fetch_assoc($check);
	echo '<h1>Edit Payload</h1><br>
	<form method=POST>
	Name:<input type=text name=name maxlength="100" value="'.$_GET['edit'].'"><br>
	Description:<input type=text name=description maxlength="200" value="'.$row['description'].'"><br>
	Type:<input type=text name=type maxlength="20" value="'.$row['type'].'"><br>
	Platform:<input type=text name=platform maxlength="50" value="'.$row['platform'].'"><br>
	Shellcode:<br><textarea name=code cols=60 rows=10 maxlength="4096">'.stripslashes($row['code']).'</textarea><br>
	<input type=hidden name="active" value="'.$row['active'].'">
	<input type=submit name=submit value=save>
	</form>';
}
?>
