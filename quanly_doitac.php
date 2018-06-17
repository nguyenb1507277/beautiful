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
    var table = $('#tablesalomon').DataTable({
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
include_once('connection.php');
if(isset($_SESSION['quantri'])==1){
?>
<?php
if(isset($_GET['ma'])){
	//nếu xóa thì lấy mã và tiến hành xóa
	$ma=$_GET['ma'];
	mysqli_query($conn, "delete from thuonghieu where thuonghieu_ma='".$ma."'");
	echo '<meta http-equiv="refresh" content="0;URL=?khoatrang=doitac"/>';
	}
?>  <h1>Quản lý đối tác</h1>
        <p>
        	<a href="?khoatrang=quanly_doitac_themmoi"><img src="images/add.png" alt="Thêm mới" width="16" height="16" border="0" /> Thêm mới</a>
        </p>
        <table id="tablesalomon" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
                <tr>
                	<th><strong>Chọn</strong></th>
                	<th><strong>STT</strong></th>
                    <th><strong>Mã thương hiệu</strong></th>
                    <th><strong>Tên thương hiệu</strong></th>
                    <th><strong>Email</strong></th>
                    <th><strong>Số điện thoại</strong></th>
                    <th><strong>Số lượng SP Kình Doanh</strong></th>
                    <th><strong>Cập nhật</strong></th>
                    <th><strong>Xóa</strong></th>
                </tr>
             </thead>

			<tbody>
            <?php
				$stt=1;	
				$result = mysqli_query($conn, "select a.thuonghieu_ma, a.thuonghieu_ten, a.thuonghieu_email, a.thuonghieu_sdt,
												count(b.thuonghieu_ma) as soluong_sanpham
												from thuonghieu a join  sanpham b
												on a.thuonghieu_ma=b.thuonghieu_ma
												group by thuonghieu_ma
												order by thuonghieu_ma ");
				while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
			?>
			<tr>
             	<td class="cotCheckBox"><input type="checkbox" name="checkbox[]" id="checkbox[]" value="<?php echo $row["thuonghieu_ma"]?>"/></td>
              	<td ><?php echo $stt; ?></td>
              	<td ><?php echo $row["thuonghieu_ma"] ?></td>
              	<td><?php echo $row["thuonghieu_ten"] ?></td>
              	<td><?php echo $row["thuonghieu_email"] ?></td>
               	<td ><?php echo $row["thuonghieu_sdt"] ?></td>
              	<td><?php echo $row["soluong_sanpham"] ?></td>              
              
              	<td align='center' class='cotNutChucNang'>
              		<a href='?khoatrang=quanly_doitac_capnhat&ma=<?php echo $row['thuonghieu_ma']; ?>'><img src='images/edit.png' border='0'  /></a>
              	</td>
              
              	<td align='center' class='cotNutChucNang'>
              		<a href='?khoatrang=doitac&ma=<?php echo $row['thuonghieu_ma'];?>' onclick="return deleteConfirm()">
             <img src='images/delete.png' border='0' /></a>
              	</td>
            </tr>
            <?php
			$stt++;
				}
				?>
			</tbody>
        
        </table>  

 </form>
 </div>
<?php
}
else {
	echo '<meta  http-equiv="refresh" content="0;URL=?khoatrang=dangnhap"/>';
}
?>