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
if(isset($_POST['btnDongY'])){
	$tendangnhap = $_POST['txtTenDangNhap'];
	$email = $_POST['txtEmail'];
	$loi ="";
	if($tendangnhap=="" || $email=="" )
	$loi.="Vui lòng không để trống bắt kỳ thông tin nào!";
	if(strpos($email,'@')=== false)
		$loi.="Email không hợp lệ";
	if($loi!="")
		echo "<font style='text-align:center; color=\"red\";'><b>".$loi."<b></font>";
	else {
		
		//con co ... con co .. con co la bay la ... bay tu la tu cua so  bay ra la ra canh dong.. oi tinh tinh tang .... tang... 
		//hop ngay 8/6 khoa cntt.. 
		//ke hoach trai he la tu thu hai den thu sau .. thay vinh ... c.dung hoc thu 2 4. 6 nghi.. 6 xit phog
		include_once("sendmailLib.php");
		$matkhaumoi=substr(md5(rand(1,9999)),0,8);
		$randmatkhau=md5($matkhaumoi);
		$sq = "select * from khachhang where kh_tendangnhap='$tendangnhap' and kh_email = '$email'";
		$kqx = mysqli_query($conn, $sq);
		if(mysqli_num_rows($kqx)==0){
			echo "<div align=\"center\" ><b>Không tìm thấy tài khoản với email này</b></div>";
			}
		else {
			mysqli_query($conn, "update khachhang set kh_matkhau='".$randmatkhau."'") or die(mysqli_error($conn));
			
			$noidungmail="<p>Chúc mừng bạn $tendangnhap đã thay đổi mật khẩu thành công tại website BeautifulShop</p>".
			"<p>Mật khẩu mới là: ".$matkhaumoi." <br/>Nhấn vào liên kết sau để quay trở về đăng nhập:
			<a href='http://localhost:1000/banhang/index.php?khoatrang=dangnhap'>
			http://localhost:1000/banhang/index.php?khoatrang=dangnhap</a>
			</p>";
			sendGMail("testmailweb02@gmail.com","web02#cusc","ban quản trị website BeautifulShop",
			array(array($email,$tendangnhap)),array(array("nguyenb1507277@student.ctu.edu.vn",
			"Ban Quản trị website BeautifulShop")),"Mail thông báo mật khẩu mới BeautifulShop",$noidungmail);
			}
		}
	}
else 
 echo '<meta http-equiv="refresh" content="0;URL:?khoatrang=quenmatkhau"/>';
?>


<div class="container">
        <h2>Quên mật khẩu</h2>
			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
					<div class="form-group">
						    
                            <label for="txtTen" class="col-sm-2 control-label">Tên tài khoản(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtTenDangNhap" id="txtTenDangNhap" class="form-control" placeholder="Tên đăng nhập" value=""/>
							</div>
                    </div>  
                     
                     <div class="form-group">
						    
                            <label for="txtEmail" class="col-sm-2 control-label">Email xác nhận(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtEmail" id="txtEmail" class="form-control" placeholder="beautifulshop@gmail.com" value=""/>
							</div>
                    </div> 
   
                      <label for="lblMMaAnToan" class="col-sm-2 control-label">Mã an toàn(*):</label>
                      <div class="col-sm-10">
						<div class="g-recaptcha" data-sitekey="6LdrAFoUAAAAAN4hGuGSuGWA00U8s-A5vQBeQ_2o"></div>
                      </div>
                      </div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						      <input type="submit"  class="btn btn-primary" name="btnDongY" id="btnDongY" value="Đồng Ý"/>
						</div>
                     </div>

			
				</form>
                <script src='https://www.google.com/recaptcha/api.js'></script>

</div>
