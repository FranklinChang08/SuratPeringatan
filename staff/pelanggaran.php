<?php
include('../conn.php');

// Hitung jumlah mahasiswa
$mahasiswa_count_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM tb_user WHERE role = 'Mahasiswa'");
$data_mahasiswa = mysqli_fetch_assoc($mahasiswa_count_query);
$mahasiswaCount = $data_mahasiswa['total'];

// Query untuk dropdown mahasiswa di form
$mahasiswa_list = mysqli_query($conn, "SELECT id_user, nama_user, nim FROM tb_user WHERE role = 'Mahasiswa' ORDER BY nama_user");

// Query mahasiswa untuk edit modal
$mahasiswa_list_edit = mysqli_query($conn, "SELECT id_user, nama_user, nim FROM tb_user WHERE role = 'Mahasiswa' ORDER BY nama_user");

// Ambil semua data pelanggaran + nama mahasiswa
$pelanggaran_query = mysqli_query($conn, "
    SELECT 
        p.*,
        u.nama_user,
        u.nim
    FROM tb_pelanggaran p
    LEFT JOIN tb_user u ON p.mahasiswa_id = u.id_user
    ORDER BY p.tanggal DESC
");

// Hitung total pelanggaran
$pelanggaran_count_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tb_pelanggaran");
$data_pelanggaran = mysqli_fetch_assoc($pelanggaran_count_query);
$pelanggaranCount = $data_pelanggaran['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggaran | Polibatam Surat Peringatan</title>
    <link rel="icon" href="../static/img/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="../node_modules/bootstrap/dist/js/bootstrap.js"></script>

    <link rel="stylesheet" href="../static/style/font.css">
    <link rel="stylesheet" href="../static/style/sidebar.css">
    <link rel="stylesheet" href="../static/style/dashboard.css">

    <style>
        /* Buat custom backdrop */
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.8) !important;
            backdrop-filter: blur(1000px) !important;
            -webkit-backdrop-filter: blur(1000px) !important;
        }

        .modal-backdrop.show {
            background-color: rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(100px);
            -webkit-backdrop-filter: blur(100px);
        }

        .modal-backdrop {
            transition: opacity 0.3s ease;
        }
    </style>
</head>

