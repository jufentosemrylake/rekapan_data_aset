<?php
require '../function.php';

$id = $_GET["kode_cabang"];

if(delBranch($id) > 0 ){//delbarg = nama fungsi untuk hapus
	echo "
	<script>
		alert('Data berhasil dihapus');
		document.location.href = 'indexBranchOffice.php';
	</script>
	";
}else{
	echo "
	<script>
		alert('Data gagal dihapus');
		document.location.href = 'indexBranchOffice.php';
	</script>
	";
}

?>