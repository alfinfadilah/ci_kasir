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
        <h1 align="center">Data Pelanggan</h1>
        <div class="col text-end">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalTambahPelanggan">
                <i class="fa-solid fa-cart-plus"></i> Tambah Pelanggan
            </button>
        </div>
    </div>
    <div class="modal fade" id="ModalTambahPelanggan" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: blue; color:white;">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Konten modal -->
                    <form id="formPelanggan">
                        <div class="row mb-3">
                            <label class="col-4 col-form-label">Nama Pelanggan</label>
                            <div class="col-8">
                                <input type="text" class="form-control" id="namaPelanggan">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="alamat" class="col-4 col-form-label">alamat</label>
                            <div class="col-8">
                                <input type="text" class="form-control" id="alamat">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="no_telp" class="col-4 col-form-label">no_telp</label>
                            <div class="col-8">
                                <input type="text" class="form-control" id="no_telp">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="simpanPelanggan">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="container ml-5">
                <table class="table table-bordered" id="pelangganTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Alamat</th>
                            <th>No Telp</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ModalEditPelanggan" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: orange; color:white;">
                    <h5 class="modal-title" id="editModalLabel">Edit Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEditPelanggan">
                        <input type="hidden" id="editProductId">
                        <div class="row mb-3">
                            <label class="col-4 col-form-label">Nama Pelanggan</label>
                            <div class="col-8">
                                <input type="text" class="form-control" id="editNamaPelanggan">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="editalamat" class="col-4 col-form-label">Alamat</label>
                            <div class="col-8">
                                <input type="text" class="form-control" id="editalamat">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="editno_telp" class="col-4 col-form-label">No Telp</label>
                            <div class="col-8">
                                <input type="text" class="form-control" id="editno_telp">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="updatePelanggan">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>
    <script src="asset/bootstrap-5.3.3-dist/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            function tampilPelanggan() {
                $.ajax({
                    url: '<?= base_url('pelanggan/tampil') ?>',
                    type: 'GET',
                    dataType: 'json',
                    success: function(hasil) {
                        if (hasil.status === 'success') {
                            var pelangganTable = $('#pelangganTable tbody');
                            pelangganTable.empty();

                            var pelanggan = hasil.pelanggan;
                            var no = 1;

                            pelanggan.forEach(function(item) {
                                var row = '<tr>' +
                                    '<td>' + no + '</td>' +
                                    '<td>' + item.nama_pelanggan + '</td>' +
                                    '<td>' + item.alamat + '</td>' +
                                    '<td>' + item.no_telp + '</td>' +
                                    '<td>' +
                                    '<button class="btn btn-warning btn-sm editPelanggan" data-id="' + item.id_pelanggan + '" data-bs-toggle="modal" data-bs-target="#ModalEditPelanggan"><i class="fa-solid fa-pencil"></i> Edit</button>' +
                                    '<button class="btn btn-danger btn-sm hapusPelanggan" data-id="' + item.id_pelanggan + '"><i class="fa-solid fa-trash-can"></i> Hapus</button>' +
                                    '</td>' +
                                    '</tr>';
                                pelangganTable.append(row);
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

            tampilPelanggan();

            $("#simpanPelanggan").on("click", function() {
                var formData = {
                    nama_pelanggan: $("#namaPelanggan").val(),
                    alamat: $("#alamat").val(),
                    no_telp: $("#no_telp").val(),
                };

                $.ajax({
                    url: '<?= base_url('pelanggan/simpan'); ?>',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(hasil) {
                        console.log(hasil);

                        if (hasil.status === 'success') {
                            Swal.fire({
                                title: "Good job!",
                                text: "You clicked the button!",
                                icon: "success"
                            });
                            $('#ModalTambahPelanggan').modal('hide');
                            $('#formPelanggan')[0].reset();
                            tampilPelanggan();
                        } else {
                            alert('Gagal menyimpan data: ' + JSON.stringify(hasil.errors));
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan: ' + error);
                    }
                });
            });

            $('#pelangganTable').on("click", ".editPelanggan", function() {
                var id_pelanggan = $(this).attr('data-id');
                document.getElementById('editNamaPelanggan').value = $(this).closest('tr').find('td:eq(1)').text()
                document.getElementById('editalamat').value = $(this).closest('tr').find('td:eq(2)').text()
                document.getElementById('editno_telp').value = $(this).closest('tr').find('td:eq(3)').text()

                $("#updatePelanggan").on("click", function() {

                    console.log(id_pelanggan);

                    var formData = {
                        id_pelanggan: id_pelanggan,
                        nama_pelanggan: $('#editNamaPelanggan').val(),
                        alamat: $('#editalamat').val(),
                        no_telp: $('#editno_telp').val(),
                    };


                    $.ajax({
                        url: '<?= base_url('pelanggan/update'); ?>',
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                $('#ModalEditPelanggan').modal('hide');
                                $('#formEditPelanggan')[0].reset();
                                tampilPelanggan();
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


        


        $('#pelangganTable').on("click", ".hapusPelanggan", function() {
            var id_pelanggan = $(this).attr('data-id')
            console.log(id_pelanggan);

            hapusPelanggan(id_pelanggan);
        });

        function hapusPelanggan(id_pelanggan) {

            if (confirm("Anda yakin ingin menghapus produk ini?")) {
                $.ajax({
                    url: '<?= base_url('pelanggan/hapus'); ?>',
                    type: 'POST',
                    data: {
                        id_pelanggan: id_pelanggan
                    },
                    dataType: 'json',
                    success: function(hasil) {
                        if (hasil.status === 'success') {
                            Swal.fire({
                                title: "Good job!",
                                text: "You clicked the button!",
                                icon: "success"
                            });
                            tampilPelanggan();
                        } else {
                            alert("Gagal menghapus pelanggan: " + hasil.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("Terjadi kesalahan: " + error);
                    }
                });
            }
        }
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>