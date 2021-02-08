<?php
session_start();
require 'admin/function.php';
if (!isset($_SESSION["login"])) {
  header("location: login.php");
  exit;
}

if (isset($_POST["ubahPasword"])) {
  if (ubahPasswordOperator($_POST) > 0) {
    $_SESSION = [];
    session_unset();
    session_destroy();
    echo "<script>
      alert('Password Sukses Diganti. Silahkan Login Kembali');
      document.location.href = 'login.php';
      </script>";
    exit;
  } else {
    echo mysqli_error($knk);
  }
}

$nol = 0;
$habis = count(Allaset("SELECT * FROM aset WHERE sisa_bln_sst <= $nol"));




?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Rekapan Data Aset - Operator</title>

  <script src="assets/jQuery/jquery-3.4.1.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#kodeCbg').change(function() {
        var branchId = $(this).val();
        $.ajax({
          type: 'POST',
          url: 'kass.php',
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
          url: 'kassEdit.php',
          data: 'kode=' + branchId,
          success: function(response) {
            $('#kas').html(response);
          }
        });
      })
    });
    $(document).ready(function() {
      $('#pajak').change(function() {
        var branchId = $(this).val();
        $.ajax({
          type: 'POST',
          url: 'pajakA.php',
          data: 'kode=' + branchId,
          success: function(response) {
            $('#masaManfaat').html(response);
          }
        });
      })
    });
    $(document).ready(function() {
      $('#pajak').change(function() {
        var branchId = $(this).val();
        $.ajax({
          type: 'POST',
          url: 'pajakB.php',
          data: 'kode=' + branchId,
          success: function(response) {
            $('#tarif').html(response);
          }
        });
      })
    });
    $(document).ready(function() {
      $('#pjk').change(function() {
        var branchId = $(this).val();
        $.ajax({
          type: 'POST',
          url: 'pajakA.php',
          data: 'kode=' + branchId,
          success: function(response) {
            $('#masaManfaatEdit').html(response);
          }
        });
      })
    });
    $(document).ready(function() {
      $('#pjk').change(function() {
        var branchId = $(this).val();
        $.ajax({
          type: 'POST',
          url: 'pajakB.php',
          data: 'kode=' + branchId,
          success: function(response) {
            $('#tarifEdit').html(response);
          }
        });
      })
    });
  </script>
  </script>
  <link rel="stylesheet" href="assets/datepicker/css/datepicker.css">

  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="assets/style.css" rel="stylesheet">
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Theme style -->

</head>

<body id="page-top">

  <div class="modal fade" id="ubahPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="brModalLabel">Form Ganti Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST">
          <div class="modal-body">
            <div class="form-group">
              <label for="username">Username</label>
              <p id="errorUsername" style="color: red; margin-bottom: 0;"></p>
              <input onkeyup="cekValidasiUsername();" type="text" name="username" id="username" class=" form-control" autocomplete="off" required>
            </div>
            <div class="form-group">
              <label for="newpassword1">Password Baru</label>
              <p id="errorNewPassword1" style="color: red; margin-bottom: 0;"></p>
              <input type="password" name="newpassword1" id="newpassword1" class="form-control" autocomplete="off" required>
            </div>
            <div class="form-group">
              <label for="newpassword2">Konfirmasi Password Baru</label>
              <p id="errorNewPassword2" style="color: red; margin-bottom: 0;"></p>
              <input onkeyup="cekValidasiPassword();" type="password" name="newpassword2" id="newpassword2" class="form-control" autocomplete="off" required>
            </div>
            <div class="form-group">
              <label class="form-check-label">Sembunyikan Password?</label>
              <div class="form-check">
                <input onclick="showpassword();" class="form-check-input" type="radio" id="yes" name="yes">
                <label for="yes" class="form-check-label">Yes</label>
              </div>
              <div class="form-check">
                <input onclick="hidepassword();" class="form-check-input" type="radio" id="no" name="yes">
                <label for="no" class="form-check-label">No</label>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-warning" name="ubahPasword">
              <i class="fas fa-save" style="margin-right: 10px;"></i>Ubah Password
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="indexOp.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-file-invoice-dollar"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Rekapan Data Aset</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider">
      <li class="nav-item">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-book"></i>
          <span>Laporan Data Aset</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Data Aset :</h6>
            <a class="collapse-item" href="http://localhost/rekapanDataAset/indexOp.php">Laporan Tiap Periode</a>

          </div>
        </div>
      </li>
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-dark bg-dark topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form action="" method="post" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" name="katakunci">
              <div class="input-group-append">
                <button class="btn btn-primary" type="submit" name="search">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </form>
          <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <!--- <span class="mr-2 d-none d-lg-inline text-white small"></span> --->
                <i class="rounded-circle fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

                <a type="submit" class="dropdown-item" data-toggle="modal" data-target="#ubahPassword" data-whatever="@mdo">
                  <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                  Ganti Password
                </a>
                <a class="dropdown-item" onclick="return confirm('Anda yakin ingin keluar dari halaman ini??');" href="admin/LogOut.php">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>


              </div>
            </li>
          </ul>

        </nav>