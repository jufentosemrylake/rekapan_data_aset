<?php
session_start();
require '../function.php';
if (!isset($_SESSION["login"])) {
  header("location: ../../login.php");
  exit;
}


if (isset($_POST["saveAset"])) {

  if (addAset($_POST) > 0) {
    echo "
      <script>
        alert('Data inventaris berhasil disimpan');
        </script>
        ";
  } else {
    echo "
        <script>
        alert('Data gagal disimpan. Cek Primary key tidak boleh sama atau unik');
        </script>
        ";
  }
}
if (isset($_POST["ubah"])) {
  if (editAset($_POST) > 0) {
    echo "
      <script>
        alert('Data berhasil diupdate');
      </script>
      ";
  } else {
    echo "
      <script>
        alert('Data gagal diupdate');
      </script>
      ";
  }
}


$AllKas = allKas("SELECT id_kas , nama_kantorKas FROM kantor_kas");
$AllCbg = addBranch("SELECT kode_cabang , nama_cabang FROM cabang");
$nol = 0;
$habis = count(Allaset("SELECT * FROM aset WHERE sisa_bln_sst <= $nol "));
$idLaporan = $_GET["id"];

$date =  date("Y/m/d");
$date = new DateTime("" . $date);

$jumdatph = 10;
$jumAset = count(Allaset("SELECT * FROM aset WHERE id_lprn = '$idLaporan'"));
$jumhal = ceil($jumAset / $jumdatph);
$aktpage = (isset($_GET["page"])) ? $_GET["page"] : 1;
$dtawl = ($jumdatph * $aktpage) - $jumdatph;

//$ttlNLIjumlah = allAset("SELECT SUM(nilai_jumlah) AS total_NiJum FROM aset WHERE id_lprn = '$idLaporan'");
$ttlNLIjumlah = Allaset("SELECT SUM(nilai_jumlah) AS DATA FROM aset WHERE id_lprn = '$idLaporan'")[0];
$TotalpnytBulan = allAset("SELECT SUM(pnystn_perBulan) AS DATA FROM aset WHERE id_lprn = '$idLaporan'")[0];
$TTLsisaNILAIsst = allAset("SELECT SUM(ssa_nlai_pnystan) AS DATA FROM aset WHERE id_lprn = '$idLaporan'")[0];
$edit  = "UPDATE report SET 
                ttlSSTbulan  = '$TotalpnytBulan[DATA]',
                ttlNILAIjmlh = '$ttlNLIjumlah[DATA]',
                ttlSISAnilaiPnyustan = '$TTLsisaNILAIsst[DATA]'
                WHERE 
                id  = '$idLaporan'";
mysqli_query($knk, $edit);

