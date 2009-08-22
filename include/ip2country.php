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
 *   File: ip2country.php							   *
 ***************************************************************************/

class getcountry{

	var $Country = "Unknown";
	var $Flag = "Unknown";

	function getcountry($ip){
		// properties
		$gc['Country'] = "Unknown";
		$gc['Flag'] = "Unknown";

		// read file
		$countrydb = file("resources/ip2country.csv");
		$ip_number = sprintf("%u",ip2long($ip));

		// search in ip2country
		$low = 0;
		$high = count($countrydb) -1;
		$count = 0;

		while($low <= $high) {
		$count++;
		$mid = floor(($low + $high) / 2);
		$num1 = substr($countrydb[$mid], 1, 10);
		$num2 = substr($countrydb[$mid], 14, 10);
		$country = substr($countrydb[$mid], 38, strlen($countrydb[$mid]) - 41);
		$gc['Country']=ucwords(strtolower($country));
		$gc['Flag']= strtolower(substr($countrydb[$mid], 27, 2));

			if($num1 <= $ip_number && $ip_number <= $num2){
			break;
			} elseif ($ip_number < $num1) {
                  	$high = $mid - 1; 
			} else {
			$low = $mid + 1; 
              		}
          	}

		// assign properties
		$this->Country = $gc['Country'];
		$this->Flag = $gc['Flag'];
	}
}
?>