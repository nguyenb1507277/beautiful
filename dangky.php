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
if(isset($_POST['btnDangKy'])){
	$tendangnhap = $_POST['txtTenDangNhap'];
	
	$matkhau = $_POST['txtMatKhau1'];
	$matkhau=md5($matkhau);
	$hoten = $_POST['txtHoTen'];
	$email = $_POST['txtEmail'];
	$diachi =$_POST['txtDiaChi'];
	$dienthoai=$_POST['txtDienThoai'];
	if(isset($_POST['grpGioiTinh']))
		$gioitinh = $_POST['grpGioiTinh'];
	$ngaysinh = $_POST['slNgaySinh'];
	$thangsinh = $_POST['slThangSinh'];
	$namsinh = $_POST['slNamSinh'];
	
	$loi ="";
	if($tendangnhap=="" || $matkhau=="" || $hoten=="" || $email=="" || $diachi=="" || $dienthoai=="" || $gioitinh=="" || $ngaysinh=="" || $thangsinh=="" ||$namsinh =="")
	$loi.="Vui lòng không để trống bắt kỳ thông tin nào!";
	if($_POST['txtMatKhau1']!=$_POST['txtMatKhau2'])
		$loi.="Mật khẩu không đúng!";
	if(strlen($matkhau)<=5)
		$loi.="Mật khẩu phải nhiều hơn 5 ký tự";
	if(strpos($email,'@')=== false)
		$loi.="Email không hợp lệ";
	if($ngaysinh==0 || $namsinh==0 || $thangsinh == 0)
		$loi.="Lỗi nhập ngày tháng năm";
	if($loi!="")
		echo "<script>alert(' ".$loi."' );</script>";
	else {
		
		//con co ... con co .. con co la bay la ... bay tu la tu cua so  bay ra la ra canh dong.. oi tinh tinh tang .... tang... 
		//hop ngay 8/6 khoa cntt.. 
		//ke hoach trai he la tu thu hai den thu sau .. thay vinh ... c.dung hoc thu 2 4. 6 nghi.. 6 xit phog
		include_once("sendmailLib.php");
		$randomcode=md5(rand());
		$sq = "select * from khachhang where kh_tendangnhap='$tendangnhap' or kh_email = '$email'";
		
			// thành công ->thêm ngược lại nếu đã có email hoặc tên đăng nhập này thì thông báo lỗi
		$kqx = mysqli_query($conn, $sq);
		if(mysqli_num_rows($kqx)>0){
			echo "<div align=\"center\" ><b>Tên đăng nhập hoặc email này đã được sử dụng</b></div>";
			}
		else {
			mysqli_query($conn, "insert into  khachhang(kh_tendangnhap, kh_matkhau, kh_ten, kh_gioitinh, kh_diachi, kh_dienthoai, kh_email, kh_ngaysinh, kh_thangsinh, kh_namsinh, kh_cmnd, kh_makichhoat, kh_trangthai, kh_quantri) values('$tendangnhap', '".$matkhau."', '$hoten', '$gioitinh', '$diachi', '$dienthoai','$email','$ngaysinh','$thangsinh', '$namsinh', '', '$randomcode', 0, 0)") or die(mysqli_error($conn));
			
			$noidungmail="<p>Chúc mừng bạn $hoten đã đăng ký thành công tại website BeautifulShop</p>".
			"<p>Vui lòng nhấn vào liên kết sau để kích hoạt:
			<a href='http://localhost:1000/banhang/index.php?khoatrang=kichhoat&taikhoan=$tendangnhap&ma=$randomcode'>
			http://localhost:1000/banhang/kichhoat.php?taikhoan=$tendangnhap&ma=$randomcode</a>
			</p>";
			sendGMail("testmailweb02@gmail.com","web02#cusc","ban quản trị website BeautifulShop",
			array(array($email,$hoten)),array(array("nguyenb1507277@student.ctu.edu.vn",
			"Ban Quản trị website BeautifulShop")),"Mail kích hoạt tài khoản BeautifulShop",$noidungmail);
			echo "<div align=\"center\" ><b>Vui lòng check email để kích hoạt tài khoản</b></div>";
			echo "<script language='javacript'>window.location='dangnhap.php'</script>";
			}
		}
		
		
		//	}
		
		//}
	}
else 
 echo '<meta http-equiv="refresh" content="0;URL:?khoatrang=dangky"/>';
?>


