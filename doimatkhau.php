<link rel="stylesheet" type="text/css" href="style.css"/>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/responsive.css">
<script src="js/jquery-3.2.0.min.js"/></script>
<script src="js/jquery.dataTables.min.js"/></script>
<script src="js/dataTables.bootstrap.min.js"/></script>
<script src="https://www.google.com/recaptcha/api.js?hl=vi"></script>
 <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript">
 var RecaptchaOptions = {
    theme : 'white'
 };
 </script>
 <?php
 include_once ('connection.php');
 if(isset($_POST['btnDangKy'])){
 $api_url='https://www.google.com/recaptcha/api/siteverify';
 $site_key='6LdrAFoUAAAAAN4hGuGSuGWA00U8s-A5vQBeQ_2o';
 $secretkey='6LdrAFoUAAAAAI6cnCAQki_Ka0Z--UEYmESTyhKA';
 $responsekey=$_POST['g-recaptcha-response'];
 $userip=$_SERVER['REMOTE_ADDR'];
 $url="https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$responsekey&remoteip=$userip";
 $response=file_get_contents($url);
 }
 ?>
 <?php 
include_once('connection.php');
if(isset($_POST['btnDoiMK'])){
	$tendangnhap = $_POST['txtTenDangNhap'];
	$matkhaucu = $_POST['txtMatKhau1'];
	$matkhaucu=md5($matkhaucu);
	$matkhaumoi=$_POST['txtMatKhau2'];
	$matkhaumoi=md5($matkhaumoi);
	$matkhauxacnhan=$_POST['txtMatKhau3'];
	$loi ="";
	if($tendangnhap=="" || $matkhaucu=="" || $matkhaucu=="" || $matkhauxacnhan==""){
	$loi.="Vui lòng không để trống bắt kỳ thông tin nào!";
	}
	if($_POST['txtMatKhau1']==$_POST['txtMatKhau2'])
		$loi.="Mật khẩu này đã từng sử dụng!";
	if(strlen($matkhaumoi)<=5 || strlen($matkhaucu<=5))
		$loi.="Mật khẩu phải nhiều hơn 5 ký tự";
	if($_POST['txtMatKhau2']!=$_POST['txtMatKhau3']){
		$loi.="Mật khẩu mới và mật khẩu xác nhận phải giống nhau";
		}
	if($loi!=""){
		
		echo "<p align=\"center\" style=\"color:red;\">".$loi."</b>";
		}
		
	else {
		$sql = "select * from khachhang where kh_tendangnhap='$tendangnhap' and kh_matkhau='$matkhaucu'";
		$kq = mysqli_query($conn, $sql);
		if(mysqli_num_rows($kq)==1){
			mysqli_query($conn, "update khachhang set kh_matkhau='$matkhaumoi' where kh_tendangnhap='$tendangnhap' and kh_matkhau='$matkhaucu'") or die(mysqli_error($conn));

			echo "<script>alert('Mật khẩu đã được thay đổi thành công!');</script>";
			echo '<meta http-equiv="refresh" content="0;URL=?khoatrang=doimatkhau"/>';
		}
		else 
		echo "<p align=\"center\" style=\"color:red;\">Tài khoản hoặc mật khẩu không đúng</b>";
	}
}
?>
<div class="container">
        <h2>Đổi mật khẩu</h2>
			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
					<div class="form-group">
						    
                            <label for="txtTen" class="col-sm-2 control-label">Tên tài khoản:  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtTenDangNhap" id="txtTenDangNhap" class="form-control" placeholder="" value=""/>
							</div>
                      </div>  
                      
                       <div class="form-group">   
                            <label for="" class="col-sm-2 control-label">Mật khẩu cũ:  </label>
							<div class="col-sm-10">
							      <input type="password" name="txtMatKhau1" id="txtMatKhau1" class="form-control" placeholder=""/>
							</div>
                       </div>     
                       
                       <div class="form-group"> 
                            <label for="" class="col-sm-2 control-label">Mật khẩu mới:  </label>
							<div class="col-sm-10">
							      <input type="password" name="txtMatKhau2" id="txtMatKhau2" class="form-control" placeholder=""/>
							</div>
                       </div>     
                      <div class="form-group"> 
                            <label for="" class="col-sm-2 control-label">Xác nhận mật khẩu:  </label>
							<div class="col-sm-10">
							      <input type="password" name="txtMatKhau3" id="txtMatKhau3" class="form-control" placeholder=""/>
							</div>
                       </div>
                      <div class="form-group">
                      <label for="lblMMaAnToan" class="col-sm-2 control-label">Mã an toàn(*):</label>
                      <div class="col-sm-10">
						<div class="g-recaptcha" data-sitekey="6LdrAFoUAAAAAN4hGuGSuGWA00U8s-A5vQBeQ_2o"></div>
                      </div>
                      </div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						      <input type="submit"  class="btn btn-primary" name="btnDoiMK" id="btnDoiMK" value="Đổi mật khẩu"/>
						</div>
                     </div>
				</form>
                <script src='https://www.google.com/recaptcha/api.js'></script>

</div>



