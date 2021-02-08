<?php
include 'template/header.php';
$iduser = $_SESSION["login"];
$AllKas = addBranch("SELECT nama_kantorKas FROM kantor_kas");
if (isset($_POST["saveLap"])) {

  if (createLap($_POST) > 0) {
    echo "
      <script>
        alert('Data berhasil disimpan');
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
if (isset($_POST["aptLap"])) {
  if (editLap($_POST) > 0) {
    echo "
      <script>
        alert('Data berhasil diupdate');
        document.location.href = 'indexOp.php';
      </script>
      ";
  } else {
    echo "
      <script>
        alert('Data gagal diupdate');
        document.location.href = 'indexOp.php';
      </script>
      ";
  }
}
$jumdatph = 10;
$jumalldat = count(lapo("SELECT * FROM laporan WHERE id_user = $iduser"));
$jumhal = ceil($jumalldat / $jumdatph);
$aktpage = (isset($_GET["page"])) ? $_GET["page"] : 1;
$dtawl = ($jumdatph * $aktpage) - $jumdatph;
$lap = lapo("SELECT * FROM laporan  WHERE id_user = $iduser LIMIT $dtawl, $jumdatph");
if (isset($_POST["search"])) {
  $lap = carilap($_POST["katakunci"]);
  //   var_dump($lap);die;
}
$akun = addBranch("SELECT * FROM users WHERE id = $iduser")[0];
$kanCabang = addBranch("SELECT nama_cabang from cabang WHERE kode_cabang = $akun[lokasi_cbg]")[0];
?>

<!---################################################################################################################## -->
<div class="modal fade" id="lapAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="brModalLabel">Form Pembuatan Laporan Aset</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
        <div class="modal-body">
          <!-----
          <div class="form-group">
            <label for="namaKas">Kantor Kas</label>
            <div class="form-label-group">
              <select class="form-control" name="namaKas" id="namaKas" required>
                <option value="">---</option>
                <?php foreach ($AllKas as $brs) : ?>
                  <option id="namaKas" value="<?= $brs["nama_kantorKas"]; ?>">
                    <?= $brs["nama_kantorKas"]; ?>
                  </option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          ----->
          <input autocomplete="off" value="<?= $akun["id"]; ?>" required type="hidden" name="iduser" id="iduser" class="form-control" readonly>
          <div class="form-group">
            <div class="row">
              <div class="col">
                <label for="cabang">Kantor Cabang</label>
                <input autocomplete="off" value="<?= $kanCabang["nama_cabang"]; ?>" required type="text" name="cabang" id="cabang" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="kas">Kantor Kas</label>
                <input autocomplete="off" value="<?= $akun["lokasi_kas"]; ?>" required type="text" name="kas" id="kas" class="form-control" readonly>
              </div>
            </div>
            <label for="periode">Periode</label>
            <div class="row">
              <div class="col">
                <input autocomplete="off" required type="text" name="tglStart" id="tglStart" class="form-control" placeholder="dd/mm/yyyy">
              </div>
              <span class="mt-2">s.d</span>
              <div class="col">
                <input autocomplete="off" required type="text" name="tglEnd" id="tglEnd" class="form-control" placeholder="dd/mm/yyyy">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="noLap">Nomor Laporan</label>
            <input type="text" name="noLap" id="noLap" class="form-control" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label for="nameLap">Judul Laporan</label>
            <input type="text" name="nameLap" id="nameLap" class="form-control" autocomplete="off" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" name="saveLap">
            <i class="fas fa-save" style="margin-right: 10px;"></i>Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!---##################################################################################################################---->
<div class="modal fade" id="lapEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="brModalLabel">Form Edit Laporan Aset</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST">
        <div class="modal-body">
          <input autocomplete="off" value="<?= $akun["id"]; ?>" required type="hidden" name="iduserEDT" id="iduserEDT" class="form-control" readonly>
          <div class="form-group">
            <div class="row">
              <div class="col">
                <label for="cabang">Kantor Cabang</label>
                <input autocomplete="off" value="<?= $kanCabang["nama_cabang"]; ?>" required type="text" name="cabangEDT" id="cabangEDT" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="kas">Kantor Kas</label>
                <input autocomplete="off" value="<?= $akun["lokasi_kas"]; ?>" required type="text" name="kasEDT" id="kasEDT" class="form-control" readonly>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="periode">Periode</label>
            <div class="row">
              <div class="col">
                <input type="text" name="tStart" id="tStart" class="form-control" placeholder="dd/mm/yyyy">
              </div>
              <span class="mt-2">s.d</span>
              <div class="col">
                <input type="text" name="tEnd" id="tEnd" class="form-control" placeholder="dd/mm/yyyy">
              </div>
            </div>
          </div>
          <div class="form-group">
            <input type="hidden" name="noLapEDIT" id="noLapEDIT" class="form-control" autocomplete="off" required>
          </div>
          <div class="form-group">
            <label for="nameLap">Judul Laporan</label>
            <input type="text" name="tit" id="tit" class="form-control" autocomplete="off" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning" name="aptLap">
            <i class="fas fa-save" style="margin-right: 10px;"></i>Update
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!---################################################################################################################## -->


<div class="container">
  <h4>Dashboard / <strong><?= $akun["nama"]; ?></strong></h4>
  <input id="OPusername" type="hidden" value="<?= $akun["username"]; ?>">
</div>
<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Laporan Data Aset</h6>
    </div>
    <div class="card-body">
      <!-- Button trigger modal -->
      <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#lapAddModal" data-whatever="@mdo">
        <i class="fas fa-plus"></i> Buat Laporan
      </button>
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
              <th>Nomor Dokumen</th>
              <th>Kantor Cabang</th>
              <th>Kantor Kas</th>
              <th>Nama Dokumen</th>
              <th>Periode</th>
              <th>Jumlah Aset</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; ?>
            <?php foreach ($lap as $brs) : ?>
              <tr align="center">
                <td><?= $no; ?></td>
                <td><?= $brs["id"]; ?></td>
                <td><?= $brs["nama_cbg"]; ?></td>
                <td><?= $brs["nama_kankas"]; ?></td>
                <td><?= $brs["nama_laporan"]; ?></td>
                <td><?= $brs["periode"]; ?></td>
                <?php $jumAset = count(Allaset("SELECT * FROM aset WHERE id_lprn = $brs[id]")); ?>
                <td><?= $jumAset; ?></td>
                <td>
                  <a type="button" title="Detail" class='btn btn-success' href="indexAset.php?id=<?= $brs["id"]; ?>">
                    <i class="fas fa-eye"></i>
                  </a>
                  <button type="button" title="Edit" class='btn btn-warning editLapBtn'><i class="fas fa-edit"></i>
                  </button>

                  <a type="button" title="Hapus" class='btn btn-danger' href="delLap.php?id=<?= $brs["id"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini? Jika Menghapus dokumen ini maka juga akan menghapus semua data aset yang ada didalam dokumen ini. Anda yakin?');"><i class="fas fa-trash"></i>
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
<script>
  document.getElementById('hide').addEventListener('click', function() {
    var status = document.getElementById('hide').innerHTML;
    console.log(status);
    if (statur == "-") {
      document.getElementById('hide').innerHTML('+');
    }
  });
</script>

<?php include 'template/footer.php'; ?>