<div class="container">
        <h2>Đăng ký thành viên</h2>
			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
					<div class="form-group">
						    
                            <label for="txtTen" class="col-sm-2 control-label">Tên tài khoản(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtTenDangNhap" id="txtTenDangNhap" class="form-control" placeholder="Tên đăng nhập" value=""/>
							</div>
                      </div>  
                      
                       <div class="form-group">   
                            <label for="" class="col-sm-2 control-label">Mật khẩu(*):  </label>
							<div class="col-sm-10">
							      <input type="password" name="txtMatKhau1" id="txtMatKhau1" class="form-control" placeholder="Mật khẩu"/>
							</div>
                       </div>     
                       
                       <div class="form-group"> 
                            <label for="" class="col-sm-2 control-label">Nhập lại mật khẩu(*):  </label>
							<div class="col-sm-10">
							      <input type="password" name="txtMatKhau2" id="txtMatKhau2" class="form-control" placeholder="Xác nhận mật khẩu"/>
							</div>
                       </div>     
                       
                       <div class="form-group">                               
                            <label for="lblHoten" class="col-sm-2 control-label">Họ tên(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtHoTen" id="txtHoTen" value="" class="form-control" placeholder="Họ tên"/>
							</div>
                       </div> 
                       
                       <div class="form-group">      
                            <label for="lblEmail" class="col-sm-2 control-label">Email(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtEmail" id="txtEmail" value="" class="form-control" placeholder="Email"/>
							</div>
                       </div>  
                       
                        <div class="form-group">   
                             <label for="lblDiaChi" class="col-sm-2 control-label">Địa chỉ(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtDiaChi" id="txtDiaChi" value="" class="form-control" placeholder="Địa chỉ"/>
							</div>
                        </div>  
                        
                         <div class="form-group">  
                            <label for="lblDienThoai" class="col-sm-2 control-label">Điện thoại(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtDienThoai" id="txtDienThoai" value="" class="form-control" placeholder="Điện thoại" />
							</div>
                         </div> 
                         
                          <div class="form-group">  
                            <label for="lblGioiTinh" class="col-sm-2 control-label">Giới tính(*):  </label>
							<div class="col-sm-10">                              
                                      <label class="radio-inline"><input type="radio" name="grpGioiTinh" value="0" id="grpGioiTinh"  />Nam</label>
                 
                                      <label class="radio-inline"><input type="radio" name="grpGioiTinh" value="1" id="grpGioiTinh"  />

                                      Nữ</label>

							</div>
                          </div> 
                          
                          <div class="form-group"> 
                            <label for="lblNgaySinh" class="col-sm-2 control-label">Ngày sinh(*):  </label>
                            <div class="col-sm-10 input-group">
                                <span class="input-group-btn">
                                  <select name="slNgaySinh" id="slNgaySinh" class="form-control" >
										<?php
                                            for($i=1;$i<=31;$i++)
                                             {
                                                 if($i==$ngaysinh){
                                                     echo "<option value='".$i."' selected=\"selected\">".$i."</option>";
                                                 }
                                                 else{
                                                 echo "<option value='".$i."'>".$i."</option>";
                                                 }
                                             }
                                        ?>
                				 </select>
                                </span>
                                <span class="input-group-btn">
                                  <select name="slThangSinh" id="slThangSinh" class="form-control">
									<?php
                                        for($i=1;$i<=12;$i++)
                                         {
                                              if($i==$thangsinh){
                                                 echo "<option value='".$i."' selected=\"selected\">".$i."</option>";
                                             }
                                             else{
                                             echo "<option value='".$i."'>".$i."</option>";
                                             }
                                         }
                                    ?>
                				</select>
                                </span>
                                <span class="input-group-btn">
                                  <select name="slNamSinh" id="slNamSinh" class="form-control">
                                    <?php
                                        for($i=1970;$i<=2010;$i++)
                                         {
                                             if($i==$namsinh){
                                                 echo "<option value='".$i."' selected=\"selected\">".$i."</option>";
                                             }
                                             else{
                                             echo "<option value='".$i."'>".$i."</option>";
                                             }
                                         }
                                    ?>
                                </select>
                                </span>
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
						      <input type="submit"  class="btn btn-primary" name="btnDangKy" id="btnDangKy" value="Đăng ký"/>
						</div>
                     </div>
				</form>
                <script src='https://www.google.com/recaptcha/api.js'></script>

</div>
