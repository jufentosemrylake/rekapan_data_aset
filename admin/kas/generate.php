<?php
session_start();
require '../function.php';
if (!isset($_SESSION["login"])) {
    header("location: ../../login.php");
    exit;
}
//cek Submit
if (isset($_POST["saveKas"])) {

    if (addKas($_POST) > 0) {
        echo "
          <script>
            alert('Data berhasil disimpan');
            document.location.href = 'indexKas.php';
          </script>
          ";
    } else {
        echo "
          <script>
            alert('Data gagal disimpan. Cek Primary key tidak boleh sama atau unik');
            document.location.href = 'indexKas.php';
          </script>
          ";
    }
}

$AllCbg = allKas("SELECT kode_cabang , nama_cabang FROM cabang");
$jumlah = $_POST['ttl'];

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RDA / Kantor Kas</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../assets/css/sb-admin-2.min.css" rel="stylesheet">

    <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">


    <div class="container-fluid">
        <div class="card shadow mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Kantor Kas</h6>
            </div>
            <div class="card-body">
                <a class="btn btn-info" href="indexKas.php">
                    <i class="fas fa-fw fa-arrow-left"></i> Kembali
                </a><br>
                <form action="" method="post">
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <input type="hidden" name="total" value="<?= $jumlah; ?>">
                            <thead>
                                <tr align="center">
                                    <th>No</th>
                                    <th>Kode Cabang</th>
                                    <th>Kode Kantor Kas</th>
                                    <th>Nama Kantor Kas</th>
                                    <th>Alamat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($i = 1; $i <= $jumlah; $i++) { ?>
                                    <tr align="center">
                                        <td><?= $i; ?></td>
                                        <td>
                                            <div class="form-label-group">
                                                <select class="form-control" name="kodeCbg-<?= $i; ?>" id="kodeCbg<?= $i; ?>" required>
                                                    <option value="">---</option>
                                                    <?php foreach ($AllCbg as $brs) : ?>
                                                        <option id="kodeCbg" value="<?= $brs["kode_cabang"]; ?>">
                                                            <?= $brs["kode_cabang"]; ?> - <?= $brs["nama_cabang"]; ?>
                                                        </option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <input type="text" name="idKas-<?= $i; ?>" id="idKas-<?= $i; ?>" class="form-control" autocomplete="off" maxlength="8" required>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="nameKas-<?= $i; ?>" id="nameKas-<?= $i; ?>" class="form-control" autocomplete="off" required>
                                        </td>
                                        <td>
                                            <textarea name="address-<?= $i; ?>" id="address-<?= $i; ?>" rows="3" cols="35" class="form-control" required autocomplete="off"></textarea>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary" name="saveKas">
                            <i class="fas fa-save" style="margin-right: 10px;"></i>Simpan
                        </button>
                </form>
            </div>
        </div>
    </div>
    </div>

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
</body>

</html>