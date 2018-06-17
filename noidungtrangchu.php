

<script>
 function timkiem(){
	 ///	 var tukhoa=document.getElementById("txtTuTim").value;
	 var thuonghieu=document.getElementById("slThuongHieu").value;
	 var lsp=document.getElementById('slLoaiSanPham').value;
	 var giatu=document.getElementById('slGiaTu').value;
	 var giaden=document.getElementById('slGiaDen').value;

		 window.location="index.php?khoatrang=timkiem&hang="+thuonghieu+"&lsp="+lsp+"&giatu="+giatu+"&giaden="+giaden;
 }
 
 </script>
<meta charset="UTF-8"> 
 <!-- Creat banner -->
 <?php
include_once("connection.php");

	function dathang($ma,$conn)
	{
			$ma = $_GET["ma"];
			$resultsql = mysqli_query($conn, "SELECT a.*, b.thuonghieu_ten FROM sanpham a, thuonghieu b
									WHERE sp_ma = ".$ma);
			$rowsql = mysqli_fetch_row($resultsql);
			if($rowsql[0] >= 1)
			{
				$coroi = false;
				foreach ($_SESSION["giohang"] as $key => $row) 
				{
					if($key==$ma)
					{
						$_SESSION['giohang'][$key]["soluong"] +=  1;
						$coroi = true;
					}
				}
				
				if(!$coroi)
				{
					$ten = $rowsql[1];
					$gia = $rowsql[2];
					$thuonghieu = $rowsql[11];
					
					$dathang = array(
					"ten" => $ten,
					"gia" => $gia,
					"soluong" =>1,
					"hang" => $thuonghieu);
					$_SESSION['giohang'][$ma]=$dathang;
				}
				echo "<script language='javascript'>
				alert('Sản phẩm đã được thêm vào giỏ hàng, truy cập giỏ hàng để xem!'); 
				</script>";
			}
			else
			{
				echo "<script>alert('Số lượng bạn đặt vượt quá số lượng trong kho.');</script>";
			}
	}
	
	if(isset($_GET['func'])&isset($_GET['ma']))
	{
		$ma = $_GET['ma'];
		dathang($ma,$conn);
	}

 ?>
<div class="container-fluid">
<div class="col-lg-12">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img  src="images/bannera.jpg" alt="" width="100%" height="700">   
      </div>

      <div class="item">
        <img src="images/bannerb.jpg" alt="" width="100%" height="700">
      </div>
    
      <div class="item">
        <img src="images/bannerc.jpg" alt="" width="100%" height="700">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
</div>
</div>

<!--Tim kiem-->
<div class="maincontent-area">
	<div>
       <form id="form1" name="form1" method="POST" action="">
          <div class="form-group">
        
               <div class="col-sm-3">
                	<span class="input-group-btn">
					<?php
                        $query = "select thuonghieu_ma, thuonghieu_ten from thuonghieu";
                        $result = mysqli_query($conn,$query);
                        echo "<select name='slThuongHieu' id='slThuongHieu' class='form-control'>
                                <option value='0'>Tất cả thương hiệu</option>";
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            echo "<option value='" . $row['thuonghieu_ma'] . "'>" . $row['thuonghieu_ten'] . "</option>";
                        }
                        echo "</select>";
                    ?>
                     </span>
                </div>
                <div class="col-sm-3">
                	<span class="input-group-btn">
                	<?php
						$query = "select lsp_ma, lsp_ten from loaisanpham";
						$result = mysqli_query($conn,$query);
						echo "<select name='slLoaiSanPham' id='slLoaiSanPham' class='form-control'>
								<option value='0'>Tất cả loại sản phẩm</option>";
						while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						echo "<option value='" . $row['lsp_ma'] . "'>" . $row['lsp_ten'] . "</option>";
						}
						echo "</select>";
					?>
                	</span>
                </div>
          		<div class="col-sm-2">
         			<span class="input-group-btn">
        				<select name="slGiaTu" id="slGiaTu" class='form-control'>
                          <option value="1">Giá từ</option>
                          <option value="1000000">1.000.000</option>
                          <option value="3000000">3.000.000</option>
                          <option value="8000000">8.000.000</option>
                        </select>
                    </span>
        		</div>
                <div class="col-sm-2">
                	<span class="input-group-btn">
                		<select name="slGiaDen" id="slGiaDen" class='form-control'>
                          <option value="20000000">Giá đến</option>
                          <option value="3000000">3.000.000</option>
                          <option value="8000000">8.000.000</option>
                          <option value="20000000">20.000.000</option>
                        </select>
                	</span>
                </div>
        		<div class="form-group">
					<div class="col-sm-2">
						<input name="btnSearch" type="button" class="btnSearch" id="btnSearch" value="Tìm kiếm" onclick="timkiem();"/>    	
					</div>
				</div>
       	</div>
      </form>
   </div> <!--Ket thuc tim kiem-->
