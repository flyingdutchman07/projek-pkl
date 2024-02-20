<?php

require_once './koneksi.php';

$kodeBrg = $_POST['kodeBrg'];
$namaBrg = $_POST['namaBrg'];
$unitBrg = $_POST['unitBrg'];
$statusStok = $_POST['statusStok'];

for($i = 0; $i < sizeof($namaBrg); $i++){
    $insert = mysqli_query($conn,"INSERT INTO barang_db (`kode_barang`, `nama_barang`, `unit_barang`,`status_stok`) VALUES ('$kodeBrg[$i]', '$namaBrg[$i]', '$unitBrg[$i]', '$statusStok[$i]')");
}

if($insert){
    echo "<script>alert('Insert Data Berhasil!'); location='../cekstok.php'</script>";
}

?>