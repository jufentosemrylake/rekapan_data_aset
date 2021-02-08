<?php
include 'template/header.php';
$iduser = $_SESSION["login"];
$idLaporan = $_GET["id"];

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
if ($idLaporan == null) {
    var_dump("ID KOSONG");
    die;
}
//getId($idLaporan);

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
$edit  = "UPDATE laporan SET 
                    ttlSSTbulan  = '$TotalpnytBulan[DATA]',
                    ttlNILAIjmlh = '$ttlNLIjumlah[DATA]',
                    ttlSISAnilaiPnyustan = '$TTLsisaNILAIsst[DATA]'
                    WHERE 
                    id  = '$idLaporan'";
mysqli_query($knk, $edit);

$allLap = lapo("SELECT * FROM laporan WHERE id = '$idLaporan'")[0];
$asets = Allaset("SELECT * FROM aset WHERE id_lprn = '$idLaporan' LIMIT $dtawl, $jumdatph");
$tyHA = AllAmor("SELECT kelompok FROM amortisasi");
//var_dump($tyHA);die;
if (isset($_POST["search"])) {
    $asets = SearchASET($_POST["katakunci"]);
}
$akun = addBranch("SELECT * FROM users WHERE id = $iduser")[0];
$kanCabang = addBranch("SELECT nama_cabang from cabang WHERE kode_cabang = $akun[lokasi_cbg]")[0];
$habis = count(Allaset("SELECT * FROM aset WHERE sisa_bln_sst <= $nol"));
?>

