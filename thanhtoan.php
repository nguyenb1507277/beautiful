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
include_once("connection.php");
function bindHTTTList($conn)
{
	$query="select httt_ma,httt_ten from hinhthucthanhtoan";
	$result=mysqli_query($conn,$query);
	echo "<select name='slHinhThucThanhToan'>
	<option value='0'>Chon hinh thuc thanh toan</option>";
	while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
	{
		echo "<option value='".$row['httt_ma']."'>".$row['httt_ten']."</option>";
	}
	echo "</select>";
}
?>
<div class="container">
<h1>Thanh toán giỏ hàng</h1>
<form id="form1" class="form-horizontal" name="form1" method="POST" action="">
				
    <div class="form-group">						    
        <label for="lblNoiGiaoHang" class="col-sm-2 control-label">Địa chỉ nhận hàng(*):  </label>
		<div class="col-sm-10">
		      <input type="text" name="txtNoiGiaoHang" id="txtNoiGiaoHang" class="form-control" placeholder="Nhập số, đường, phường, thị trấn , tỉnh thành" value=""/>
		</div>
   </div>  
    <div class="form-group">						    
        <label for="txtSDT" class="col-sm-2 control-label">Số điện thoại liên hệ(*):  </label>
		<div class="col-sm-10">
		      <input type="text" name="txtSDT" id="txtSDT" class="form-control" placeholder="Số điện thoại khi nhận hàng" value=""/>
		</div>
   </div>
   <?php 
   		$ng=mysqli_query($conn, "select kh_email from khachhang where kh_tendangnhap='".$_SESSION['tendangnhap']."'");
		while($row=mysqli_fetch_array($ng,MYSQLI_ASSOC)){
	?>
     <div class="form-group">						    
        <label for="txtEmail" class="col-sm-2 control-label">Email để nhận mã đơn hàng(*):  </label>
		<div class="col-sm-10">
		      <input type="text" name="txtEmail" id="txtEmail" class="form-control" placeholder="" value="<?php echo $row['kh_email']?>"/>
		</div>
   </div> 
   <?php }?>
   <div class="form-group">           
        <label for="lblHinhThucThanhToan" class="col-sm-2 control-label">Hình thức thanh toán(*):  </label>
		<div class="col-sm-10">
		      <?php bindHTTTList($conn);  ?>
		</div>
   </div>     
   
   <div class="form-group">      
   <div class="col-sm-2"></div>
        <div class="col-sm-10">
        	<input type="submit" name="btnThanhToan"  class="btn btn-primary" id="btnThanhToan" value="Thanh toán"/>
            <input name="btnBoQua" type="button" class="btn btn-primary" id="btnBoQua" value="Bỏ qua" onclick="window.location='?khoatrang=giohang'" />
        </div>
     </div>   
</form>
</div>

<?php 
include_once('connection.php');
if(isset($_POST['btnThanhToan'])){
	
		$noigiao=$_POST['txtNoiGiaoHang'];
		$httt=$_POST['slHinhThucThanhToan'];
		$sdt=$_POST['txtSDT'];
		$email=$_POST['txtEmail'];
		$hoten=$_SESSION['tendangnhap'];
	
	$loi ="";
	if($noigiao=="" ||  $httt=='0' || $sdt=="" || $email=="")
	$loi.="Vui lòng không để trống bắt kỳ thông tin nào!";
	if(strpos($email,'@')=== false)
		$loi.="Email không hợp lệ";
	if($loi!="")
		echo "<script>alert(' ".$loi."' );</script>";
	else {
		include_once("sendmailLib.php");
		$query="insert into dondathang(dh_ngaydathang,dh_noigiao,dh_trangthaithanhtoan,httt_ma,kh_tendangnhap, dh_dienthoai)
		values(now(),'".$noigiao."',0,".$httt.",'".$_SESSION['tendangnhap']."', '".$sdt."')";
		mysqli_query($conn,$query)or die(mysqli_error($conn));
		$dh_ma=mysqli_insert_id($conn);
		foreach($_SESSION["giohang"] as $key =>$row){
			$query="insert into sanpham_dondathang(sp_ma,dh_ma,sp_dh_soluong,sp_dh_dongia) values (".$key.",".$dh_ma.",".$row['soluong'].",".$row['gia'].")";
			mysqli_query($conn,$query)or die(mysqli_error($conn));
			$queryupdatesoluong="update sanpham set sp_soluong=sp_soluong-".$row['soluong']."where sp_ma=".$key;
			mysqli_query($conn,$queryupdatesoluong);
		}
			unset($_SESSION['giohang']);
			$noidungmail="<p >Chúc mừng bạn $hoten đã đăng đặt hàng thành công tại website BeautifulShop</p>".
			"<p>Mã đơn hàng của bạn là $dh_ma
			</p>";
			sendGMail("testmailweb02@gmail.com","web02#cusc","ban quản trị website BeautifulShop",
			array(array($email,$hoten)),array(array("nguyenb1507277@student.ctu.edu.vn",
			"Ban Quản trị website BeautifulShop")),"Mail đơn hàng BeautifulShop",$noidungmail);
			echo "<script language='javacript'>window.location='index.php'</script>";
			echo "Vui lòng đợi email để xem mã đơn hàng";
			//}
		
		}
}
?>

