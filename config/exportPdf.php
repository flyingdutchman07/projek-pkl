<?php 

session_start();

require_once("../vendor/autoload.php"); // Include MPDF
require_once("../config/koneksi.php"); // Include file koneksi database
require_once("../config/countstoksalah.php"); // Include file hitung presentase

// Cek apakah sesi user sesuai
if ($_SESSION['log'] != 'login') {
  header("location: ./loginpage.php");
}

// Fungsi simpan laporan pdf kedalam database
if(isset($_POST['exportPdf-store'])){
// Ngatur tanggal dan timezone
date_default_timezone_set('Asia/Jakarta');
setlocale(LC_ALL, 'id_ID.utf8');
$tgl = date('d-m-Y H:i:s');
$tglprint = date('dmY_His');
$tgl_stokAkhir = date('d-m-Y', strtotime('+1 day'));
$tgl_periode = date('d-m-Y', strtotime('+34 day'));

// Query menampilkan data
$que_ekspor_save = 'SELECT * FROM barang_db ORDER BY id ASC';
$hsl = mysqli_query($conn, $que_ekspor_save);

// Konten yang mau di print disini
$html = '

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Stock Cycle Count</title>
</head>
<body style="font-family: Arial">
<p style="font-weight: bold">
PT PIONEERINDO GOURMET INTERNATIONAL .TBK<br>
LAPORAN HASIL STOCK OPNAME DISTRIBUTION CENTER<br>
</p>
<p>
    NAMA DC : INDTIM SIDOARJO<br>
    TANGGAL PELAKSANAAN : ' . $tgl . '<br>
    UNTUK STOK AKHIR TGL : '. $tgl_stokAkhir .'<br>
    BERLAKU UNTUK PERIODE : '. $tgl_stokAkhir .' - '. $tgl_periode .' 
</p>
<table border="1" width="100%" cellspacing="0" cellpadding="10">
    <tr>
        <td style="background-color: #f0f2ff; font-weight: bold">No. </td>
        <td style="background-color: #f0f2ff; font-weight: bold">Kode Barang</td>
        <td style="background-color: #f0f2ff; font-weight: bold">Nama Barang</td>
        <td style="background-color: #f0f2ff; font-weight: bold">Unit</td>
        <td style="background-color: #f0f2ff; font-weight: bold">Stok Data</td>
        <td style="background-color: #f0f2ff; font-weight: bold">Status Stok</td>
    </tr>';
$num = 1;
foreach ($hsl as $row) {
    $html .= '
        <tr>
        <td>' . $num++ . '</td>
        <td>' . $row["kode_barang"] . '</td>
        <td>' . $row["nama_barang"] . '</td>
        <td>' . $row["unit_barang"] . '</td>
        <td>' . $row["stok_data"] . '</td>';
    $warnateks = '';
    if ($row['status_stok'] === 'Stok Salah') {
        $warnateks = 'color: #FF2E2E';
    }
    $html .= '
        <td style="'. $warnateks .'">' . $row["status_stok"] . '</td>
        </tr>
        ';
}

$html .= '
        <tr>
            <td colspan="6" style="color: #0000ff; font-weight: bold">Jumlah Data : '. $totalEntries .'</td>
        </tr>
        <tr>
            <td colspan="6" style="color: #ff2e2e; font-weight: bold">Jumlah presentase stok salah : '. $percentage .'%</td>
        </tr>
</table>

</body>

';

// Memakai fungsi MPDF dan buat fungsi print
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);

// Konversi file pdf menjadi format biner
$binerPdf = base64_encode($mpdf->Output('', \Mpdf\Output\Destination::STRING_RETURN));

// Simpan ke database dengan nama laporan_(Tanggal Cetak).pdf dan tanggal 
$laporan_nama = "Laporan_{$tglprint}.pdf";
$tgl_save = date('Y-m-d H:i:s');

// Query insert ke database
$que_insertPdf = "INSERT INTO cetaklaporan_db (laporan_pdf, laporan_nama, laporan_persentase, laporan_created) VALUES (?, ?, ?, ?)";

if ($stmt = $conn->prepare($que_insertPdf)) {
    $stmt->bind_param("ssss", $binerPdf, $laporan_nama, $percentage, $tgl_save);
    
    if ($stmt->execute()) {
        echo "<script>alert('Berhasil Menyimpan Laporan!'); location='../cekstok.php'</script>";
    } else {
        echo "<script>alert('Gagal Menyimpan Laporan'); location='../cekstok.php'</script>";
    }
} else {
    echo "Error: " . $conn->error;
}
        
}

// Fungsi download pdf sesuai dengan id
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
                header('Content-Disposition: attachment; filename="' . $laporan_nama . '"');
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