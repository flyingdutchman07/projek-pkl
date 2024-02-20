<?php

require "../config/koneksi.php";
require "../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['imporexcel'])) {
    // Check if a file was uploaded
    if (isset($_FILES['excelform']['tmp_name']) && !empty($_FILES['excelform']['tmp_name'])) {
        $file = $_FILES['excelform']['tmp_name'];
        $ext = pathinfo($_FILES['excelform']['name'], PATHINFO_EXTENSION);

        // Check if the file extension is supported (xlsx, xls, or csv)
        if ($ext == 'xlsx' || $ext == 'xls' || $ext == 'csv') {
            $spreadsheet = IOFactory::load($file);
            $worksheet = $spreadsheet->getActiveSheet();
            $data = $worksheet->toArray();

            // Start from index 1 to skip the header row if it exists
            for ($i = 1; $i < count($data); $i++) {
                $kode_barang = $data[$i][0];
                $nama_barang = $data[$i][1];
                $unit_barang = $data[$i][2];
                $stok_data = $data[$i][3];
                $status_stok = $data[$i][4];

                // You should use prepared statements to avoid SQL injection
                $que_update = "INSERT INTO barang_db (kode_barang, nama_barang, unit_barang, stok_data, status_stok) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($que_update);
                $stmt->bind_param("sssss", $kode_barang, $nama_barang, $unit_barang, $stok_data, $status_stok);

                if ($stmt->execute()) {
                    echo "<script>alert('Data Berhasil Diimport');location='../cekstok.php'</script>";
                } else {
                    echo "Error terjadi : " . $stmt->error;
                }
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Format File Harus xlsx atau csv!</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">File belum diunggah!</div>';
    }
}

?>
