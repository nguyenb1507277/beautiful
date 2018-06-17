<?php ob_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Beautiful Online</title>
<!-- Latest compiled and minified CSS & JS -->
<link rel="stylesheet" href="css/bootstrap.min.css" media="screen">

<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/bootstrap.min.js" ></script> 


<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
    
    <!-- Tao menu cap -->
	<link href="csseshop/main.css" rel="stylesheet">
  
    
<!--datatable-->
	<script src="js/jquery-3.2.0.min.js"/></script>
    <script src="js/jquery.dataTables.min.js"/></script>
    <script src="js/dataTables.bootstrap.min.js"/></script>
    
 <script>
 function timsanpham(){
	 var tukhoa=document.getElementById('txtTuKhoa').value;
	 if(tukhoa=="")
	 {
		 alert("Nhập từ khóa để tìm kiếm");
		 return false;
	 }
	 else{
		 window.location="index.php?khoatrang=timsanpham&tukhoa="+tukhoa;
	 }
 }
 </script>
 <script language="javascript">
$(document).ready(function() {
    var table = $('#table').DataTable({
		responsive: true,
		"language":{
			
			"search": "Tìm kiếm",
			
			}
		});
		new $.fn.dataTable.FixedHeader(table);
});
</script>

   
</head>
<body>
  <?php
include_once("connection.php");
session_start();
if(!isset($_SESSION["giohang"])){
	$_SESSION["giohang"]=array();
}
?>

 <div class="container-fluid">
    <div class="row">
    	<div class="col-md-12">
      		<nav class="navbar navbar-default" role="navigation">
        		<div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          		<div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                    <a href="index.php" style="font-size: 28px;color: #060; text-decoration:none;">Beautiful Online<img src="images/logo1.png" alt="" width="200px" height="70px"></a>
         		</div>
      
          <!-- Collect the nav links, forms, and other content for toggling -->
          		<div class="collapse navbar-collapse navbar-ex1-collapse">
            		<ul class="nav navbar-nav navbar-right">
              			<li><a href="?khoatrang=giohang"><img src="images/icon_01.png">Giỏ hàng<span class="badge"><?php
								if((isset($_SESSION['giohang']))&& count($_SESSION['giohang'])>0) echo count($_SESSION['giohang']); else '';?></span></a></li> 
                                <?php
								if (isset($_SESSION['tendangnhap']) && $_SESSION['tendangnhap'] !=""){
								?>
                                <li ><a href="?khoatrang=doimatkhau"><img src="images/icon_02.png"><?php echo $_SESSION['tendangnhap']."<span class=\"glyphicon glyphicon-refresh\"></span>"?></a></li>
              			<li><a href="?khoatrang=dangxuat"><img src="images/icon_02.png">Đăng xuất</a></li>
              			 <?php
								}
								else
								{
											?>
						  <li><a href="?khoatrang=dangnhap"><img src="images/icon_02.png">Đăng nhập</a></li>
						  <li><a href="?khoatrang=dangky"><img src="images/icon_02.png">Đăng ký</a></li>
              			<?php
								}
									  ?>
                      <li><a href="?khoatrang=quanly_gopy"><img src="images/icon_03.png">Góp ý</a></li>
                    </ul>
           		</div><!-- /.navbar-collapse -->
  			</div><!-- /.container-fluid -->
		</nav>
    
      	<nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <ul class="nav navbar-nav">
              <li class="active"><a href="index.php">TRANG CHỦ</a></li>
              <li><a href="?khoatrang=giamgia">GIẢM GIÁ</a></li>
              <li><a href="?khoatrang=hangmoinhat">HÀNG MỚI NHẤT</a></li>
              <li><a href="?khoatrang=banchaynhat">SẢN PHẨM BÁN CHẠY</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="?khoatrang=kiemtradonhang">TRA CỨU ĐƠN HÀNG</a></li>
            </ul>
            <ul>
            <form class="navbar-form navbar-left" action="">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm bạn mong muốn" 
                name="txtTuKhoa" id="txtTuKhoa" size="40px">
                <div class="input-group-btn">
                  <button class="btn btn-default" type="button" onclick="timsanpham()">
                    <i class="glyphicon glyphicon-search"></i>
                  </button>
                </div>
              </div>
            </form>
           </ul>
  		</div>
	</nav>
