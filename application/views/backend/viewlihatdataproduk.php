<?php echo $this->load->view('backend/view_header', '', TRUE); ?>

<!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Data Table Example</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Id Produk</th>
                    <th>Nama Produk</th>
                    <th>Ukuran Produk</th>
                    <th>Stock produk</th>
                    <th>Berat Produk</th>
                    <th>Ket produk</th>
                    <th>Harga Produk</th>
                    <th>Foto Produk</th>
                    <th>Ubah</th>
                    <th>Hapus</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $j=0;
                      foreach($produk as $h){
                  ?>
                <tr>
                  <td><?php echo ++$j ?></td>
                  <td><?php echo $h->kode_produk; ?></td>
                  <td><?php echo $h->nama_produk; ?></td>
                  <td><?php echo $h->ukuran_produk; ?></td>
                  <td><?php echo $h->stock_produk; ?></td>
                  <td><?php echo $h->berat_produk; ?></td>
                  <td><?php echo $h->ket_produk; ?></td>
                  <td><?php echo $h->harga_produk; ?></td>
                  <td><img width="80%" src="<?php echo base_url(); ?>Foto/<?php echo $h->foto_produk; ?>" /></td>
                  <td><a href="<?php echo base_url() ?>admin/ubahdataproduk?id=<?php echo $h->id?>"><button class="btn btn-danger" type="button">Ubah</button></a></td>
                  <td><a href="<?php echo base_url() ?>admin/proseshapusproduk?id=<?php echo $h->id?>" onclick="return confirm('Yakin Hapus Data?')"><button class="btn btn-danger" type="button">Hapus</button></a></td>
                </tr>
        <?php
          }
        ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

      </div>
      <!-- /.container-fluid -->

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