<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Insert Barang baru</title>
    <?php include('./views/themestyle.php') ?>
</head>
<body class="hold-transition lockscreen">
    <div class="m-5">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">MASUKKAN DATA BARANG BARU</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="./config/insertbrg.php" method="post">
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="itemName">Kode Barang</label>
                        <input type="text" class="form-control" id="itemName" name="kodeBrg[]" placeholder="Enter Item Name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="itemDescription">Nama Barang</label>
                        <input type="text" class="form-control" id="itemDescription" name="namaBrg[]" placeholder="Enter Item Description" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="itemDescription">Unit</label>
                        <input type="text" class="form-control" id="itemDescription" name="unitBrg[]" placeholder="Enter Item Description" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="itemDescription">Status Stok</label>
                        <input type="text" class="form-control" id="itemDescription" name="statusStok[]" value="Stok Benar" disabled>
                    </div>
                </div>
                <div id="tbl-barang-body">
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="button" class="btn btn-primary" id="btnAdd"><i class="fa-solid fa-plus me-2"></i>Tambah Barang</button>
                <button type="submit" class="btn btn-success btnSave"><i class="fa-solid fa-floppy-disk me-2"></i>Simpan Barang</button>
                <a href="./cekstok.php" class="btn btn-danger float-right"><i class="fa-solid fa-xmark me-2"></i>Batal</a>
            </div>
            <!-- /.card-footer -->
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
<script>
    $(function(){
        var num = 0;

        $('#btnAdd').on('click', function(){
            num += 1;

            var removeButton = num > 1 ? '<button type="button" class="btn btn-danger removeItem"><i class="fa-solid fa-trash-arrow-up"></i></button>' : '';

            $('#tbl-barang-body').append(`
                <div class="form-row">
                    <div class="form-group col-md-6">
                            <label for="itemName">Kode Barang</label>
                            <input type="text" class="form-control" id="itemName" name="kodeBrg[]" placeholder="Enter Item Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="itemDescription">Nama Barang</label>
                            <input type="text" class="form-control" id="itemDescription" name="namaBrg[]" placeholder="Enter Item Description" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="itemDescription">Unit</label>
                            <input type="text" class="form-control" id="itemDescription" name="unitBrg[]" placeholder="Enter Item Description" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="itemDescription">Status Stok</label>
                            <input type="text" class="form-control" id="itemDescription" name="statusStok[]" value="Stok Benar" disabled>
                        </div>
                    </div>
            `);

            $('.removeItem').off('click').on('click', function(){
                $(this).closest('tr').remove();
                num -= 1;
            });
        });
    });
</script>
    <?php include './views/script.php'; ?>
</body>
</html>