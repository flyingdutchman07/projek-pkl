<?php

require_once('./config/koneksi.php');

// Isset seluruh data
if(isset($_POST['username']) && isset($_POST['namalengkap']) && isset($_POST['password']) && isset($_POST['password_con'])){
  
  // Proses data
  $username = $_POST['username'];
  $namalengkap = $_POST['namalengkap'];
  $password = $_POST['password'];
  $password_con = $_POST['password_con'];

  if ($password != $password_con){
    echo "<script>alert('Kedua password tidak sama!')</script>; location='./registpage.php'</script>";
  } else {
    // Membuat query insert database
    $sql_reg = "INSERT INTO user_db (uname, uname_long, upass, ucreated) VALUES (?, ?, ?, CONVERT_TZ(NOW(), 'UTC', 'Asia/Jakarta'))";
    if ($stmt_reg = $conn -> prepare($sql_reg)){
      // Bind parameter ke query
      $stmt_reg->bind_param("sss", $username, $namalengkap, $password);
      // Eksekusi query
      if ($stmt_reg->execute()){
        echo "<script>alert('Selamat, Akun anda berhasil didaftarkan! Anda akan dialihkan ke halaman Login!'); location='./loginpage.php'</script>";
      } else {
          echo "<script>alert('Error telah terjadi!')</script>";
      }
      // Tutup statement
      $stmt_reg->close();
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>WH Cycle Count | Login</title>
  <?php include('./views/themestyle.php') ?>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <span class="h2"><i class="fa-solid fa-box-open ml-3 mr-2"></i><b>WH</b> Cycle Count</span>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Form pendaftaran user baru</p>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <!-- Username -->
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Masukkan Username" pattern=".{5,}" oninvalid="this.setCustomValidity('Username harus terdiri dari minimal 5 karakter')" oninput="setCustomValidity('')" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <!-- Nama Lengkap -->
        <div class="input-group mb-3">
          <input type="text" name="namalengkap" class="form-control" placeholder="Masukkan Nama Lengkap Anda" oninvalid="this.setCustomValidity('Mohon isi nama lengkap anda')" oninput="setCustomValidity('')" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <!-- Password 1 -->
        <div class="input-group mb-0">
            <div class="input-group mb-3 password-container">
                <input type="password" name="password" class="form-control password" id="pswd1" class="form-control" placeholder="Masukkan Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" oninvalid="this.setCustomValidity('Password berisi setidaknya satu angka, satu huruf besar, satu huruf kecil, dan 8 karakter atau lebih')" oninput="setCustomValidity('')" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Password 2 -->
        <div class="input-group mb-3 password-container">
            <input type="password" name="password_con" class="form-control password" id="pswd2" class="form-control" placeholder="Ulang Password" oninvalid="this.setCustomValidity('Password konfirmasi harus diisi')" oninput="setCustomValidity('')" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <div class="col d-flex flex-row-reverse mb-3">
            <div class="">
                <label>Tampilkan Password</label>
                <input type="checkbox" id="togglePassword">
            </div>
        </div>
        <!-- Logpage + tombol -->
        <div class="row">
          <div class="col d-flex flex-row justify-content-between">
            <span href="login.html" class="text-center mt-1">Sudah punya akun? <a href="./loginpage.php" class="fw-bold">Login disini</a></span>
            <button type="submit" class="btn btn-primary ">Daftar</button>
          </div>
        </div>
      </form>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<?php include('./views/script.php') ?>

</body>
</html>