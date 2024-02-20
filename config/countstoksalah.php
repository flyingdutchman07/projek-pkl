<?php

include(__DIR__ . '/koneksi.php');

// Hitung jumlah data
$que_get_stoksalah = "SELECT COUNT(*) as total FROM barang_db WHERE status_stok = 'Stok Salah'";
$result = $conn->query($que_get_stoksalah);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalStokSalah = $row['total'];
} else {
    $totalStokSalah = 0;
}

// Get total data keseluruhan
$que_total_stoksalah = "SELECT COUNT(*) as total FROM barang_db";
$result = $conn->query($que_total_stoksalah);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalEntries = $row['total'];
} else {
    $totalEntries = 0;
}

// Hitung presentase
if ($totalEntries > 0) {
    $percentage = ($totalStokSalah / $totalEntries) * 100;
    $percentage = round($percentage);
} else {
    $percentage = 0;
}

?>