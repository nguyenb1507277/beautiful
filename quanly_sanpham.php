<?php 
include_once('connection.php');
if(isset($_SESSION['quantri'])==1){
?>
    <!-- Bootstrap -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery-3.2.0.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<div class="container-fluid" style="margin-top:0px;">
<form name="frmXoa" method="post" action="" style="margin-top:0px;">
<script language="javascript">
	function deleteConfirm(){
		if(confirm("Bạn có chắc chắn muốn có xóa!")){
			return true;
			}
		else
			return false;
		}
</script>
<script language="javascript">
$(document).ready(function() {
    var table = $('#tablesanpham').DataTable({
		responsive: true,
		"language":{
			"lengthMenu": "Hiển thị _MENU_ dòng dữ liệu trên một trang",
			"info": "Hiển thị từ dòng _START_ trong tổng số _TOTAL_ dòng dữ liệu",
			"infoEmpty": "Dữ liệu rỗng",
			"emptyTable": "Chưa có dữ liệu nào",
			"processing": "Đang xử lý ...",
			"search": "Tìm kiếm",
			"loadingRecords": "Đang load dữ liệu...",
			"zeroRecords": "Không tìm thấy dữ liệu",
			"infoFiltered": "(Được từ tổng số _MAX_ dòng dữ liệu)",
			"paginate": {
				"first": "|<",
				"last": ">|",
				"next": ">>",
				"previous": "<<"
				}
			},
			"lengthMenu": [[5,10,15,20,25,30,-1],[5,10,15,20,25,30,"Tất cả"]]
		});
		new $.fn.dataTable.FixedHeader(table);
});
</script>
<?php 

//kiểm tra xem có truyền mã cần xóa
if(isset($_GET['ma'])){
	//nếu xóa thì lấy mã và tiến hành xóa
	$ma=$_GET['ma'];
	mysqli_query($conn, "delete from sanpham where sp_ma='".$ma."'");
	echo '<meta http-equiv="refresh" content="0;URL=?khoatrang=quanly_sanpham"/>';
	}
?>
        <h1>Quản lý sản phẩm</h1>
        <p>
        	<a href="?khoatrang=quanly_sanpham_themmoi"><img src="images/add.png" alt="Thêm mới" width="16" height="16" border="0" /> Thêm mới</a>
        </p>
        <table id="tablesanpham" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><strong>Chọn</strong></th>
                    <th><strong>Số thứ tự</strong></th>
                    <th><strong>Mã sản phẩm</strong></th>
                    <th><strong>Tên sản phẩm</strong></th>
                    <th><strong>Giá/SP</strong></th>
                    <th><strong>Số lượng</strong></th>
                    <th><strong>Loại sản phẩm</strong></th>
                    <th><strong>Thương hiệu</strong></th>
                    <th><strong>Hình ảnh</strong></th>
                    <th><strong>Cập nhật</strong></th>
                    <th><strong>Xóa</strong></th>
                </tr>
             </thead>

			<tbody>
            <?php
				$stt=1;	
				$result = mysqli_query($conn, "SELECT sp_ma, sp_ten, sp_mota_ngan, sp_gia, sp_ngaycapnhat, sp_soluong,lsp_ten, 
												thuonghieu_ten FROM sanpham a JOIN loaisanpham b 
												ON a.lsp_ma = b.lsp_ma JOIN thuonghieu c ON a.thuonghieu_ma = c.thuonghieu_ma 
												ORDER BY sp_ma ");
				while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
					
			?>
			<tr>
            	<td class="cotCheckBox"><input type="checkbox" name="checkbox[]" id="checkbox[]" value="<?php echo $row["sp_ma"]?>"/></td>
            	<td><?php echo $stt; ?></td>
              	<td ><?php echo $row["sp_ma"] ?></td>
              	<td><?php echo $row["sp_ten"] ?></td>
              	<td><?php echo $row["sp_gia"] ?></td>
               	<td ><?php echo $row["sp_soluong"] ?></td>
              	<td><?php echo $row["lsp_ten"] ?></td>
              	<td><?php echo $row["thuonghieu_ten"] ?></td>
              
              
             	<td align='center' class='cotNutChucNang'>
             		<a href="?khoatrang=quanly_sanpham_hinhanh&ma=<?php echo $row['sp_ma']?>">
             			<img src='images/image_edit.png' border='0'  /></a></td>
             
              	<td align='center' class='cotNutChucNang'>
              		<a href='?khoatrang=quanly_sanpham_capnhat&ma=<?php echo $row['sp_ma']; ?>'><img src='images/edit.png' border='0'  /></a>
              	</td>
              
              	<td align='center' class='cotNutChucNang'>
              		<a href='?khoatrang=quanly_sanpham&ma=<?php echo $row['sp_ma'];?>' onclick="return deleteConfirm()">
             			<img src='images/delete.png' border='0' /></a>
              	</td>
            </tr>
            <?php
			$stt++;
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
if(isset($_POST['btnLuu'])){
	$sp_ma = $_POST['txtMa'];
	$taptin=$_FILES['fileHinhAnh'];
	if($taptin['type']=="image/jpg" ||$taptin['type']=="image/jpeg" || $taptin['type']=="image/png" || $taptin['type']=="image/gif"  ){
		if($taptin['size']<61440){
			$tentaptin = $sp_ma."_".$taptin['name'];
			copy($taptin['tmp_name'], "product-imgs/".$tentaptin);
			$sqlstring = "insert into hinhsanpham(hsp_tentaptin, sp_ma) values('$tentaptin', '$sp_ma')" ;
			$kp=mysqli_query($conn, $sqlstring);
			if($kp)
				echo "<script> alter('upload thanh cong ... '); </script>";
				else 
				{
				echo "<script> alter('upload khong thanh cong ... '); </script>";
				echo '<meta http-equiv="refresh" content="0; URL=?khoatrang=quanly_sanpham_hinhanh&?mahinh='.$sp_ma.'"/>';
					}
			}
			else echo "hinh anh co kich thuoc qua lon";
		}
		else echo "hinh khong dung dinh dang";
	}
?>
   <?php 
   if(isset($_POST['btnXoa'])&& isset($_POST['checkbox'])){
	   for($i = 0; $i<count($_POST['checkbox']); $i++){
		   $ma_sanpham = $_POST['checkbox'][$i];
		   mysqli_query($conn, "delete from sanpham where sp_ma='".$ma_sanpham."'");
		   echo '<meta http-equiv="refresh" content="0; URL=?khoatrang=quanly_sanpham"/>';
		   }
	   }
   ?> 
        
    