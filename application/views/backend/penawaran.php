<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Online Shop</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url();?>/assets/backend/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url();?>/assets/backend/css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Notifikasi</div>
      <div class="card-body">
        <p><font color="red"><?php echo $this->session->userdata('login'); ?></font></p><br>
        <p>Apakah anda ingin mendapatkan notifikasi jika ada produk baru dari toko kami?</p>
        <button onclick="myFunction()" class="btn btn-success btn-block">IYA</button>
        <button onclick="tidak()" class="btn btn-danger btn-block">TIDAK</button>
      </div>
    </div>
  </div>
  <script>
  function myFunction() {
    window.open('https://t.me/elgns_bot', '_blank');
    location.replace("http://localhost/online_shop/user_login/");
  }
  function tidak(){
    location.replace("http://localhost/online_shop/user_login/");
  }
</script>
  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url();?>/assets/backend/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url();?>/assets/backend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url();?>/assets/backend/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
