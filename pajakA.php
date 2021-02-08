<?php

require_once 'admin/function.php';
$type = $_POST['kode'];
$sql_kas = mysqli_query($knk, "SELECT * FROM amortisasi where kelompok = $type");
$data = addBranch("SELECT * FROM amortisasi WHERE kelompok = '$type'")[0];
//var_dump($data);die;

echo '<option value="' . $data['masa'] . '">' . $data['masa'] . '</option>';
