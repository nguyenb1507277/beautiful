    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
<?php 
include_once('connection.php');
if(isset($_SESSION['quantri'])==1){
?>
<?php 
function bindLSPList($conn){
	$sql = "select lsp_ma, lsp_ten from loaisanpham";
	$result = mysqli_query($conn, $sql);
	echo "<select name='slLoaiSanPham'>";
	echo "<option value='0'>Chọn loại sản phẩm</option>";
	while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
		echo "<option value='".$row['lsp_ma']."'>".$row['lsp_ten']."</option>";
		}
	echo "</select>";
	}
function bindTHList($conn){
	$sql = "select thuonghieu_ma, thuonghieu_ten from thuonghieu";
	$result = mysqli_query($conn, $sql);
	echo "<select name='slThuongHieu'>";
	echo "<option value='0'>Chọn Thương hiệu</option>";
	while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
		echo "<option value='".$row['thuonghieu_ma']."'>".$row['thuonghieu_ten']."</option>";
		}
	echo "</select>";
	}
?>
<?php
if(isset($_POST['btnThemMoi'])){
	$ten = $_POST['txtTen'];
	$motangan=$_POST['txtMoTaNgan'];
	$motachitiet=$_POST['txtMoTaChiTiet'];
	$gia=$_POST['txtGia'];
	$soluong=$_POST['txtSoLuong'];
	$loai=$_POST['slLoaiSanPham'];
	$thuonghieu=$_POST['slThuongHieu'];
	$loi="";
	if($ten=="")
		$loi.= "<li>Vui lòng nhập tên sản phẩm</li>";
	if(!is_numeric($gia))
		$loi.= "<li>Vui lòng nhập giá sản phẩm</li>";
	if(!is_numeric($soluong))
		$loi.= "<li>Vui lòng chọn số lượng sản phẩm</li>";
	if($loai=="0")
		$loi.= "<li>Vui lòng chọn loại sản phẩm</li>";
	if($thuonghieu=="0")
		$loi.= "<li>Vui lòng chọn nhà sản xuất</li>";
	if($loi!="")
		echo "<ul>$loi</ul>";
	else{
		$sqlstring = " insert into sanpham(sp_ten, sp_mota_ngan, sp_mota_chitiet, sp_gia, sp_soluong, lsp_ma, thuonghieu_ma, sp_ngaycapnhat) 
			values('".$ten."', '".$motangan."', '".$motachitiet."' , ".$soluong.", ".$gia.", ".$loai.", ".$thuonghieu.", '".date("Y-m-d H:i:s")."')";
		mysqli_query($conn, $sqlstring);
			echo '<meta http-equiv="refresh" content="0;URL=?khoatrang=quanly_sanpham"/>';
		}
	}
?>

<div class="container">
	<h2>Thêm sản phẩm</h2>

	 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
			<div class="form-group">
				<label for="txtTen" class="col-sm-2 control-label">Tên sản phẩm(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtTen" id="txtTen" class="form-control" placeholder="Tên loại sản phẩm" value=''/>
							</div>
                      </div>   
                      <div class="form-group">   
                             <label for="" class="col-sm-2 control-label">Loại sản phẩm(*):  </label>
							<div class="col-sm-10">
							      <?php bindLSPList($conn); ?>
							</div>
                       </div>
                        
                        <div class="form-group">   
                            <label for="" class="col-sm-2 control-label">Thương hiệu(*):  </label>
							<div class="col-sm-10">
							      <?php bindTHList($conn);  ?>
							</div>
                        </div>   
                          
                          <div class="form-group">  
                            <label for="lblGia" class="col-sm-2 control-label">Giá(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtGia" id="txtGia" class="form-control" placeholder="Giá" value=''/>
							</div>
                            </div>   
                            
                            <div class="form-group">   
                            <label for="lblMoTa_Ngan" class="col-sm-2 control-label">Mô tả ngắn(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtMoTaNgan" id="txtMoTaNgan" class="form-control" placeholder="Mô tả ngắn" value=''/>
							</div>
                            </div>
                            
                             <div class="form-group">  
                            <label for="lblMoTaChiTiet" class="col-sm-2 control-label">Mô tả chi tiết(*):  </label>
							<div class="col-sm-10">
							      <textarea name="txtMoTaChiTiet" rows="4" class="ckeditor"></textarea>
              <script language="javascript">
                                        CKEDITOR.replace( 'txtMoTaChiTiet',
                                        {
                                            skin : 'kama',
                                            extraPlugins : 'uicolor',
                                            uiColor: '#eeeeee',
                                            toolbar : [ ['Source','DocProps','-','Save','NewPage','Preview','-','Templates'],
                                                ['Cut','Copy','Paste','PasteText','PasteWord','-','Print','SpellCheck'],
                                                ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
                                                ['Form','Checkbox','Radio','TextField','Textarea','Select','Button','ImageButton','HiddenField'],
                                                ['Bold','Italic','Underline','StrikeThrough','-','Subscript','Superscript'],
                                                ['OrderedList','UnorderedList','-','Outdent','Indent','Blockquote'],
                                                ['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'],
                                                ['Link','Unlink','Anchor', 'NumberedList','BulletedList','-','Outdent','Indent'],
                                                ['Image','Flash','Table','Rule','Smiley','SpecialChar'],
                                                ['Style','FontFormat','FontName','FontSize'],
                                                ['TextColor','BGColor'],[ 'UIColor' ] ]
                                        });
										
                                    </script> 
                                  
							</div>
                        </div>
                            
                        <div class="form-group">  
                            <label for="lblSoLuong" class="col-sm-2 control-label">Số lượng(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtSoLuong" id="txtSoLuong" maxlength="10" class="form-control" placeholder="Số lượng" value=""/>
							</div>
                        </div>
 
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						      <input type="submit"  class="btn btn-primary" name="btnThemMoi" id="btnThemMoi" value="Thêm mới"/>
                              <input type="button" class="btn btn-primary" name="btnBoQua"  id="btnBoQua" value="Bỏ qua" onclick="window.location='?khoatrang=quanly_sanpham'" />
                              	
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
<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
