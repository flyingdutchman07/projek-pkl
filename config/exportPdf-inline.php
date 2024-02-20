<?php

require_once('../config/koneksi.php'); // Include file koneksi

if (isset($_GET['id_laporan'])) {
    $id = $_GET['id_laporan'];
    // Query download pdf by id
    $que_downPdf = "SELECT laporan_pdf, laporan_nama FROM cetaklaporan_db WHERE id_laporan = ?";
    $stmt = $conn->prepare($que_downPdf);
    $stmt->bind_Param("i", $id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $laporan_nama = $row['laporan_nama'];
                $pdf_base64 = $row['laporan_pdf'];

                $laporan_pdf = base64_decode($pdf_base64);
                header('Content-type: application/pdf');
                header('Content-Disposition: inline; filename="' . $laporan_nama . '"');
                header('Content-Length: ' . strlen($laporan_pdf));
                echo $laporan_pdf;
                exit;
            }
        } else {
            echo "<script>alert('File tidak ditemukan')</script>";
        }
    } else {
        echo "Error";
    }

} else {
    echo "ID Parameter hilang";
}

?>