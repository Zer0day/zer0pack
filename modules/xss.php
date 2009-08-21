XSS-Functions not included yet :(
<?php
        $ch = curl_init("www.google.com/curl.php?option=test");
        curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);      
	curl_close($ch);
	echo $output;
?>