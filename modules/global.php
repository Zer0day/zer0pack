<div align=center><h1>Statistic</h1></div><br>
<?php
include('include/mysql_connect.php');

$sql="SELECT count(*) AS count FROM `".$mysql_prefix."visitors`";
$check = mysql_query($sql) OR die(mysql_error());
$row=mysql_fetch_assoc($check);
echo "<div align=center><b>Total Visitors: ".$row['count']."</b></div>";
?>