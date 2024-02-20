<?php
// Mengambil data dari database
require_once('./config/koneksi.php');
require_once('./config/countstoksalah.php');

$que = 'SELECT * FROM barang_db ORDER BY id ASC';
$que_persentase = 'SELECT laporan_persentase, laporan_created FROM cetaklaporan_db ORDER BY laporan_created DESC LIMIT 1';

$res_persentase = mysqli_query($conn, $que_persentase);
$res = mysqli_query($conn, $que);

$isi = false;
$i = 1;
?>

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Barang</h3>
    <div class="card-tools">
      <div class="input-group input-group-sm">
        <div class="col d-flex flex-row-reverse gap-1">
          <!-- Tombol hapus all data -->
          <button type="button" onclick="deleteAllData()" class="btn btn-danger me-0"><i class="fa-solid fa-trash"
              style="color: #ffffff;"></i></i></button>
          <!-- Tombol impor excel -->
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default"><i
              class="fa-solid fa-file-excel" style="color: #ffffff;"></i></button>
          <!-- Tombol insert multiple data -->
          <a href="./form-insert.php" class="btn btn-info"><i
              class="fa-solid fa-plus" style="color: #ffffff;"></i></a>
        </div>
        <div class="input-group-append">
        </div>
      </div>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <thead>
        <tr>
          <th>#</th>
          <th>Kode Barang</th>
          <th>Nama Barang</th>
          <th>Unit</th>
          <th>Qty</th>
          <th>Ceklis</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <form action="./config/simpan.php" method="post">
        <tbody>
          <tr>
            <?php
            while ($row = mysqli_fetch_assoc($res)) {
              $isi = true;
              ?>
              <td> <!-- Nomer -->
                <?php echo $i++ ?>
              </td>
              <td> <!-- Kode barang -->
                <?php echo $row['kode_barang'] ?>
              </td>
              <td> <!-- Nama barang -->
                <?php echo $row['nama_barang'] ?>
              </td>
              <td> <!-- Unit barang -->
                <?php echo $row['unit_barang'] ?>
              </td>
              <td> <!-- Stok data -->
                <?php echo $row['stok_data'] ?>
              </td>
              <td> <!-- Ceklis -->
                    <?php
                    echo "<input type='checkbox' name='stock[" . $row['id'] . "]' value='Stok Salah' ";
                    if ($row['status_stok'] == "Stok Salah") {
                      echo "checked";
                    }
                    ?>
              </td>
              <td>
                <!-- Tombol hapus data by id -->
                <button type="button" name="" onclick="deleteData(<?php echo $row['id']; ?>)" class="btn btn-danger"><i
                    class="fa-solid fa-trash-arrow-up" style="color: #ffffff;"></i></button>
                <!-- Tombol edit by id -->
                <a href="./form-update.php?id=<?php echo $row['id'] ?>" class="btn btn-warning"><i
                    class="fa-solid fa-pen" style="color: #ffffff;"></i></a>
              </td>
            </tr>
            <?php
            }
            if (!$isi) {
              echo "<tr>
                    <td colspan='7'>Data Kosong
                    </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
  </div>
  <div class="mt-2 mb-0 mr-2 ml-3 fw-bold"><em>Jika ada perubahan dalam data, Jangan lupa untuk klik <span class="text text-primary fw-bold">SIMPAN DATA</span> terlebih dulu sebelum simpan laporan</em></div>
  <!-- Tombol simpan data -->
  <div class="col d-flex flex-row gap-2 p-0 mt-2 mb-2 mr-2 ml-3">
    <button type="submit" onclick="return konfirmasi()" name="simpanStatus" class="btn btn-primary mt-0"><i class="fa-solid fa-floppy-disk me-2 "
        style="color: #ffffff;"></i>Simpan Data</button>
    </form>
    <!-- Tombol simpan pdf (ke database) -->
    <form action="./config/exportPdf.php" method="post">
      <button type="submit" name="exportPdf-store" class="btn btn-warning mt-0"><i class="fa-solid fa-cloud-arrow-up me-2" style="color:#ffffff"></i>Simpan Laporan</button>
    </form>
  </div>
</div>

<!-- Modal upload excel mulai -->
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Form Upload Excel</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Form upload -->
        <form action="./config/imporexcel.php" method="post" enctype="multipart/form-data" class="">
          <div class="mb-3">
            <label for="formFile" class="form-label">Pilih file Excel untuk diupload</label>
            <input class="form-control" type="file" name="excelform" required data-parsley-type="file"
              data-parsley-trigger="keyup" accept=".csv, .xlsx, .xls">
            <p class="fst-italic mt-1">Format file yang diterima : XLSX, XLS, CSV</p>
          </div>
      </div>
      <div class="modal-footer">
        <!-- Form post + tombol upload -->
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark me-2" style="color: #ffffff;"></i>Batal</button>
        <button type="submit" name="imporexcel" class="btn btn-primary"><i class="fa-solid fa-upload me-2" style="color: #ffffff;"></i>Upload File</button>
        </form>
      </div>
    </div>
  </div>
</div>