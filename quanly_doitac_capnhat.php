<!-- Bootstrap -->
<link rel="stylesheet" href="css/bootstrap.min.css"/>
<?php 
include_once('connection.php');
if(isset($_SESSION['quantri'])==1){
?>
 <?php 
	if(isset($_GET['ma'])){
		$ma = $_GET['ma'];
		$sqlu="select thuonghieu_ten, thuonghieu_email, thuonghieu_sdt from  thuonghieu where thuonghieu_ma=".$ma;
		$result = mysqli_query($conn, $sqlu);
		$row = mysqli_fetch_row($result);
		$ten = $row[0];
		$email=$row[1];
		$sodt = $row[2];
		}
	else
		echo '<meta http-equiv="refresh" content="0; URL=?khoatrang=quanly_doitac"/>';
?>
<script>
      function trove(){
          history.back();
      }
</script>
<div class="container">
	<h2>Cập nhật thông tin đối tác thương hiệu</h2>
			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
					<div class="form-group">
                            <label for="txtTen" class="col-sm-2 control-label">Tên thương hiệu(*):  </label>
							<div class="col-sm-10 col-lg-10">
							      <input type="text" name="txtTen" id="txtTen" class="form-control" placeholder="Tên sản phẩm" value='<?php echo $ten ?>'/>
							</div>
                      </div>   
                      <div class="form-group">
                            <label for="txtEmail" class="col-sm-2 control-label">Email thương hiệu(*):  </label>
							<div class="col-sm-10 col-lg-10">
							      <input type="text" name="txtEmail" id="txtEmail" class="form-control" placeholder="Email thương hiệu" 
                                  value='<?php echo $email; ?>'/>
							</div>
                      </div> 
                        
                        <div class="form-group">
                            <label for="txtSDT" class="col-sm-2 control-label">Số điện thoại(*):  </label>
							<div class="col-sm-10 col-lg-10">
							      <input type="text" name="txtSDT" id="txtSDT" class="form-control" placeholder="Số điện thoại" value='<?php echo $sodt ?>'/>
							</div>
                      </div>    
                          
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						      <input type="submit"  class="btn btn-primary" name="btnCapNhat" id="btnCapNhat" value="Cập nhật"/>
                              <input type="button" class="btn btn-primary" name="btnTroVe"  id="btnTroVe" value="Trở về" onclick="trove()" />
                              	
						</div>
					</div>
				</form>
		</div>
<?php
}
else {
	echo '<meta  http-equiv="refresh" content="0;URL=?khoatrang=dangnhap"/>';
}
?>
<?php
if(isset($_POST['btnCapNhat'])){
	$ten = $_POST['txtTen'];
	$email=$_POST['txtEmail'];
	$sodt=$_POST['txtSDT'];
	$loi="";
	if($ten=="")
		$loi.= "<li>Vui lòng nhập tên thương hiệu</li>";
	if($email=="")
		$loi.= "<li>Vui lòng nhập tên email</li>";
		if($sodt=="")
		$loi.= "<li>Vui lòng nhập số điện thoại</li>";
	if($loi!="")
		echo "<ul>$loi</ul>";
	else{
		$sqlstring = "update thuonghieu
						set thuonghieu_ten= '".$ten."',
						thuonghieu_email='".$email."',
						thuonghieu_sdt='".$sodt."'
						where thuonghieu_ma='".$ma."'";
		mysqli_query($conn, $sqlstring);
			echo '<meta http-equiv="refresh" content="0;URL=?khoatrang=doitac"/>';
		}
	}
?>