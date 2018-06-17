    <!-- Bootstrap --> 
    <link rel="stylesheet" type="text/css" href="style.css"/>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
    

        <form name="frmXoa" method="post" action="">
        <h1>Đơn đặt hàng</h1>
       
        <table id="tablesalomon" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
            <thead>
                <tr>
            		<th><strong>Số thứ tự</strong></th>
                    <th><strong>Sản phẩm đặt hàng</strong></th>
                    <th><strong>Mã đơn hàng</strong></th>
                     <th><strong>Số lượng</strong></th>
                    <th><strong>Đơn giá</strong></th>
                    <th><strong>Ngày đặt hàng</strong></th>
                    <th><strong>Trạng thái giao hàng</strong></th>
                    <th><strong>Trạng thái thanh toán</strong></th>
                </tr>
             </thead>

			<tbody>
<?php 
if(isset($_GET['mahang']) && isset($_GET['sdt'])){
		$ma = $_GET['mahang'];
		$sdt = $_GET['sdt'];
		$stt=1;
		$sqlu="select (select sp_ten from sanpham a where a.sp_ma=b.sp_ma) as sp, b.dh_ma, b.sp_dh_soluong, b.sp_dh_dongia,dh_ngaydathang,dh_trangthai,dh_trangthaithanhtoan from sanpham_dondathang b , dondathang c 
		where b.dh_ma='".$ma."' and c.dh_dienthoai='".$sdt."'";
		$result = mysqli_query($conn, $sqlu);
		while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
?>
			<tr>
              <td class="cotCheckBox"><?php echo $stt; ?></td>
              <td><?php echo $row["sp"] ?></td>
              <td><?php echo $row["dh_ma"] ?></td>
              <td><?php echo $row["sp_dh_soluong"] ?></td>
              <td><?php echo $row["sp_dh_dongia"] ?></td>
              <td><?php echo $row["dh_ngaydathang"] ?></td>
              <td><?php if($row["dh_trangthai"]=='0') echo "Đơn hàng đang được giao" ; 
			  			if($row["dh_trangthai"]=='1') echo "Đơn hàng sẽ giao trong vài giờ " ; 
						if($row["dh_trangthai"]=='2') echo "Đơn hàng đã được giao" ; 
			  		?>
              </td>
              <td><?php if($row["dh_trangthaithanhtoan"]=='0') echo "Chưa thanh toán";
			  			if($row["dh_trangthaithanhtoan"]=='1') echo "Đơn hàng đã được thanh toán" ;
				?>
               </td>
            </tr>
            <?php
				$stt++;
				}
			}
				?>
			</tbody>
        
        </table>  
        
 </form>
