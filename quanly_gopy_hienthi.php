    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <script src="js/jquery-3.2.0.min.js"/></script>
    <script src="js/jquery.dataTables.min.js"/></script>
    <script src="js/dataTables.bootstrap.min.js"/></script>
    <script language="javascript">
	$(document).ready(function() {
        var table = $('#tablesalomon').DataTable({
			responsive: true,
			"language":{
				"lengthMenu": "Hiển thị _MENU_ dòng dữ liệu trên một trang",
				"info": "Hiển thị từ dòng _START_ trong tổng số _TOTAL_ dòng dữ liệu",
				"infoEmpty":"Dữ liệu rỗng",
				"emptyTable":"Chưa có dữ liệu nào",
				"proccessing":"Đang xử lý...",
				"search":"Tìm kiếm:",
				"loadingRecords":"Đang load dữ liệu...",
				"zeroRecords":"không tìm thấy dữ liệu...",
				"infoFiltered":"(Được từ tổng số _MAX_ dòng dữ liệu)",
				"paginate":{
					"first":"|<",
					"last":">|",
					"next": ">>",
					"previous":"<<"
				}
			},
			"lengthMenu":[[5,10,15,20,25,30,-1],[5,10,15,20,25,30,"Tất cả"]]
		});
		new $.fn.dataTable.FixedHeader(table);
    });
	</script>
    <script language="javascript">
	function deleteConfirm(){
		if(confirm("Bạn có chắc chắn muốn xóa? ")){
			return true;
		}
		else{
			return false;
		}
	}
	</script>
<?php 
include_once('connection.php');
if(isset($_SESSION['quantri'])==1){
?>
<?php
			if(isset($_GET['ma'])){
				$magopy = $_GET["ma"];
				mysqli_query($conn, "delete from gopy where gy_ma=$magopy");
				echo '<meta http-equiv="refresh" content="0;URL=?khoatrang=quanly_gopy_hienthi"/>';
			}
?>
        
<?php
  if(isset($_POST['btnXoa'])&&isset($_POST['checkbox']))
  {
	  for($i=0;$i<count($_POST['checkbox']);$i++)
	  {
		  $masanpham=$_POST['checkbox'][$i];
		  mysqli_query($conn,"delete from gopy where gy_ma=$magopy");
	  }
  }
?>
        <form name="frmXoa" method="post" action="">
        <h1>Quản lý góp ý</h1>
 
        <table id="tablesalomon" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Chọn</th>
                    <th><strong>Mã góp ý</strong></th>
                    <th><strong>Họ tên</strong></th>
                    <th><strong>Email</strong></th>
                    <th><strong>Điện thoại</strong></th>
                    <th><strong>Nội dung</strong></th>
                    <th><strong>Ngày góp ý</strong></th>
                    
                    <th><strong>Xóa</strong></th>
                </tr>
             </thead>

			<tbody>
            <?php
					
				$result = mysqli_query($conn, "SELECT gy_ma, gy_hoten, gy_email, gy_dienthoai, gy_noidung,gy_ngaygopy FROM gopy order by gy_ngaygopy");
				while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
			?>
			<tr>
              <td class="cotCheckBox"><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<?php echo $row['gy_ma'];?>" /></td>
              <td ><?php echo $row["gy_ma"] ?></td>
              <td><?php echo $row["gy_hoten"] ?></td>
              <td><?php echo $row["gy_email"] ?></td>
               <td ><?php echo $row["gy_dienthoai"] ?></td>
              <td><?php echo $row["gy_noidung"] ?></td>
              <td><?php echo $row["gy_ngaygopy"] ?></td>
              
              
             
             
             
              <td align='center' class='cotNutChucNang'>
              <a onclick="return deleteConfirm()" href="?khoatrang=quanly_gopy_hienthi&ma=<?php echo $row['gy_ma']?>"/>
              	<img src='images/delete.png' border='0' />
              </td>
            </tr>
            <?php
				}
				?>
			</tbody>
        
        </table>  
        <!--Nút Thêm mới , xóa tất cả-->
        <div class="row" style="background-color:#FFF"><!--Nút chức nang-->
            <div class="col-md-12">
            	<input type="submit" value="Xóa mục chọn" name="btnXoa" onclick="return deleteConfirm()" class="btn btn-primary"/>
            </div>
        </div><!--Nút chức nang-->

 </form>
<?php
}
else {
	echo '<meta  http-equiv="refresh" content="0;URL=?khoatrang=dangnhap"/>';
}
?>