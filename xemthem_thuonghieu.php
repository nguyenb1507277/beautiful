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
							$result = mysqli_query($conn,"SELECT a.hth_tentaptin,b.thuonghieu_ma FROM hinhthuonghieu a,thuonghieu b WHERE a.thuonghieu_ma=b.thuonghieu_ma" );
							while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
						?>
                                <li><a href="./?khoatrang=quanly_thuonghieu&ma=<?php echo  $row['thuonghieu_ma'] ;?>">
                                <img src="img/<?php echo  $row['hth_tentaptin'] ?>" title="img"  />
          						</a></li>
						<?php
                        }
                        ?>
    				</ul>
				</div>
			</div>
		</div>
	</div>