</div>
 </div>
 </div>  
 
 <div class="container-fluid">
    <?php
		if(isset($_GET['khoatrang']))
		{
			$khoatrang = $_GET['khoatrang'];
			if($khoatrang=="giohang"){
				include_once("giohang.php");
			}elseif($khoatrang=="dangky"){
				include_once("dangky.php");
			}elseif($khoatrang=="dangnhap"){
				include_once("dangnhap_index.php");
			}elseif($khoatrang=="thanhtoan"){
				include_once("thanhtoan.php");
			}elseif($khoatrang=="quanly_loaisanpham_themmoi"){
				include_once("quanly_loaisanpham_themmoi.php");
			}elseif($khoatrang=="danhsachsanpham"){
				include_once("danhsachsanpham.php");
			}elseif($khoatrang=="dangxuat"){
				include_once("dangxuat_index.php");
			}elseif($khoatrang=="quanly_chitietsanpham"){
				include_once("quanly_chitietsanpham.php");
			}elseif($khoatrang=="thanhtoan"){
				include_once("thanhtoan.php");
			}elseif($khoatrang=="timkiem"){
				include_once("timkiem.php");
			}elseif($khoatrang=="timsanpham"){
				include_once("timsanpham.php");
			}elseif($khoatrang=="xemthem"){
				include_once("xemthem.php");
			}elseif($khoatrang=="banchaynhat"){
				include_once("banchaynhat.php");
			}elseif($khoatrang=="giamgia"){
				include_once("giamgia.php");
			}elseif($khoatrang=="hangmoinhat"){
				include_once("hangmoinhat.php");
			}elseif($khoatrang=="quanly_gopy"){
				include_once("quanly_gopy.php");
			}elseif($khoatrang=="kichhoat"){
				include_once("kichhoat.php");
			}elseif($khoatrang=="xemthem_thuonghieu"){
				include_once("xemthem_thuonghieu.php");
			}elseif($khoatrang=="quanly_thuonghieu"){
				include_once("quanly_thuonghieu.php");
			}elseif($khoatrang=="doimatkhau"){
				include_once("doimatkhau.php");
			}elseif($khoatrang=="kiemtradonhang"){
				include_once("kiemtradonhang.php");
			}
			elseif($khoatrang=="xemdonhang"){
				include_once("xemdonhang.php");
			}
			elseif($khoatrang=="cauhoi"){
				include_once("cauhoi.html");
			}
			elseif($khoatrang=="baomat"){
				include_once("baomat.html");
			}
			elseif($khoatrang=="tuyendung"){
				include_once("tuyendung.html");
			}
			elseif($khoatrang=="huongdan"){
				include_once("huongdan.html");
			}
			elseif($khoatrang=="phivanchuyen"){
				include_once("phivanchuyen.html");
			}
			elseif($khoatrang=="dieukhoan"){
				include_once("dieukhoan.html");
			}
			elseif($khoatrang=="huongdan"){
				include_once("huongdan.html");
			}
			elseif($khoatrang=="doitra"){
				include_once("doitra.html");
			}
			elseif($khoatrang=="gioithieu"){
				include_once("gioithieu.html");
			}
			elseif($khoatrang=="quenmatkhau"){
				include_once("quenmatkhau.php");
			}
			elseif($khoatrang=="quanly_thongtincanhan"){
				include_once("quanly_thongtincanhan.php");
			}
			elseif($khoatrang=="dangnhap_change"){
				include_once("dangnhap_change.php");
			}
			
			
		}
		else{
			include_once("noidungtrangchu.php");
		}
	?>
 </div>
    
