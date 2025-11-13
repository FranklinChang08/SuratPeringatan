<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <?php
    include('../component/sidebar.php')
    ?>

    <div class="main-content">
        <header class="header">
            <h2 class="fw-bold">Data Pelanggaran</h2>
            <div class="account">
                <div class="account-desc">
                    <h2 class="nama fs-6 mb-0 fw-bold">Gilang</h2>
                    <h2 class="email">gilang@gmail.com</h2>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-user-icon lucide-user">
                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
            </div>
        </header>
        <section id="tableMahasiswa" class="tableMahasiswa">
            <div class="container">
                <div class="button d-flex justify-content-between flex-column flex-lg-row gap-2">
                    <div class="button-group">
                        <button type="button" class="btn btn-primary font-poppins" data-bs-toggle="modal"
                            data-bs-target="#createPelanggaran">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus">
                                <path d="M5 12h14" />
                                <path d="M12 5v14" />
                            </svg>
                            Tambah Mahasiswa</button>

                        <button class="btn btn-primary font-poppins" data-bs-toggle="modal"
                            data-bs-target="#ImportMahasiswa">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-folder-output-icon lucide-folder-output">
                                <path
                                    d="M2 7.5V5a2 2 0 0 1 2-2h3.9a2 2 0 0 1 1.69.9l.81 1.2a2 2 0 0 0 1.67.9H20a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-1.5" />
                                <path d="M2 13h10" />
                                <path d="m5 10-3 3 3 3" />
                            </svg>
                            Import</button>
                    </div>

                    <form action="" class="form-search">
                        <label for="search"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-search-icon lucide-search">
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
                                                    id="formEditPelanggaran">
                                                    <div class="mb-3">
                                                        <label for="mahasiswaEdit" class="form-label">Mahasiswa</label>
                                                        <input type="text" class="form-control" id="mahasiswaEdit"
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
                            <form method="POST" class="needs-validation" novalidate id="formCreatePelanggaran">
                                <div class="mb-3">
                                    <label for="mahasiswaCreate" class="form-label">Mahasiswa</label>
                                    <input type="text" class="form-control" id="mahasiswaCreate" required>
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
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal fade" id="ImportMahasiswa" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="ImportMahasiswaLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ImportMahasiswaLabel">Form Mahasiswa</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="FormImportMahasiswa">
                                <div class="mb-3">
                                    <label for="file" class="form-label">File Data Mahasiswa</label>
                                    <input type="file" class="form-control" id="file">
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
        </section>
    </div>
</body>

<script type="text/javascript">
const formCreatePelanggaran = document.getElementById('formCreatePelanggaran');
const mahasiswaInputCreate = document.getElementById('mahasiswaCreate');
const jenisSuratInputCreate = document.getElementById('jenis_suratCreate');
const tanggalInputCreate = document.getElementById('tanggalCreate');
const statusInputCreate = document.getElementById('statusCreate');
const keteranganInputCreate = document.getElementById('keteranganCreate');

