<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/bootstrap-5.3.3-dist/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/fontawesome-free-6.6.0-web/css/all.min.css">
    <script src="<?= base_url("asset/jquery-3.7.1.min.js") ?>"></script>
    <title>Document</title>
</head>

<body>
    <div class="container mt-3">
        <h1 align="center">Data Produk</h1>
        <div class="col text-end">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalTambahProduct">
                <i class="fa-solid fa-cart-plus"></i> Tambah Produk
            </button>
        </div>
    </div>
    <div class="modal fade" id="ModalTambahProduct" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: blue; color:white;">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Konten modal -->
                    <form id="formProduct">
                        <div class="row mb-3">
                            <label class="col-4 col-form-label">Nama Produk</label>
                            <div class="col-8">
                                <input type="text" class="form-control" id="namaProduct">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="hargaProduct" class="col-4 col-form-label">Harga</label>
                            <div class="col-8">
                                <input type="number" class="form-control" id="hargaProduct">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="stokProduct" class="col-4 col-form-label">Stok</label>
                            <div class="col-8">
                                <input type="number" class="form-control" id="stokProduct">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="gambarProduct" class="col-4 col-form-label">Gambar</label>
                            <div class="col-8">
                                <input type="file" class="form-control" id="gambarProduct" accept="image/*">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="simpanProduct">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="container ml-5">
                <table class="table table-bordered" id="productTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Product</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Gambar</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ModalEditProduct" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: orange; color:white;">
                    <h5 class="modal-title" id="editModalLabel">Edit Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditProduct">
                        <input type="hidden" id="editProductId">
                        <div class="row mb-3">
                            <label class="col-4 col-form-label">Nama Produk</label>
                            <div class="col-8">
                                <input type="text" class="form-control" id="editNamaProduct">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="editHargaProduct" class="col-4 col-form-label">Harga</label>
                            <div class="col-8">
                                <input type="number" class="form-control" id="editHargaProduct">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="editStokProduct" class="col-4 col-form-label">Stok</label>
                            <div class="col-8">
                                <input type="number" class="form-control" id="editStokProduct">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="editGambarProduct" class="col-4 col-form-label">Gambar</label>
                            <div class="col-8">
                                <input type="file" class="form-control" id="editGambarProduct" accept="image/*">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="updateProduct">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>
    <script src="asset/bootstrap-5.3.3-dist/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {

            tampilProduct();

            $("#simpanProduct").on("click", function() {
                var formData = {
                    nama_product: $("#namaProduct").val(),
                    harga: $("#hargaProduct").val(),
                    stok: $("#stokProduct").val(),
                    gambar: $("#gambarProduct")[0].files[0]
                };

                $.ajax({
                    url: '<?= base_url('product/simpan'); ?>',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(hasil) {
                        console.log(hasil);

                        if (hasil.status === 'success') {
                            $('#ModalTambahProduct').modal('hide');
                            $('#formProduct')[0].reset();
                            Swal.fire({
                                title: "Good job!",
                                text: "You clicked the button!",
                                icon: "success"
                            });
                            tampilProduct();
                        } else {
                            alert('Gagal menyimpan data: ' + JSON.stringify(hasil.errors));
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan: ' + error);
                    }
                });
            });

            $('#productTable').on("click", ".editProduct", function() {
                var productId = $(this).attr('data-id');
                document.getElementById('editNamaProduct').value = $(this).closest('tr').find('td:eq(1)').text()
                document.getElementById('editHargaProduct').value = $(this).closest('tr').find('td:eq(2)').text()
                document.getElementById('editStokProduct').value = $(this).closest('tr').find('td:eq(3)').text()

                // $.ajax({
                //     url: '<?= base_url('product/edit'); ?>',
                //     type: 'POST',
                //     data: { product_id: productId },
                //     dataType: 'json',
                //     success: function(data) {
                //         if (data.status === 'success') {
                //             $('#editProductId').val(data.product.product_id);
                //             $('#editNamaProduct').val(data.product.nama_product);
                //             $('#editHargaProduct').val(data.product.harga);
                //             $('#editStokProduct').val(data.product.stok);

                //             $('#ModalEditProduct').modal('show');
                //         } else {
                //             alert('Gagal mengambil data produk.');
                //         }
                //     },
                //     error: function(xhr, status, error) {
                //         alert('Terjadi kesalahan: ' + error);
                //     }
                // });
                $("#updateProduct").on("click", function() {
                    var formData = {
                        product_id: productId,
                        nama_product: $('#editNamaProduct').val(),
                        harga: $('#editHargaProduct').val(),
                        stok: $('#editStokProduct').val(),
                    };
                    var fileGambar = $("#editGambarProduct")[0].files[0];
                    if (fileGambar) {
                        formData.append("gambar", fileGambar);
                    }


                    $.ajax({
                        url: '<?= base_url('product/update'); ?>',
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                $('#ModalEditProduct').modal('hide');
                                $('#formEditProduct')[0].reset();
                                tampilProduct();
                                Swal.fire({
                                    title: "Good job!",
                                    text: "You clicked the button!",
                                    icon: "success"
                                });
                            } else {
                                alert('Gagal mengupdate data produk: ' + JSON.stringify(response.errors));
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Terjadi kesalahan: ' + error);
                        }
                    });
                });

            });


        });

        function tampilProduct() {
            $.ajax({
                url: '<?= base_url('product/tampil') ?>',
                type: 'GET',
                dataType: 'json',
                success: function(hasil) {
                    if (hasil.status === 'success') {
                        var productTable = $('#productTable tbody');
                        productTable.empty();

                        var product = hasil.product;
                        var no = 1;

                        product.forEach(function(item) {
                            var row = '<tr>' +
                                '<td>' + no + '</td>' +
                                '<td>' + item.nama_product + '</td>' +
                                '<td>' + item.harga + '</td>' +
                                '<td>' + item.stok + '</td>' +
                                '<td><img src="<?= base_url('uploads') ?>/' + item.gambar + '" width="50"></td>' +
                                '<td>' +
                                '<button class="btn btn-warning btn-sm editProduct" data-id="' + item.product_id + '" data-bs-toggle="modal" data-bs-target="#ModalEditProduct"><i class="fa-solid fa-pencil"></i> Edit</button>' +
                                '<button class="btn btn-danger btn-sm hapusProduct" data-id="' + item.product_id + '"><i class="fa-solid fa-trash-can"></i> Hapus</button>' +
                                '</td>' +
                                '</tr>';
                            productTable.append(row);
                            no++;
                        });


                    } else {
                        alert('Gagal menampilkan data. ');
                    }
                },
                error: function(xhr, status, error) {
                    alert('Terkadi Kesalahan: ' + error);
                }
            });
        }
        $('#productTable').on("click", ".hapusProduct", function() {
            var productId = $(this).attr('data-id')
            console.log(productId);

            hapusProduct(productId);
        });

        function hapusProduct(productId) {

            if (confirm("Anda yakin ingin menghapus produk ini?")) {
                $.ajax({
                    url: '<?= base_url('product/hapus'); ?>',
                    type: 'POST',
                    data: {
                        product_id: productId
                    },
                    dataType: 'json',
                    success: function(hasil) {
                        if (hasil.status === 'success') {
                            Swal.fire({
                                title: "Good job!",
                                text: "You clicked the button!",
                                icon: "success"
                            });
                            tampilProduct();
                        } else {
                            alert("Gagal menghapus produk: " + hasil.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("Terjadi kesalahan: " + error);
                    }
                });
            }
        }
    </script>
</body>

</html>