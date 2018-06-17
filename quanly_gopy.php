<link rel="stylesheet" type="text/css" href="style.css"/>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/responsive.css">
<script src="js/jquery-3.2.0.min.js"/></script>
<script src="js/jquery.dataTables.min.js"/></script>
<script src="js/dataTables.bootstrap.min.js"/></script>
<script src="https://www.google.com/recaptcha/api.js?hl=vi"></script>
 <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript">
 var RecaptchaOptions = {
    theme : 'white'
 };
 </script>
<?php 
include_once('connection.php');
if(isset($_SESSION['quantri'])==1){
?>
<div class="container">
        <h2>Góp ý</h2>
			 	<form id="form1" name="form1" method="post" action="" class="form-horizontal" role="form">
					<div class="form-group">
						    
                            <label for="txtTen" class="col-sm-2 control-label">Họ tên(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtTen" id="txtTen" class="form-control" placeholder="Họ tên" value=""/>
							</div>
                      </div>  
                      
                       <div class="form-group">   
                            <label for="" class="col-sm-2 control-label">Email(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtEmail" id="txtEmail" class="form-control" placeholder="Email"/>
							</div>
                       </div>         
                       
                       <div class="form-group">                               
                            <label for="lblHoten" class="col-sm-2 control-label">Điện thoại(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtDienThoai" id="txtDienThoai" value="" class="form-control" placeholder="Điện thoại"/>
							</div>
                       </div> 
                       
                       
                       
                        <div class="form-group">   
                             <label for="lblDiaChi" class="col-sm-2 control-label">Địa chỉ(*):  </label>
							<div class="col-sm-10">
							      <input type="text" name="txtDiaChi" id="txtDiaChi" value="" class="form-control" placeholder="Địa chỉ"/>
							</div>
                        </div>  
                        
                          
                        
                        <div class="form-group">  
                            <label for="lblMoTaChiTiet" class="col-sm-2 control-label">Nội dung góp ý(*):  </label>
							<div class="col-sm-10">
							      <textarea name="txtNoiDung" rows="4" class="ckeditor"></textarea>
              <script language="javascript">
                                        CKEDITOR.replace( 'txtNoiDung',
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
						<div class="col-sm-offset-2 col-sm-10">
						      <input type="submit"  class="btn btn-primary" name="btnGopY" id="btnGopY" value="Góp ý"/>
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

<?php 
if(isset($_POST['btnGopY'])){
	$hoten = $_POST['txtTen'];
	$email = $_POST['txtEmail'];
	$dienthoai = $_POST['txtDienThoai'];
	$noidung = $_POST['txtNoiDung'];
	
	
	$loi ="";
	if($hoten=="" || $email=="" || $dienthoai=="" || $noidung=="" )
	$loi.="<li class=\"cssLoi\">Vui lòng không để trống bắt kỳ thông tin nào!</li>";
	if(strpos($email,'@')=== false)
		$loi.="<li class=\"cssLoi\">Email không hợp lệ</li>";
	if($loi!="")
		echo $loi;
	else {
		$sql="insert into gopy(gy_hoten,gy_email,gy_dienthoai,gy_noidung,gy_ngaygopy) values('".$hoten."','".$email."','".$dienthoai."','".$noidung."','".date("Y-m-d H:i:s")."')";
		$result=mysqli_query($conn,$sql);
			}
}
?>