</div>
   <?php
include_once("connection.php");
$sql="select * from loaisanpham ";
$result=mysqli_query($conn,$sql);
?>
    
<div class="container-fluid col-sm-12 " style="margin-top:20px;">
  <div class="panel-group">
    <div class="panel panel-default">
    
      <div class="panel-heading"  style="text-align:justify; text-align:left;"><span>SALE ĐANG DIỄN RA</span>
      <span style="padding-left:80%; " ><a href="?khoatrang=giamgia"><button type="button" class="btn btn-default">Xem thêm</button></a></span>
      </div>
      <div class="panel-body">
      
      	<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<div class="latest-product">
									<div class="product-carousel">
                                        <!--Load san pham tu DB -->
                                           <?php
                                            	$result = mysqli_query($conn, "SELECT a.*,(SELECT b.hsp_tentaptin FROM hinhsanpham b WHERE a.sp_ma = b.sp_ma LIMIT 0,1) as sp_hinhdaidien FROM sanpham a" );
			
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                            ?>
                                        <!--Một sản phẩm -->
										<div class="single-product">
											<div class="product-f-image">
												<img src="product-imgs/<?php echo  $row['sp_hinhdaidien'] ?>" title="product-imgs"  >
                                                    <div class="product-hover">
                                                        <a href="?func=dathang&ma=<?php echo  $row['sp_ma'] ?>" class="add-to-cart-link" >
                                                        <i class="fa fa-shopping-cart"></i> Add to cart</a>
                                                        <a href="?khoatrang=quanly_chitietsanpham&ma=<?php echo  $row['sp_ma'] ?>" class="view-details-link">
                                                        <i class="fa fa-link"></i> See details</a>
                                                    </div>
											</div>
                                                <h2><a href="?khoatrang=quanly_chitietsanpham&ma=<?php echo  $row['sp_ma']?>"><?php echo  $row['sp_ten']?></a></h2>
											<div class="product-carousel-price">
                                                    <ins><?php echo  $row['sp_gia']?></ins> <del><?php echo  $row['sp_giacu']?></del>
                                            </div> 
										</div>
										<?php
											}
                                        ?>
                                        <!-- open product-carousel-->
									</div>
								</div>
							</div>
						</div>
					</div>
      			</div>
    </div>
    </div>

    <div class="panel panel-primary">
      <div class="panel-heading" style="text-align:justify">
      <span>THƯƠNG HIỆU NỔI BẬT</span>
      <span style="padding-left:78%; " ><a href="?khoatrang=xemthem_thuonghieu"><button type="button" class="btn btn-default">Xem thêm</button></a></span>
      </div>
      <div class="panel-body">
      
      				<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<div class="latest-product">
									<div class="product-carousel">
                                        <!--Load san pham tu DB -->
                                           <?php
                              $result = mysqli_query($conn, "SELECT a.hth_tentaptin,b.thuonghieu_ma FROM hinhthuonghieu a,thuonghieu b WHERE a.thuonghieu_ma=b.thuonghieu_ma" );
			
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                            ?>
                                        <!--Một sản phẩm -->
										<div class="single-product">
											<div class="product-f-image">
                                            <a href="./?khoatrang=quanly_thuonghieu&ma=<?php echo  $row['thuonghieu_ma'] ;?>">
												<img src="img/<?php echo  $row['hth_tentaptin'] ?>" title="img"  />
                                                </a>
											</div>
										</div>
										<?php
											}
                                        ?>
                                        <!-- open product-carousel-->
									</div>
								</div>
							</div>
						</div>
					</div>
	
      </div>
    </div>
 <?php

