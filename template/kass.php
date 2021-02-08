<?php

require_once '../function.php';
$kode_cbg = $_POST['kode'];
$sql_kas = mysqli_query($knk,"SELECT * FROM kantor_kas where kode_cabang = $kode_cbg");
//var_dump($sql_kas);die;
echo '<option>--- Pilih Kantor Kas ---</option>';
while ($row_kas = mysqli_fetch_array($sql_kas)) {
    echo '<option value="'.$row_kas['nama_kantorKas'].'">'.$row_kas['nama_kantorKas'].'</option>';
}