formCreatePelanggaran.addEventListener('submit', function(event) {
    event.preventDefault()
    formCreatePelanggaran.classList.add('was-validated')
    let isValid = true

    const mahasiswaFeedbackCreate = mahasiswaInputCreate.nextElementSibling;
    mahasiswaInputCreate.classList.remove('is-invalid')
    if (mahasiswaInputCreate.value === '') {
        mahasiswaFeedbackCreate.textContent = 'Silahkan masukkan atau pilih nama mahasiswa'
        mahasiswaInputCreate.classList.add('is-invalid')
        isValid = false
    }

    const jenisSuratFeedbackCreate = jenisSuratInputCreate.nextElementSibling;
    jenisSuratInputCreate.classList.remove('is-invalid')
    if (jenisSuratInputCreate.value === '') {
        jenisSuratFeedbackCreate.textContent = 'Silahkan pilih jenis surat'
        jenisSuratInputCreate.classList.add('is-invalid')
        isValid = false
    }
    const tanggalFeedbackCreate = tanggalInputCreate.nextElementSibling;
    tanggalInputCreate.classList.remove('is-invalid')
    if (tanggalInputCreate.value === '') {
        tanggalFeedbackCreate.textContent = 'Silahkan pilih tanggal'
        tanggalInputCreate.classList.add('is-invalid')
        isValid = false
    }

    const statusFeedbackCreate = statusInputCreate.nextElementSibling;
    statusInputCreate.classList.remove('is-invalid')
    if (statusInputCreate.value === '') {
        statusFeedbackCreate.textContent = 'Silahkan pilih status'
        statusInputCreate.classList.add('is-invalid')
        isValid = false
    }

    const keteranganFeedbackCreate = keteranganInputCreate.nextElementSibling;
    keteranganInputCreate.classList.remove('is-invalid')
    if (keteranganInputCreate.value === '') {
        keteranganFeedbackCreate.textContent = 'Silahkan Isi Keterangan'
        keteranganInputCreate.classList.add('is-invalid')
        isValid = false
    }

    if (isValid) {
        const modal = bootstrap.Modal.getInstance(
            document.getElementById("createPelanggaran")
        );
        modal.hide();

        alert("Data Pelanggaran berhasil dikirim!");
        formCreatePelanggaran.reset();
        formCreatePelanggaran.classList.remove("was-validated");
    }
})

const formEditPelanggaran = document.getElementById('formEditPelanggaran');
const mahasiswaInputEdit = document.getElementById('mahasiswaEdit');
const jenisSuratInputEdit = document.getElementById('jenis_suratEdit');
const tanggalInputEdit = document.getElementById('tanggalEdit');
const statusInputEdit = document.getElementById('statusEdit');
const keteranganInputEdit = document.getElementById('keteranganEdit');

formEditPelanggaran.addEventListener('submit', function(event) {
    event.preventDefault()
    formEditPelanggaran.classList.add('was-validated')
    let isValid = true

    const mahasiswaFeedbackEdit = mahasiswaInputEdit.nextElementSibling;
    mahasiswaInputEdit.classList.remove('is-invalid')
    if (mahasiswaInputEdit.value === '') {
        mahasiswaFeedbackEdit.textContent = 'Silahkan masukkan atau pilih nama mahasiswa'
        mahasiswaInputEdit.classList.add('is-invalid')
        isValid = false
    }

    const jenisSuratFeedbackEdit = jenisSuratInputEdit.nextElementSibling;
    jenisSuratInputEdit.classList.remove('is-invalid')
    if (jenisSuratInputEdit.value === '') {
        jenisSuratFeedbackEdit.textContent = 'Silahkan pilih jenis surat'
        jenisSuratInputEdit.classList.add('is-invalid')
        isValid = false
    }
    const tanggalFeedbackEdit = tanggalInputEdit.nextElementSibling;
    tanggalInputEdit.classList.remove('is-invalid')
    if (tanggalInputEdit.value === '') {
        tanggalFeedbackEdit.textContent = 'Silahkan pilih tanggal'
        tanggalInputEdit.classList.add('is-invalid')
        isValid = false
    }

    const statusFeedbackEdit = statusInputEdit.nextElementSibling;
    statusInputEdit.classList.remove('is-invalid')
    if (statusInputEdit.value === '') {
        statusFeedbackEdit.textContent = 'Silahkan pilih status'
        statusInputEdit.classList.add('is-invalid')
        isValid = false
    }

    const keteranganFeedbackEdit = keteranganInputEdit.nextElementSibling;
    keteranganInputEdit.classList.remove('is-invalid')
    if (keteranganInputEdit.value === '') {
        keteranganFeedbackEdit.textContent = 'Silahkan Isi Keterangan'
        keteranganInputEdit.classList.add('is-invalid')
        isValid = false
    }

    if (isValid) {
        const modal = bootstrap.Modal.getInstance(
            document.getElementById("EditPelanggaran")
        );
        modal.hide();

        alert("Data pelanggaran berhasil dikirim!");
        formEditPelanggaran.reset();
        formEditPelanggaran.classList.remove("was-validated");
    }
})
</script>

</html>