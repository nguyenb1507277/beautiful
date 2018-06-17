<link rel="stylesheet" type="text/css" href="style.css"/>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/responsive.css">
<script src="js/jquery-3.2.0.min.js"/></script>
<script src="js/jquery.dataTables.min.js"/></script>
<script src="js/dataTables.bootstrap.min.js"/></script>

<?php 
if(isset($_POST['btnKiemTra'])){
				$stt=1;
				$madh =$_POST['txtMaDonHang'];
				$sdt = $_POST['txtDienThoai'];
				$loi = "";
				if($madh=="" || $sdt=""){
					$loi=$loi."Không bỏ trống mã đơn hàng và số điện thoại";
					echo "".$loi."";
					}
			 else {
				 	echo '<meta http-equiv="refresh" content="0;URL=?khoatrang=xemdonhang&mahang='.$madh.'&sdt='.$sdt.'"/>';
			 }
}
?>
<h1>Kiểm tra đơn hàng</h1>
<form class="form-horizontal" id="form1" name="form1" method="POST" action="">
	<div class="row" style="height:250px;">
    <div class="form-group">
						    
        <label for="txtTenDangNhap" class="col-sm-2 control-label">Mã đơn hàng(*):  </label>
		<div class="col-sm-10">
		      <input type="text" name="txtMaDonHang" id="txtMaDonHang" class="form-control" placeholder="Nhập mã đơn hàng" value=""/>
		</div>
      </div>  
      
        <div class="form-group">
        <label for="txtMatKhau" class="col-sm-2 control-label">Số diện thoại(*):  </label>
		<div class="col-sm-10">
		      <input type="text" name="txtDienThoai" id="txtDienThoai" class="form-control" placeholder="Nhập số điện thoại" value=""/>
		</div>
         </div> 
         
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
        
        	<input type="submit" name="btnKiemTra"  class="btn btn-primary" id="btnKiemTra" value="Kiểm tra đơn hàng"/>
            
        </div>

 </div>
    
</form>
