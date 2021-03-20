<?php
	include "conf/conn.php";
	$produk = mysqli_query($con, "select * from jenis_pakaian");	
	foreach ($produk as $k) {
			# code...
			echo $k['id'];		
		}	
?>