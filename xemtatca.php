<link rel="stylesheet" href="style2.css" media="screen">
<?php
include_once("connection.php");

?>
<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
<div class="sanpham11">
	<ul>
    <?php
								$result = mysqli_query($conn, "SELECT a.*,(SELECT b.hsp_tentaptin FROM hinhsanpham b
								WHERE a.sp_ma = b.sp_ma LIMIT 0,1) as sp_hinhdaidien FROM sanpham a " );
								while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
								?>
                                <li><a href="?khoatrang=quanly_chitietsanpham&ma=<?php echo  $row['sp_ma'] ;?>"">
                                <img src="product-imgs/<?php echo  $row['sp_hinhdaidien'] ?>" title="product-imgs"  >
                                <h4><?php echo  $row['sp_ten']?></h4>
                                <?php echo  $row['sp_gia']?></ins> <del><?php echo  $row['sp_giacu']?></del>
                                </a></li>
                                <?php
								}
								?>
    </ul>
</div>
</div>
</div>
</div>