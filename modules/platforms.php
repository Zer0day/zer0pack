<div align=center><h1>Statistic - Platforms</h1><br></div>
<?php
include('include/mysql_connect.php');

$sql = "SELECT DISTINCT platform FROM ".$mysql_prefix."visitors";
	$check = mysql_query($sql) OR die(mysql_error());
	$arr_cnt=0;
	while($row=mysql_fetch_assoc($check)) {
		$platform=$row['platform'];
		$column_array[$arr_cnt]=$platform;
		$arr_cnt++;
	}
echo '<div align=center><table width="45%" border="1" cellspacing="1" cellpadding=""><tr>';
echo '<td><h3> Platform </h3></td><td><h3> Count </h3></td></tr>';
		$new_array=array('', '');
	for($i=0; $i!=$arr_cnt; $i++) {
		$arr_val=$column_array[$i];
		$sql = "SELECT * FROM ".$mysql_prefix."visitors WHERE platform = '".$arr_val."'";
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
		foreach($new_array as $platform=>$anzahl) {
				echo "<tr><td> $platform </td><td> $anzahl </td></tr>";
			}
echo '</table></div>';
?>