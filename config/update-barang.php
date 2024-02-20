<?php 

require_once "./config/koneksi.php";

if (isset($_POST['updateBarang'])){
    $sql_update = "UPDATE barang_db SET 
                    nama_barang = '$_POST[namaBrg]', 
                    stok_data = '$_POST[stokBrg]', 
                    status_stok = '$_POST[statusStok]' 
                    WHERE id = '$_POST[id]' ";
    if($conn -> query($sql_update) === TRUE) {
        echo "<script>alert('Data berhasil diperbarui!');location='./cekstok.php'</script>";
        } else {
            echo "Error updating record: " . $conn->error;
    }
}

?>