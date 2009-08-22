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
 *   File: addshellcode.php						   *
 ***************************************************************************/
include('mysql_connect.php');

	function AddPayload($name, $description, $type, $platform, $code, $active){
		
		include('config.php');
		$sql = "INSERT INTO `"._PREFIX_."payloads` (`name`, `description`, `type`, `platform`, `code`, `active`) VALUES ('".mysql_escape_string(htmlspecialchars($name))."', '".mysql_escape_string(htmlspecialchars($description))."',
		'".mysql_escape_string(htmlspecialchars($type))."',
		'".mysql_escape_string(htmlspecialchars($platform))."', '".mysql_escape_string($code)."', '".mysql_escape_string(htmlspecialchars($active))."');";
		if(mysql_query($sql)) {
			return true;
		} else {
			return mysql_error();
		}
	}
?>