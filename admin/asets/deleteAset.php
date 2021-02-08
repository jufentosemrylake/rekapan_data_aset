<?php
require '../function.php';

$idL = $_GET["kode_aset"];

if(delAset($idL) > 0 ){//delbarg = nama fungsi untuk hapus
	echo "
	<script>
		alert('Data berhasil dihapus');
	</script>
	";
}else{
	echo "
	<script>
		alert('Data gagal dihapus');
	</script>
	";
}
