<?php
$knk = mysqli_connect("localhost", "root", "", "rekapan_data_aset");

//Cabang
function addBranch($query)
{
    global $knk; //artinya variabel knk adalah variabel global/sama dengan variabel koneksi
    $result = mysqli_query($knk, $query);
    $rows   = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
function SearchCbg($aa)
{
    $cari = "SELECT * FROM cabang WHERE
            kode_cabang LIKE '%$aa%' OR
            nama_cabang LIKE '%$aa%' OR
            alamat LIKE '%$aa%'
            ";
    return addBranch($cari);
}
function addCbg($a)
{
    global $knk;

    $kode  = htmlspecialchars($a["idBranch"]);
    $name = htmlspecialchars($a["nameBranch"]);
    $address = htmlspecialchars($a["address"]);
    $insert = "INSERT INTO cabang(kode_cabang,nama_cabang,alamat) VALUES ('$kode','$name','$address')";
    mysqli_query($knk, $insert);
    return mysqli_affected_rows($knk);
}
function delBranch($id)
{
    global $knk;
    $del = "DELETE FROM cabang WHERE kode_cabang = '$id'";
    mysqli_query($knk, $del);
    return mysqli_affected_rows($knk);
}
function editBranch($aC)
{

    global $knk;
    $id    = htmlspecialchars($aC["kode"]);
    $name  = htmlspecialchars($aC["name"]);
    $address = htmlspecialchars($aC["adr"]);
    $edit  = "UPDATE cabang SET 
                nama_cabang  = '$name',
                alamat = '$address'
                WHERE 
                kode_cabang  = '$id'";
    mysqli_query($knk, $edit);
    return mysqli_affected_rows($knk);
}

//Kas
function allKas($query)
{
    global $knk; //artinya variabel knk adalah variabel global/sama dengan variabel koneksi
    $result = mysqli_query($knk, $query);
    $rows   = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
function SearchKanKas($aa)
{
    $cari = "SELECT * FROM kantor_kas WHERE
            id_kas LIKE '%$aa%' OR
            kode_cabang LIKE '%$aa%' OR
            nama_kantorKas LIKE '%$aa%' OR
            alamat LIKE '%$aa%'
            ";
    return allKas($cari);
}
function addKas($a)
{
    global $knk;

    $totalData = htmlspecialchars($a["total"]);
    for ($i = 1; $i <= $totalData; $i++) {
        $kCbg  = htmlspecialchars($a["kodeCbg-" . $i]);
        $id = htmlspecialchars($a["idKas-" . $i]);
        $name = htmlspecialchars($a["nameKas-" . $i]);
        $address = htmlspecialchars($a["address-" . $i]);
        $insert = "INSERT INTO kantor_kas(id_kas,kode_cabang,nama_kantorKas,alamat) VALUES ('$id','$kCbg','$name','$address')";
        mysqli_query($knk, $insert);
    }
    return mysqli_affected_rows($knk);
}
function delKas($id)
{
    global $knk;
    $del = "DELETE FROM kantor_kas WHERE id_kas = '$id'";
    mysqli_query($knk, $del);
    return mysqli_affected_rows($knk);
}
function editKas($aC)
{

    global $knk;
    $KB  = htmlspecialchars($aC["KC"]);
    $id = htmlspecialchars($aC["IKA"]);
    $nameK = htmlspecialchars($aC["name"]);
    $address = htmlspecialchars($aC["addressKas"]);
    $edit  = "UPDATE kantor_kas SET 
                kode_cabang  = '$KB',
                nama_kantorKas = '$nameK',
                alamat = '$address'
                WHERE 
                id_kas  = '$id'";
    mysqli_query($knk, $edit);
    return mysqli_affected_rows($knk);
}

//Laporan
function lapo($query)
{
    global $knk; //artinya variabel knk adalah variabel global/sama dengan variabel koneksi
    $result = mysqli_query($knk, $query);
    $rows   = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
function carilap($aa)
{
    $cari = "SELECT * FROM report WHERE
            id LIKE '%$aa%' OR
            nama_kankas LIKE '%$aa%' OR
            nama_laporan LIKE '%$aa%' OR
            periode Like '%$aa%'
            ";
    return lapo($cari);
}
function createLapAdmin($a)
{
    global $knk;

    $idLap  = htmlspecialchars($a["noLap"]);
    $awlPer = htmlspecialchars($a["tglStart"]);
    $akrPer = htmlspecialchars($a["tglEnd"]);
    $perio = $awlPer . ' - ' . $akrPer;
    $name = htmlspecialchars($a["nameLap"]);
    $cbg = htmlspecialchars($a["nama_cabang"]);
    $ks = htmlspecialchars($a["kks"]);
    $insert = "INSERT INTO report(id,nama_laporan,periode,nama_cbg,nama_kankas) 
    VALUES ('$idLap','$name','$perio','$cbg','$ks')";
    //var_dump($insert);die;
    mysqli_query($knk, $insert);
    return mysqli_affected_rows($knk);
}
function createLap($a)
{
    global $knk;

    $nmCabang = htmlspecialchars($a["cabang"]);
    $idUser = htmlspecialchars($a["iduser"]);
    $nmKas = htmlspecialchars($a["kas"]);
    $idLap  = htmlspecialchars($a["noLap"]);
    $awlPer = htmlspecialchars($a["tglStart"]);
    $akrPer = htmlspecialchars($a["tglEnd"]);
    $perio = $awlPer . ' - ' . $akrPer;
    $name = htmlspecialchars($a["nameLap"]);
    //    $cbg = htmlspecialchars($a["nama_cabang"]);
    //$ks = htmlspecialchars($a["kks"]);
    $insert = "INSERT INTO report(id,id_user,nama_cbg,nama_kankas,nama_laporan,periode) 
    VALUES ('$idLap','$idUser','$nmCabang','$nmKas','$name','$perio')";
    //var_dump($insert);die;
    mysqli_query($knk, $insert);
    return mysqli_affected_rows($knk);
}
function delLapo($idL)
{
    global $knk;
    $jumAset = count(Allaset("SELECT * FROM aset WHERE id_lprn = $idL"));
    if ($jumAset > 0) {
        $del2 = "DELETE FROM aset WHERE id_lprn = '$idL'";
        mysqli_query($knk, $del2);
        $del = "DELETE FROM report WHERE id = '$idL'";
        mysqli_query($knk, $del);
    } else {
        $del = "DELETE FROM report WHERE id = '$idL'";
        mysqli_query($knk, $del);
    }
    return mysqli_affected_rows($knk);
}
function editLap($aC)
{

    global $knk;
    $idUsers = htmlspecialchars($aC["iduserEDT"]);
    $kanCBG = htmlspecialchars($aC["cabangEDT"]);
    $kanKAS = htmlspecialchars($aC["kasEDT"]);
    $NoLap  = htmlspecialchars($aC["noLapEDIT"]); //no edit
    $ts = htmlspecialchars($aC["tStart"]);
    $te = htmlspecialchars($aC["tEnd"]);
    $perio = $ts . ' - ' . $te;
    $lapName = htmlspecialchars($aC["tit"]);
    $edit  = "UPDATE report SET 
                id_user = '$idUsers',
                nama_cbg  = '$kanCBG',
                nama_kankas = '$kanKAS',
                nama_laporan = '$lapName',
                periode = '$perio'
                WHERE 
                id  = '$NoLap'";
    mysqli_query($knk, $edit);
    return mysqli_affected_rows($knk);
}

//Aset
function Allaset($query)
{
    global $knk; //artinya variabel knk adalah variabel global/sama dengan variabel koneksi
    $result = mysqli_query($knk, $query);
    $rows   = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
function addAset($a)
{
    global $knk;
    $idLaporan = $_GET["id"];
    $allLap = lapo("SELECT * FROM report WHERE id = '$idLaporan'")[0];
    $idLaporan = $allLap['id'];
    $periode = $allLap['periode'];
    $periode   = explode(" - ", $periode);
    $periode1 = $periode[0];
    $periode2 = $periode[1];
    $periode1   = explode('/', $periode1);
    $periode2 = explode('/', $periode2);

    $idINV = htmlspecialchars($a["IdAset"]);
    $nmINV  = htmlspecialchars($a["nameINV"]);
    $cabang = htmlspecialchars($a["kodeCbg"]);
    $nmKAS = htmlspecialchars($a["kodeKas"]);
    $categori = htmlspecialchars($a["categori"]);
    $jenis = htmlspecialchars($a["jenis"]);

    $pajak = htmlspecialchars($a["pajak"]);
    $allValuePajak = AllAmor("SELECT * FROM amortisasi WHERE kelompok='$pajak'")[0];
    $umurEKO = htmlspecialchars($a["masaManfaat"]); //number
    $trfSST = htmlspecialchars($a["tarif"]); //Hitung Tarif Penyusutan

    $tglSek =  date("Y/m/d");
    $date = new DateTime("" . $tglSek);
    $tglSekarang  = explode('/', $tglSek);

    $tglPerolehan = htmlspecialchars($a["tglPRL"]);
    $tglPer  = explode('/', $tglPerolehan);

    $jumlah = htmlspecialchars($a["qty"]); //number
    $harga = intval(htmlspecialchars($a["sold"])); //number

    $nilaiRESIDU = htmlspecialchars($a["nilaiResidu"]); //numbers
    //var_dump("Nilai residu : $nilaiRESIDU");die;

    $thnHbs = $tglPer[2] + $umurEKO; //Hitung Tahun Habis Masa Pakai
    $tglHbsUmur  = $tglPer[0] . "/" . $tglPer[1] . "/" . $thnHbs;
    $nilaiJumlah = htmlspecialchars($a["nilaiJumlah"]); //Hitung Nilai Jumlah
    $blnTHNpertama = 12 - $periode1[1]; //Hitung Jumlah Bulan di Tahun Pertama
    $ttlBlnSST = 12 * $umurEKO;
    if (is_null($tglPerolehan)) { //Hitung sisa bulan susut & jumlah bulan susut
        $SISAblnSUSUT = 0;
        $JUMLAHblnSUSUT = 0;
    } else {
        $SISAblnSUSUT = $ttlBlnSST;
        $tglbli = $tglPer[2] . "/" . $tglPer[1] . "/" . $tglPer[0];
        $tglbeli = new DateTime("" . $tglbli);
        $selisih = $tglbeli->diff($date);
        $JUMLAHblnSUSUT = $selisih->m + $selisih->y * 12;
        $SISAblnSUSUT = $SISAblnSUSUT - $JUMLAHblnSUSUT;
        if ($SISAblnSUSUT < 0) {
            $SISAblnSUSUT = 0;
        }
        //var_dump($SISAblnSUSUT);die;
    }

    if (($umurEKO * 12) >= $JUMLAHblnSUSUT) { //Hitung penyusutan per bulan
        if ($JUMLAHblnSUSUT == 0) {
            $sstPERbulan = 0;
        } else {
            $sstPERbulan = round(($nilaiJumlah - $nilaiRESIDU) / ($umurEKO * 12));
        }
    } else {
        $sstPERbulan = round(($nilaiJumlah - $nilaiRESIDU) / ($umurEKO * 12));
    }
    //Hitung Kolom kosong
    if ($JUMLAHblnSUSUT == 0) {
        $rwKOSONG = 0;
    } else {
        $rwKOSONG = round(($nilaiJumlah - $nilaiRESIDU) / ($umurEKO * 12));
    }

    //Hitung penyusutan per tahun
    $penyusutanPERthn = ($harga - $nilaiRESIDU) / $umurEKO;
    //Hitung sisa nilai punyusutan
    if ($JUMLAHblnSUSUT > $ttlBlnSST) {
        $SISAnliSUSUT = 0;
    } else {
        $SISAnliSUSUT = round(($nilaiJumlah - $nilaiRESIDU) - ($rwKOSONG * $JUMLAHblnSUSUT));
    }
    //hitung sisa nilai buku
    if ($SISAnliSUSUT >= $nilaiRESIDU) {
        $NILAIBUKU = round($nilaiJumlah - ($rwKOSONG * $JUMLAHblnSUSUT));
    } else {
        $NILAIBUKU = $nilaiRESIDU;
    }

    $insert = "INSERT INTO aset(kode_aset,id_lprn,nama_aset,cabang,kantor_kas,kategori,jenis,type_pajak,tgl_beli,jumlah,harga_beli,
        nilai_jumlah,umur_eko,tgl_hbs_sst,nilai_residu,tarif_penyusutan,jmlh_bln_thn_prtma,ttl_BLN_sst,jmlh_bln_sst,sisa_bln_sst,
        pnystn_perBulan,row_kosong,pnystan_tahun,ssa_nlai_pnystan,nilai_buku)
        VALUES ('$idINV','$idLaporan','$nmINV','$cabang','$nmKAS','$categori','$jenis','$pajak','$tglPerolehan','$jumlah','$harga',
        '$nilaiJumlah','$umurEKO','$tglHbsUmur','$nilaiRESIDU','$trfSST','$blnTHNpertama','$ttlBlnSST','$JUMLAHblnSUSUT','$SISAblnSUSUT',
        '$sstPERbulan','$rwKOSONG','$penyusutanPERthn','$SISAnliSUSUT','$NILAIBUKU')";

    mysqli_query($knk, $insert) or die(mysqli_error($knk));
    return mysqli_affected_rows($knk);
}
function editAset($a)
{
    global $knk;
    $idLaporan = $_GET["id"];
    $allLap = lapo("SELECT * FROM report WHERE id = '$idLaporan'")[0];
    $idLaporan = $allLap['id'];
    $periode = $allLap['periode'];
    $periode   = explode(" - ", $periode);
    $periode1 = $periode[0];
    $periode2 = $periode[1];
    $periode1   = explode('/', $periode1);
    $periode2 = explode('/', $periode2);

    $idINV = htmlspecialchars($a["asetID"]);
    $nmINV  = htmlspecialchars($a["INVnm"]);
    $cabang = htmlspecialchars($a["cabang"]);
    $nmKAS = htmlspecialchars($a["kas"]);
    $categori = htmlspecialchars($a["kate"]);
    $jenis = htmlspecialchars($a["jns"]);

    $pajak = htmlspecialchars($a["pjk"]);
    $allValuePajak = AllAmor("SELECT * FROM amortisasi WHERE kelompok='$pajak'")[0];
    $umurEKO = htmlspecialchars($a["masaManfaatEdit"]); //number
    $trfSST = htmlspecialchars($a["tarifEdit"]); //Hitung Tarif Penyusutan

    $tglsek =  date("Y/m/d");
    $date = new DateTime("" . $tglsek);
    $tglSekarang  = explode('/', $tglsek);

    $tglPerolehan = htmlspecialchars($a["tglBeli"]);
    $tglPer   = explode('/', $tglPerolehan);

    $jumlah = htmlspecialchars($a["jumlah"]); //number
    $harga = htmlspecialchars($a["harga"]); //number
    $nilaiRESIDU = htmlspecialchars($a["nilaiResiduEdit"]);

    $thnHbs = $tglPer[2] + $umurEKO; //Hitung Tahun Habis Masa Pakai

    $tglHbsUmur  = $tglPer[0] . "/" . $tglPer[1] . "/" . $thnHbs;
    $nilaiJumlah = htmlspecialchars($a["nilaiJumlahEdit"]); //Hitung Nilai Jumlah
    $blnTHNpertama = 12 - $periode1[1]; //Hitung Jumlah Bulan di Tahun Pertama

    $ttlBlnSST = 12 * $umurEKO;
    if (is_null($tglPerolehan)) { //Hitung sisa bulan susut & jumlah bulan susut
        $SISAblnSUSUT = 0;
        $JUMLAHblnSUSUT = 0;
    } else {
        $SISAblnSUSUT = $ttlBlnSST;
        $tglbli = $tglPer[2] . "/" . $tglPer[1] . "/" . $tglPer[0];
        $tglbeli = new DateTime("" . $tglbli);
        $selisih = $tglbeli->diff($date);
        $JUMLAHblnSUSUT = $selisih->m + $selisih->y * 12;
        $SISAblnSUSUT = $SISAblnSUSUT - $JUMLAHblnSUSUT;
        if ($SISAblnSUSUT < 0) {
            $SISAblnSUSUT = 0;
        }
    }

    if (($umurEKO * 12) >= $JUMLAHblnSUSUT) { //Hitung penyusutan per bulan
        if ($JUMLAHblnSUSUT == 0) {
            $sstPERbulan = 0;
        } else {
            $sstPERbulan = round(($nilaiJumlah - $nilaiRESIDU) / ($umurEKO * 12));
        }
    } else {
        $sstPERbulan = round(($nilaiJumlah - $nilaiRESIDU) / ($umurEKO * 12));
    }
    //Hitung Kolom kosong
    if ($JUMLAHblnSUSUT == 0) {
        $rwKOSONG = 0;
    } else {
        $rwKOSONG = round(($nilaiJumlah - $nilaiRESIDU) / ($umurEKO * 12));
    }

    //Hitung penyusutan per tahun
    $penyusutanPERthn = ($harga - $nilaiRESIDU) / $umurEKO;
    //Hitung sisa nilai punyusutan
    if ($JUMLAHblnSUSUT > $ttlBlnSST) {
        $SISAnliSUSUT = 0;
    } else {
        $SISAnliSUSUT = round(($nilaiJumlah - $nilaiRESIDU) - ($rwKOSONG * $JUMLAHblnSUSUT));
    }
    //hitung sisa nilai buku
    if ($SISAnliSUSUT > $nilaiRESIDU) {
        $NILAIBUKU = round($nilaiJumlah - ($rwKOSONG * $JUMLAHblnSUSUT));
    } else {
        $NILAIBUKU = $nilaiRESIDU;
    }
    if ($NILAIBUKU < 0) {
        $NILAIBUKU = 0;
    }


    $edit  = "UPDATE aset SET 
            nama_aset  = '$nmINV', cabang = '$cabang', kantor_kas = '$nmKAS', kategori = '$categori', jenis = '$jenis', type_pajak = '$pajak',
            tgl_beli  = '$tglPerolehan', jumlah = '$jumlah', harga_beli = '$harga', nilai_jumlah = '$nilaiJumlah', umur_eko = '$umurEKO', tgl_hbs_sst = '$tglHbsUmur',
            nilai_residu  = '$nilaiRESIDU', tarif_penyusutan = '$trfSST', jmlh_bln_thn_prtma = '$blnTHNpertama', ttl_BLN_sst = '$ttlBlnSST',
            jmlh_bln_sst  = '$JUMLAHblnSUSUT', sisa_bln_sst = '$SISAblnSUSUT', pnystn_perBulan = '$sstPERbulan', row_kosong = '$rwKOSONG',
            pnystan_tahun  = '$penyusutanPERthn', ssa_nlai_pnystan = '$SISAnliSUSUT', nilai_buku = '$NILAIBUKU'
            WHERE 
            kode_aset  = '$idINV'";

    mysqli_query($knk, $edit);
    return mysqli_affected_rows($knk);
}
function delAset($id)
{
    global $knk;
    $del = "DELETE FROM aset WHERE kode_aset = '$id'";
    mysqli_query($knk, $del);
    return mysqli_affected_rows($knk);
}
function SearchASET($aa)
{
    $cari = "SELECT * FROM aset WHERE
        kode_aset LIKE '%$aa%' OR id_lprn LIKE '%$aa%' OR nama_aset LIKE '%$aa%' OR cabang LIKE '%$aa%' OR 
        kantor_kas LIKE '%$aa%' OR kategori LIKE '%$aa%' OR jenis LIKE '%$aa%' OR type_pajak LIKE '%$aa%' OR 
        tgl_beli LIKE '%$aa%' OR jumlah LIKE '%$aa%' OR harga_beli LIKE '%$aa%' OR nilai_jumlah LIKE '%$aa%' OR 
        umur_eko LIKE '%$aa%' OR tgl_hbs_sst LIKE '%$aa%' OR nilai_residu LIKE '%$aa%' OR tarif_penyusutan LIKE '%$aa%' OR 
        jmlh_bln_thn_prtma LIKE '%$aa%' OR ttl_BLN_sst LIKE '%$aa%' OR jmlh_bln_sst LIKE '%$aa%' OR sisa_bln_sst LIKE '%$aa%' OR 
        pnystn_perBulan LIKE '%$aa%' OR row_kosong LIKE '%$aa%' OR pnystan_tahun LIKE '%$aa%' OR ssa_nlai_pnystan LIKE '%$aa%' OR 
        nilai_buku LIKE '%$aa%'
        ";
    return Allaset($cari);
}


function daftar($d)
{
    global $knk;
    $lvlUS = htmlspecialchars($d['level']);
    $nama = htmlspecialchars($d['username']);
    $user = strtolower(stripslashes($d["username"]));
    $pass = mysqli_real_escape_string($knk, $d["password1"]);
    $pass2 = mysqli_real_escape_string($knk, $d["password2"]);
    $cabang = htmlspecialchars($d['cabang']);;
    $kas = htmlspecialchars($d['kas']);;
    $ambil = mysqli_query($knk, "SELECT username FROM users WHERE username = '$user'");
    if (mysqli_fetch_assoc($ambil)) {
        echo "<script>
                    alert('Ganti Nama. Username Telah Digunakan');
                    </script>";
        return false;
    }

    if ($pass !== $pass2) {
        echo "<script>
                    alert('Password tidak sesuai');
                    </script>";
        return false;
    }
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $query = "INSERT INTO users VALUES('','$lvlUS','$user','$pass','$nama','$cabang','$kas')";
    mysqli_query($knk, $query);
    return mysqli_affected_rows($knk);
}
function changeProfile($d)
{
    global $knk;
    $user = strtolower(stripslashes($d["username"]));
    $pass = mysqli_real_escape_string($knk, $d["password1"]);
    $pass2 = mysqli_real_escape_string($knk, $d["password2"]);
    $ambil = mysqli_query($knk, "SELECT username FROM users WHERE username = '$user'");
    if (mysqli_fetch_assoc($ambil) <= 0) {
        echo "<script>
                    alert('Username Tidak Terdaftar');
                    </script>";
        return false;
    }

    if ($pass !== $pass2) {
        echo "<script>
                    alert('Password tidak sesuai');
                    </script>";
        return false;
    }
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET password = '$pass' WHERE username = '$user'";
    mysqli_query($knk, $sql);
    return mysqli_affected_rows($knk);
}
function ubahPasswordOperator($d)
{
    global $knk;
    $user = strtolower(stripslashes($d["username"]));
    $pass = mysqli_real_escape_string($knk, $d["newpassword1"]);
    $pass2 = mysqli_real_escape_string($knk, $d["newpassword2"]);
    $ambil = mysqli_query($knk, "SELECT username FROM users WHERE username = '$user'");
    if (mysqli_fetch_assoc($ambil) <= 0) {
        echo "<script>
                    alert('Username Tidak Terdaftar');
                    </script>";
        return false;
    }

    if ($pass !== $pass2) {
        echo "<script>
                    alert('Password tidak sesuai');
                    </script>";
        return false;
    }
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET password = '$pass' WHERE username = '$user'";
    mysqli_query($knk, $sql);
    return mysqli_affected_rows($knk);
}


//Amortisasi
function AllAmor($query)
{
    global $knk; //artinya variabel knk adalah variabel global/sama dengan variabel koneksi
    $result = mysqli_query($knk, $query);
    $rows   = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
function addAmor($a)
{
    global $knk;

    $kel = htmlspecialchars($a["kelompok"]);
    $Masa  = htmlspecialchars($a["masa"]);
    $Tarif = htmlspecialchars($a["Tarif"]);
    $insert = "INSERT INTO amortisasi(id,kelompok,masa,tarif) VALUES ('','$kel','$Masa','$Tarif')";
    mysqli_query($knk, $insert);
    return mysqli_affected_rows($knk);
}
function editAmor($aC)
{

    global $knk;
    $id    = htmlspecialchars($aC["id"]);
    $kelom  = htmlspecialchars($aC["kel"]);
    $masa  = htmlspecialchars($aC["mas"]);
    $tari = htmlspecialchars($aC["tar"]);
    $edit  = "UPDATE amortisasi SET 
                kelompok  = '$kelom',
                masa = '$masa',
                tarif = '$tari'
                WHERE 
                id  = '$id'";
    mysqli_query($knk, $edit);
    return mysqli_affected_rows($knk);
}
function delAmor($id)
{
    global $knk;
    $del = "DELETE FROM amortisasi WHERE id = '$id'";
    mysqli_query($knk, $del);
    return mysqli_affected_rows($knk);
}
function SearchAmor($aa)
{
    $cari = "SELECT * FROM amortisasi WHERE
            id LIKE '%$aa%' OR
            kelompok LIKE '%$aa%' OR
            masa LIKE '%$aa%' OR
            tarif LIKE '%$aa%'
            ";
    return allAmor($cari);
}


//Search Aset Yang habis masa susut
function SearchASETnull($aa)
{
    $nol = 0;
    $cari = "SELECT * FROM aset WHERE sisa_bln_sst <= $nol AND
    kode_aset LIKE '%$aa%' OR id_lprn LIKE '%$aa%' OR nama_aset LIKE '%$aa%' OR cabang LIKE '%$aa%' OR 
    kantor_kas LIKE '%$aa%' OR kategori LIKE '%$aa%' OR jenis LIKE '%$aa%' OR type_pajak LIKE '%$aa%' OR 
    tgl_beli LIKE '%$aa%' OR jumlah LIKE '%$aa%' OR harga_beli LIKE '%$aa%' OR nilai_jumlah LIKE '%$aa%' OR 
    umur_eko LIKE '%$aa%' OR tgl_hbs_sst LIKE '%$aa%' OR nilai_residu LIKE '%$aa%' OR tarif_penyusutan LIKE '%$aa%' OR 
    jmlh_bln_thn_prtma LIKE '%$aa%' OR ttl_BLN_sst LIKE '%$aa%' OR jmlh_bln_sst LIKE '%$aa%' OR sisa_bln_sst LIKE '%$aa%' OR 
    pnystn_perBulan LIKE '%$aa%' OR row_kosong LIKE '%$aa%' OR pnystan_tahun LIKE '%$aa%' OR ssa_nlai_pnystan LIKE '%$aa%' OR 
    nilai_buku LIKE '%$aa%'
    ";
    return Allaset($cari);
}

function epI($semri)
{
    $key1 = password_hash($semri, PASSWORD_DEFAULT);
    $key2 = "nokin";
    $key3 = $semri;
    $idenq = $key1 . $key2 . $key3;
    return $idenq;
}
