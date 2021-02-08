<?php

require 'function.php';


if (isset($_POST["regis"])) {
  if (daftar($_POST) > 0) {
    echo "<script>
        alert('Pengguna Terdaftar');
        document.location.href = 'index.php';
        </script>";
  } else {
    echo mysqli_error($knk);
  }
}
$AllCbg = addBranch("SELECT kode_cabang , nama_cabang FROM cabang");

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Halaman Registarasi User</title>
  <script src="../assets/jQuery/jquery-3.4.1.min.js"></script>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/vendor/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <script>
    $(document).ready(function() {
      $('#kodeCbg').change(function() {
        var branchId = $(this).val();
        $.ajax({
          type: 'POST',
          url: 'asets/kass.php',
          data: 'kode=' + branchId,
          success: function(response) {
            $('#kodeKas').html(response);
          }
        });
      })
    });
    $(document).ready(function() {
      $('#cabang').change(function() {
        var branchId = $(this).val();
        $.ajax({
          type: 'POST',
          url: 'asets/kassEdit.php',
          data: 'kode=' + branchId,
          success: function(response) {
            $('#kas').html(response);
          }
        });
      })
    });
  </script>

</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg"></p>

        <form action="" method="post">
          <div class="form-group">
            <div class="form-label-group">
              <select class="form-control form-control-sm" name="level" id="level" required onclick="tampilFORM()">
                <option id="level" value="admin">Admin</option>
                <option id="level" value="operator">Operator</option>
              </select>
            </div>
          </div>
          <div class="input-group mb-3">
            <input name="username" id="username" type="text" required autocomplete="off" class="form-control" placeholder="Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input name="password1" id="password1" type="password" required autocomplete="off" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input name="password2" id="password2" type="password" required autocomplete="off" class="form-control" placeholder="Konfirmasi Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="form-group" id="form-cabang">
            <div class="form-label-group">
              <select class="form-control form-control-sm" name="cabang" id="cabang" disabled required>
                <option id="cabang">Pilih Kantor Cabang</option>
                <?php foreach ($AllCbg as $brs) : ?>
                  <option id="kodeCbg" value="<?= $brs["kode_cabang"]; ?>">
                    <?= $brs["nama_cabang"]; ?>
                  </option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="form-group" id="form-kas">
            <div class="form-label-group">
              <select class="form-control form-control-sm" name="kas" id="kas" disabled required>
                <option id="kas">Pilih Kantor Kas</option>
              </select>
            </div>
          </div>


          <div class="row">
            <div class="col-6">
              <a type="submit" href="index.php" class="btn btn-primary btn-block btn-flat">Kembali</a>
            </div>
            <div class="col-6">
              <button class="btn btn-primary btn-block" type="submit" name="regis">Simpan</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="../assets/jQuery/jquery-3.4.1.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../assets/dist/js/adminlte.min.js"></script>
  <script src="../assets/js/show-cabang.js"></script>

</body>

</html>