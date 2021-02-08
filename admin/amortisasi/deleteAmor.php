<?php
require '../function.php';

$id = $_GET["id"];

if(delAmor($id) > 0 ){//delbarg = nama fungsi untuk hapus
	echo "
	<script>
		alert('Data berhasil dihapus');
		document.location.href = 'indexamor.php';
	</script>
	";
}else{
	echo "
	<script>
		alert('Data gagal dihapus');
		document.location.href = 'indexamor.php';
	</script>
	";
}

?>