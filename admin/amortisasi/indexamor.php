<?php
session_start();
require '../function.php';
if (!isset($_SESSION["login"])) {
  header("location: ../../login.php");
  exit;
}
//cek Submit
if (isset($_POST["saveAmor"])) {

  if (addAmor($_POST) > 0) {
    echo "
          <script>
            alert('Data berhasil disimpan');
            document.location.href = 'indexamor.php';
          </script>
          ";
  } else {
    echo "
          <script>
            alert('Data gagal disimpan. Cek Primary key tidak boleh sama atau unik');
            document.location.href = 'indexamor.php';
          </script>
          ";
  }
}
if (isset($_POST["editAmor"])) {
  if (editAmor($_POST) > 0) {
    echo "
          <script>
            alert('Data berhasil diupdate');
            document.location.href = 'indexamor.php';
          </script>
          ";
  } else {
    echo "
          <script>
            alert('Data gagal diupdate');
            document.location.href = 'indexamor.php';
          </script>
          ";
  }
}

$nol = 0;
$jumCbg = count(addBranch("SELECT * FROM cabang"));
$jumKas = count(allKas("SELECT * FROM kantor_kas"));
$jumLap = count(lapo("SELECT * FROM laporan"));
$habis = count(Allaset("SELECT * FROM aset WHERE sisa_bln_sst = $nol AND ssa_nlai_pnystan = $nol"));


$jumdatph = 10;
$jumalldat = count(AllAmor("SELECT * FROM amortisasi"));
$jumhal = ceil($jumalldat / $jumdatph);
$aktpage = (isset($_GET["page"])) ? $_GET["page"] : 1;
$dtawl = ($jumdatph * $aktpage) - $jumdatph;

$Amor = allAmor("SELECT * FROM amortisasi LIMIT $dtawl, $jumdatph");

