<?php 

require_once "./config/koneksi.php";

// Cek apakah sesi user sesuai
session_start();
if ($_SESSION['log'] != 'login') {
    header("location: ./loginpage.php");
  }

// Ambil detail
$uid = $_SESSION['uid'];
$que_getUser = "SELECT * FROM user_db WHERE id = ?";

$res_getUser = $conn->prepare($que_getUser);
$res_getUser->bind_param('i', $uid);
$res_getUser->execute();
$row_user = $res_getUser->get_result();

if($row_user -> num_rows === 1){
    $data_user = $row_user->fetch_assoc();
} else {
    echo "<script>alert('Error fetching user details!')</script>";
    exit();
}

// Helper function to bind parameters dynamically
function bindParameters($stmt, $types, ...$params) {
    $bindParams = [$types];
    foreach ($params as &$param) {
        $bindParams[] = &$param;
    }
    call_user_func_array([$stmt, 'bind_param'], $bindParams);
}

// Handling profil update
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateProfile'])){
    // Validasi data yang diinputkan
    $new_uname = mysqli_real_escape_string($conn, $_POST['uname_baru']);
    $new_uname_long = mysqli_real_escape_string($conn, $_POST['uname_long_baru']);
    $new_upass = mysqli_real_escape_string($conn, $_POST['upass_baru']);

    // Query update user profile
    $que_UpdateProfil = "UPDATE user_db SET uname = ?, uname_long = ?";
    $params = array("ss", $new_uname, $new_uname_long);

    if (!empty($new_upass)) {
        $que_UpdateProfil .= ", upass = ?";
        $params[0] .= "s";
        $params_new_upass = mysqli_real_escape_string($conn, $_POST['upass_baru']);
        $params[] = $params_new_upass;
    }

    $que_UpdateProfil .= " WHERE id = ?";
    $params[0] .= "i";
    $params[] = $uid;

    $stmt_updateProfil = $conn->prepare($que_UpdateProfil);

    // Bind parameters dynamically using the helper function
    bindParameters($stmt_updateProfil, ...$params);

    if($stmt_updateProfil->execute()){
        echo "<script>alert('Profil sukses diperbarui!\\nNB : Login ulang untuk melihat perubahan!'); location='./index.php'</script>";
    } else {
        echo "<script>alert('Profile failed updated!');</script>";
    }

    $stmt_updateProfil->close();
}

// Close connections
$res_getUser->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form Ubah Profil</title>
  <?php include('./views/themestyle.php') ?>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h4 class="m-0 text-center"><b>UBAH PROFIL USER</b></h4>
                </div>
            <div class="card-body">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <!-- Username -->
                <div class="form-group">
                    <label for="">Username Baru</label>
                    <input type="text" class="form-control" name="uname_baru" placeholder="Username Baru" value="<?php echo $data_user['uname'] ?>" required>
                </div>
                <!-- Nama lengkap -->
                <div class="form-group">
                    <label for="">Nama Lengkap Baru</label>
                    <input type="text" class="form-control" name="uname_long_baru" placeholder="Nama Lengkap Baru" value="<?php echo $data_user['uname_long'] ?>" required>
                </div>
                <!-- Nama lengkap -->
                <div class="form-group">
                    <label for="">Password Baru</label>
                    <input type="password" class="form-control" id="pswd" name="upass_baru" placeholder="Password Baru">
                </div>
                <!-- Tampilkan password -->
                <div class="col d-flex flex-row-reverse mb-2">
                    <div class="">
                        <label>Tampilkan Password</label>
                        <input type="checkbox" class="ml-2 mb-0" onclick="showPw()">
                    </div>
                </div>
                <!-- Tombol simpan + kembali -->
                <div class="d-flex gap-1 flex-column">
                    <button type="submit" name="updateProfile" class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-2" style="color: #ffffff;"></i>Simpan Perubahan</button>
                    <a class="btn btn-danger" href="./index.php"><i class="fa-solid fa-arrow-left me-2" style="color: #ffffff;"></i>Batal</a>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php include('./views/script.php') ?>
</body>
</html>