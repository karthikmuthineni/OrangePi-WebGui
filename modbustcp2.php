<?php

require_once 'ModbusMaster.php';
require_once 'PhpType.php';
include("PhpSerialModbus.php");

if (isset($_POST["Host"]) && isset($_POST["Port"]) && isset($_POST["UnitID"]) && isset($_POST["Address"]) && isset($_POST["Quantity"]) && isset($_POST["FC"]))
{
        $Host=$_POST["Host"];
        $Port=$_POST["Port"];
        $UnitID=$_POST["UnitID"];
        $Address=$_POST["Address"];
        $Quantity=$_POST["Quantity"];
        $FunCode=$_POST["FC"];
        //echo "Host is: $Host";
        //echo "Port is: $Port";
        //echo "Unit ID is: $UnitID";
        //echo "Address is: $Address";
        //echo "Quantity is: $Quantity";
        //echo "Function Code is: $FunCode";
        if ($FunCode == "5") {
           $modbus = new ModbusMaster("$Host", "UDP");
           try {
               $recData = $modbus->writeMultipleCoils($UnitID, $Address, $Quantity);
           } catch (Exception $e) {
               echo $modbus;
               echo $e;
               echo '<a href="Modbustcp.html"><br /><br />Return to Modbus Page</a>';
               exit;
           }
           echo PhpType::bytes2string($recData);

        } elseif ($FunCode == "6") {
                 $modbus = new ModbusMaster("$Host", "UDP");
                 $data = array(10,-1000,2000,3.0);
                 $dataTyoes = array("WORD","INT","DINT","REAL");
                 try {
                     $recData = $modbus->writeMultipleRegister($UnitID, $Address, $data, $dataTypes);
                 } catch (Exception $e) {
                     echo $modbus . "\n";
                     echo $e;
                     echo '<a href="Modbustcp.html"><br /><br />Return to Modbus Page</a>';
                     exit;
                 }
                 echo PhpType::bytes2string($recData);
        } else {
            echo "Invalid FC";
        }
}
?>
