<?php

session_start();
require_once('./config/koneksi.php');

if (!isset($_SESSION['log'])){
} else {
  header("location:./index.php");
}

if (isset($_POST['login'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  $que_login = "SELECT * FROM user_db WHERE uname = '$username' ";
  $res_login = mysqli_query($conn,$que_login);
  $row_login = mysqli_fetch_assoc($res_login);

  // Validasi kredensial
  if ($row_login) {
    if ($password === $row_login['upass']) {
        $_SESSION['uid'] = $row_login['id'];
        $_SESSION['username'] = $row_login['uname'];
        $_SESSION['namalengkap'] = $row_login['uname_long'];
        $_SESSION['ucreated'] = $row_login['ucreated'];
        $_SESSION['log'] = 'login';
        // Sukses login dan redirect langsung ke index.php
        echo "<script> alert('Selamat datang, " . $row_login['uname_long'] . "'); location='./index.php' </script>";
    } else {
        // Alert jika password salah
        echo "<script> alert('Password yang anda masukkan salah!');</script>";
    }
  } else {
      // Alert jika username salah
      echo "<script> alert('Username yang anda masukkan tidak ada di database');</script>";
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
  <!-- Login box -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <span class="h2"><i class="fa-solid fa-box-open ml-3 mr-2"></i><b>WH</b> Cycle Count</span>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Masukkan Username dan Password anda</p>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <!-- Username -->
        <div class="input-group mb-3">
          <input type="username" name="username" class="form-control" placeholder="Username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <!-- Password -->
        <div class="input-group mb-3 password-container">
          <input type="password" id="pswd" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="col d-flex flex-row-reverse mb-2">
            <div class="">
                <label>Tampilkan Password</label>
                <input type="checkbox" class="ml-2 mb-0" onclick="showPw()">
            </div>
          </div>
          <!-- Tombol submit + regpage -->
          <div class="col-4 float-right">
            <button type="submit" name="login" class="btn btn-primary btn-block mt-1 mr-0">Login</button>
          </div>
          <div class="col-10 mt-2 mb-0">
          <p class="">Belum punya akun?<a href="./registpage.php" class="text-center fw-bold"> Daftar disini</a></p>
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