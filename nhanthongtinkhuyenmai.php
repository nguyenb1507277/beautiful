<?php 
include_once('connection.php');
if(isset($_POST['btnDangKy_Email'])){
	$email=$_POST['btnDangKy_Email'];
	$sql = "insert into nhantinkhuyenmai(n_email) values('".$email."')";
	$result = mysqli_query($conn, $sql) or die (mysqli_error($sql));
	}
?>