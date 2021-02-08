<?php
require 'admin/function.php';

$idL = $_GET["id"];

if(delLapo($idL) > 0 ){//delbarg = nama fungsi untuk hapus
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
