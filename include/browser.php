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
 *   File: browser.php							   *
 ***************************************************************************/

class browser{

	var $Name = "Unknown";
	var $Version = "Unknown";
	var $Platform = "Unknown";
	var $UserAgent = "Not reported";
	var $Architecture = "Unknown";
	var $Picture = "";
	var $AOL = false;

	function browser(){
		$ua_string = $_SERVER['HTTP_USER_AGENT'];

		// initialize properties
		$br['platform'] = "Unknown";
		$br['browser'] = "Unknown";
		$br['version'] = "Unknown";
		$br['architecture'] = "Unknown";
		$this->UserAgent = $ua_string;
		
		// architecture
		if (eregi("Win32", $ua_string))
			$br['architecture'] = "32";
		elseif (eregi("Win64", $ua_string))
			$br['architecture'] = "64";
		elseif (eregi("i686", $ua_string))
			$br['architecture'] = "i686";
		elseif (eregi("x86_64", $ua_string))
			$br['architecture'] = "x86_64";


		// operating system
		if (eregi("Windows NT 3.1", $ua_string)) {
			$br['platform'] = "Windows 3.1";
		} elseif (eregi("Windows NT 3.51", $ua_string)) {
			$br['platform'] = "Windows 3.51";
		} elseif (eregi("Windows 95", $ua_string)) {
			$br['platform'] = "Windows 95";
		} elseif (eregi("Windows 98", $ua_string)) {
			$br['platform'] = "Windows 98";
		} elseif (eregi("Win 9x 4.90", $ua_string)) {
			$br['platform'] = "Windows ME";
		} elseif (eregi("Windows NT 4.0", $ua_string)) {
			$br['platform'] = "Windows NT";
		} elseif (eregi("Windows NT 5.0", $ua_string)) {
			$br['platform'] = "Windows 2000";
		} elseif (eregi("Windows NT 5.01", $ua_string)) {
			$br['platform'] = "Windows 2000 SP1";
		} elseif (eregi("Windows NT 5.1; SV1", $ua_string)) {
			$br['platform'] = "Windows XP SP2";
			$br['picture'] = "winxp.gif";
		} elseif (eregi("Windows NT 5.1", $ua_string)) {
			$br['platform'] = "Windows XP";
			$br['picture'] = "winxp.gif";
		} elseif (eregi("Windows NT 6.0", $ua_string)) {
			$br['platform'] = "Windows Vista";
			$br['picture'] = "winvista.gif";
		} elseif (eregi("win", $ua_string)) {
			$br['platform'] = "Windows";
		} elseif (eregi("mac", $ua_string)) {
			$br['platform'] = "MacIntosh";
			$br['picture'] = "macos.gif";
		} elseif (eregi("linux", $ua_string)) {
			$br['platform'] = "Linux";
			$br['picture'] = "linux.gif";
		} elseif (eregi("OS/2", $ua_string)) {
			$br['platform'] = "OS/2";
		} elseif (eregi("BeOS", $ua_string)) {
			$br['platform'] = "BeOS";
		} elseif (eregi("SunOS", $ua_string)) {
			$br['platform'] = "SunOS";
			$br['picture'] = "sunos.gif";
		} elseif (eregi("FreeBSD", $ua_string)) {
			$br['platform'] = "FreeBSD";
			$br['picture'] = "freebsd.gif";
		} elseif (eregi("Solaris", $ua_string)) {
			$br['platform'] = "Solaris";
		}

		// test for Opera		
		if (eregi("opera",$ua_string)){
			$val = stristr($ua_string, "opera");
			if (eregi("/", $val)){
				$val = explode("/",$val);
				$br['browser'] = $val[0];
				$val = explode(" ",$val[1]);
				$br['version'] = $val[0];
			}else{
				$val = explode(" ",stristr($val,"opera"));
				$br['browser'] = $val[0];
				$br['version'] = $val[1];
			}

		// test for google chrome
		}elseif(eregi("Chrome", $ua_string)){
			$br['browser']="Chrome";
			$val = stristr($ua_string, "Chrome");
			$val = explode("/",$val);
			$val = explode(" ",$val[1]);
			$br['version'] = $val[0];
			
		// test for iron
		}elseif(eregi("Iron", $ua_string)){
			$br['browser']="Chrome";
			$val = stristr($ua_string, "Chrome");
			$val = explode("/",$val);
			$val = explode(" ",$val[1]);
			$br['version'] = $val[0];

		// test for WebTV
		}elseif(eregi("webtv",$ua_string)){
			$val = explode("/",stristr($ua_string,"webtv"));
			$br['browser'] = $val[0];
			$br['version'] = $val[1];
		
		// test for MS Internet Explorer version 1
		}elseif(eregi("microsoft internet explorer", $ua_string)){
			$br['browser'] = "MSIE";
			$br['version'] = "1.0";
			$var = stristr($ua_string, "/");
			if (ereg("308|425|426|474|0b1", $var)){
				$br['version'] = "1.5";
			}

		// test for NetPositive
		}elseif(eregi("NetPositive", $ua_string)){
			$val = explode("/",stristr($ua_string,"NetPositive"));
			$br['platform'] = "BeOS";
			$br['browser'] = $val[0];
			$br['version'] = $val[1];

		// test for MS Internet Explorer
		}elseif(eregi("msie",$ua_string) && !eregi("opera",$ua_string)){
			$val = explode(" ",stristr($ua_string,"msie"));
			$br['browser'] = $val[0];
			$br['version'] = $val[1];
		
		// test for MS Pocket Internet Explorer
		}elseif(eregi("mspie",$ua_string) || eregi('pocket', $ua_string)){
			$val = explode(" ",stristr($ua_string,"mspie"));
			$br['browser'] = "MSPIE";
			$br['platform'] = "WindowsCE";
			if (eregi("mspie", $ua_string))
				$br['version'] = $val[1];
			else {
				$val = explode("/",$ua_string);
				$br['version'] = $val[1];
			}
			
		// test for Galeon
		}elseif(eregi("galeon",$ua_string)){
			$val = explode(" ",stristr($ua_string,"galeon"));
			$val = explode("/",$val[0]);
			$br['browser'] = $val[0];
			$br['version'] = $val[1];
			
		// test for Konqueror
		}elseif(eregi("Konqueror",$ua_string)){
			$val = explode(" ",stristr($ua_string,"Konqueror"));
			$val = explode("/",$val[0]);
			$br['browser'] = $val[0];
			$br['version'] = $val[1];
			
		// test for iCab
		}elseif(eregi("icab",$ua_string)){
			$val = explode(" ",stristr($ua_string,"icab"));
			$br['browser'] = $val[0];
			$br['version'] = $val[1];

		// test for OmniWeb
		}elseif(eregi("omniweb",$ua_string)){
			$val = explode("/",stristr($ua_string,"omniweb"));
			$br['browser'] = $val[0];
			$br['version'] = $val[1];

		// test for Phoenix
		}elseif(eregi("Phoenix", $ua_string)){
			$br['browser'] = "Phoenix";
			$val = explode("/", stristr($ua_string,"Phoenix/"));
			$br['version'] = $val[1];
		
		// test for Firebird
		}elseif(eregi("firebird", $ua_string)){
			$br['browser']="Firebird";
			$val = stristr($ua_string, "Firebird");
			$val = explode("/",$val);
			$br['version'] = $val[1];
			
		// test for Firefox
		}elseif(eregi("Firefox", $ua_string)){
			$br['browser']="Firefox";
			$val = stristr($ua_string, "Firefox");
			$val = explode("/",$val);
			$br['version'] = $val[1];
			
	  // test for Mozilla Alpha/Beta Versions
		}elseif(eregi("mozilla",$ua_string) && 
			eregi("rv:[0-9].[0-9][a-b]",$ua_string) && !eregi("netscape",$ua_string)){
			$br['browser'] = "Mozilla";
			$val = explode(" ",stristr($ua_string,"rv:"));
			eregi("rv:[0-9].[0-9][a-b]",$ua_string,$val);
			$br['version'] = str_replace("rv:","",$val[0]);
			
		// test for Mozilla Stable Versions
		}elseif(eregi("mozilla",$ua_string) &&
			eregi("rv:[0-9]\.[0-9]",$ua_string) && !eregi("netscape",$ua_string)){
			$br['browser'] = "Mozilla";
			$val = explode(" ",stristr($ua_string,"rv:"));
			eregi("rv:[0-9]\.[0-9]\.[0-9]",$ua_string,$val);
			$br['version'] = str_replace("rv:","",$val[0]);
		
		// test for Lynx & Amaya
		}elseif(eregi("libwww", $ua_string)){
			if (eregi("amaya", $ua_string)){
				$val = explode("/",stristr($ua_string,"amaya"));
				$br['browser'] = "Amaya";
				$val = explode(" ", $val[1]);
				$br['version'] = $val[0];
			} else {
				$val = explode("/",$ua_string);
				$br['browser'] = "Lynx";
				$br['version'] = $val[1];
			}
		
		// test for w3m
		}elseif(eregi("w3m/", $ua_string)){
			$br['browser'] = "Safari";
			$val=explode("w3m/",$ua_string);
			$br['version'] = $val[0];

		// test for Safari
		}elseif(eregi("safari", $ua_string)){
			$br['browser'] = "Safari";
			$br['version'] = "";

		// test for netscape
		}elseif(eregi("netscape",$ua_string)){
			$val = explode(" ",stristr($ua_string,"netscape"));
			$val = explode("/",$val[0]);
			$br['browser'] = $val[0];
			$br['version'] = $val[1];
		}elseif(eregi("mozilla",$ua_string) && !eregi("rv:[0-9]\.[0-9]\.[0-9]",$ua_string)){
			$val = explode(" ",stristr($ua_string,"mozilla"));
			$val = explode("/",$val[0]);
			$br['browser'] = "Netscape";
			$br['version'] = $val[1];
		}
		
		// clean up extraneous garbage that may be in the name
		$br['browser'] = ereg_replace("[^a-z,A-Z]", "", $br['browser']);
		// clean up extraneous garbage that may be in the version		
		$br['version'] = ereg_replace("[^0-9,.,a-z,A-Z]", "", $br['version']);
		
		// check for AOL
		if (eregi("AOL", $ua_string)){
			$var = stristr($ua_string, "AOL");
			$var = explode(" ", $var);
			$br['aol'] = ereg_replace("[^0-9,.,a-z,A-Z]", "", $var[1]);
		}
		
		$this->Name = $br['browser'];
		$this->Version = htmlspecialchars($br['version']);
		$this->Platform = $br['platform'];
		$this->AOL = $br['aol'];
		$this->Architecture = $br['architecture'];
		$this->Picture = $br['picture'];
	}
}
?>
