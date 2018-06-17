<link rel="stylesheet" href="style.css" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
	<script src="js/jquery-3.2.0.min.js"/></script>
<?php

include_once('connection.php');
	if(isset($_GET["ma"])){
		$ma=$_GET['ma'];
		$sanpham=mysqli_query($conn, "select a.sp_ma, a.sp_ten, a.sp_gia, sp_giacu, sp_ngaycapnhat, sp_soluong, b.lsp_ten,c.thuonghieu_ten, sp_mota_ngan, sp_mota_chitiet,(select d.hsp_tentaptin from hinhsanpham d
		where d.sp_ma = a.sp_ma limit 0,1) as hsp_tentaptin from sanpham a join loaisanpham b on a.lsp_ma= b.lsp_ma join thuonghieu c on a.thuonghieu_ma=c.thuonghieu_ma where sp_ma=" . $ma) or die(mysqli_error($conn));
		while($row=mysqli_fetch_array($sanpham, MYSQLI_ASSOC)){
			$ten=$row['sp_ten'];
			$loai=$row['lsp_ten'];
			$thuonghieu=$row['thuonghieu_ten'];
			$gia=$row['sp_gia'];
			$giacu=$row['sp_giacu'];
			$motangan=$row['sp_mota_ngan'];
			$motachitiet=$row['sp_mota_chitiet'];
			$soluong=$row['sp_soluong'];
			$ngaydang=date_create($row['sp_ngaycapnhat']);
			if($row['hsp_tentaptin']!=""){
				$hinhlon=$row['hsp_tentaptin'];
			}
			else{
				$hinhlon="no_image.gif";
			}
		}
		$hinhs=mysqli_query($conn, "SELECT * FROM hinhsanpham WHERE sp_ma=".$ma);
		$hinh2s=mysqli_query($conn, "SELECT * FROM hinhsanpham WHERE sp_ma=".$ma);
		
	if(isset($_POST['txtDatHang'])){
		if(is_numeric($_POST['txtDatHang'])){
			$querysoluongconlai=mysqli_query($conn,"select sp_soluong from sanpham where sp_ma=".$ma);
			$soluongconlai=mysqli_fetch_row($querysoluongconlai);
			if($soluongconlai[0] >= $_POST['txtDatHang']){
				$coroi=false;
				foreach($_SESSION["giohang"] as $key =>$row){
					if($key==$ma){
						$_SESSION['giohang'][$key]["soluong"] +=$_POST['txtDatHang'];
						$coroi=true;
					}
				}
			if(!$coroi){
				$dathang = array(
				"ten"=>$ten,
				"gia"=>$gia,
				"soluong"=>$_POST['txtDatHang'],
				"hang"=>$thuonghieu);
				$_SESSION['giohang'][$ma]=$dathang;
			}
			echo "<script language='javascript'>
			alert('San pham da duoc them vao gio hang,truy cap gio hang de xem!');
			window.location=window.location;
			</script>";
			
		}
		else{
			echo "<script>alert('So luong ban dat vuot qua so luong trong kho.');</script>";
		}
	}
	else{
		echo "<script>alert('So luong khong hop le.');</script>";
		}
	
	}
}
	
?>

<link rel="stylesheet" href="scripts/x_slideshow/css/main.css" type="text/css">
<link rel="stylesheet" type="text/css" href="scripts/x_slideshow/css/jquery.lightbox-0.5.css" media="screen" />
<script type="text/javascript" src="scripts/x_slideshow/jquery.lightbox-0.5.js"></script>
<link rel="stylesheet" href="scripts/x_tab/general.css" type="text/css" media="screen" />
<script type="text/javascript" src="scripts/x_tab/jquery.idTabs.min.js"></script>

