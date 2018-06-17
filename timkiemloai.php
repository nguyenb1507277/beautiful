<!-- Bootstrap -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery-3.2.0.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<div class="container-fluid" style="margin-top:0px;">
<form name="frmXoa" method="get" action="" style="margin-top:0px;">
<script language="javascript">
	function timkiem(){
			loai_sp=document.getElementById('slLoaiSanPham').value;
			if(loai_sp==""){
				alert("Nhập từ khóa để tìm kiếm");
				}
		else
			window.location="?khoatrang=timkiemloai&loai_sp="+loai_sp;
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
if(isset($_GET['loai_sp'])){
	$ma = $_GET['loai_sp'];
?>
        <h1>Quản lý tồn kho</h1>

        	<div class="col-sm-2" style="text-align:right;">
            	<span>
                	<?php 
						$query="select lsp_ma, lsp_ten from loaisanpham";
						$kq =mysqli_query($conn, $query);
						echo "<select name='slLoaiSanPham' id='slLoaiSanPham' class='form-control'><option value='0'>Chọn loại sản phẩm</option>";
						while($row=mysqli_fetch_array($kq, MYSQLI_ASSOC)){
							echo "<option value='".$row['lsp_ma']."'> 
							<a href='?khoatrang=timkiem&loai_sp=<?php echo ".$row['lsp_ma']." ?>'>".$row['lsp_ten']."</a></option>";
							}
						echo "</select>";
					?>
                    
                </span>
                 
            </div>
            <div>
            	<span>
                	<button type="button" class="btn btn-default" id="btnSeach"  onclick="return timkiem()">
                  <span class="glyphicon glyphicon-search"></span>
                 </button>
                </span>
            </div>
            <br/>
        <br/>
        <table id="tablesalomon" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
                <tr>
                 	<th><strong>STT</strong></th>
                    <th><strong>Mã sản phẩm</strong></th>
                    <th><strong>Tên sản phẩm</strong></th>
                    <th><strong>Số lượng</strong></th>
                    <th><strong>Tổng tiền</strong></th>
                    <th><strong>Loại sản phẩm</strong></th>
                    <th><strong>Thương hiệu</strong></th>
					<th><strong>Thêm</strong></th>
                </tr>
             </thead>

			<tbody>
            <?php
					$stt=1;
				$result = mysqli_query($conn, 
				"SELECT sp_ma, sp_ten, sp_soluong, sp_gia, lsp_ten, thuonghieu_ten
				 FROM sanpham a JOIN loaisanpham b ON a.lsp_ma = b.lsp_ma JOIN thuonghieu c ON a.thuonghieu_ma = c.thuonghieu_ma where b.lsp_ma =".$ma." ORDER BY sp_ma ");
				while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
			?>
			<tr>
            	<td ><?php echo $stt ?></td>
              <td ><?php echo $row["sp_ma"] ?></td>
              <td><?php echo $row["sp_ten"] ?></td>
               <td ><?php echo $row["sp_soluong"] ?></td>
               <td ><?php echo $row["sp_soluong"]*$row['sp_gia'] ?></td>
              <td><?php echo $row["lsp_ten"] ?></td>
              <td><?php echo $row["thuonghieu_ten"] ?></td>
	
    		 <td align='center' class='cotNutChucNang'>
              <a href='?khoatrang=nhaphang&mah=<?php echo $row['sp_ma'];?>'">
             <img src='images/edit.png' border='0' /></a>
 
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
else 
echo '<meta http-equiv="refresh" content="0;URL=?khoatrang=tonkho"/>';
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
				echo "<script> alter('Upload thành công ... '); </script>";
				else 
				{
				echo "<script> alter('upload không thành công ... '); </script>";
				echo '<meta http-equiv="refresh" content="0; URL=?khoatrang=quanly_sanpham_hinhanh&mahinh='.$sp_ma.'"/>';
					}
			}
			else echo "Hình ảnh có kích thước quá lớn";
		}
		else echo "Hình không đúng định dạng";
	}
?>