<h1>Add Payload</h1><br>
<form method=POST>
Name:<input type=text name=name maxlength="100"><br>
Description:<input type=text name=description maxlength="200"><br>
Type:<input type=text name=type maxlength="20"><br>
Platform:<input type=text name=platform maxlength="50"><br>
Shellcode:<br><textarea name=code cols=60 rows=10 maxlength="4096"></textarea><br>
Active:<select name=active><option value=true>active</option><option value=false>inactive</option></select><br>
<input type=submit name=submit value=add>
</form>
<?php
include('include/addpayload.php');
if(isset($_POST['submit'])) {
if(empty($_POST['name']) OR empty($_POST['description']) OR empty($_POST['platform']) OR empty($_POST['code']) OR empty($_POST['active'])) {
	$error="You have to fill all fields out!";
} elseif($_POST['name']!=mysql_escape_string(htmlspecialchars($_POST['name']))) {	
	$error="Illegal character in field 'name'!";
} else {
AddPayload($_POST['name'], $_POST['description'], $_POST['type'], $_POST['platform'], $_POST['code'], $_POST['active']);
$msg="Payload added!";
}
}
?>
