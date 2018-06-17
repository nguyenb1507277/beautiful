<!-- Bootstrap -->
<link rel="stylesheet" href="css/bootstrap.min.css">

 <?php 
 include_once('connection.php');
	if(isset($_GET['mah'])){
		$ma = $_GET['mah'];
		$sqlu="select b.sp_ten,a.thuonghieu_ten, b.sp_gia, sp_soluong, b.lsp_ma, a.thuonghieu_ma
				 from thuonghieu a, sanpham b
				where a.thuonghieu_ma = b.thuonghieu_ma and b.sp_ma ='$ma'";
		$result = mysqli_query($conn, $sqlu);
		$row = mysqli_fetch_row($result);
		$ten = $row[0];
		$gia=$row[2];
		$soluong = $row[3];
		$loai=$row[4];
		$thuonghieu=$row[1];
		$thuonghieu_ma=$row[5];
		
		}
	else
		echo '<meta http-equiv="refresh" content="0; URL=?khoatrang=tonkho"/>';
?>

<?php 

function bindTHList($conn, $selectedValue){
	$sql = "select distinct b.thuonghieu_ten from sanpham a, thuonghieu b where a.thuonghieu_ma=b.thuonghieu_ma
					and a.thuonghieu_ma=".$selectedValue;
	$result = mysqli_query($conn, $sql);
	echo "<select name='slThuongHieu'>";
	echo "<option value='0'>Chọn thương hiệu</option>";
	while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
		if($row==$selectedValue)
			echo "<option value='".$row['thuonghieu_ma']."' selected>".$row['thuonghieu_ten']."</option>";
		else
			echo "<option value='".$row['thuonghieu_ma']."'>".$row['thuonghieu_ten']."</option>";
		}
	echo "</select>";
	}

?>
<script language="javascript">
	function themhangConfirm(){
		if(confirm("Bạn có chắc chắn thêm sản phẩm này không!")){
			return true;
			}
		else
			return false;
		}
</script>



<script language="javascript">
      function trove(){
          history.back();
      }
</script>
<div class="container">
	<h2>Thêm số lượng cho sản phẩm</h2>
			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
					<div class="form-group">
                            <label for="txtTen" class="col-sm-2 control-label">Tên sản phẩm(*):  </label>
							<div class="col-sm-10 col-lg-10">
							      <input type="text" name="txtTen" id="txtTen" class="form-control" placeholder="Tên sản phẩm" value='<?php echo $ten ?>'/>
							</div>
                      </div>   
      
                        <div class="form-group">   
                            <label for="" class="col-sm-2 control-label">Thương hiệu(*):  </label>
							<div class="col-sm-10 col-lg-10">
							      <?php bindTHList($conn, $thuonghieu_ma); ?>
							</div>
                          </div>   
                          
                          <div class="form-group">  
                            <label for="lblGia" class="col-sm-2 control-label">Giá/sảnphẩm(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtGia" id="txtGia" class="form-control" placeholder="Giá" value='<?php echo $gia; ?>'/>
							</div>
                            </div>   
                            

                           
                            <div class="form-group">  
                            <label for="lblSoLuong" class="col-sm-2 control-label">Số lượng(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtSoLuong" id="txtSoLuong" maxlength="10" id="txtGia" class="form-control" 
                                  placeholder="Số lượng" value=''/>
							</div>
                            </div>
                            
                            
                            
					
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						      <input type="submit"  class="btn btn-primary" name="btnDatHang" id="btnDatHang" value="Đặt Hàng" onclick="return themhangConfirm()"/>
                              <input type="button" class="btn btn-primary" name="btnTroVe"  id="btnTroVe" value="Trở về" onclick="trove()" />
                              	
						</div>
					</div>
				</form>
		</div>

<a onclick="b"> </a>
<?php
if(isset($_POST['btnDatHang'])){
	$ten = $_POST['txtTen'];
	$gia=$_POST['txtGia'];
	$soluong=$_POST['txtSoLuong'];
	$thuonghieu=$_POST['slThuongHieu'];
	$loi="";
	if($ten=="")
		$loi.= "<li>Vui lòng nhập tên sản phẩm</li>";
	if(!is_numeric($gia))
		$loi.= "<li>Vui lòng nhập giá sản phẩm</li>";
	if(!is_numeric($soluong))
		$loi.= "<li>Vui lòng chọn số lượng sản phẩm</li>";
	if($thuonghieu=="0")
		$loi.= "<li>Vui lòng chọn nhà sản xuất</li>";
	if($loi!="")
		echo "<ul>$loi</ul>";
	else{
		$load="update sanpham set sp_soluong=sp_soluong+$soluong where sp_ma=$ma";
			mysqli_query($conn, $load);
			echo "<script>alert('Đã thêm ".$soluong." sản phẩm');</script>";
			echo '<meta http-equiv="refresh" content="0;URL=?khoatrang=tonkho"/>';
		}
	}
?>
<?php 
