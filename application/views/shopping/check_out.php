<h2>Konfirmasi Check Out</h2>
<div class="kotak2">
<?php
$grand_total = 0;
if ($cart = $this->cart->contents())
	{
		foreach ($cart as $item)
			{
				$grand_total = $grand_total + $item['subtotal'];
			}
		echo "<h4>Total Belanja: Rp.".number_format($grand_total,0,",",".")."</h4>";	
?><hr>
<h4>Detail Customer</h4>
<form class="form-horizontal" action="<?php echo base_url()?>shopping/proses_order" method="post" name="frmCO" id="frmCO">
    <?php foreach($pelanggan as $p){?>
        <div class="form-group  has-success has-feedback">
            <label class="control-label col-xs-3" for="inputEmail">Nama Lengkap:</label>
            <div class="col-xs-9">
                <p class="form-control"><?php echo $p->nama_user ?></p>
                <input type="text" name="nama" value="<?php echo $p->nama_user ?>" hidden>
            </div>
        </div>
        <div class="form-group  has-success has-feedback">
            <label class="control-label col-xs-3" for="firstName">alamat :</label>
            <div class="col-xs-9">
                <p class="form-control"><?php echo $p->alamat ?></p>
            </div>
        </div>
        <div class="form-group  has-success has-feedback">
            <label class="control-label col-xs-3" for="lastName">No. HP:</label>
            <div class="col-xs-9">
                <p class="form-control"><?php echo $p->no_hp ?></p>
            </div>
        </div>
        <div class="form-group  has-success has-feedback">
            <label class="control-label col-xs-3" for="phoneNumber">Email:</label>
            <div class="col-xs-9">
                <p class="form-control"><?php echo $p->email ?></p>
            </div>
        </div>
        <?php } ?>
        <div class="form-group  has-success has-feedback">
            <div class="col-xs-offset-3 col-xs-9">
                <button type="submit" class="btn btn-primary">Bayar</button>
            </div>
        </div>
    </form>
    <?php
	}
	else
		{
			echo "<h5>Shopping Cart masih kosong</h5>";	
		}
	?>
</div>