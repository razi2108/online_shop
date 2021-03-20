<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url();?>/assets/backend/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url();?>/assets/backend/css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Register</div>
      
      <div class="card-body">
        <center><p><font color="red"><?php echo $this->session->userdata('login'); ?></font></p></center>
        <form action="<?php echo base_url('user_login/reg_aksi');?>" method="POST">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="inputEmail" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap" required="required">
              <label for="inputEmail">Nama Lengkap</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="inputuser" name="username" class="form-control" placeholder="Username" required="required">
              <label for="inputuser">Username</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="required">
              <label for="password">Password</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="confirm_password" name="password2" class="form-control" placeholder="Confirm Password" required="required">
              <label for="confirm_password">Confirm Password</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="inputhp" name="no_hp" class="form-control" placeholder="Nomor HP" required="required" >
              <label for="inputhp" >Nomor HP</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="inputmail"  name="email" class="form-control" placeholder="gold.store@gmail.com" required="required">
              <label for="inputmail" >Email</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <textarea name="alamat" id="inputEmail" class="form-control" placeholder="Alamat Lengkap" required="required"></textarea>
              <!-- <label for="inputEmail">Alamat Lengkap</label> -->
            </div>
          </div>
         <!--  <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me">
                Remember Password
              </label>
            </div>
          </div> -->
          <input class="btn btn-primary btn-block" type="submit" name="Register" value="Register">
          <!-- <a class="btn btn-primary btn-block" href="index.html">Login</a> -->
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url();?>/assets/backend/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url();?>/assets/backend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url();?>/assets/backend/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script type="text/javascript">
    var password = document.getElementById("password");
    var confirm_password = document.getElementById("confirm_password");

    function validatePassword(){
      if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords Don't Match");
      } else {
        confirm_password.setCustomValidity('');
      }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
  </script>

</body>

</html>
