<?php
    require '../../admin/function.php';
    $aa = $_GET["keyword"];
    $date =  date("Y/m/d");  $date = new DateTime("".$date);
    $nol = 0;
    $cari = "SELECT * FROM aset WHERE
        kode_aset LIKE '%$aa%' OR id_lprn LIKE '%$aa%' OR nama_aset LIKE '%$aa%' OR cabang LIKE '%$aa%' OR 
        kantor_kas LIKE '%$aa%' OR kategori LIKE '%$aa%' OR jenis LIKE '%$aa%' OR type_pajak LIKE '%$aa%' OR 
        tgl_beli LIKE '%$aa%' OR jumlah LIKE '%$aa%' OR harga_beli LIKE '%$aa%' OR nilai_jumlah LIKE '%$aa%' OR 
        umur_eko LIKE '%$aa%' OR tgl_hbs_sst LIKE '%$aa%' OR nilai_residu LIKE '%$aa%' OR tarif_penyusutan LIKE '%$aa%' OR 
        jmlh_bln_thn_prtma LIKE '%$aa%' OR ttl_BLN_sst LIKE '%$aa%' OR jmlh_bln_sst LIKE '%$aa%' OR sisa_bln_sst LIKE '%$aa%' OR 
        pnystn_perBulan LIKE '%$aa%' OR row_kosong LIKE '%$aa%' OR pnystan_tahun LIKE '%$aa%' OR ssa_nlai_pnystan LIKE '%$aa%' OR 
        nilai_buku LIKE '%$aa%'
        ";
    $asets = Allaset($cari);
?>


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
                
        <?php $no =1; ?>
        <?php foreach($asets as $brs) : ?>
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
                <td><?= number_format($brs["harga_beli"],0,',','.'); ?></td>
                <td><?= number_format($brs["nilai_jumlah"],0,',','.'); ?></td>
                <td><?= $brs["umur_eko"]; ?></td>
                <td><?= $brs["tgl_hbs_sst"]; ?></td>
                <td><?= number_format($brs["nilai_residu"],0,',','.'); ?></td>
                <td><?= $brs["tarif_penyusutan"]; ?>%</td>
                    <?php
                        $kdASET = $brs["kode_aset"];
                        $ssaBLNSSTnow = $brs["jmlh_bln_sst"];
                        
                        $tglbli = $brs["tgl_beli"];
                        $tglPer  = explode('/', $tglbli);
                        $tglbli = $tglPer[2]."/".$tglPer[1]."/".$tglPer[0];
                        $tglbeli = new DateTime("".$tglbli);
                        $selisih = $tglbeli->diff($date);
                        $bulansusut = $selisih->m + $selisih->y * 12;
                        $ttlblnsst = $brs["ttl_BLN_sst"];
                        $sisaBLNSusut = $ttlblnsst - $bulansusut;
                        //auto update
                        if ($ssaBLNSSTnow != $bulansusut) {
                            $edit  = "UPDATE aset SET 
                        jmlh_bln_sst  = '$bulansusut', sisa_bln_sst  = '$sisaBLNSusut', ttl_BLN_sst = '$ttlblnsst' WHERE kode_aset  = '$kdASET'";
                        mysqli_query($knk,$edit);
                        return mysqli_affected_rows($knk);
                    }
                    ?>
                <td><?= $brs["jmlh_bln_sst"] ?></td>
                <td><?= $brs["sisa_bln_sst"] ?></td>
                <td><?= number_format($brs["pnystn_perBulan"],0,',','.'); ?></td>
                <td><?= number_format($brs["pnystan_tahun"],0,',','.'); ?></td>
                <td><?= number_format($brs["ssa_nlai_pnystan"],0,',','.'); ?></td>
                <td><?= number_format($brs["nilai_buku"],0,',','.'); ?></td>
            </tr>
        <?php $no++; ?>
        <?php endforeach; ?>
    </tbody>
</table>