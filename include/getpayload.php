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
 *   File: getshellcode.php							   *
 ***************************************************************************/

function GetPayload($platform, $payload){

	$os=split(" ", $platform);
	$sql = "SELECT * FROM `"._PREFIX_."payloads` WHERE `platform` LIKE '".$os['0']."' AND `active` = 'true' AND `type` = '$payload'";
	$check = mysql_query($sql) OR die(mysql_error());
	$row=mysql_fetch_assoc($check);
	if(!empty($row['code'])) {
		return $row['code'];
	} else {
		return false;
		}
	}
?>