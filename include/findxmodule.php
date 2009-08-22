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
 *   File: findxmodule.php							   *
 ***************************************************************************/

function findxmodule($target, $version) {
	
		$sql = "SELECT * FROM `"._PREFIX_."xmodules` WHERE `browser` = '".$target."' AND `active` = 'true'";
		$check = mysql_query($sql) OR die(mysql_error());
		$i=0;
		while($row=mysql_fetch_assoc($check)) {
			if(preg_match($row['version'], $version) OR $version==$row['version'] OR $version=="any") {
				$xmodules[$i]=$row['filename'];
				$i++;
			}
		}
		if(!empty($xmodules)) { 
		return $xmodules;
		}
		return false;
	}
?>