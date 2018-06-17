    <!-- Bootstrap -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery-3.2.0.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<div class="container-fluid" style="margin-top:0px;">
<form name="frmXoa" method="post" action="" style="margin-top:0px;">
<script language="javascript">
$(document).ready(function() {
    var table = $('#tablekhachhang').DataTable({
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
<h1>Quản lý khách hàng</h1>
<form method="post" action=""/>
        <table id="tablekhachhang" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
                <tr>
                	<th>STT</th>
                    <th><strong>Tên đăng nhập</strong></th>
                    <th><strong>Tên khách hàng</strong></th>
                    <th><strong>Địa chỉ</strong></th>
                    <th><strong>Số điện thoại</strong></th>
                    <th><strong>Email</strong></th>
                    <th><strong>Cập nhật</strong></th>
                </tr>
             </thead>

			<tbody>
            <?php
				$stt=1;	
				$result = mysqli_query($conn, "SELECT kh_tendangnhap, kh_ten, kh_diachi, kh_dienthoai, kh_email
				FROM khachhang ");
				while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
			?>
			<tr>
            	<td><?php echo $stt;?></td>
              	<td ><?php echo $row["kh_tendangnhap"] ?></td>
              	<td><?php echo $row["kh_ten"] ?></td>
              	<td><?php echo $row["kh_diachi"] ?></td>
               	<td ><?php echo $row["kh_dienthoai"] ?></td>
              	<td><?php echo "<a href='mailto:".$row["kh_email"]."'>".$row["kh_email"]."</a>" ?></td>
             
              	<td align='center' class='cotNutChucNang'>
              		<a href='?khoatrang=quanly_khachhang_capnhat&ma=<?php echo $row['kh_tendangnhap']; ?>'><img src='images/edit.png' border='0'  /></a>
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