$sql="select * from loaisanpham where lsp_ma=9";
$result=mysqli_query($conn,$sql);
$cot1 = mysqli_fetch_array($result, MYSQLI_ASSOC)
?>
<div class="panel panel-info">
   <div class="panel-heading"  style="text-align:justify; text-align:left;"><span>TRANG ĐIỂM</span>
      <span style="padding-left:84%; " ><a href="?khoatrang=xemthem&ma=<?php echo $cot1['lsp_ma'];?>"><button type="button" class="btn btn-default">
      Xem thêm</button></a></span>
	</div>
		<div class="panel-body">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="latest-product">
							<div class="product-carousel">
                                        <!--Load san pham tu DB -->
							<?php
								$result = mysqli_query($conn, "SELECT a.*,(SELECT b.hsp_tentaptin FROM hinhsanpham b
								WHERE a.sp_ma = b.sp_ma LIMIT 0,1) as sp_hinhdaidien FROM sanpham a where lsp_ma=9" );
								while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
								?>
                                        <!--Một sản phẩm -->
							<div class="single-product">
							<div class="product-f-image">
							<img src="product-imgs/<?php echo  $row['sp_hinhdaidien'] ?>" title="product-imgs"  >
							<div class="product-hover">
								<a href="?func=dathang&ma=<?php echo  $row['sp_ma'] ?>" class="add-to-cart-link" >
								<i class="fa fa-shopping-cart"></i> Add to cart</a>
                                <a href="?khoatrang=quanly_chitietsanpham&ma=<?php echo  $row['sp_ma'] ?>" class="view-details-link">
                                <i class="fa fa-link"></i> See details</a>
                            <!--end hover-->
                            </div>
                            <!--end f-image-->
							</div>
							<h2><a href="?khoatrang=quanly_chitietsanpham&ma=<?php echo  $row['sp_ma']?>"><?php echo  $row['sp_ten']?></a></h2>
							<div class="product-carousel-price">
								<ins><?php echo  $row['sp_gia']?></ins> <del><?php echo  $row['sp_giacu']?></del>
                             <!--end product-carousel-price-->
							</div> 
                            <!--end single-product-->
							</div>
							<?php
								}
							?>
  						<!-- open product-carousel-->
									</div>
                         <!--end lastest-->
								</div>
                          <!--end clo-md-12-->
							</div>
                           <!--end row-->
						</div>
                       <!--end container-f-->
					</div>
                  <!--end panel-body-->
      			</div>
            <!--end info-->
      </div>
 <?php