$allLap = lapo("SELECT * FROM report WHERE id = '$idLaporan'")[0];
$asets = Allaset("SELECT * FROM aset WHERE id_lprn = '$idLaporan' LIMIT $dtawl, $jumdatph");
$tyHA = AllAmor("SELECT kelompok FROM amortisasi");
//var_dump($tyHA);die;
if (isset($_POST["searchAset"])) {
  $asets = SearchASET($_POST["katakunci"]);
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

  <title>RDA / Aset</title>


  <script src="../../assets/jQuery/jquery-3.4.1.min.js"></script>
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
          url: '../../pajakA.php',
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
          url: '../../pajakB.php',
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
          url: '../../pajakA.php',
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
          url: '../../pajakB.php',
          data: 'kode=' + branchId,
          success: function(response) {
            $('#tarifEdit').html(response);
          }
        });
      })
    });
  </script>
  <link rel="stylesheet" href="../../assets/datepicker/css/datepicker.css">

  <!-- Custom fonts for this template-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
  <!---################################################################################################################## -->
  <?php require_once 'modalAdd.php'; ?>
  <?php require_once 'modalEdit.php'; ?>
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
            <a class="collapse-item" href="habisMasaSusut.php">Habis Masa Susut
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
      <hr class="sidebar-divider d-none d-md-block">
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

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
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
                <button class="btn btn-primary" type="submit" name="searchAset">
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

        <!-- Begin Page Content -->

        <div class="container-fluid">

          <!-- DataTales Example -->

          <a href="../lapAset/indexLap.php" class="btn btn-info btn-lg active" role="button" style="margin-bottom: 5px;">
            <i class="fas fa-arrow-left" style="margin-right: 10px;"></i>Kembali
          </a>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Daftar Aset</h6>
            </div>
            <div class="card-body">
              <b>Periode :</b> <?= $allLap['periode']; ?><br>
              <b>Total Nilai Jumlah :</b> <?= number_format($allLap["ttlNILAIjmlh"], 0, ',', '.'); ?><br>
              <b>Total Penyusutan Per Bulan :</b> <?= number_format($allLap["ttlSSTbulan"], 0, ',', '.'); ?><br>
              <b>Total Sisa Nilai Penyusutan :</b> <?= number_format($allLap["ttlSISAnilaiPnyustan"], 0, ',', '.'); ?><br><br>
              <!-- Button trigger modal 
              <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#lapAddModal" data-whatever="@mdo">
                <i class="fas fa-plus"></i> Tambah
              </button>
              -->
              <a class="btn" href="" style="border-color: black; margin-bottom: 1px;">
                <i class="fas fa-fw fa-retweet"></i> Refresh
              </a>
              <br>
              <br>
              <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                  <thead>
                    <tr align="center">
                      <th>No</th>
                      <!--<th colspan="2">Opsi</th>-->
                      <th>Kode</th>
                      <th>Nama Inventaris</th>
                      <th>Nama Cabang</th>
                      <th>Kantor Kas</th>
                      <th>Kategori Aset</th>
                      <th>Jenis Aset</th>
                      <th>Type Harta/Aktiva (Pajak)</th>
                      <th>Tanggal Perolehan</th>
                      <th>Jumlah</th>
                      <th>Harga Beli</th>
                      <th>Nilai Jumlah</th>
                      <th>Umur Ekonomis (Tahun)</th>
                      <th>Tanggal Habis Penyusutan</th>
                      <th>Nilai Residu</th>
                      <th>Tarif Penyusutan</th>
                      <th>Jumlah Bulan Susut</th>
                      <th>Sisa Bulan Susut</th>
                      <th>Penyusutan Perbulan</th>
                      <th>Penyusutan Pertahun</th>
                      <th>Sisa Nilai Penyusutan</th>
                      <th>Nilai Sisa / Nilai Buku</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php $no = 1; ?>
                    <?php foreach ($asets as $brs) : ?>
                      <tr align="center">
                        <td><?= $no; ?></td>
                        <!---
                        <td>
                          <button type="button" title="Edit" class='btn btn-success editAsetBtn'><i class="fas fa-edit"></i>
                          </button>
                        </td>
                        <td>
                          <a type="button" title="Hapus" class='btn btn-danger' href="deleteAset.php?kode_aset=<?= $brs["kode_aset"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini');"><i class="fas fa-trash"></i>
                          </a>
                        </td>
                          -->
                        <td><?= $brs["kode_aset"]; ?></td>
                        <td><?= $brs["nama_aset"]; ?></td>
                        <td><?= $brs["cabang"]; ?></td>
                        <td><?= $brs["kantor_kas"]; ?></td>
                        <td><?= $brs["kategori"]; ?></td>
                        <td><?= $brs["jenis"]; ?></td>
                        <td><?= $brs["type_pajak"]; ?></td>
                        <td><?= $brs["tgl_beli"]; ?></td>
                        <td><?= $brs["jumlah"]; ?></td>
                        <td><?= number_format($brs["harga_beli"], 0, ',', '.'); ?></td>
                        <td><?= number_format($brs["nilai_jumlah"], 0, ',', '.'); ?></td>
                        <td><?= $brs["umur_eko"]; ?></td>
                        <td><?= $brs["tgl_hbs_sst"]; ?></td>
                        <td><?= number_format($brs["nilai_residu"], 0, ',', '.'); ?></td>
                        <td><?= $brs["tarif_penyusutan"]; ?>%</td>
                        <?php
                        $kdASET = $brs["kode_aset"];
                        $ssaBLNSSTnow = $brs["jmlh_bln_sst"];

                        $tglbli = $brs["tgl_beli"];
                        $tglPer  = explode('/', $tglbli);
                        $tglbli = $tglPer[2] . "/" . $tglPer[1] . "/" . $tglPer[0];
                        $tglbeli = new DateTime("" . $tglbli);
                        $selisih = $tglbeli->diff($date);
                        $bulansusut = $selisih->m + $selisih->y * 12;
                        $ttlblnsst = $brs["ttl_BLN_sst"];
                        $sisaBLNSusut = $ttlblnsst - $bulansusut;
                        if ($sisaBLNSusut < 0) {
                          $sisaBLNSusuttampil = 0;
                        } else {
                          $sisaBLNSusuttampil = $sisaBLNSusut;
                        }
                        //auto update
                        if ($ssaBLNSSTnow != $bulansusut) {
                          $edit  = "UPDATE aset SET 
                            jmlh_bln_sst  = '$bulansusut', sisa_bln_sst  = '$sisaBLNSusut', ttl_BLN_sst = '$ttlblnsst' WHERE kode_aset  = '$kdASET'";
                          mysqli_query($knk, $edit);
                          return mysqli_affected_rows($knk);
                        }
                        ?>
                        <td><?= $brs["jmlh_bln_sst"]; ?></td>
                        <td><?= $sisaBLNSusuttampil; ?></td>
                        <td><?= number_format($brs["pnystn_perBulan"], 0, ',', '.'); ?></td>
                        <td><?= number_format($brs["pnystan_tahun"], 0, ',', '.'); ?></td>
                        <td><?= number_format($brs["ssa_nlai_pnystan"], 0, ',', '.'); ?></td>
                        <td><?= number_format($brs["nilai_buku"], 0, ',', '.'); ?></td>
                      </tr>
                      <?php $no++; ?>
                    <?php endforeach; ?>
                  </tbody>
                </table>

              </div>
              <div class="mt-2 text-center">
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

  <!-- Page level custom scripts -->
  <script src="../../assets/js/demo/datatables-demo.js"></script>
  <script src="../../assets/datepicker/js/bootstrap-datepicker.js"></script>
  <script>
    $('#tglPRL').datepicker({
      format: 'dd/mm/yyyy',
    });
    $('#tglBeli').datepicker({
      format: 'dd/mm/yyyy',
    });

    $(document).ready(function() {
      $('.editAsetBtn').on('click', function() {
        $('#asetEditModal').modal('show');
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
          return $(this).text();
        }).get();
        console.log(data);
        $('#asetID').val(data[3]);
        $('#INVnm').val(data[4]);
        $('#kate').val(data[7]);
        $('#jns').val(data[8]);
        $('#pjk').val(data[9]);
        $('#tglBeli').val(data[10]);
        $('#jumlah').val(data[11]);
      });
    });
  </script>
  <script src="../../assets/js/indexOp.js"></script>
</body>

</html>