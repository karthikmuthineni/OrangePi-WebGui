<?php
//$localtime = localtime(time(), true);
//echo json_encode($localtime);
session_start();
echo json_encode($_SESSION["a"]);
//echo json_encode($_SESSION["c"]);
?>
