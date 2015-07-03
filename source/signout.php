<?php
session_start();
ob_start();
$_SESSION["id"]=0;
header("Location: http://iswd.nkg5.cf");
exit();
?>