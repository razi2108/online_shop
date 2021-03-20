<?php echo $this->load->view('backend/view_header', '', TRUE); ?>

        <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <form action="<?php echo base_url();?>/admin/prosesubahdetail_order" method="post" enctype="multipart/form-data">
                <?php foreach($detail_order as $h){ ?>
              <div>
                <label>Id Order</label>
                <p class="form-control"><?php echo $h->id_order ?></p>
                <input type="text" class="form-control" name="id" id="exampleInputEmail1" value="<?php echo $h->id_order ?>" hidden='TRUE'>
              </div>
              <!-- /.form-group -->
               <div class="form-group">
                <label>Nama Pelanggan</label>
                <input type="text" class="form-control" name="nama" id="exampleInputEmail1" value="<?php echo $h->nama_pelanggan ?>" >
              </div>
              <div class="form-group">
                <label>Produk Order</label>
                <input type="text" class="form-control" name="produk_order" id="exampleInputEmail1" value="<?php echo $h->produk_order ?>" >
              </div>
              <div class="form-group">
                <label>Qty</label>
                <input type="text" class="form-control" name="qty" id="exampleInputEmail1" value="<?php echo $h->qty ?>" >
              </div>
              <div class="form-group">
                <label>Harga Produk</label>
                <input type="text" class="form-control" name="harga" id="exampleInputEmail1"  value="<?php echo $h->harga ?>" >
              </div>
              <div class="form-group">
                <label>Tanggal Order</label>
                <input type="date" class="form-control" name="tanggal_order" id="exampleInputEmail1" value="<?php echo $h->tanggal_order ?>" >
              </div>
            <?php 
      }
        // echo form_close(); 
        ?>
              <!-- /.form-group -->
        <div class="form-group">
          <button class="btn btn-primary btn-block" type="submit">Simpan</button>
        </div>
      </form>

            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        
      </div>

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Your Website 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url();?>/assets/backend/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url();?>/assets/backend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url();?>/assets/backend/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="<?php echo base_url();?>/assets/backend/vendor/chart.js/Chart.min.js"></script>
  <script src="<?php echo base_url();?>/assets/backend/vendor/datatables/jquery.dataTables.js"></script>
  <script src="<?php echo base_url();?>/assets/backend/vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url();?>/assets/backend/js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="<?php echo base_url();?>/assets/backend/js/demo/datatables-demo.js"></script>
  <script src="<?php echo base_url();?>/assets/backend/js/demo/chart-area-demo.js"></script>

</body>

</html>
