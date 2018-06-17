
<?php ob_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Quản lý Beautifulshop</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
	  min-height:auto;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: auto;
	min-height:500px;}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
	</style>
</head>

<?php 
include_once('connection.php');
session_start();
	//datablas.net
?>
<body>
<div class="container-fluid col-lg-12">
	<div class="row">
		<nav class="navbar navbar-inverse">
  			<div class="container-fluid">
    			<div class="navbar-header">
     				 <a class="navbar-brand" href="addd.php">Trang chủ</a>
    			</div>
    			<ul class="nav navbar-nav">
      				<li class="dropdown">
        				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Sản phẩm
        					<span class="caret"></span></a>
        			<ul class="dropdown-menu">
                          <li><a href="addd.php?quyen=1&khoatrang=quanly_sanpham">Sản phẩm</a></li>
                          <li><a href="?khoatrang=quanly_loaisanpham">Loại sản phẩm</a></li>
                          <li><a href="?khoatrang=tonkho">Tồn kho</a></li>
        			</ul>
     	 			</li>
                      <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Đơn hàng
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="?khoatrang=quanly_donhang">Đơn hàng</a></li>
                        </ul>
                      </li>
                      <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Khách hàng
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="?khoatrang=quanly_khachhang">Thông tin khách hàng</a></li>
                        </ul>
                      </li>
                       <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Đối tác
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="?khoatrang=doitac">Thông tin đối tác</a></li>
                        </ul>
                      </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Góp ý
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="?khoatrang=quanly_gopy_hienthi">Thông tin góp ý</a></li>
                        </ul>
                      </li>
                       <li class="dropdown">
                       
                        <?php
								if(isset($_SESSION['quantri'])==1){
									
						?>
              				<a class="dropdown-toggle" href="?khoatrang=dangxuat">Đăng xuất</a>
              			 <?php
								}
								else
						{
						?>
						  <a class="dropdown-toggle" href="?khoatrang=dangnhap">Đăng nhập</a>
                       <?php }?>
                      </li>
    			</ul>
                
     		</div>
		</nav>
	</div>
</div>
      
<div class="container-fluid bg-info">
  <div class="row"> 
      <h3>Welcome  BeautifulShop</h3>
       <hr>
				   
				<?php
            if(isset($_GET['khoatrang']))
            {
                $khoatrang = $_GET['khoatrang'];
                if($khoatrang=="quanly_loaisanpham"){
                    include_once("quanly_loaisanpham.php");
                }
                if($khoatrang=="quanly_loaisanpham_themmoi"){
                    include_once("quanly_loaisanpham_themmoi.php");
                }
                elseif($khoatrang=="quanly_loaisanpham_capnhat"){
                    include_once("quanly_loaisanpham_capnhat.php");
                }
                elseif($khoatrang=="quanly_sanpham"){
                    include_once("quanly_sanpham.php");
                }
				if($khoatrang=="quanly_sanpham_themmoi"){
                    include_once("quanly_sanpham_themmoi.php");
				}
                elseif($khoatrang=="quanly_sanpham_capnhat"){
                    include_once("quanly_sanpham_capnhat.php");
                }
                elseif($khoatrang=="quanly_sanpham_hinhanh"){
                    include_once("quanly_sanpham_hinhanh.php");
                }
                elseif($khoatrang=="quanly_chitietsanpham"){
                    include_once("quanly_chitietsanpham.php");
                }
				 elseif($khoatrang=="tonkho"){
                    include_once("tonkho.php");
                }
				 elseif($khoatrang=="nhaphang"){
                    include_once("nhaphang.php");
                }
                elseif($khoatrang=="giohang"){
                    include_once("giohang.php");
                }
                elseif($khoatrang=="dangky"){
                    include_once("dangky.php");
                }
                elseif($khoatrang=="thanhtoan"){
                    include_once("thanhtoan.php");
                }
                elseif($khoatrang=="capnhatkhachhang"){
                    include_once("capnhatkhachhang.php");
                }
				elseif($khoatrang=="dangnhap"){
                    include_once("dangnhap_addd.php");
                }
                elseif($khoatrang=="gopy"){
                    include_once("phanhoi.php");
                }
				 elseif($khoatrang=="timkiem"){
                    include_once("timkiem.php");
                }
                elseif($khoatrang=="dangxuat"){
                    include_once("dangxuat_addd.php");
                }
                elseif($khoatrang=="danhsachsanpham"){
                    include_once("danhsachsanpham.php");
                }
                elseif($khoatrang=="kichhoat"){
                    include_once("kichhoat.php");
                }
				 elseif($khoatrang=="doitac"){
                    include_once("quanly_doitac.php");
                }
				elseif($khoatrang=="quanly_doitac_capnhat"){
                    include_once("quanly_doitac_capnhat.php");
                }
				if($khoatrang=="quanly_doitac_themmoi"){
                    include_once("quanly_doitac_themmoi.php");
				}
				elseif($khoatrang=="duyetdonhang"){
                    include_once("duyetdonhang.php");
                }
				elseif($khoatrang=="quanly_khachhang"){
                    include_once("quanly_khachhang.php");
                }
				elseif($khoatrang=="quanly_donhang"){
                    include_once("quanly_donhang.php");
                }
				elseif($khoatrang=="quanly_donhang_chitiet"){
                    include_once("quanly_donhang_chitiet.php");
                }
				elseif($khoatrang=="quanly_donhang_capnhat"){
                    include_once("quanly_donhang_capnhat.php");
                }
				elseif($khoatrang=="quanly_gopy_hienthi"){
                    include_once("quanly_gopy_hienthi.php");
                }
				elseif($khoatrang=="timkiemloai"){
                    include_once("timkiemloai.php");
                }
            }
           else 
		   	include_once('addd.php');
            ?>	
      <hr>
    </div>
</div>

<footer class="container-fluid text-center">
  <p align="center" align="justify">BeautifulShop</p>
</footer>

</body>
</html>
<?php ob_flush()?>