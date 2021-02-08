<?php
include 'template/header.php';
$iduser = $_SESSION["login"];
$date =  date("Y/m/d");
$date = new DateTime("" . $date);
$jumdatph = 50;
$jumAset = count(Allaset("SELECT * FROM aset WHERE sisa_bln_sst <= $nol "));
$jumhal = ceil($jumAset / $jumdatph);
$aktpage = (isset($_GET["page"])) ? $_GET["page"] : 1;
$dtawl = ($jumdatph * $aktpage) - $jumdatph;
$asets = Allaset("SELECT * FROM aset WHERE sisa_bln_sst <= $nol LIMIT $dtawl, $jumdatph");
if (isset($_POST["search"])) {
    $asets = SearchASETnull($_POST["katakunci"]);
}
$akun = addBranch("SELECT * FROM users WHERE id = $iduser")[0];
$kanCabang = addBranch("SELECT nama_cabang from cabang WHERE kode_cabang = $akun[lokasi_cbg]")[0];
?>
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Aset Yang Habis Masa Susut</h6>
        </div>
        <div class="card-body">
            <a class="btn mb-1" href="" style="border-color: black;">
                <i class="fas fa-fw fa-retweet"></i> Refresh
            </a>
            <br>
            <div id="tabelXaja">

                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr align="center">
                                <th>No</th>
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