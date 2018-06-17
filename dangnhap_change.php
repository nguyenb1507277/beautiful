 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<meta charset="utf-8">
<?php 
if(isset($_SESSION["tendangnhap"])){
	echo '<meta http-equiv="refresh" content="0;URL=?khoatrang=quanly_thongtincanhan"/>';
	} else {
?>
<?php
if(!empty($_POST["login"])) {
	$conn = mysqli_connect("localhost", "root", "", "beautiful");
	$tendangnhap = trim($_POST['txtTenDangNhap']);
	$matkhau1 =$_POST['txtMatKhau'];
	$matkhau=md5($matkhau1);
	$sql = "Select * from khachhang where kh_tendangnhap = '" .$tendangnhap. "' and kh_matkhau = '" .$matkhau. "'";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);
	if($row) {
			$_SESSION["tendangnhap"] = $row["kh_tendangnhap"];
			$_SESSION["quantri"]=$row['kh_quantri'];
			if(!empty($_POST["remember"])) {
				setcookie ("member_login",$_POST["txtTenDangNhap"],time()+ (10 * 365 * 24 * 60 * 60));
				setcookie ("member_password",$_POST["txtMatKhau"],time()+ (10 * 365 * 24 * 60 * 60));
			} else {
				if(isset($_COOKIE["member_login"])) {
					setcookie ("member_login","");
				}
				if(isset($_COOKIE["member_password"])) {
					setcookie ("member_password","");
				}
			}
	} else {
				$message = "Thất bại";
	}
}
?>	


<?php if(empty($_SESSION["tendangnhap"])) { ?>
<div class="container" style="height:320px;">
<form class="form-horizontal" action="" method="post" id="frmLogin">
<div class="error-message">
<?php if(isset($message)) { echo "<div align=\"center\" style=\"color:red\"><b>".$message."</b></div>"; } ?></div>
	<h3>Bạn cần đăng nhập trước khi thay đổi thông tin cá nhân</h3>
    <div class="form-group">
		 <label class="control-label col-sm-2" for="login">Tên tài khoản: </label>
		<div class="col-sm-10">
        <input name="txtTenDangNhap" type="text" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>"  class="form-control">
        </div>
	</div>
	<div class="form-group">
		 <label class="control-label col-sm-2" for="password">Mật khẩu: </label>
		<div class="col-sm-10">
        <input name="txtMatKhau" type="password" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" 
         class="form-control"> 
         </div>
	</div>
	<div class="form-group">
		 <div class="col-sm-offset-2 col-sm-10">
             <div class="checkbox">
             <label for="remember">
             <input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> />
                Ghi nhớ đăng nhập</label>
            </div>
            <br />
            <a href="?khoatrang=quenmatkhau" style="text-decoration:none;">Quên mật khẩu</a>
           </div>
	</div>
	<div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
		<input type="submit" name="login" value="Submit" class="btn btn-default">
        </div>
       </div>
	</div>       
</form>
</div>
<?php } 
else { 
	echo '<meta  http-equiv="refresh" content="0;URL=?khoatrang=quanly_thongtincanhan"/>';
	}
	}
?>
