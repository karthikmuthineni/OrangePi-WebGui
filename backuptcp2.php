<?php

//require_once 'ModbusMaster.php';
//require_once 'PhpType.php';

use ModbusTcpClient\Network\BinaryStreamConnection;
use ModbusTcpClient\Packet\ModbusFunction\WriteSingleCoilRequest;
use ModbusTcpClient\Packet\ModbusFunction\WriteSingleCoilResponse;
use ModbusTcpClient\Packet\ResponseFactory;
require 'vendor/autoload.php';
include("PhpSerialModbus.php");

if (isset($_POST["Host"]) && isset($_POST["Port"]) && isset($_POST["UnitID"]) && isset($_POST["Address"]) && isset($_POST["FC"]) && isset($_POST["Coil"]) && isset($_POST["Value"]))
{
        $Host=$_POST["Host"];
        $Port=$_POST["Port"];
        $UnitID=$_POST["UnitID"];
        $Address=$_POST["Address"];
        //$Quantity=$_POST["Quantity"];
        $FunCode=$_POST["FC"];
        $Value=$_POST["Value"];
        $Coil=$_POST["Coil"];
        //echo "Host is: $Host";
        //echo "Port is: $Port";
        //echo "Unit ID is: $UnitID";
        //echo "Address is: $Address";
        //echo "Quantity is: $Quantity";
        //echo "Function Code is: $FunCode";
        //echo "Coil is: $Coil";
        //echo "Value is: $Value";
        if ($FunCode == "5") {
           $connection = BinaryStreamConnection::getBuilder()
               ->setPort($Port)
               ->setHost($Host)
               ->build();
           $startAddress = $Address;
           $coil = $Coil;
           $packet = new WriteSingleCoilRequest($startAddress,$coil);
           echo 'Packet to be sent (in hex): ' . $packet->toHex() . PHP_EOL;

           try {
               $binaryData = $connection->connect()
                   ->sendAndReceive($packet);
               echo 'Binary received (in hex):   ' . unpack('H*', $binaryData)[1] . PHP_EOL;
               $response = ResponseFactory::parseResponseOrThrow($binaryData);
               echo 'Parsed packet (in hex):     ' . $response->toHex() . PHP_EOL;
               echo 'Coil value parsed from packet:' . PHP_EOL;
               print_r($response->isCoil());
               session_start();
               $_SESSION["d"]=$response->isCoil();

           } catch (Exception $exception) {
               echo 'An exception occurred' . PHP_EOL;
               echo $exception->getMessage() . PHP_EOL;
               echo $exception->getTraceAsString() . PHP_EOL;
           } finally {
               $connection->close();
               echo '<a href="Modbustcp.html"><br /><br />Return to Modbus Page</a>';
           }
        } elseif ($FunCode == "6") {
                $connection = BinaryStreamConnection::getBuilder()
                    ->setPort($Port)
                    ->setHost($Host)
                    ->build();
                $startAddress = $Address;
                $value = '$Value';
                $packet = new WriteSingleRegisterRequest($startAddress,$value);
                echo 'Packet to be sent (in hex): ' . $packet->toHex() . PHP_EOL;

                try {
                    $binaryData = $connection->connect()
                        ->sendAndReceive($packet);
                    echo 'Binary received (in hex):   ' . unpack('H*', $binaryData)[1] . PHP_EOL;

                    $response = ResponseFactory::parseResponseOrThrow($binaryData);
                    echo 'Parsed packet (in hex):     ' . $response->toHex() . PHP_EOL;
                    echo 'Coil value parsed from packet:' . PHP_EOL;
                    print_r($response->getWord()->getInt16());
                    session_start();
                    $_SESSION["d"]=$response->getWord()->getInt16();

                } catch (Exception $exception) {
                    echo 'An exception occurred' . PHP_EOL;
                    echo $exception->getMessage() . PHP_EOL;
                     echo $exception->getTraceAsString() . PHP_EOL;
                } finally {
                    $connection->close();
                    echo '<a href="Modbustcp.html"><br /><br />Return to Modbus Page</a>';
                }
        } else {
           echo "Invalid Function Code";
           echo '<a href="Modbustcp.html"><br /><br />Return to Modbus Page</a>';
        }
}
?>
