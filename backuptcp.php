<?php

use ModbusTcpClient\Network\BinaryStreamConnection;
use ModbusTcpClient\Packet\ModbusFunction\ReadCoilsRequest;
use ModbusTcpClient\Packet\ModbusFunction\ReadCoilsResponse;
use ModbusTcpClient\Packet\ResponseFactory;
require 'vendor/autoload.php';
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
           $connection = BinaryStreamConnection::getBuilder()
               ->setPort($Port)
               ->setHost($Host)
               ->build();
           $startAddress = $Address;
           $quantity = $Quantity;
           $packet = new ReadCoilsRequest($startAddress, $quantity);
           echo 'Packet to be sent (in hex): ' . $packet->toHex() . PHP_EOL;

           try {
               $binaryData = $connection->connect()
                   ->sendAndReceive($packet);
               echo 'Binary received (in hex):   ' . unpack('H*', $binaryData)[1] . PHP_EOL;

               $response = ResponseFactory::parseResponseOrThrow($binaryData);
               echo 'Parsed packet (in hex):     ' . $response->toHex() . PHP_EOL;
               echo 'Data parsed from packet (bytes):' . PHP_EOL;
               print_r($response->getCoils());

           } catch (Exception $exception) {
               echo 'An exception occurred' . PHP_EOL;
               echo $exception->getMessage() . PHP_EOL;
               echo $exception->getTraceAsString() . PHP_EOL;
           } finally {
               $connection->close();
           }
        }
        elseif ($FunCode == "2")
        {
                 $connection = BinaryStreamConnection::getBuilder()
                     ->setPort($Port)
                     ->setHost($Host)
                     ->build();

                 $startAddress = $Address;
                 $quantity = $Quantity;
                 $packet = new ReadInputDiscretesRequest($startAddress, $quantity);
                 echo 'Packet to be sent (in hex): ' . $packet->toHex() . PHP_EOL;
                 try {
                     $binaryData = $connection->connect()
                         ->sendAndReceive($packet);
                     echo 'Binary received (in hex):   ' . unpack('H*', $binaryData)[1] . PHP_EOL;

                     $response = ResponseFactory::parseResponseOrThrow($binaryData);
                     echo 'Parsed packet (in hex):     ' . $response->toHex() . PHP_EOL;
                     echo 'Data parsed from packet (bytes):' . PHP_EOL;
                     print_r($response->getCoils());

                 } catch (Exception $exception) {
                     echo 'An exception occurred' . PHP_EOL;
                     echo $exception->getMessage() . PHP_EOL;
                     echo $exception->getTraceAsString() . PHP_EOL;
                 } finally {
                     $connection->close();
                 }
        }
        elseif ($FunCode == "3")
        {
                 $connection = BinaryStreamConnection::getBuilder()
                     ->setPort($Port)
                     ->setHost($Host)
                     ->build();

                 $startAddress = $Address;
                 $quantity = $Quantity;
                 $packet = new ReadHoldingRegistersRequest($startAddress, $quantity);
                 echo 'Packet to be sent (in hex): ' . $packet->toHex() . PHP_EOL;

                 try {
                     $binaryData = $connection->connect()
                         ->sendAndReceive($packet);
                     echo 'Binary received (in hex):   ' . unpack('H*', $binaryData)[1] . PHP_EOL;

                     $response = ResponseFactory::parseResponseOrThrow($binaryData);
                     echo 'Parsed packet (in hex):     ' . $response->toHex() . PHP_EOL;
                     echo 'Data parsed from packet (bytes):' . PHP_EOL;
                     print_r($response->getData());

                     foreach ($response as $word) {
                         print_r($word->getBytes());
                     }
                     foreach ($response->asDoubleWords() as $doubleWord) {
                         print_r($doubleWord->getBytes());
                     }

                     $responseWithStartAddress = $response->withStartAddress($startAddress);
                     print_r($responseWithStartAddress[256]->getBytes()); // use array access to get word
                     print_r($responseWithStartAddress->getDoubleWordAt(257)->getFloat());

                 } catch (Exception $exception) {
                     echo 'An exception occurred' . PHP_EOL;
                     echo $exception->getMessage() . PHP_EOL;
                     echo $exception->getTraceAsString() . PHP_EOL;
                 } finally {
                     $connection->close();
                 }
        }
        elseif ($FunCode == "4")
        {
                 $connection = BinaryStreamConnection::getBuilder()
                     ->setPort($Port)
                     ->setHost($Host)
                     ->build();

                 $startAddress = $Address;
                 $quantity = $Quantity;
                 $packet = new ReadInputRegistersRequest($startAddress, $quantity);
                 echo 'Packet to be sent (in hex): ' . $packet->toHex() . PHP_EOL;
                 try {
                     $binaryData = $connection->connect()
                         ->sendAndReceive($packet);
                     echo 'Binary received (in hex):   ' . unpack('H*', $binaryData)[1] . PHP_EOL;

                     $response = ResponseFactory::parseResponseOrThrow($binaryData);
                     echo 'Parsed packet (in hex):     ' . $response->toHex() . PHP_EOL;
                     echo 'Data parsed from packet (bytes):' . PHP_EOL;
                     print_r($response->getData());

                     foreach ($response as $word) {
                     print_r($word->getBytes());
                     }
                     foreach ($response->asDoubleWords() as $doubleWord) {
                     print_r($doubleWord->getBytes());
                     }

                     $responseWithStartAddress = $response->withStartAddress($startAddress);
                     print_r($responseWithStartAddress[256]->getBytes()); // use array access to get word
                     print_r($responseWithStartAddress->getDoubleWordAt(257)->getFloat());

                 } catch (Exception $exception) {
                     echo 'An exception occurred' . PHP_EOL;
                     echo $exception->getMessage() . PHP_EOL;
                     echo $exception->getTraceAsString() . PHP_EOL;
                 } finally {
                     $connection->close();
                 }

        }
        else
        {
          echo "Invalid Function Code";
          echo '<a href="Modbustcp.html"><br /><br />Return to Modbus Page</a>';
        }
}
?>
