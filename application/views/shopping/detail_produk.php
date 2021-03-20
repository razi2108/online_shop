<h2><?php echo $detail['nama_produk'];?></h2>
<form method="post" action="<?php echo base_url();?>shopping/tambah" method="post" accept-charset="utf-8">
<div class="kotak2">
<img class="img-responsive" src="<?php echo base_url() . 'foto/'.$detail['foto_produk']; ?>"/>
 <h5>Harga: Rp. <?php echo number_format($detail['harga_produk'],0,",",".");?></h5>
 <p class="card-text">
<strong> <u>Kategori</u></strong><br>
 <?php echo $detail['kategori'];?></p>
  <input type="hidden" name="id" value="<?php echo $detail['id']; ?>" />
  <input type="hidden" name="nama" value="<?php echo $detail['nama_produk']; ?>" />
  <input type="hidden" name="harga" value="<?php echo $detail['harga_produk']; ?>" />
  <input type="hidden" name="gambar" value="<?php echo $detail['foto_produk']; ?>" />
  <input type="hidden" name="qty" value="1" />
 <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-shopping-cart"></i> Beli Produk Ini</button>
 </div>
 </form>