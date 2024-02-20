<?php

require "../config/koneksi.php";

// Fungsi hapus data by ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM barang_db WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data Berhasil Dihapus!');location='../cekstok.php'</script>";
    } else {
        echo "Error! : " . $conn->error;
    }
}

// Fungsi hapus laporan pdf by ID
if (isset($_GET['id_laporan'])) {
    $id = $_GET['id_laporan'];
    $sql = "DELETE FROM cetaklaporan_db WHERE id_laporan = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Laporan Berhasil Dihapus!');location='../laporan-export.php'</script>";
    } else {
        echo "Error! : " . $conn->error;
    }
}

?>
