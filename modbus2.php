<?php
include("PhpSerialModbus.php");

if (isset($_POST["UnitID"]) && isset($_POST["Address"]) && isset($_POST["Quantity"]) && isset($_POST["FC"]))
{
        $UnitID=$_POST["UnitID"];
        $Address=$_POST["Address"];
        $Quantity=$_POST["Quantity"];
        //$FunctionCode=$_POST["FunctionCode"];
        $FunCode=$_POST["FC"];
        //$PortNo=$_POST["PortNo"];
        //echo "Unit ID is: $UnitID";
        //echo "Address is: $Address";
        //echo "Quantity is: $Quantity";
        //echo "FunctionCode is: $FunctionCode";
        $modbus = new PhpSerialModbus;
        $modbus->deviceInit('/dev/ttyUSB0',115200,'none',8,1,'none');
        $modbus->deviceOpen();
        //$modbus->debug = true;
        $result=$modbus->sendQuery($UnitID,$FunCode,"$Address",$Quantity);
        sleep(2);
        //print_r($result);
        $jsonresult=json_encode($result);
        print_r($jsonresult);
        session_start();
        $_SESSION["b"]=$jsonresult;
        //print "\nVoltage: ".(hexdec($result[0].$result[1])/100);
        $modbus->deviceClose();
        session_start();
        echo '<a href="Modbus.html"><br /><br />Return to Modbus Page</a>';

}
?>
