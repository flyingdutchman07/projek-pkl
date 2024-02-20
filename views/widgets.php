<?php 

require_once('./config/countstoksalah.php');
require_once('./config/koneksi.php');

$que_persentase = 'SELECT laporan_persentase, laporan_created FROM cetaklaporan_db ORDER BY laporan_created DESC LIMIT 1';
$res_persentase = mysqli_query($conn, $que_persentase);

if ($res_persentase -> num_rows > 0) {
  $prc = $res_persentase->fetch_assoc();
  $tgl_baru = $prc['laporan_created'];
  $persentase_baru = $prc['laporan_persentase'];
} else {
  $tgl_baru = "Tidak ada laporan";
  $persentase_baru = "NaN";
}
?>
        <!-- Total barang -->
        <div class="col-lg-3 col-sm-5">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><?php echo $totalEntries ?></h3>
                <p>Total Barang Terdaftar</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="./cekstok.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <!-- Persentase terbaru-->
          <div class="col-lg-3 col-sm-5">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $persentase_baru ?><sup style="font-size: 20px">%</sup></h3>
                <p>Persentase Laporan Terakhir</p>
              </div>
              <div class="icon">
                <i class="ion ion-clipboard"></i>
              </div>
              <a href="./laporan-export.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <!-- Cycle Count terakhir -->
          <div class="col-lg-6 col-sm-5">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $tgl_baru ?></h3>
                <p>Cycle Count Terakhir</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="./laporan-export.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
