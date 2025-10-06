<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="../static/img/logo.png" type="image/x-icon">

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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>

<body class="bg-light-subtle font-poppins">
    <?php
    include('../component/sidebar.php')
    ?>

    <div class="main-content">
        <header class="header">
            <h2 class="fw-bold">Data Pelanggaran</h2>
            <div class="account">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-icon lucide-user">
                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
            </div>
        </header>

        <section id="tableMahasiswa" class="tableMahasiswa">
            <div class="container">
                <div class="button d-flex justify-content-between flex-column flex-md-row gap-2">
                    <div class="button-group">
                        <button type="button" class="btn btn-primary font-poppins" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createMahasiswa">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus">
                                <path d="M5 12h14" />
                                <path d="M12 5v14" />
                            </svg>
                            Tambah Mahasiswa</button>

                        <button class="btn btn-primary font-poppins">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder-output-icon lucide-folder-output">
                                <path d="M2 7.5V5a2 2 0 0 1 2-2h3.9a2 2 0 0 1 1.69.9l.81 1.2a2 2 0 0 0 1.67.9H20a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-1.5" />
                                <path d="M2 13h10" />
                                <path d="m5 10-3 3 3 3" />
                            </svg>
                            Import</button>
                    </div>

                    <form action="" class="form-search">
                        <label for="search"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search">
                                <path d="m21 21-4.34-4.34" />
                                <circle cx="11" cy="11" r="8" />
                            </svg></label>
                        <input type="text" name="search" id="search" placeholder="Cari...">
                    </form>
                </div>
            </div>
            <div class="container">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>Jenis SP</th>
                            <th>Jenis Pelanggaran</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Gilang Ramdhan</td>
                            <td>Surat Peringatan 1</td>
                            <td>Mahasiswa yang tidak masuk sebanyak 5%</td>
                            <td>14 September 2025</td>
                            <td>Active</td>
                            <td class="d-flex align-items-center">
                                <a href="" class="btn btn-warning me-2 py-1 px-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen-icon lucide-square-pen">
                                        <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                        <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
                                    </svg>
                                </a>
                                <form action="">
                                    <button class="btn btn-danger py-1 px-2" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
            <div class="modal fade" id="createMahasiswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createMahasiswaLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createMahasiswaLabel">Form Manejement Pelanggaran</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Mahasiswa</label>
                                    <input type="text" class="form-control" id="nama">
                                </div>
                                <div class="mb-3">
                                    <label for="nim" class="form-label">Jenis Surat Peringatan</label>
                                    <input type="text" class="form-control" id="nim">
                                </div>
                                <div class="mb-3">
                                    <label for="prodi" class="form-label">Tanggal</label>
                                    <input type="text" class="form-control" id="prodi">
                                </div>
                                <div class="mb-3">
                                    <label for="kelas" class="form-label">Status Pelanggaran</label>
                                    <input type="text" class="form-control" id="kelas">
                                </div>
                                <div>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>