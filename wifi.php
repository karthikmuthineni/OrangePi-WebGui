<?php

include __DIR__ . '/vendor/autoload.php';

use Sanchescom\WiFi\WiFi;

class Example
{
    public $device;

    /**
     * @throws Exception
     */
    public function getAllNetworks()
    {
        $networks = WiFi::scan()->getAll();

        foreach ($networks as $network) {
            echo $network . "\n";
        }
    }

    /**
     * @param $ssid
     * @param $password
     */
    public function connect($ssid, $password)
    {
        try {
            WiFi::scan()->getBySsid($ssid)->connect($password, $this->device);
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * @throws Exception
     */
    public function disconnect()
    {
        $networks = WiFi::scan()->getConnected();

        foreach ($networks as $network) {
            $network->disconnect($this->device);
        }
    }
}

$example = new Example();
try {
    //$example->device = 'en1';
    //$example->getAllNetworks();
    if (isset($_POST["SSID"]) && isset($_POST["password"]))

    {
           $ssid=$_POST["SSID"];
           $password=$_POST["password"];
           $example->getAllNetworks();
           $example->connect($ssid, $password);
           echo "<a href=\\"Wlan.html\\">Click here</a>";
           //$example->disconnect();
           //$example->list();
    }
} catch (Exception $e) {
    //
}
?>