<div class="" style="width:98%; padding-left:2%;">
	<div class="row" style="background-color:#CCC">
 		<div class="container-fluid bg-3 text-center">    
 	    	<div class="row" style="margin-top:20px;">
            
    			<div class="col-sm-3">
      				<h4> Cập nhật thông tin khuyến mãi</h4>
      				<p>
      				<form class="navbar-form navbar-left" method="post" action="#">
                  	<div class="form-group">
                    <input type="email" class="form-control" placeholder="Nhập địa chỉ email" name="txtEmail">
                  	</div>
      				<button type="submit" name="btnDangKy_Email" class="btn btn-default">Đăng ký</button>
    				</form><br>Đăng ký nhận tin từ BeautifulOnline.vn,<br>cơ hội nhận quyền lợi giảm giá riêng biệt.<br>
       				</p>
                    
                    <?php 
					include_once('connection.php');
					if(isset($_POST['btnDangKy_Email'])){
						$e=$_POST['txtEmail'];
						$sql_tim="select * from nhantinkhuyenmai where n_email='".$e."'";
						$exell = mysqli_query($conn, $sql_tim);
						if(mysqli_num_rows($exell)>0){
							}
						else 
						{
							$sql = "insert into nhantinkhuyenmai(n_email) values('".$e."');";
							$result = mysqli_query($conn, $sql) or die (mysqli_error($sql));
							}
						echo "<script>alert('Đăng ký nhận tin khuyến mãi thành công!');</script>";
						}
					?>
    			</div>
    			<div class="col-sm-3"> 
      				<h4>HỖ TRỢ KHÁCH HÀNG</h4>
     				<p>
                	<strong>Hotline: 1900636 900</strong><br>
                	(8-21h kể cả T7,CN)<br>
                	<a href="?khoatrang=cauhoi">Các câu hỏi thường gặp</a><br>
                	<a href="?khoatrang=huongdan">Hướng dẫn đặt hàng online<a><br>
                	<a href="?khoatrang=phivanchuyen">Phí vận chuyển</a><br>
                	<a href="?khoatrang=doitra">Chính sách đổi tra</a><br>
            		</p>
    			</div>
    			<div class="col-sm-3" align="center"> 
     	 			<h4>VỀ BEAUTIFUL ONLINE</h4>
      				<p>
            		<a href="?khoatrang=gioithieu">Giới thiệu BeautifulOnline.vn</a><br>
            		<a href="?khoatrang=tuyendung">Tuyển dụng</a><br>
            		<a href="?khoatrang=baomat">Chính sách bảo mật</a><br>
            		<a href="?khoatrang=dieukhoan">Điều khoản sử dụng</a><br>
            		<a href="?khoatrang=quanly_gopy">Liên hệ</a><br>
            		</p>   
      				
    			</div>
    			<div class="col-sm-3">
      				<h4>TÀI KHOẢN CỦA BẠN</h4>
     				<p>
     				<a href="?khoatrang=dangnhap">Đăng nhập</a><br>
            		<a href="?khoatrang=dangky">Đăng ký</a><br>
                    <a href="?khoatrang=doimatkhau">Đổi mật khẩu</a><br>
                    <a href="?khoatrang=dangnhap_change">Thay đổi thông tin cá nhân</a>
     				</p>
  				</div>
                
  			</div>
		</div>
	</div> 
 
   
    
  <!-- Latest jQuery form server -->
    <script src="https://code.jquery.com/jquery.min.js"></script>
    
    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    
    <!-- jQuery sticky menu -->
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    
    <!-- jQuery easing -->
    <script src="js/jquery.easing.1.3.min.js"></script>
    
    <!-- Main Script -->
    <script src="js/main.js"></script>
    
    <!-- Slider -->
    <script type="text/javascript" src="js/bxslider.min.js"></script>
	<script type="text/javascript" src="js/script.slider.js"></script>
    
    <!--data table - dat dung vi tri nay-->
    <script src="js/jquery.dataTables.min.js"/></script>
    <script src="js/dataTables.bootstrap.min.js"/></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.bootstrap.min.css"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css"></script>
       
    
 
    
   
</body>
</html>
<?php ob_flush()?>