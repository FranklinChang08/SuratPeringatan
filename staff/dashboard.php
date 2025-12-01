<?php
session_start();

if (!isset($_SESSION['nik'])) {
    echo "<script>location.href = '../auth/login.php';</script>";
    session_unset();
    session_destroy();
    exit;
}

include('../conn.php');

$list_prodi = [];
$list_kelas = [];

$search = isset($_GET['search']) ? $_GET['search'] : '';
$prodi_filter = isset($_GET['prodi']) ? $_GET['prodi'] : '';
$semester_filter = isset($_GET['semester']) ? $_GET['semester'] : '';

$mahasiswa_query = " SELECT * FROM tb_user as u 
    INNER JOIN tb_kelas as k ON k.id_Kelas = u.kelas_id 
    INNER JOIN tb_prodi as p ON p.id_prodi = u.prodi_id WHERE 1=1";
$mahasiswa_count_query = "SELECT COUNT(*) AS total FROM tb_user as u 
    INNER JOIN tb_kelas as k ON k.id_Kelas = u.kelas_id 
    INNER JOIN tb_prodi as p ON p.id_prodi = u.prodi_id WHERE 1=1";

$prodi = mysqli_query($conn, "SELECT * FROM tb_prodi");

$kelas = mysqli_query($conn, "SELECT * FROM tb_kelas AS k INNER JOIN tb_prodi AS p ON p.id_prodi = k.prodi_id");

$kelas_count = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tb_kelas");
$data_kelas = mysqli_fetch_assoc($kelas_count);
$kelasCount = $data_kelas['total'];

if ($search) {
    $mahasiswa_query .= " AND (u.nama_user LIKE '%$search%') OR (u.nim = '$search') OR (u.email LIKE '%$search%')";
    $mahasiswa_count_query .= " AND (u.nama_user LIKE '%$search%') OR (u.nim = '$search') OR (u.email LIKE '%$search%')";
}
if ($prodi_filter) {
    $mahasiswa_query .= " AND u.prodi_id = '$prodi_filter'";
    $mahasiswa_count_query .= " AND u.prodi_id = '$prodi_filter'";
}
if ($semester_filter) {
    $mahasiswa_query .= " AND k.semester = '$semester_filter'";
    $mahasiswa_count_query .= " AND k.semester = '$semester_filter'";
}

$mahasiswa_count = mysqli_query($conn, $mahasiswa_count_query);
$mahasiswa_count_data = mysqli_fetch_assoc($mahasiswa_count);
$total_data = $mahasiswa_count_data['total'];

// Pagination
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$offset = ($page - 1) * $limit;
$total_page = ceil($total_data / $limit);
$range = 3;

// Hitungan range pagination
$start = max(1, $page - floor($range / 2));
$end   = min($total_page, $start + $range - 1);
$start = max(1, $end - $range + 1);

// Info data (1–10 dari total)
$start_asc = ($page - 1) * $limit + 1;
$end_asc   = min($page * $limit, $total_data);

$mahasiswa_query .= " AND u.role = 'Mahasiswa' ORDER BY nim ASC LIMIT $offset, $limit";

$select_mahasiswa = mysqli_query($conn, $mahasiswa_query);

// Masukkan ke array prodi
while ($row = mysqli_fetch_assoc($prodi)) {
    $list_prodi[] = $row;
}

