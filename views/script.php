<script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
<!-- JQuery Slim -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- Script untuk projek -->
<script>
  
  // Hitung presentase
  function calculatePercentage() {
    const selectedCheckboxes = document.querySelectorAll(".ceklis:checked").length;
    const totalItems = document.querySelectorAll(".ceklis").length;    
    if (totalItems > 0) {
      const percentage = (selectedCheckboxes / totalItems) * 100;
      document.getElementById("result").innerHTML = `${Math.round(percentage)}%`;
  } else {
      alert("Tidak ada data");
  }
}
  // Konfirmasi save data
  function konfirmasi() {
    if (confirm("Apakah data stok sudah benar?")) {
      return true;
    } else {
      return false;
    }
  }
  // Fungsi hapus ALL data
  function deleteAllData() {
      if (confirm('Apakah kamu yakin akan menghapus seluruh data?')) {
          window.location.href = './config/hapus-all.php';
      }
  }
  // Fungsi hapus ALL laporan
  function deleteAllDataLaporan() {
    if (confirm('Apakah kamu yakin akan menghapus seluruh data?')) {
        window.location.href = './config/hapus-all-laporan.php';
    }
  }
  // Fungsi hapus data By ID
  function deleteData(id) {
      if (confirm('Apa anda yakin akan menghapus item ini?')) {
          window.location.href = './config/hapus-byid.php?id=' + id;
      }
  }
  // Fungsi hapus pdf By ID
  function hapusLaporan(id_laporan) {
      if (confirm('Apa anda yakin akan menghapus laporan ini?')) {
          window.location.href = './config/hapus-byid.php?id_laporan=' + id_laporan;
      }
  }
  // Fungsi toggle show hide password di logpage
  function showPw() {
    var x = document.getElementById("pswd");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
  }
  // Fungsi toggle show hide password di regpage
  $(document).ready(function() {
            $("#togglePassword").change(function() {
                var type = $(this).is(":checked") ? "text" : "password";
                $(".password").attr("type", type);
            });
        });
  
</script>