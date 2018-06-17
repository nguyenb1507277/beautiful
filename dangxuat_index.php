<?php 
session_destroy();
$_SESSION["tendangnhap"] = "";
echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
?>