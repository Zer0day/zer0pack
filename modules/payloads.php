<h1>Payload-Manager</h1><br>
<?php
include('include/mysql_connect.php');

if(isset($_GET['enable'])) {
	$sql = 'UPDATE `'._PREFIX_.'payloads` SET `active` = \'true\' WHERE `name` = \''.mysql_escape_string($_GET['enable']).'\'';
	mysql_query($sql) OR die(mysql_error());
} elseif(isset($_GET['disable'])) {
	$sql = 'UPDATE `'._PREFIX_.'payloads` SET `active` = \'false\' WHERE `name` = \''.mysql_escape_string($_GET['disable']).'\''; 
	mysql_query($sql) OR die(mysql_error());
} elseif(isset($_GET['delete'])) {
	$sql = 'DELETE FROM `'._PREFIX_.'payloads` WHERE `name` = \''.mysql_escape_string($_GET['delete']).'\'';
mysql_query($sql) OR die(mysql_error());
}
echo '<table class="tableBorder" width="100%" cellpadding="0" cellspacing="0" border="0"><tr>
<td class="tableHeading"> Name </td>
<td class="tableHeading"> Description </td>
<td class="tableHeading"> Type </td>
<td class="tableHeading"> Platform </td>
<td class="tableHeading"> Status </td>
<td class="tableHeading"> Edit </td>
<td class="tableHeading"> Delete </td>
</tr><form method=POST action=?modul=payload>';
$sql = "SELECT * FROM "._PREFIX_."payloads";
	$check = mysql_query($sql) OR die(mysql_error());
	while($row=mysql_fetch_assoc($check)) {
		$active="<td class=\"tableCell\" width=5 align=center><a href=?modul=payloads&enable=".urlencode($row['name'])."><img src=img/disable.png border=0></img></a></td>";
if($row['active'] == "true") { $active="<td class=\"tableCell\" width=5 align=center><a href=?modul=payloads&disable=".urlencode($row['name'])."><img src=img/enable.png border=0></img></a></td>"; }
echo "<tr>
<td class=\"tableCell\"> ".$row['name']." </td>
<td class=\"tableCell\"> ".$row['description']." </td>
<td class=\"tableCell\"> ".$row['type']." </td>
<td class=\"tableCell\"> ".$row['platform']." </td>
".$active."
<td class=\"tableCell\" width=5 align=center><a href=?modul=edit_payload&edit=".urlencode($row['name'])."><img src=img/edit.png border=0></img></a></td>
<td class=\"tableCell\" width=5 align=center><a href=?modul=payloads&delete=".urlencode($row['name'])."><img src=img/delete.png border=0></img></a></td>
</tr>";
}
echo '</table><br></form>';
?>