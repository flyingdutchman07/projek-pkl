<?php

require "../config/koneksi.php";

$que_delete = "DELETE FROM cetaklaporan_db";

if ($conn->query($que_delete) === TRUE) {
    echo "<script>alert('Seluruh laporan berhasil dihapus!');location='../laporan-export.php'</script>";
} else {
    echo "<script>alert('Gagal menghapus data')</script>";
}

?>