     <!-- Bootstrap --> 
    <link rel="stylesheet" type="text/css" href="style.css"/>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <script language="javascript">
	function deleteConfirm(){
		if(confirm("Bạn có chắc chắn muốn xóa!")){
			return true;
		}
		else{
			return false;
		}
	}
	
</script>
<!--lay ma san pham va hien  thi thong tin san pham trong trang nay-->
<?php 
include_once('connection.php');
if(isset($_SESSION['quantri'])==1){
?>
 <?php
		if(isset($_GET['ma'])){
			$sp_ma = $_GET['ma'];
			$spl="select sp_ten from sanpham where sp_ma='$sp_ma'";
			$result=mysqli_query($conn,$spl);
			$row=mysqli_fetch_row($result);
			$ten=$row[0];
			}
		else{
			echo '<meta http-equiv="refesh" content="0;URL=?khoatrang=quanly_sanpham"/>';
			}
 ?>
 	<h2>Quản lý hình ảnh sản phẩm</h2>
		<div class="container">
			 	<form  id="frmHinhAnh" class="form-horizontal" name="frmHinhAnh" method="post" action="" enctype="multipart/form-data" role="form">
					<div class="form-group">
                        <label for="txtTen" class="col-sm-2 control-label">Mã sản phẩm(*):  </label>
						<div class="col-sm-10">
							<input type="text" name="txtMa" id="txtMa" class="form-control" placeholder="Mã sản phẩm" value='<?php echo $sp_ma; ?>' readonly="readonly"/>
						</div>
            		</div>	
                    <div class="form-group">    
                        <label for="txtTen" class="col-sm-2 control-label">Tên sản phẩm(*):  </label>
						<div class="col-sm-10">
						     <input type="text" name="txtTen" id="txtTen" class="form-control" placeholder="Tên loại sản phẩm" value='<?php echo $ten; ?>' readonly="readonly"/> 
						</div>
                    </div>    
                     <div class="form-group">    
                        <label for="" class="col-sm-2 control-label">Hình ảnh(*):  </label>
						<div class="col-sm-10">
							<input type="file" name="fileHinhAnh" id="fileHinhAnh" class="form-control"/>
                            <input type="submit"  class="btn btn-primary" name="btnLuu" id="btnLuu" value="Lưu hình ảnh"/>        
						</div>
                     </div>       
 
                    <!--Danh sach hinh anh-->
                     <div class="col-sm-offset-2 col-sm-12">
						<div class="col-sm-1">
                        	<label class="control-label">STT</label>
                        </div>
                        <div class="col-sm-2">
                        	<label class="control-label">Hình ảnh</label>
                        </div>
                        <div class="col-sm-1">
                        	<label class="control-label">Xóa</label>
                        </div>
                    </div> <!-- <div class="col-sm-offset-2 col-sm-12">1 hang bang hinh anh-->
                   <!--Row du lieu-->
                   <?php
		  				$query ="select hsp_ma, hsp_tentaptin from hinhsanpham where sp_ma='$sp_ma'";
						$rs= mysqli_query($conn, $query) or die(mysqli_error($conn));
						$stt=1;
						while($row = mysqli_fetch_array($rs, MYSQLI_ASSOC)){
					?>
							<div class='col-sm-offset-2 col-sm-12'>
							  <div class='col-sm-1'>
								<?php echo $stt; ?>
								</div>
							  <div class='col-sm-2'>
								<img src="product-imgs/<?php echo $row['hsp_tentaptin']; ?>" width="100px"/>
							  </div>
							  <div class='col-sm-3'>
								  <a onclick="return deleteConfirm()" 
                                  href="?khoatrang=quanly_sanpham_hinhanh.php&mahinh=<?php  echo $row['hsp_ma']; ?>">
								  <img src='images/delete.png' border='0' /></a>
							  </div>
                              
							</div>
                            <div class='col-sm-offset-2 col-sm-4'>
                           		<div><hr /></div>
                           </div>
                          <?php
				$stt++;
						}
		  				?>
				<!-- <div class="form-group"> -Danh sach hinh anh-->

                   <div class="col-sm-offset-2 col-sm-12">
                   		<div class="col-sm-1">
						     <a href="?khoatrang=quanly_sanpham"> Đóng</a>
                        </div>
              		</div>
                    
				</form>
		</div><!--<div class="container">-->
<?php
}
else {
	echo '<meta  http-equiv="refresh" content="0;URL=?khoatrang=dangnhap"/>';
}
?>
<?php 
if(isset($_POST['btnLuu'])){
	$sp_ma=$_POST['txtMa'];
	$taptin=$_FILES['fileHinhAnh'];
	if($taptin['type']=="image/jpg" || $taptin['type']=="image/jpeg" || $taptin['type']=="image/gif" || $taptin['type']=="image/png" ){
		if($taptin['size'] <=61440){
			$tentaptin = $sp_ma."_".$taptin['name'];
			copy($taptin['tmp_name'], "product-imgs/".$tentaptin);
			$sqltring = "insert into hinhsanpham(hsp_tentaptin, sp_ma) values('$tentaptin', '$sp_ma')";
			$pp = mysqli_query($conn, $sqltring);
if($pp){
	echo "<script> alter('upload thanh cong'); </script>";
		echo '<meta http-equiv="refresh" content="0;URL=?khoatrang=quanly_sanpham_hinhanh&ma='.$sp_ma.'"/>';
		}
else
{
	echo "<script> alter('upload khong thanh cong'); </script>";
	echo '<meta http-equiv="refresh" content="0;URL=?khoatrang=quanly_sanpham_hinhanh&mahinh='.$sp_ma.'"/>';
	}
			}
			else echo "hinh anh kich thuoc qua lon";
		}
		else echo "hinh anh khong dinh dang";
}
if(isset($_GET['mahinh'])){
	$mahinh=$_GET['mahinh'];
	$ketqua=mysqli_query($conn, "select * from hinhsanpham where hsp_ma=$mahinh");
	$row=mysqli_fetch_array($ketqua, MYSQLI_ASSOC);
	$filecanxoa = $row['hsp_tentaptin'];
	$sp_ma=$row['sp_ma'];
	unlink("product-imgs/".$filecanxoa);
	mysqli_query($conn, "delete from hinhsanpham where hsp_ma=$mahinh");
	echo '<meta http-equiv="refresh" content="0;URL=?khoatrang=quanly_sanpham_hinhanh&mahinh='.$sp_ma.'"/>';
	}
?>

