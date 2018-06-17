<!-- Bootstrap --> 
<link rel="stylesheet" type="text/css" href="style.css"/>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<script language="javascript">
	function deleteConfirm(){
		if(confirm("Bạn có chắc chắn muốn xóa! ")){
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
	  if(isset($_GET["ma"]))
	  {
		  $maloai=$_GET["ma"];
		  mysqli_query($conn, "DELETE from loaisanpham where lsp_ma= $maloai" );
	  }
?> 
<form name="frmXoa" method="post" action="">
        <h1>Danh sách loại sản phẩm</h1>
        <p>
        <a href="index.php?khoatrang=quanly_loaisanpham_themmoi">
        <img src="images/add.png" alt="Thêm mới" width="16" height="16" border="0" /><a href="?khoatrang=quanly_loaisanpham_themmoi"> Thêm mới</a>
        </p>
        <table id="tablesalomon" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
                <tr>
                	<th>Chọn</th>
                    <th><strong>Số thứ tự</strong></th>
                    <th><strong>Tên loại sản phẩm</strong></th>
                     <th><strong>Mô tả</strong></th>
                    <th><strong>Cập nhật</strong></th>
                    <th><strong>Xóa</strong></th>
                </tr>
             </thead>

			<tbody>
            <?php
			
				$stt=1;
				$result = mysqli_query($conn, "SELECT * FROM loaisanpham");
				while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
				{
			?>
			<tr>
            <td class="cotCheckBox"><input name="checkbox[]" type="checkbox" id="checkbox[]" value="<?php echo $row['lsp_ma'];?>" /></td>
              <td class="cotCheckBox"><?php echo $stt; ?></td>
              <td><?php echo $row["lsp_ten"] ?></td>
              <td><?php //echo $row["lsp_mota"] ?></td>
             
              <td align='center' class='cotNutChucNang'>
              <a href="?khoatrang=quanly_loaisanpham_capnhat&ma=<?php echo $row['lsp_ma']; ?>">
              <img src='images/edit.png' border='0'  /></a></td>
              <td align='center' class='cotNutChucNang'>
              <a href="?khoatrang=quanly_loaisanpham&ma=<?php echo $row['lsp_ma']; ?>" onclick="return deleteConfirm()">
              <img src='images/delete.png' border='0' /></a></td>
            </tr>
            <?php
				$stt++;
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