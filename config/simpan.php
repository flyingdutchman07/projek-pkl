<?php

require("../config/koneksi.php");

// Simpan status ceklis terbaru
if (isset($_POST['simpanStatus'])) {
    $stocks = $_POST['stock'];
    foreach ($stocks as $key => $value) {
        $sql = "UPDATE barang_db SET status_stok = '$value' WHERE id = '$key'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Data berhasil disimpan!');location='../cekstok.php'</script>";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}

?>