if (isset($_POST["searchAmortisasi"])) {
  $Amor = SearchAmor($_POST["katakunci"]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>RDA / Tabel Amortisasi</title>

  <!-- Custom fonts for this template-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">


</head>

<body id="page-top">
  <!---########################### Modal Tambah Data ############################################################## -->
  <div class="modal fade" id="amorAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="brModalLabel">Form Tambah Data Amortisasi Aset</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST">
          <div class="modal-body">
            <div class="form-group">
              <label for="kelompok">Kelompok Harta</label>
              <input type="text" name="kelompok" id="kelompok" class="form-control" autocomplete="off" maxlength="2" required>
            </div>
            <div class="form-group">
              <label for="masa">Masa Manfaat ( Tahun )</label>
              <input type="text" name="masa" id="masa" class="form-control" autocomplete="off" required>
            </div>
            <div class="form-group">
              <label for="Tarif">Tarif Penyusutan ( % )</label>
              <input type="text" name="Tarif" id="Tarif" class="form-control" autocomplete="off" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="saveAmor">
              <i class="fas fa-save" style="margin-right: 10px;"></i>Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!---##################################################################################################################---->
  <div class="modal fade" id="EditAmortModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="brModalLabel">Form Edit Data Amortisasi Aset</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST">
          <div class="modal-body">
            <input type="hidden" name="id" id="id" class="form-control">
            <div class="form-group">
              <label for="kel">Kelompok Harta</label>
              <input type="text" name="kel" id="kel" class="form-control" autocomplete="off" maxlength="2" required>
            </div>
            <div class="form-group">
              <label for="mas">Masa Manfaat ( Tahun )</label>
              <input type="text" name="mas" id="mas" class="form-control" autocomplete="off" required>
            </div>
            <div class="form-group">
              <label for="tar">Tarif Penyusutan ( % )</label>
              <input type="text" name="tar" id="tar" class="form-control" autocomplete="off" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="editAmor">
              <i class="fas fa-save" style="margin-right: 10px;"></i>Update
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!---################################################################################################################## -->
  <!--- Modal Update---->

  <!--- End Modal Update---->
  <!---##################################################################################################################---->

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-file-invoice-dollar"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Rekapan Data Aset</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="../branchOffice/indexBranchOffice.php">
          <i class="fas fa-fw fa-building"></i>
          <span>Kantor Cabang</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="../kas/indexKas.php">
          <i class="fas fa-fw fa-code-branch"></i>
          <span>Kantor Kas</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">
      <li class="nav-item">
        <a class="nav-link" href="../amortisasi/indexamor.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Tabel Amortisasi</span></a>
      </li>
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
            <a class="collapse-item" href="../lapAset/indexLap.php">Laporan Tiap Periode</a>
            <a class="collapse-item" href="../asets/habisMasaSusut.php">Habis Masa Susut
              <span class="ml-3 badge badge-danger navbar-badge"><?= $habis; ?></span>
            </a>
          </div>
        </div>
      </li>

      <hr class="sidebar-divider">
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#modal-xl" href="">
          <i class="fas fa-user"></i>
          <span>Daftar User</span></a>
      </li>
      <div class="modal fade" id="modal-xl">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Daftar Nama Operator</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php
              include '../data.php';
              ?>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
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
                <button class="btn btn-primary" type="submit" name="searchAmortisasi">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </form>
          <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="rounded-circle fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="../regis.php">
                  <i class="fas fa-plus fa-sm fa-fw mr-2 text-gray-400"></i>
                  Tambah User
                </a>
                <a class="dropdown-item" href="../changePass.php">
                  <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                  Ganti Password
                </a>
                <a class="dropdown-item" onclick="return confirm('Anda yakin ingin keluar dari halaman ini??');" href="../LogOut.php">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->
        <div class="container-fluid">

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tabel Tarif dan Masa Manfaat Penyusutan</h6>
            </div>
            <div class="card-body">
              <!-- Button trigger modal -->
              <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#amorAddModal" data-whatever="@mdo">
                <i class="fas fa-plus"></i> Tambah
              </button>
              <a class="btn" href="" style="border-color: black; margin-bottom: 1px;">
                <i class="fas fa-fw fa-retweet"></i> Refresh
              </a>

              </button>
              <div class="float-right">

              </div>
              <br>
              <br>
              <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                  <thead>
                    <tr align="center">
                      <th>No</th>
                      <th>ID</th>
                      <th>Kelompok Harta</th>
                      <th>Masa Manfaat ( Tahun )</th>
                      <th>Tarif Penyusutan ( % )</th>
                      <th>Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($Amor as $brs) : ?>
                      <tr align="center">
                        <td><?= $no; ?></td>
                        <td><?= $brs["id"]; ?></td>
                        <td><?= $brs["kelompok"]; ?></td>
                        <td><?= $brs["masa"]; ?></td>
                        <td><?= $brs["tarif"]; ?></td>
                        <td>
                          <button type="button" title="Edit" class='btn btn-success editAmorBtn'><i class="fas fa-edit"></i>
                          </button>

                          <a type="button" title="Hapus" class='btn btn-danger' href="deleteAmor.php?id=<?= $brs["id"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini');"><i class="fas fa-trash"></i>
                          </a>
                        </td>
                      </tr>
                      <?php $no++; ?>
                    <?php endforeach; ?>
                  </tbody>
                </table>

                <div class="text-center">
                  <span class="btn btn-primary">Halaman</span>
                  <div class="btn-group">
                    <?php if ($aktpage > 1) : ?>
                      <a href="?page=<?= $aktpage - 1; ?>" class="btn" style="border-color: black;"><i class="fas fa-angle-left"></i></a>
                    <?php endif; ?>
                    <?php for ($a = 1; $a <= $jumhal; $a++) : ?>
                      <?php if ($a == $aktpage) : ?>
                        <a href="?page=<?= $a; ?>" class="btn btn-success" style="font-weight: bold; border-color: black;"><?= $a; ?>
                        </a>
                      <?php else : ?>
                        <a href="?page=<?= $a; ?>" class="btn" style="border-color: black;"><?= $a; ?></a>
                      <?php endif; ?>
                    <?php endfor; ?>

                    <?php if ($aktpage < $jumhal) : ?>
                      <a href="?page=<?= $aktpage + 1; ?>" class="btn" style="border-color: black;"><i class="fas fa-angle-right"></i></a>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-dark">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span class="text-light">Copyright &copy; Semry 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="../../assets/jQuery/jquery-3.4.1.min.js"></script>
  <script src="../../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../../assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../../assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>


  <!-- Page level custom scripts -->
  <script src="../../assets/js/demo/datatables-demo.js"></script>
  <script>
    $(document).ready(function() {
      $('.editAmorBtn').on('click', function() {
        $('#EditAmortModal').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();
        console.log(data);
        $('#id').val(data[1]);
        $('#kel').val(data[2]);
        $('#mas').val(data[3]);
        $('#tar').val(data[4]);



      });
    });
  </script>
</body>

</html>