// Masukkan ke array kelas
while ($data = mysqli_fetch_assoc($kelas)) {
    $list_kelas[] = $data;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa | Polibatam Surat Peringatan</title>
    <link rel="icon" href="../static/img/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="../node_modules/bootstrap/dist/js/bootstrap.js"></script>

    <link rel="stylesheet" href="../static/style/font.css">
    <link rel="stylesheet" href="../static/style/sidebar.css">
    <link rel="stylesheet" href="../static/style/dashboard.css">
</head>

<body class="bg-light-subtle font-poppins">
    <?php
    include('../component/sidebar.php');
    ?>

    <div class="main-content">
        <header class="header">
            <h2 class="fw-bold mb-0">Data Mahasiswa</h2>
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
                <div class="button d-flex justify-content-center justify-content-md-between flex-column flex-lg-row gap-2">
                    <div class="button-group mb-2 mb-md-0 ">
                        <button type="button" id="btnCreateMahasiswaModal" class="btn btn-primary font-poppins">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus">
                                <path d="M5 12h14" />
                                <path d="M12 5v14" />
                            </svg>
                            Tambah Mahasiswa</button>
                        <button class="btn btn-primary font-poppins " data-bs-toggle="modal" data-bs-target="#ImportMahasiswa">
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

            <div class="container poppins mb-0 p-3">
                <div class="row mb-2 px-2">
                    <div class="col d-flex justify-content-start align-items-center">
                        <p class="mb-0">
                            <?= $start_asc ?> - <?= $end_asc ?> dari <?= $total_data ?>
                        </p>
                    </div>
                    <form action="" class="col d-flex justify-content-center align-items-center gap-2" autocomplete="off">
                        <select name="prodi" id="" class="form-select">
                            <option value="">Program Studi</option>
                            <?php
                            foreach ($list_prodi as $row) { ?>
                                <option value="<?= $row['id_prodi'] ?>"><?= $row['nama_prodi'] ?></option>
                            <?php } ?>
                        </select>
                        <select name="semester" id="" class="form-select">
                            <option value="">Semester</option>
                            <option value="1">Semester 1</option>
                            <option value="2">Semester 2</option>
                            <option value="3">Semester 3</option>
                            <option value="4">Semester 4</option>
                            <option value="5">Semester 5</option>
                            <option value="6">Semester 6</option>
                            <option value="7">Semester 7</option>
                            <option value="8">Semester 8</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
                <?php
                if ($total_data > 0) {
                ?>
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mahasiswa</th>
                                <th>Email</th>
                                <th>Prodi</th>
                                <th>Kelas</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = $offset + 1;
                            while ($row = mysqli_fetch_array($select_mahasiswa)) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['nama_user']  ?></td>
                                    <td><?= $row['email']  ?></td>
                                    <td><?= $row['nama_prodi']  ?></td>
                                    <td><?= $row['kode_prodi'] . " " . $row['semester'] . $row['nama_kelas'] . " - " . $row['jadwal']  ?></td>
                                    <td class="d-flex align-items-center">
                                        <button type="button" class="btn btn-warning me-2 py-1 px-2" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editMahasiswa"
                                            data-id="<?= $row['id_user'] ?>" data-nim="<?= $row['nim'] ?>"
                                            data-prodi="<?= $row['prodi_id'] ?>" data-kelas="<?= $row['kelas_id'] ?>" data-nama="<?= $row['nama_user'] ?>"
                                            data-email="<?= $row['email'] ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen-icon lucide-square-pen">
                                                <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
                                            </svg>
                                        </button>

                                        <form action="./backend/mahasiswa/delete.php" method="POST" onsubmit="return confirmRemove(event)">
                                            <input type="hidden" name="id_user" value="<?= $row['id_user'] ?>">
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
                            <?php } ?>
                        </tbody>
                    </table>
                <?php
                } else { ?>
                    <div class="container mb-0 p-0 shadow-none">
                        <div class="alert alert-primary  mb-0" role="alert">
                            Data Mahasiswa tidak ada. Silahkan isi data mahasiswa terlebih dahulu!!!!
                        </div>
                    </div>
                <?php }
                ?>
                <?php if ($total_data > 10) { ?>
                    <div class="my-4 d-flex justify-content-center align-items-center gap-4">

                        <!-- PREV -->
                        <?php if ($page > 1): ?>
                            <a href="?page=<?= $page - 1 ?>" class="btn btn-outline-dark mb-0 text-center">Prev</a>
                        <?php endif; ?>

                        <div class="d-flex justify-content-center align-items-center">
                            <!-- jika halaman awal > 1, tampilkan ... -->

                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <!-- range halaman -->
                                <?php for ($i = $start; $i <= $end; $i++): ?>
                                    <a href="?page=<?= $i ?>"
                                        class="btn
                            <?= $page == $i ? 'btn-dark' : 'btn-outline-dark' ?>">
                                        <?= $i ?>
                                    </a>
                                <?php endfor; ?>
                            </div>

                        </div>

                        <!-- NEXT -->
                        <?php if ($page < $total_page): ?>
                            <a href="?page=<?= $page + 1 ?>" class="btn btn-outline-dark mb-0 text-center">Next</a>
                        <?php endif; ?>

                    </div>
                <?php } ?>
            </div>



            <!-- Modal -->
            <div class="modal fade" id="createMahasiswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createMahasiswaLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createMahasiswaLabel">Form Mahasiswa</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" class="needs-validation" novalidate id="FormCreateMahasiswa">
                                <div class="mb-3">
                                    <label for="nimCreate" class="form-label">Nomor Induk Mahasiswa</label>
                                    <input type="number" name="nim" class="form-control" id="nimCreate" placeholder="Masukkan nim mahasiswa..." required>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="namaCreate" class="form-label">Nama Mahasiswa</label>
                                    <input type="text" name="nama_user" class="form-control" id="namaCreate" placeholder="Masukkan nama mahasiswa" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="emailCreate" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="emailCreate" placeholder="Masukkan email mahasiswa" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <!-- <div class="mb-3">
                                    <label for="jurusanCreate" class="form-label">Jurusan</label>
                                    <select class="form-select" id="jurusanCreate" aria-label="Default select example" required>
                                        <option value="" selected>Pilih Jurusan Mahasiswa</option>
                                        <option value="if">Teknik Informatika</option>
                                        <option value="mesin">Teknik Mesin</option>
                                        <option value="elektro">Teknik Elektro</option>
                                        <option value="mb">Manajemen Bisnis</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div> -->
                                <div class="mb-3">
                                    <label for="prodiCreate" class="form-label">Program Studi</label>
                                    <select class="form-select" name="prodi_id" id="prodiCreate" aria-label="Default select example" required>
                                        <option value="" selected>Pilih Program Studi Mahasiswa</option>
                                        <?php
                                        foreach ($list_prodi as $row) { ?>
                                            <option value="<?= $row['id_prodi'] ?>"><?= $row['nama_prodi'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="kelasCreate" class="form-label">Kelas</label>
                                    <select name="kelas_id" class="form-control" id="kelasCreate" required>
                                        <option value="">Pilih Kelas</option>
                                        <?php
                                        foreach ($list_kelas as $kelas) { ?>
                                            <option value="<?= $kelas['id_kelas'] ?>"><?= $kelas['kode_prodi'] . " " . $kelas['semester'] . $kelas['nama_kelas'] . " - " . $kelas['jadwal']  ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal fade" id="editMahasiswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editMahasiswaLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editMahasiswaLabel">Form Mahasiswa</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST" class="needs-validation" novalidate id="FormEditMahasiswa">
                                <div class="mb-3">
                                    <label for="nimEdit" class="form-label">Nomor Induk Mahasiswa</label>
                                    <input type="text" name="nim" class="form-control" id="nimEdit" placeholder="Masukkan nim mahasiswa..." required>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="namaEdit" class="form-label">Nama Mahasiswa</label>
                                    <input type="text" name="nama_user" class="form-control" id="namaEdit" placeholder="Masukkan nama mahasiswa" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="emailEdit" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="emailEdit" placeholder="Masukkan email mahasiswa" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="prodiEdit" class="form-label">Program Studi</label>
                                    <select class="form-select" name="prodi_id" id="prodiEdit" aria-label="Default select example" required>
                                        <option value="" selected>Pilih Program Studi Mahasiswa</option>
                                        <?php
                                        foreach ($list_prodi as $row) { ?>
                                            <option value="<?= $row['id_prodi'] ?>"><?= $row['nama_prodi'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="kelasEdit" class="form-label">Kelas</label>
                                    <select name="kelas_id" class="form-control" id="kelasEdit" required>
                                        <option value="">Pilih Kelas</option>
                                        <?php
                                        foreach ($list_kelas as $kelas) { ?>
                                            <option value="<?= $kelas['id_kelas'] ?>"><?= $kelas['kode_prodi'] . " " . $kelas['semester'] . $kelas['nama_kelas'] . " - " . $kelas['jadwal']  ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div>
                                    <input type="hidden" name="id_user" id="idEdit" value="">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="ImportMahasiswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ImportMahasiswaLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ImportMahasiswaLabel">Form Mahasiswa</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="formImportMahasiswa" novalidate>
                                <div class="mb-3">
                                    <label for="file" class="form-label">File Data Mahasiswa</label>
                                    <input type="file" class="form-control" id="file" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
<script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">

<script src="../static/js/validationFile.js"></script>
<script src="../static/js/confirmRemove.js"></script>
<script src="../static/js/validationFormMahasiswa.js"></script>
<script src="../static/js/confirmLogout.js"></script>

<script>
    document.getElementById('btnCreateMahasiswaModal').addEventListener('click', function() {

        let kelasCount = <?php echo $kelasCount ?>; // ambil dari PHP

        if (kelasCount === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Data Kelas Kosong!',
                text: 'Silakan tambahkan data kelas terlebih dahulu.',
                confirmButtonColor: '#3085d6',
            });
        } else {
            // Jika ada data → buka modal
            var myModal = new bootstrap.Modal(document.getElementById('createMahasiswa'));
            myModal.show();
        }
    });

    document.getElementById('editMahasiswa').addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget; // tombol yang diklik

        // Ambil data dari tombol
        const id = button.getAttribute('data-id');
        const nim = button.getAttribute('data-nim');
        const nama = button.getAttribute('data-nama');
        const kelas = button.getAttribute('data-kelas');
        const email = button.getAttribute('data-email');
        const prodi = button.getAttribute('data-prodi');

        // Isi ke dalam form modal
        document.getElementById('idEdit').value = id;
        document.getElementById('nimEdit').value = nim;
        document.getElementById('namaEdit').value = nama;
        document.getElementById('emailEdit').value = email;
        document.getElementById('prodiEdit').value = prodi;
        document.getElementById('kelasEdit').value = kelas;
    });
</script>

</html>