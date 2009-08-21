<div align=center><h1>Statistic - Browsers</h1><br></div>
<?php
include('include/mysql_connect.php');
$sql = "SELECT DISTINCT browser FROM ".$mysql_prefix."visitors";
	$check = mysql_query($sql) OR die(mysql_error());
	$arr_cnt=0;
	while($row=mysql_fetch_assoc($check)) {
		$browser=$row['browser'];
		if(!$_GET['detail']=="true") {
			//$browser=explode(".", $row['browser'], 2);
			//$browser=$browser['0'];
			}
		$column_array[$arr_cnt]=$browser;
		$arr_cnt++;
	}
echo '<div align=center><table width="45%" border="1" cellspacing="1"><tr>';
echo '<td width=32><h3>Img</h3></td><td><h3> Browser </h3></td><td><h3> Count </h3></td></tr>';
		$new_array=array('', '');
	for($i=0; $i!=$arr_cnt; $i++) {
		$arr_val=$column_array[$i];
		$sql = "SELECT * FROM ".$mysql_prefix."visitors WHERE browser LIKE '".$arr_val."%"."'";
		$check = mysql_query($sql) OR die(mysql_error());
		$cnt=0;
		while($row=mysql_fetch_assoc($check)) {
			$cnt++;
			}
		$new_array=array_merge($new_array, array($arr_val=>$cnt));
			//echo "<tr><td> $arr_val </td><td> $cnt </td></tr>";
		}
		unset($new_array['0']);
		unset($new_array['1']);
		arsort($new_array);
		foreach($new_array as $browser=>$anzahl) {
			$browserimg=explode(" ", $browser);
			
				echo "<tr><td><img src=\"img/browser/".strtolower($browserimg['0']).".gif\" /></td><td valign=\"middle\"> $browser </td><td> $anzahl </td></tr>";
			}
echo '</table></div>';
?>