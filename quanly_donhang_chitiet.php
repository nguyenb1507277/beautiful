<!-- Bootstrap -->
<link rel="stylesheet" href="css/bootstrap.min.css">

<script>
      function trove(){
          history.back();
      }
</script>
<?php 
include_once('connection.php');
if(isset($_SESSION['quantri'])==1){
//kiểm tra xem có truyền mã cần xóa
if(isset($_GET['madonhang'])){
	//nếu xóa thì lấy mã và tiến hành xóa
	$mad=$_GET['madonhang'];
	mysqli_query($conn, "delete from dondathang where dh_ma='".$mad."'");
	echo '<meta http-equiv="refresh" content="0;URL=?khoatrang=quanly_donhang"/>';
	}
?>
        <h1>Quản lý Đơn đặt hàng</h1>

        <table id="tablesalomon" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><strong>Chọn</strong></th>
                    <th><strong>Số thứ tự</strong></th>
                    <th><strong>Mã đơn đặt hàng</strong></th>
                    <th><strong>Sản phẩm</strong></th>
                    <th><strong>Số lượng</strong></th>
                    <th><strong>Tổng tiền</strong></th>
                    <th><strong>ĐH trạng thái</strong></th>
                    <th><strong>ĐH trạng thái TT</strong></th>
                     <th><strong>Cập nhật</strong></th>
                    <th><strong>Xóa</strong></th>
                </tr>
             </thead>

			<tbody>
            

					 <?php 
						if(isset($_GET['mahd'])){
							$ma = $_GET['mahd'];
							$stt=1;
							$result = mysqli_query($conn, "select  b.dh_ma, (select sp_ten from sanpham a where a.sp_ma=b.sp_ma) as sp,
									b.sp_dh_soluong, b.sp_dh_dongia , c.dh_trangthai, c.dh_trangthaithanhtoan 
									from sanpham_dondathang b , dondathang c where b.dh_ma= c.dh_ma and c.dh_ma='".$ma."'");
							while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
					
					?>
			<?php
					

			?>
			<tr>
            	<td class="cotCheckBox"><input type="checkbox" name="checkbox[]" id="checkbox[]" value="<?php echo $row["dh_ma"]?>"/></td>
            	<td class="cotCheckBox"><?php echo $stt; ?></td>
              	<td ><?php echo $row["dh_ma"] ?></td>
              	<td><?php echo $row["sp"] ?></td>
              	<td><?php echo $row["sp_dh_soluong"] ?></td>
               	<td ><?php echo $row["sp_dh_dongia"] ?></td>
              	<td><?php echo $row["dh_trangthai"] ?></td>
              	<td><?php echo $row["dh_trangthaithanhtoan"] ?></td>
              

              	<td align='center' class='cotNutChucNang'>
              		<a href='?khoatrang=quanly_donhang_capnhat&mahang=<?php echo $row['dh_ma']; ?>'><img src='images/edit.png' border='0'  /></a>
              	</td>
              
              	<td align='center' class='cotNutChucNang'>
              		<a href='?khoatrang=quanly_donhang&madonhang=<?php echo $row['dh_ma'];?>' onclick="return deleteConfirm()">
             		<img src='images/delete.png' border='0' /></a>
              	</td>
            </tr>
            <?php
			$stt++;
				}
				}
				?>
			</tbody>
        
        </table>  
		<div class="row" style="background-color:#FFF"><!--Nút chức nang-->
            <div class="col-md-12">
            	<input type="submit" value="Xoá mục chọn" name="btnXoa" onclick='return deleteConfirm()' class="btn btn-primary"/>
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
   if(isset($_POST['btnXoa'])&& isset($_POST['checkbox'])){
	   for($i = 0; $i<count($_POST['checkbox']); $i++){
		   $donhang = $_POST['checkbox'][$i];
		   mysqli_query($conn, "delete from donhang where dh_ma=$donhang");
		   echo '<meta http-equiv="refresh" content="0; URL=?khoatrang=quanly_donhang"/>';
		   }
	   }
?> 