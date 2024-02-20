<?php

require "../config/koneksi.php";

$que_delete = "DELETE FROM barang_db";

if ($conn->query($que_delete) === TRUE) {
    echo "<script>alert('Seluruh data berhasil dihapus!');location='../cekstok.php'</script>";
} else {
    echo "<script>alert('Gagal menghapus data')</script>";
}

?>