<div onmousemove="hitungResidu();" class="modal fade" id="lapAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="brModalLabel">Form Tambah Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input placeholder="Kode Aset" type="text" name="IdAset" id="IdAset" class="form-control form-control-sm" autocomplete="off" required>
                                <input type="hidden" name="perioLap" id="perioLap" class="form-control" autocomplete="off" required value="<?= $allLap['periode']; ?>">
                            </div>
                            <div class="col">
                                <input placeholder="Nama Inventaris" type="text" name="nameINV" id="nameINV" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <div class="form-label-group">
                                    <select readonly class="form-control form-control-sm" name="kodeCbg" id="kodeCbg" required>
                                        <option value="<?= $kanCabang["nama_cabang"]; ?>"><?= $kanCabang["nama_cabang"]; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-label-group">
                                    <select readonly class="form-control form-control-sm" name="kodeKas" id="kodeKas" required>
                                        <option value="<?= $akun["lokasi_kas"]; ?>"><?= $akun["lokasi_kas"]; ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <div class="form-label-group">
                                    <select class="form-control form-control-sm" name="categori" id="categori" required>
                                        <option value="">Kategori Aset</option>
                                        <option id="categori" value="ELU">ELU</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-label-group">
                                    <select class="form-control form-control-sm" name="jenis" id="jenis" required>
                                        <option value="">Jenis Aset</option>
                                        <option id="jenis" value="TANAH">TANAH</option>
                                        <option id="jenis" value="BANGUNAN">BANGUNAN</option>
                                        <option id="jenis" value="MESIN">MESIN</option>
                                        <option id="jenis" value="INVENTARIS">INVENTARIS</option>
                                        <option id="jenis" value="KENDARAAN">KENDARAAN</option>
                                        <option id="jenis" value="PERLENGKAPAN & LAIN-LAIN">PERLENGKAPAN & LAIN-LAIN</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-label-group">
                                    <select class="form-control form-control-sm" name="pajak" id="pajak" required>
                                        <option value="">Type Harta</option>
                                        <?php foreach ($tyHA as $brs) : ?>
                                            <option id="pajak" value="<?= $brs["kelompok"]; ?>"><?= $brs["kelompok"]; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <div class="form-label-group">
                                    <label for="masaManfaat">Masa Manfaat (Tahun)</label>
                                    <select class="form-control form-control-sm" name="masaManfaat" id="masaManfaat" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-label-group">
                                    <label for="tarif">Tarif Penyusutan (%)</label>
                                    <select class="form-control form-control-sm" name="tarif" id="tarif" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <label for="nilaiResidu">Tanggal Perolehan</label>
                                <input type="text" name="tglPRL" id="tglPRL" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input placeholder="Jumlah" type="number" name="qty" id="qty" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                            <div class="col">
                                <input placeholder="Harga Beli (Rp.)" type="number" name="sold" id="sold" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                            <div class="col">
                                <input readonly placeholder="Nilai Residu" type="number" name="nilaiResidu" id="nilaiResidu" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                            <div class="col">
                                <input placeholder="Nilai Jumlah (Rp.)" readonly type="text" name="nilaiJumlah" id="nilaiJumlah" class="form-control form-control-sm" autocomplete="off" required>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="saveAset">
                        <i class="fas fa-save" style="margin-right: 10px;"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="asetEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="brModalLabel">Form Edit Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input readonly placeholder="Kode Aset" type="text" name="asetID" id="asetID" class="form-control form-control-sm" autocomplete="off" required>
                                <input type="hidden" name="periodeLap" id="periodeLap" class="form-control" autocomplete="off" required value="<?= $allLap['periode']; ?>">
                            </div>
                            <div class="col">
                                <input placeholder="Nama Inventaris" type="text" name="INVnm" id="INVnm" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <div class="form-label-group">
                                    <select readonly class="form-control form-control-sm" name="cabang" id="cabang" required>
                                        <option value="<?= $kanCabang["nama_cabang"]; ?>"><?= $kanCabang["nama_cabang"]; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-label-group">
                                    <select readonly class="form-control form-control-sm" name="kas" id="kas" required>
                                        <option value="<?= $akun["lokasi_kas"]; ?>"><?= $akun["lokasi_kas"]; ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <div class="form-label-group">
                                    <select class="form-control form-control-sm" name="kate" id="kate" required>
                                        <option value="">Kategori Aset</option>
                                        <option id="kate" value="ELU">ELU</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-label-group">
                                    <select class="form-control form-control-sm" name="jns" id="jns" required>
                                        <option value="">Jenis Aset</option>
                                        <option id="jns" value="TANAH">TANAH</option>
                                        <option id="jns" value="BANGUNAN">BANGUNAN</option>
                                        <option id="jns" value="MESIN">MESIN</option>
                                        <option id="jns" value="INVENTARIS">INVENTARIS</option>
                                        <option id="jns" value="KENDARAAN">KENDARAAN</option>
                                        <option id="jns" value="PERLENGKAPAN & LAIN-LAIN">PERLENGKAPAN & LAIN-LAIN</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-label-group">
                                    <select class="form-control form-control-sm" name="pjk" id="pjk" required>
                                        <option value="">Tipe Hatra/Aktiva (Pajak)</option>
                                        <?php foreach ($tyHA as $brs) : ?>
                                            <option id="pajak" value="<?= $brs["kelompok"]; ?>"><?= $brs["kelompok"]; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <div class="form-label-group">
                                    <label for="masaManfaatEdit">Masa Manfaat (Tahun)</label>
                                    <select class="form-control form-control-sm" name="masaManfaatEdit" id="masaManfaatEdit" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-label-group">
                                    <label for="tarifEdit">Tarif Penyusutan (%)</label>
                                    <select class="form-control form-control-sm" name="tarifEdit" id="tarifEdit" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <label for="tglBeli">Tanggal Perolehan</label>
                                <input type="text" name="tglBeli" id="tglBeli" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input placeholder="Jumlah" type="number" name="jumlah" id="jumlah" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                            <div class="col">
                                <input placeholder="Harga Beli (Rp.)" type="number" name="harga" id="harga" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                            <div class="col">
                                <input readonly placeholder="Nilai Residu" type="number" name="nilaiResiduEdit" id="nilaiResiduEdit" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                            <div class="col">
                                <input placeholder="Nilai Jumlah (Rp.)" readonly type="text" name="nilaiJumlahEdit" id="nilaiJumlahEdit" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="ubah">
                        <i class="fas fa-save" style="margin-right: 10px;"></i>Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <a href="indexOp.php" class="btn btn-info btn-lg active" role="button" style="margin-bottom: 5px;">
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
            <!-- Button trigger modal -->
            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#lapAddModal" data-whatever="@mdo">
                <i class="fas fa-plus"></i> Tambah
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
                            <th colspan="2">Opsi</th>
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
                                <td>
                                    <button type="button" title="Edit" class='btn btn-success editAsetBtn'><i class="fas fa-edit"></i>
                                    </button>
                                </td>
                                <td>
                                    <a type="button" title="Hapus" class='btn btn-danger' href="deleteAset.php?kode_aset=<?= $brs["kode_aset"]; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini');"><i class="fas fa-trash"></i>
                                    </a>
                                </td>
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
                                <td><?= $brs["jmlh_bln_sst"] ?></td>
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

<?php
include 'template/footer.php';
?>