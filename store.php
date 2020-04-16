<?php
if (isset($_POST["SSID"]) && isset($_POST["password"]))
{
	$ssid=$_POST["SSID"];
	$password=$_POST["password"];
        exec("nmcli device wifi connect $ssid password $password 2>&1",$output,$return);
        //echo $output[0];
        //echo $return;
        //var_dump($return);
        //echo "return is : $return" . "\n";
        var_dump($output);
        if($return !=0) {
           echo "<br />";
           echo "Cannot Connect to the Network";
           echo '<a href="Wlan.html"><br /><br />Return to WLAN Page</a>';
        }else{
           echo "<br />";
           echo "Connected to the Network";
           echo '<a href="Wlan.html"><br /><br />Return to WLAN Page</a>';
        }
        //echo "<a href="Wlan.html">Click here</a>";
        //$myFile = "/etc/wpa_supplicant/wpa_supplicant.conf";
	//$fh = fopen($myFile, 'a') or die("can't open file");
	//$stringData = "network={\n\tssid=\"".$ssid."\"\n\tpsk=\"".$password."\"\n\tkey-mgmt=WPA-PSK\n}";
	//fwrite($fh,"\n");
	//fwrite($fh, $stringData);
	//fwrite($fh,"\r\n");
	//fclose($fh);
        //echo "successfully connected to $ssid";
        // echo <a href="Wlan.html">Click here</a>
} ?>