$sql="select * from loaisanpham where lsp_ma=10";
$result=mysqli_query($conn,$sql);
$cot2 = mysqli_fetch_array($result, MYSQLI_ASSOC)
?>
<div class="panel panel-success">
	<div class="panel-heading"  style="text-align:justify; text-align:left;"><span>CHĂM SÓC DA MẶT</span>
		<span style="padding-left:80%; " ><a href="?khoatrang=xemthem&ma=<?php echo $cot2['lsp_ma'];?>"><button type="button" class="btn btn-default">
        Xem thêm</button></a></span>
	</div>
		<div class="panel-body">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="latest-product">
							<div class="product-carousel">
                                        <!--Load san pham tu DB -->
							<?php
                            $result = mysqli_query($conn, "SELECT a.*,(SELECT b.hsp_tentaptin FROM hinhsanpham b 
							WHERE a.sp_ma = b.sp_ma LIMIT 0,1) as sp_hinhdaidien FROM sanpham a where lsp_ma=10" );
							while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                            ?>                                        
                            <!--Một sản phẩm -->
							<div class="single-product">
							<div class="product-f-image">
							<img src="product-imgs/<?php echo  $row['sp_hinhdaidien'] ?>" title="product-imgs"  >
							<div class="product-hover">
								<a href="?func=dathang&ma=<?php echo  $row['sp_ma'] ?>" class="add-to-cart-link" >
								<i class="fa fa-shopping-cart"></i> Add to cart</a>
                                <a href="?khoatrang=quanly_chitietsanpham&ma=<?php echo  $row['sp_ma'] ?>" class="view-details-link">
                                <i class="fa fa-link"></i> See details</a>
                            <!--end hover-->
                            </div>
                            <!--end f-image-->
							</div>
							<h2><a href="?khoatrang=quanly_chitietsanpham&ma=<?php echo  $row['sp_ma']?>"><?php echo  $row['sp_ten']?></a></h2>
							<div class="product-carousel-price">
								<ins><?php echo  $row['sp_gia']?></ins> <del><?php echo  $row['sp_giacu']?></del>
                             <!--end product-carousel-price-->
							</div> 
                            <!--end single-product-->
							</div>
							<?php
								}
							?>
  						<!-- open product-carousel-->
									</div>
                         <!--end lastest-->
								</div>
                          <!--end clo-md-12-->
							</div>
                           <!--end row-->
						</div>
                       <!--end container-f-->
					</div>
                  <!--end panel-body-->
      			</div>
            <!--end info-->
      </div>
 <?php

$sql="select * from loaisanpham where lsp_ma=11";
$result=mysqli_query($conn,$sql);
$cot2 = mysqli_fetch_array($result, MYSQLI_ASSOC)
?>
<div class="panel panel-danger">
      <div class="panel-heading"  style="text-align:justify; text-align:left;"><span>CHĂM SÓC CƠ THỂ</span>
      <span style="padding-left:80%; " ><a href="?khoatrang=xemthem&ma=<?php echo $cot2['lsp_ma'];?>"><button type="button" class="btn btn-default">
      Xem thêm</button></a></span>
	</div>
		<div class="panel-body">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="latest-product">
							<div class="product-carousel">
                                        <!--Load san pham tu DB -->
							<?php
								$result = mysqli_query($conn, "SELECT a.*,(SELECT b.hsp_tentaptin FROM hinhsanpham b
								WHERE a.sp_ma = b.sp_ma LIMIT 0,1) as sp_hinhdaidien FROM sanpham a where lsp_ma=11" );
								while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
								?>
                                        <!--Một sản phẩm -->
							<div class="single-product">
							<div class="product-f-image">
							<img src="product-imgs/<?php echo  $row['sp_hinhdaidien'] ?>" title="product-imgs"  >
							<div class="product-hover">
								<a href="?func=dathang&ma=<?php echo  $row['sp_ma'] ?>" class="add-to-cart-link" >
								<i class="fa fa-shopping-cart"></i> Add to cart</a>
                                <a href="?khoatrang=quanly_chitietsanpham&ma=<?php echo  $row['sp_ma'] ?>" class="view-details-link">
                                <i class="fa fa-link"></i> See details</a>
                            <!--end hover-->
                            </div>
                            <!--end f-image-->
							</div>
							<h2><a href="?khoatrang=quanly_chitietsanpham&ma=<?php echo  $row['sp_ma']?> "><?php echo  $row['sp_ten']?></a></h2>
							<div class="product-carousel-price">
								<ins><?php echo  $row['sp_gia']?></ins> <del><?php echo  $row['sp_giacu']?></del>
                             <!--end product-carousel-price-->
							</div> 
                            <!--end single-product-->
							</div>
							<?php
								}
							?>
  						<!-- open product-carousel-->
									</div>
                         <!--end lastest-->
								</div>
                          <!--end clo-md-12-->
							</div>
                           <!--end row-->
						</div>
                       <!--end container-f-->
					</div>
                  <!--end panel-body-->
      			</div>
            <!--end info-->
      </div>


  </div>
</div> 
    
    
    

