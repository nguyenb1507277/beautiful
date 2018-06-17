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
//kiểm tra xem có truyền mã cần xóa
if(isset($_GET['ma'])){
	//nếu xóa thì lấy mã và tiến hành xóa
	$ma=$_GET['ma'];
	mysqli_query($conn, "delete from dondathang where dh_ma='".$ma."'");
	echo '<meta http-equiv="refresh" content="0;URL=?khoatrang=quanly_donhang"/>';
	}
?>
        <h1>Quản lý Đơn đặt hàng</h1>

        <table id="tablesalomon" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><strong>Chọn</strong></th>
                    <th><strong>Số thứ tự</strong></th>
                    <th><strong>Mã đơn hàng</strong></th>
                    <th><strong>Tên Khách hàng</strong></th>
                    <th><strong>Ngày đặt hàng</strong></th>
                    <th><strong>Ngày giao</strong></th>
                    <th><strong>Nơi giao</strong></th>
                    <th><strong>HTTT</strong></th>
                    <th><strong>Điện thoại</strong></th>
                    <th><strong>Chi tiết</strong></th>
                    <th><strong>Xóa</strong></th>
                </tr>
             </thead>

			<tbody>
            <?php
				$stt=1;	
				$result = mysqli_query($conn, "select dh_ma, (select kh_ten from khachhang a where 
												a.kh_tendangnhap=b.kh_tendangnhap) as kh_hoten, dh_ngaydathang, dh_ngaygiao, 
												dh_noigiao, (select httt_ten from hinhthucthanhtoan c where 
												c.httt_ma=b.httt_ma) as ht_ten, dh_dienthoai
												from dondathang b order by b.dh_ngaygiao, b.dh_ngaydathang");
				while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
					
			?>
			<tr>
            <td class="cotCheckBox"><input type="checkbox" name="checkbox[]" id="checkbox[]" value="<?php echo $row["dh_ma"]?>"/></td>
            <td class="cotCheckBox"><?php echo $stt; ?></td>
              <td ><?php echo $row["dh_ma"] ?></td>
              <td><?php echo $row["kh_hoten"] ?></td>
              <td><?php echo $row["dh_ngaydathang"] ?></td>
               <td ><?php echo $row["dh_ngaygiao"] ?></td>
              <td><?php echo $row["dh_noigiao"] ?></td>
              <td><?php echo $row["ht_ten"] ?></td>
              <td><?php echo $row["dh_dienthoai"] ?></td>
              

              <td align='center' class='cotNutChucNang'>
              <a href='?khoatrang=quanly_donhang_chitiet&mahd=<?php echo $row['dh_ma']; ?>'><img src='images/edit.png' border='0'  /></a>
              </td>
              
              <td align='center' class='cotNutChucNang'>
              <a href='?khoatrang=quanly_donhang&ma=<?php echo $row['dh_ma'];?>' onclick="return deleteConfirm()">
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
   if(isset($_POST['btnXoa'])&& isset($_POST['checkbox'])){
	   for($i = 0; $i<count($_POST['checkbox']); $i++){
		   $donhang = $_POST['checkbox'][$i];
		   mysqli_query($conn, "delete from donhang where dh_ma=$donhang");
		   echo '<meta http-equiv="refresh" content="0; URL=?khoatrang=quanly_donhang"/>';
		   }
	   }
?> 