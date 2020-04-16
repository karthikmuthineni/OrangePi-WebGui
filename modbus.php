<?php
include("PhpSerialModbus.php");

if (isset($_POST["UnitID"]) && isset($_POST["Address"]) && isset($_POST["Quantity"]) && isset($_POST["FC"]))
{
        $UnitID=$_POST["UnitID"];
        $Address=$_POST["Address"];
        $Quantity=$_POST["Quantity"];
        //$FunctionCode=$_POST["FunctionCode"];
        $FunCode=$_POST["FC"];
        //echo "Unit ID is: $UnitID";
        //echo "Address is: $Address";
        //echo "Quantity is: $Quantity";
        //echo "$FunCode";
        $modbus = new PhpSerialModbus;
        $modbus->deviceInit('/dev/ttyUSB0',1200,'none',8,1,'none');
        $modbus->deviceOpen();
        $modbus->debug = true;
        $result=$modbus->sendQuery($UnitID,$FunCode,"$Address",$Quantity);
        sleep(2);
        $jsonresult=json_encode($result);
        //print_r($jsonresult);
        session_start();
        $_SESSION["a"]=$result;
        //echo $_SESSION["a"];
        $modbus->deviceClose();
        //header("Location: http://192.168.1.101:1880/ui/#!/0?socketid=jXgKx74Sqk5BUxoeAAAA");
        echo '<a href="Modbus.html"><br /><br />Return to Modbus Page</a>';
        //exit;

}
?>
