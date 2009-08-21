<form method=POST action=?modul=search>WHERE 
	<select name=col>
		<option value=platform>platform</option>
		<option value=browser>browser</option>
		<option value=ip>ip</option>
		<option value=country>country</option>
		<option value=date>date</option>
		<option value=time>time</option>
		<option value=referer>referer</option>
	</select> LIKE 
	<input type=text name=q size=10 /> ORDER BY 
	<select name=order>
		<option value=date>date</option>
		<option value=platform>platform</option>
		<option value=browser>browser</option>
		<option value=ip>ip</option>
		<option value=country>country</option>
		<option value=time>time</option>
		<option value=referer>referer</option>
	</select>
	<select name=sort>
		<option value=asc>asc</option>
		<option value=desc>desc</option>
	</select>
<input type=submit value=query />
</form>
<?php
include('include/mysql_connect.php');

		$col=mysql_escape_string($_POST['col']);
		$order=mysql_escape_string($_POST['order']);
		if(empty($_POST['col'])) {
			$col="date";
		}
		if(empty($_POST['order'])) {
			$order="timestamp";
		}
		$q=mysql_escape_string($_POST['q'])."%";
		$sort=$_POST['sort'];
		if(empty($sort)) {
		$sort="desc";
		}
		if($sort=="asc") {
		$sql = 'SELECT * FROM `'.$mysql_prefix.'visitors` WHERE `' .$col. '` LIKE CONVERT(_utf8 \''.$q.'\' USING latin1) COLLATE latin1_swedish_ci ORDER BY `'.$order.'` ASC';
		} elseif($sort=="desc") {
		$sql = 'SELECT * FROM `'.$mysql_prefix.'visitors` WHERE `' .$col. '` LIKE CONVERT(_utf8 \''.$q.'\' USING latin1) COLLATE latin1_swedish_ci ORDER BY `'.$order.'` DESC';
		}
	$check = mysql_query($sql) OR die(mysql_error());
echo '<br><b><h3>Result:</h3></b><table width="100%" border="1" cellspacing="1" cellpadding=""><tr>
<td> OS </td>
<td> Browser </td>
<td> IP </td>
<td> Herkunft </td>
<td> Datum </td>
<td> Uhrzeit </td>
<td> Referer </td>
</tr>';
	while($row=mysql_fetch_assoc($check)) {
echo "<tr>
<td> ".$row['platform']." </td>
<td> ".$row['browser']." </td>
<td> ".$row['ip']." </td>
<td><img src=img/countries/".$row['flag'].".png></img> ".$row['country']." </td>
<td> ".$row['date']." </td>
<td> ".$row['time']." </td>
<td> ".$row['referer']." </td>
</tr>";
	}
echo '</table>';
?> 
