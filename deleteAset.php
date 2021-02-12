<?php
include 'template/header.php';

$idL = $_GET["kode_aset"];
$iduser = $_SESSION["login"];
$akun = addBranch("SELECT * FROM report WHERE id_user = $iduser")[0];
$noLaporan = $akun["id"];
//var_dump($noLaporan);die;

if (delAset($idL) > 0) { //delbarg = nama fungsi untuk hapus
	echo "
	<script>
		alert('Data berhasil dihapus');
		document.location.href = 'indexAset.php?id=$noLaporan';
	</script>
	";
} else {
	echo "
	<script>
		alert('Data gagal dihapus');
		document.location.href = 'indexAset.php?id=$noLaporan'';
	</script>
	";
}