<body class="bg-light-subtle font-poppins">
    <?php include('../component/sidebar.php') ?>

    <div class="main-content">
        <header class="header">
            <h2 class="fw-bold mb-0">Data Pelanggaran</h2>
            <div class="account">
                <div class="account-desc">
                    <h2 class="nama fs-6 mb-0 fw-bold">Gilang</h2>
                    <h2 class="email mb-0">gilang@gmail.com</h2>
                </div>
                <a href="./profile.php" class="text-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-icon lucide-user">
                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                </a>
            </div>
        </header>

        <section id="tableMahasiswa" class="tableMahasiswa">
            <div class="container">
                <div class="button d-flex justify-content-between flex-column flex-lg-row gap-2">
                    <button type="button" class="btn btn-primary font-poppins" id="btnCreatePelanggaranModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus">
                            <path d="M5 12h14" />
                            <path d="M12 5v14" />
                        </svg>
                        Tambah Pelanggaran
                    </button>

                    <form action="" class="form-search">
                        <label for="search">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search">
                                <path d="m21 21-4.34-4.34" />
                                <circle cx="11" cy="11" r="8" />
                            </svg>
                        </label>
                        <input type="text" name="search" id="search" placeholder="Cari...">
                    </form>
                </div>
            </div>
            <div class="container">
                <table class="text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>Jenis SP</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Gilang Ramdhan</td>
                            <td>Surat Peringatan 1</td>
                            <td>Mahasiswa yang tidak masuk sebanyak 5%</td>
                            <td>14 September 2025</td>
                            <td>Aktif</td>
                            <td class="d-flex align-items-center">
                                <button href="" class="btn btn-warning me-2 py-1 px-2" data-bs-toggle="modal"
                                    data-bs-target="#EditPelanggaran">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-square-pen-icon lucide-square-pen">
                                        <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                        <path
                                            d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
                                    </svg>
                                </button>
                                <div class="modal fade" id="EditPelanggaran" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="EditPelanggaranLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="EditPelanggaranLabel">Form Manejement
                                                    Pelanggaran</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" class="needs-validation" novalidate
                                                    id="formEditPelanggaran" autocomplete="off">
                                                    <div class="mb-3">
                                                        <label for="mahasiswaEdit" class="form-label">Mahasiswa</label>
                                                        <input type="text" class="form-control" id="mahasiswaEdit" placeholder="Silahkan masukkan menggunakan NIM Mahasiswa."
                                                            required>
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="jenis_suratEdit" class="form-label">Jenis Surat
                                                            Peringatan</label>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="jenis_suratEdit" required>
                                                            <option value="" selected disabled hidden>Pilih Jenis Surat
                                                                Pelanggaran</option>
                                                            <option value="sp1">SP 1</option>
                                                            <option value="sp2">SP 2</option>
                                                            <option value="sp3">SP 3</option>
                                                        </select>
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="tanggalEdit" class="form-label">Tanggal</label>
                                                        <input type="date" class="form-control" id="tanggalEdit"
                                                            required>
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="statusEdit" class="form-label">Status
                                                            Pelanggaran</label>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="statusEdit" required>
                                                            <option value="" selected disabled hidden>Pilih Status
                                                                Pelanggaran</option>
                                                            <option value="aktif">Aktif</option>
                                                            <option value="tidakAktif">Tidak Aktif</option>
                                                        </select>
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="keteranganEdit"
                                                            class="form-label">Keterangan</label>
                                                        <textarea class="form-control" id="keteranganEdit"
                                                            required></textarea>
                                                        <div class="invalid-feedback"></div>
                                                    </div>
                                                    <div>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <form action="">
                                    <button class="btn btn-danger py-1 px-2" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M10 11v6" />
                                            <path d="M14 11v6" />
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                            <path d="M3 6h18" />
                                            <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="createPelanggaran" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="createPelanggaranLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createPelanggaranLabel">Form Manejement Pelanggaran</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" class="needs-validation" novalidate id="formCreatePelanggaran" autocomplete="off">
                                <div class="mb-3">
                                    <label for="mahasiswaCreate" class="form-label">Mahasiswa</label>
                                    <input type="text" class="form-control" id="mahasiswaCreate" placeholder="Silahkan masukkan menggunakan NIM Mahasiswa." required>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="jenis_suratCreate" class="form-label">Jenis Surat Peringatan</label>
                                    <select class="form-select" aria-label="Default select example"
                                        id="jenis_suratCreate" required>
                                        <option value="" selected disabled hidden>Pilih Jenis Surat Pelanggaran</option>
                                        <option value="sp1">SP 1</option>
                                        <option value="sp2">SP 2</option>
                                        <option value="sp3">SP 3</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggalCreate" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggalCreate" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="statusCreate" class="form-label">Status Pelanggaran</label>
                                    <select class="form-select" aria-label="Default select example" id="statusCreate"
                                        required>
                                        <option value="" selected disabled hidden>Pilih Status Pelanggaran
                                        </option>
                                        <option value="aktif">Aktif</option>
                                        <option value="tidakAktif">Tidak Aktif</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="keteranganCreate" class="form-label">Keterangan</label>
                                    <textarea class="form-control" id="keteranganCreate" required></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="container">
                    <div class="alert alert-primary mb-0" role="alert">
                        Data Pelanggaran tidak ada. Silahkan isi data pelanggaran terlebih dahulu!!!!
                    </div>
                </div>
            <?php } ?>
        </section>
    </div>
</body>

<script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">

<script src="../static/js/validationFormPelanggaran.js"></script>
<script src="../static/js/confirmRemove.js"></script>
<script src="../static/js/confirmLogout.js"></script>

<script>
    // Button Create Modal dengan validasi mahasiswa count
    document.getElementById('btnCreatePelanggaranModal').addEventListener('click', function() {
        let mahasiswaCount = <?php echo $mahasiswaCount ?>;
        if (mahasiswaCount === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Data Mahasiswa Kosong!',
                text: 'Silakan tambahkan data mahasiswa terlebih dahulu.',
                confirmButtonColor: '#3085d6',
            });
        } else {
            var myModal = new bootstrap.Modal(document.getElementById('createPelanggaran'));
            myModal.show();
        }
    });
</script>

<script src="../static/js/validationFormPelanggaran.js"></script>
<script src="../static/js/confirmLogout.js"></script>



</html>