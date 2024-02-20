<?php 

// Mulai sesi login
session_start();

// Mengambil data dari database
require_once('./config/koneksi.php');
require_once('./config/countstoksalah.php');

// Cek apakah sesi user sesuai
if ($_SESSION['log'] != 'login') {
  header("location: ./loginpage.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Warehouse Cycle Count</title>
  <?php include('./views/themestyle.php') ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar start -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <?php include('./views/navbar-top.php') ?>

    <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
        <!-- Navbar User -->
        <li class="nav-item">
        <li class="nav-item dropdown user-menu">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <span><i class="fa-solid fa-circle-user fa-2xl me-2"></i></span>
            <span class="d-none d-md-inline"><?= $_SESSION['namalengkap'] ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- User image -->
            <li class="user-header bg-primary">
              <span><i class="fa-solid fa-user fa-2xl m-5"></i></span>
              <p><?= $_SESSION['namalengkap'] ?></p>
              <small>Terdaftar sejak <?= $_SESSION['ucreated'] ?></small>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
            <a href="./form-editUser.php" class="btn btn-warning float-left"><i class="fa-solid fa-pencil me-2"></i>Edit Profil</a>
              <a href="./logout.php" class="btn btn-danger float-right"><i class="fa-solid fa-power-off me-2"></i>Logout</a>
            </li>
          </ul>
        </li>
        </li>
  </ul>

  </nav>
  <!-- Navbar end -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <span class="brand-link">
      <i class="fa-solid fa-box-open ml-3 mr-2"></i>
      <span class="brand-text">WH Cycle Count</span>
    </span>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="./index.php" class="nav-link">
              <i class="fa-solid fa-house me-2 "></i>
              <p>
                Beranda
              </p>
            </a>
          </li>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="./cekstok.php" class="nav-link active">
            <i class="fa-solid fa-clipboard-check me-2"></i>
              <p>
                Penyesuaian Stok
              </p>
            </a>
          </li>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="./laporan-export.php" class="nav-link">
            <i class="fa-solid fa-file-invoice me-2"></i>
              <p>
                Laporan
              </p>
            </a>
          </li>
      </nav>
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Penyesuaian Stok</h1>
          </div><!-- /.col -->
          <!-- Breadcrumb Start -->
          <div class="col-sm-6">
          <nav aria-label="breadcrumb" class="float-sm-right">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./index.php">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Penyesuaian Stok</li>
                <li class="breadcrumb-item" aria-current="page"></li>
            </ol>
            </nav>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">

          <!-- Left col -->
          <section class="col-12">
            <!-- Tampilan presentase + entri -->
            <!-- Data barang -->
            <div class="row">
                <div class="col-md-4 col-sm-6 col-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fa-solid fa-clipboard-user"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Staff Cycle Count</span>
                      <span class="info-box-number"><?= $_SESSION['namalengkap'] ?></span>
                    </div>
                  </div>
                </div>
                <!-- Data barang -->
                  <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-primary"><i class="fa-solid fa-boxes-stacked"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Jumlah Data Barang</span>
                        <span class="info-box-number"><?php echo $totalEntries ?> Item</span>
                      </div>
                    </div>
                  </div>
                  <!-- Presentase -->
                  <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box">
                      <span class="info-box-icon bg-danger"><i class="fa-solid fa-percent"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Persentase Kesalahan Stok</span>
                        <span class="info-box-number"><?php echo $percentage . '%' ?></span>
                      </div>
                    </div>
                  </div>
                </div>
            <?php include('./views/table-barang.php') ?>
          </section>
          <!-- /.Left col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <?php include('./views/footer.php') ?>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include('./views/script.php') ?>
</body>
</html>
