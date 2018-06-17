<!-- Bootstrap --> 
<link rel="stylesheet" type="text/css" href="style.css"/>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/bootstrap.min.css">
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
if(isset($_SESSION['tendangnhap'])){
	 $result=mysqli_query($conn,"select kh_ten, kh_email, kh_diachi, kh_dienthoai 
	 from khachhang where kh_tendangnhap='".$_SESSION['tendangnhap']."'");
	 $row=mysqli_fetch_row($result);
	 $hoten=$row[0];
		 $mail=$row[1];
		 $dc=$row[2];
		 $dt=$row[3];

?>

<div class="container">
        <h2>Thay đổi thông tin</h2>
        <br/>
        <?php 
		$result1=mysqli_query($conn,"select kh_ten, kh_email, kh_diachi, kh_dienthoai , kh_gioitinh, kh_ngaysinh, kh_thangsinh, kh_namsinh
	 from khachhang where kh_tendangnhap='".$_SESSION['tendangnhap']."'");
		$rows = mysqli_fetch_array($result1);
		$ten=$rows[0];
		$em=$rows[1];
		$diachi=$rows[2];
		$dienthoai=$rows[3];
		$gioitinh=$rows[4];
		$ngay=$rows[5];
		$thang=$rows[6];
		$nam=$rows[7];
		if($rows) {
			echo "<b>Họ tên khách hàng:</b> ".$ten."<br/>";
			echo "<b>Email: </b>".$em."<br/>";
			echo "<b>Địa chỉ:</b> ".$diachi."<br/>";
			echo "<b>Điện thoại: </b>".$dienthoai."<br/>";
			echo "<b>Giới tính: </b>";
			if($gioitinh==1) echo 'Nữ'; else echo 'Nam';
			echo "<br/>";
			echo "<b>Ngày-tháng-năm sinh: </b>".$ngay."-".$thang."-".$nam;
			}
		?>
        		
			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
                       <div class="form-group">  
                       <hr color="#FF0000"/>   
                       <br/>                          
                            <label for="lblHoten" class="col-sm-2 control-label">Họ tên(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtHoTen" id="txtHoTen" class="form-control" value="<?php echo $hoten; ?>" 
                                  />
							</div>
                       </div> 
                       
                       <div class="form-group">      
                            <label for="lblEmail" class="col-sm-2 control-label">Email(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtEmail" id="txtEmail" class="form-control" value="<?php echo $mail; ?>"/>
							</div>
                       </div>  
                       
                        <div class="form-group">   
                             <label for="lblDiaChi" class="col-sm-2 control-label">Địa chỉ(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtDiaChi" id="txtDiaChi" class="form-control" value="<?php echo $dc; ?>"/>
							</div>
                        </div>  
                        
                         <div class="form-group">  
                            <label for="lblDienThoai" class="col-sm-2 control-label">Điện thoại(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtDienThoai" id="txtDienThoai" class="form-control" value="<?php echo $dt; ?>" />
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
						      <input type="submit"  class="btn btn-primary" name="btnThongTin" id="btnThongTin" value="Thay Đổi"/>
						</div>
                     </div>
				</form>
</div>
  
<?php
	}
	else
	{
		echo '<meta http-equiv="refesh" content="0;URL=?khoatrang=dangnhap"/>';
	}
?>
    
<?php
	if(isset($_POST["btnThongTin"])){
		if(isset($_POST['grpGioiTinh']))
		$gioitinh = $_POST['grpGioiTinh'];
		$ngaysinh = $_POST['slNgaySinh'];
		$thangsinh = $_POST['slThangSinh'];
		$namsinh = $_POST['slNamSinh'];
		$loi="";

		$ten=$_POST['txtHoTen'];
		$e = $_POST['txtEmail'];
		$diachi=$_POST['txtDiaChi'];
		$dienthoai = $_POST['txtDienThoai'];	
		
		if($ten=="" || $dienthoai=="" || $diachi=="" || $gioitinh=="" || $ngaysinh=="" ||$thangsinh=="" || $namsinh=="")
		{
			$loi.="<li>Yêu cầu nhập đầy đủ thông tin</li>";
		}
		if($loi!="")
		{
			echo "<ul>$loi</ul>";
		}
		else
		{
			mysqli_query($conn,"update khachhang set  kh_ten = '".$ten."', kh_email = '".$e."', kh_diachi='".$diachi."', kh_gioitinh='".$gioitinh."', kh_dienthoai='".$dienthoai."', 
			kh_ngaysinh='".$ngaysinh."', kh_thangsinh = '".$thangsinh."', kh_namsinh='".$namsinh."' where kh_tendangnhap='".$_SESSION['tendangnhap']."' ");
			echo '<meta http-equiv="refresh" content="0; URL=?khoatrang=quanly_thongtincanhan"/>';
		}
	}
?>