<script>
    
    var currentImage;
    var currentIndex = -1;
    var interval;
    function showImage(index){
		
        if(index < $('#bigPic img').length){
            var indexImage = $('#bigPic img')[index]
            if(currentImage){   
                if(currentImage != indexImage ){
                    $(currentImage).css('z-index',2);
                    clearTimeout(myTimer);
                    $(currentImage).fadeOut(250, function() {
                        myTimer = setTimeout("showNext()", 3000);
                        $(this).css({'display':'none','z-index':1})
                    });
                }
            }
            $(indexImage).css({'display':'block', 'opacity':1});
            currentImage = indexImage;
            currentIndex = index;
            $('#thumbs li').removeClass('active');
            $($('#thumbs li')[index]).addClass('active');
			
        }
    }
    
    function showNext(){
        var len = $('#bigPic img').length;
        var next = currentIndex < (len-1) ? currentIndex + 1 : 0;
        showImage(next);
    }
    
    var myTimer;
    
    $(document).ready(function() {
		
        myTimer = setTimeout("showNext()", 3000);
        showNext(); //loads first image
        $('#thumbs li').bind('click',function(e){
            var count = $(this).attr('rel');
            showImage(parseInt(count)-1);
        });
    });
</script> 

<h3>THÔNG TIN CHI TIẾT SẢN PHẨM</h3>
<div >
<div class="row" id='body'>
    <div  class="col-sm-3" align="center">
    	<div id="bigPic">
		<?php
			 //Hien thi hinh anh lon
			 while ($hinh=mysqli_fetch_array($hinhs, MYSQLI_ASSOC)){
			 echo"<a href='product-imgs/".$hinh['hsp_tentaptin']."'>
			      <img src='product-imgs/".$hinh['hsp_tentaptin']."'/></a>";
			 }
             
        ?>
         </div>                               
         
         <div >                           <ul id="thumbs" >
                                         <?php
                                       		//Hien thi hinh anh nho
											$i=1;
											while($hinh=mysqli_fetch_array($hinh2s, MYSQLI_ASSOC)){
												if($i==1){
													echo"<li rel='" .$i. "' class='active'>
													<img src=\"product-imgs/" ."small_"
													.$hinh['hsp_tentaptin'] . "\" /></li>";
												}
												else{
													echo "<li rel='" .$i. "'>
													<img src=\"product-imgs/" . "small_"
													.$hinh['hsp_tentaptin'] . "\" /></li>";
											}
											$i++;
											}
                                         ?>
                                       </ul> </div>
    </div>
    
    
    <div class="col-sm-5">
    <h2 style="color:#009" ><?php echo $ten; ?>			</h2>
                            <p><strong>Thương hiệu</strong>: <span><?php echo $thuonghieu; ?></span></p>
                                    <p><strong>Giá</strong>: <span class="Gia">
                                    <?php echo number_format($gia, 0, ',', '.'); ?></span> VND</p>
                                    <p><strong>Giá cũ</strong>: <span class="GiaCu">
                                    <?php echo number_format($giacu, 0, ',', '.'); ?></span> VND</p>
                                    <p><strong>Ngày cập nhật</strong>: 
                                    <?php echo date_format($ngaydang, "d/m/Y"); ?></p>
                                    <p><strong>Số lượng</strong>: <?php echo $soluong; ?></p>
                                    <p><strong>Loại sản phẩm</strong>: 
                                <span><?php echo $loai; ?></span></p>
                            <p>
                            
    <form name="frmDatHang" id="frmDatHang" method="post" action="">
        <input type="input" name="txtDatHang" id="txtDatHang" value="1" 
        size="3" style="text-align:center;" maxlength="3"/>
        <input type="image" src="images/datmua.gif" name="btnDatHang" id="btnDatHang"
        width="60" height="21" align="absmiddle">
    </form>
                      
        </p>                    
    </div>
    
    <div class="col-sm-4">
    	<p><strong>Mô tả</strong>: <?php echo $motangan; ?></p>
        <p><strong>Chi tiết</strong>:</p> <p><?php echo $motachitiet; ?></p>
    </div>

</div>
</div>


 <script>
                            $(function() {					
                                $('#bigPic a').lightBox(); 
											
                            });
                        </script>

