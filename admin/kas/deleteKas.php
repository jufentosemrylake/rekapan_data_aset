<?php
require '../function.php';

$id = $_GET["id_kas"];

if(delKas($id) > 0 ){//delbarg = nama fungsi untuk hapus
	echo "
	<script>
		alert('Data berhasil dihapus');
		document.location.href = 'indexKas.php';
	</script>
	";
}else{
	echo "
	<script>
		alert('Data gagal dihapus');
		document.location.href = 'indexKas.php';
	</script>
	";
}

?>