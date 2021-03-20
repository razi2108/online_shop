<h2>Upload Bukti Pembayaran</h2><br>
<!-- <div class="kotak2"> -->
	<form action="<?php echo base_url() ?>/shopping/upload_bukti_aksi" method="post" enctype="multipart/form-data">
			<div class="col-md-12">
				<div class="col-md-4">
					<label>Upload Bukti Pembayaran</label>
				</div>	
				<div class="col-md-8">
					<input type="file" class="form-control" name="file">
				</div><hr>
				<div class="col-md-4">
					<label>Keterangan*</label>
				</div>	
				<div class="col-md-8">
					<input type="text" class="form-control" name="ket" placeholder="Keterangan wajib di isi" required="">
				</div>
				<div class="col-md-12">
					<br>
					<center><input type="submit" class="btn btn-sm btn-primary" value="Upload" name="upload"></center><br>
					<?php echo $this->session->userdata('hasil_upload'); ?>
				</div>
			</div>
			
		</form>
<!-- </div> -->