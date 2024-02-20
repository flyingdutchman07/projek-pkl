<?php 

require_once "./config/update-barang.php";

include "./config/koneksi.php";
$sql = mysqli_query($conn, "SELECT * FROM barang_db WHERE id='$_GET[id]'");
$hsl = mysqli_fetch_array($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form Ubah Data</title>
  <?php include('./views/themestyle.php') ?>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h4 class="m-0 text-center"><b>FORM UBAH DATA BARANG</b></h4>
                </div>
            <div class="card-body">
                <form action="" method="post">
                <!-- Kode barang -->
                <div class="form-group"> 
                    <label for="">Kode Barang</label>
                    <input type="text" class="form-control" name="kodeBrg" placeholder="Kode Barang" value="<?php echo $hsl['kode_barang'] ?>" disabled>
                </div>
                <!-- Nama barang -->
                <div class="form-group">
                    <label for="">Nama Barang</label>
                    <input type="text" class="form-control" name="namaBrg" placeholder="Nama Barang" value="<?php echo $hsl['nama_barang'] ?>">
                </div>
                <!-- Stok barang -->
                <div class="form-group">
                    <label for="">Stok Barang</label>
                    <input type="text" class="form-control" name="stokBrg" placeholder="Stok Barang" value="<?php echo $hsl['stok_data'] ?>">
                </div>
                <!-- Status stok -->
                <div class="form-group">
                  <label for="exampleSelectBorder">Status Stok</label>
                  <select class="custom-select form-control-border" name="statusStok" id="exampleSelectBorder">
                    <option selected><?php echo $hsl['status_stok'] ?></option>
                    <option disabled="disabled" class="fw-bold text-primary">Pilih Status Stok :</option>
                    <option>Stok Benar</option>
                    <option>Stok Salah</option>
                  </select>
                </div>
                <!-- Id barang (hidden) -->
                <input type="hidden" name="id" value="<?php echo $hsl['id'] ?>">
                <!-- Tombol simpan + kembali -->
                <div class="col d-flex gap-1 flex-column">
                    <button type="submit" name="updateBarang" class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-2" style="color: #ffffff;"></i>Simpan Perubahan</button>
                    <a class="btn btn-danger" href="./cekstok.php"><i class="fa-solid fa-arrow-left me-2" style="color: #ffffff;"></i>Batal</a>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php include('./views/script.php') ?>
</body>
</html>
