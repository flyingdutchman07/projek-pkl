<?php
// Mengambil data dari database
require_once('./config/koneksi.php');
require_once('./config/countstoksalah.php');

$que = 'SELECT * FROM cetaklaporan_db ORDER BY id_laporan ASC';
$res = mysqli_query($conn, $que);
$isi = false;
$i = 1;
?>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Laporan</h3>
    <div class="card-tools">
      <div class="input-group input-group-sm">
        <div class="col d-flex">
          <!-- Tombol Hapus All Data -->
          <button type="button" onclick="deleteAllDataLaporan()" class="btn btn-danger me-0"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></i></button>
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
          <th>Nama Laporan</th>
          <th>Tanggal Laporan</th>
          <th>Persentase</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php
          while ($row = mysqli_fetch_assoc($res)) {
            $isi = true;
            ?>
            <td>
              <?php echo $i++ ?>
            </td>
            <td>
              <?php echo $row['laporan_nama'] ?>
            </td>
            <td>
              <?php echo $row['laporan_created'] ?>
            </td>
            <?php
            $warnateks_laporan = '';
            if ($row['laporan_persentase'] > 0) {
              $warnateks_laporan = 'color: #e81e1e';
            } else {
              $warnateks_laporan = 'color: #00e007';
            }
            ?>
            <td class="fw-bold" style="<?php echo $warnateks_laporan ?>">
              <?php echo $row['laporan_persentase'] ?>%
            </td>
            <td>
              <!-- Tombol view laporan -->
              <a href="./config/exportPdf-inline.php?id_laporan=<?php echo $row['id_laporan'] ?>"
                class="btn btn-warning my-1 " target="_blank"><i class="fa-solid fa-expand"
                  style="color: #ffffff;"></i></a>
              <!-- Tombol download laporan -->
              <a href="./config/exportPdf.php?id_laporan=<?php echo $row['id_laporan'] ?>"
                class="btn btn-primary my-1"><i class="fa-solid fa-file-arrow-down" style="color: #ffffff;"></i></a>
              <!-- Tombol hapus laporan -->
              <button type="button" name="" onclick="hapusLaporan(<?php echo $row['id_laporan']; ?>)"
                class="btn btn-danger my-1 "><i class="fa-solid fa-trash-arrow-up" style="color: #ffffff;"></i></button>
            </td>
          </tr>
          <?php
          }
          if (!$isi) {
            echo "<tr>
                    <td colspan='5'>Tidak ada laporan
                    </td>
                    </tr>";
          }
          ?>
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->