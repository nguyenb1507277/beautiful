<!-- Bootstrap -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<?php 
include_once('connection.php');
if(isset($_SESSION['quantri'])==1){

	if(isset($_GET['mahang'])){
		$ma = $_GET['mahang'];
		$sqlu="select  dh_trangthai, dh_trangthaithanhtoan, dh_ngaygiao from dondathang a , sanpham_dondathang b where a.dh_ma= b.dh_ma and b.sp_ma=".$ma;
		$result = mysqli_query($conn, $sqlu);
		$row = mysqli_fetch_row($result);
		$trangthai = $row[0];
		$trangthaithanhtoan =$row[1];
		$ngay = $row[2];
		}
	else
		echo '<meta http-equiv="refresh" content="0; URL=?khoatrang=quanly_donhang"/>';
?>
<script>
      function trove(){
          history.back();
      }
</script>
<div class="container">
	<h2>Cập nhật tình trạng đơn hàng</h2>
			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">  
                       <div class="form-group">
                            <label for="txtTT" class="col-sm-2 control-label">Tình trạng giao đơn hàng(*):  </label>
							<div class="col-sm-10 col-lg-10">
                            		<select name="tinhtranggiaohang">
                                    	<option value="0">Chưa giao hàng</option>
                                        <option value="1">Đang giao hàng</option>
                                    </select>
							      <input type="text" name="txtTT" id="txtTT" class="form-control" placeholder="" value='<?php echo $trangthai ?>'/>
							</div>
                      </div>   
                         <div class="form-group">
                            <label for="txtTTTT" class="col-sm-2 control-label">Tình trạng thanh toán đơn hàng(*):  </label>
							<div class="col-sm-10 col-lg-10">
                            <select name="tinhtrangthanhtoan">
                                    	<option value="0">Chưa thanh toán</option>
                                        <option value="1">Đang đã thanh toán</option>
                                    </select>
							      <input type="text" name="txtTTTT" id="txtTTTT" class="form-control" placeholder="" value='<?php echo $trangthaithanhtoan ?>'/>
							</div>
                      </div>
                    <div class="form-group">     
                    <label for="lblNgayGiaoHang" class="col-sm-2 control-label"> Ngày giao hàng(*):  </label>
                    <div class="col-sm-10">	      
                          <input name="txtNgayGiaoHang" id="txtNgayGiaoHang" type='date' class="form-control" />   
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
<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
<?php
if(isset($_POST['btnCapNhat'])){
	$tinhtrang = $_POST['txtTT'];
	$tttt=$_POST['txtTTTT'];
	$n=$_POST['txtNgayGiaoHang'];
	$loi="";
	if($tinhtrang=="" ||$tttt=="" || $n=="")
		$loi.= "<li>Vui lòng nhập đầy đủ thông tin</li>";
	if(!is_numeric($tinhtrang))
		$loi.= "<li>Vui lòng nhập tình trạng giao đơn hàng là 0 hoặc 1 hoặc 2</li>";
	if(!is_numeric($tttt))
		$loi.= "<li>Vui lòng Tình trạng thanh toán đơn hàng là 0 hoặc 1</li>";
	if($loi!="")
		echo "<ul>$loi</ul>";
	else{
		//echo "nguyen";
		$sqlstring = " update dondathang set
							dh_trangthai='".$tinhtrang."',
							dh_trangthaithanhtoan='".$tttt."',
							dh_ngaygiao = '".$n."'
							where dh_ma=".$_GET['mahang'];
		mysqli_query($conn, $sqlstring);
			echo '<meta http-equiv="refresh" content="0;URL=?khoatrang=quanly_donhang_chitiet&mahd='.$_GET['mahang'].'"/>';
		}
	}
?>