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
        if ($FunCode == "1") {
           $modbus = new ModbusMaster("$Host", "UDP");
           try {
               $recData = $modbus->readCoils($UnitID, $Address, $Quantity);
               print_r($recData);
               session_start();
               $_SESSION["c"]=$recData;
           } catch (Exception $e) {
               //echo $modbus;
               echo $e;
               //session_start();
               //$_SESSION["c"]=$recData;
               echo '<a href="Modbustcp.html"><br /><br />Return to Modbus Page</a>';
               //exit;
           }
           echo PhpType::bytes2string($recData);

        } elseif ($FunCode == "2") {
                 $modbus = new ModbusMaster("$Host", "UDP");
                 try {
                     $recData = $modbus->readInputDiscretes($UnitID, $Address, $Quantity);
                     print_r($recData);
                     session_start();
                     $_SESSION["c"]=$recData;
                 } catch (Exception $e) {
                     //echo $modbus . "\n";
                     echo $e;
                     //session_start();
                     //$_SESSION["c"]=$recData;
                     echo '<a href="Modbustcp.html"><br /><br />Return to Modbus Page</a>';
                     //exit;
                 }
                 echo PhpType::bytes2string($recData);
        } elseif ($FunCode == "3") {
                 $modbus = new ModbusMaster("$Host", "UDP");
                 try {
                     $recData = $modbus->readMultipleRegisters($UnitID, $Address, $Quantity);
                     print_r($recData);
                     session_start();
                     $_SESSION["c"]=$recData;
                 } catch (Exception $e) {
                     //echo $modbus . "\n";
                     echo $e;
                     //session_start();
                     //$_SESSION["c"]=$recData;
                     echo '<a href="Modbustcp.html"><br /><br />Return to Modbus Page</a>';
                     //exit;
                 }
                 echo PhpType::bytes2string($recData);
        } elseif ($FunCode == "4") {
             $modbus = new ModbusMaster("$Host", "UDP");
             try {
                 $recData = $modbus->readMultipleRegisters($UnitID, $Address, $Quantity);
                 print_r($recData);
                 session_start();
                 $_SESSION["c"]=$recData;
             } catch (Exception $e) {
                 //echo $modbus . "\n";
                 echo $e;
                 //session_start();
                 //$_SESSION["c"]=$recData;
                 echo '<a href="Modbustcp.html"><br /><br />Return to Modbus Page</a>';
                 //exit;
             }
             echo PhpType::bytes2string($recData);
        } else {
            echo "Invalid Function Code";
            echo '<a href="Modbustcp.html"><br /><br />Return to Modbus Page</a>';
        }
}
?>
