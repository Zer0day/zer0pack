<div align=center><h1>Server Info</h1><br><br>
<table cellpadding="0" cellspacing="0" border="0" class="tableBorder" width="60%">
<tr>
	<td class="tableHeading">Information</td>
	<td class="tableHeading">Value</td>
</tr>
<tr>
<?php
if(ini_get('safe_mode')) { $safemode="true"; } else { $safemode="false"; }
if(ini_get('url_fopen')) { $url_fopen="true"; } else { $url_fopen="false"; }
echo   '<td class="tableCell">Server Address</td>
	<td class="tableCell">'.$_SERVER['SERVER_ADDR'].'</td>
	</tr><tr>
	<td class="tableCell">Web Server</td>
	<td class="tableCell">'.$_SERVER['SERVER_SOFTWARE'].'</td>
	</tr><tr>
	<td class="tableCell">safe_mode</td>
	<td class="tableCell">'.$safemode.'</td>
	</tr><tr>
	<td class="tableCell">url_fopen</td>
	<td class="tableCell">'.$url_fopen.'</td>
	</tr><tr>
	<td class="tableCell">PHP Version</td>
	<td class="tableCell">'.phpversion().'</td>
	</tr><tr>
	<td class="tableCell">Your Address</td>
	<td class="tableCell">'.$_SERVER['REMOTE_ADDR'].'</td>
	</tr></table></div>';
?>
