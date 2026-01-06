<?php
session_start();

if (!isset($_SESSION['nik'])) {
    header("Location: ../auth/login.php");
    exit;
}
include('../conn.php');

$nik = $_SESSION['nik'];

$list_mahasiswa = [];
$list_prodi = [];

$search = isset($_GET['search']) ? $_GET['search'] : '';
$prodi_filter = isset($_GET['prodi']) ? $_GET['prodi'] : '';
$semester_filter = isset($_GET['semester']) ? $_GET['semester'] : '';

$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE nik = '$nik'");
$user = mysqli_fetch_assoc($query);

// Hitung jumlah mahasiswa
$mahasiswa_count_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM tb_user WHERE role = 'Mahasiswa'");
$data_mahasiswa = mysqli_fetch_assoc($mahasiswa_count_query);
$mahasiswaCount = $data_mahasiswa['total'];

// Query untuk dropdown mahasiswa di form
$mahasiswa_list = mysqli_query($conn, "SELECT * FROM tb_user WHERE role = 'Mahasiswa' ORDER BY nama_user");

$prodi = mysqli_query($conn, "SELECT * FROM tb_prodi");

while ($row = mysqli_fetch_assoc($mahasiswa_list)) {
    $list_mahasiswa[] = $row;
}

while ($row = mysqli_fetch_assoc($prodi)) {
    $list_prodi[] = $row;
}

// Ambil semua data pelanggaran + nama mahasiswa
$pelanggaran_query = "SELECT * FROM tb_pelanggaran p INNER JOIN tb_user u ON p.mahasiswa_id = u.id_user INNER JOIN tb_kelas k ON k.id_kelas = u.kelas_id INNER JOIN tb_prodi s ON s.id_prodi = u.prodi_id WHERE 1=1";
$pelanggaran_count_query = "SELECT COUNT(*) AS total FROM tb_pelanggaran p INNER JOIN tb_user u ON p.mahasiswa_id = u.id_user INNER JOIN tb_kelas k ON k.id_kelas = u.kelas_id INNER JOIN tb_prodi s ON s.id_prodi = u.prodi_id WHERE 1=1";

if ($search) {
    $pelanggaran_query .= " AND (u.nama_user LIKE '%$search%') OR (u.nim = '$search') OR (u.email LIKE '%$search%')";
    $pelanggaran_count_query .= " AND (u.nama_user LIKE '%$search%') OR (u.nim = '$search') OR (u.email LIKE '%$search%')";
}
if ($prodi_filter) {
    $pelanggaran_query .= " AND u.prodi_id = '$prodi_filter'";
    $pelanggaran_count_query .= " AND u.prodi_id = '$prodi_filter'";
}
if ($semester_filter) {
    $pelanggaran_query .= " AND k.semester = '$semester_filter'";
    $pelanggaran_count_query .= " AND k.semester = '$semester_filter'";
}

// Hitung total pelanggaran
$pelanggaran_count_query_select = mysqli_query($conn, $pelanggaran_count_query);
$data_pelanggaran = mysqli_fetch_assoc($pelanggaran_count_query_select);
$pelanggaranCount = $data_pelanggaran['total'];

$limit = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

$total_data = $data_pelanggaran['total'];

$offset = ($page - 1) * $limit;
$total_page = ceil($total_data / $limit);

$range = 3;

$start = max(1, $page - floor($range / 2));
$end = min($total_page, $start + $range - 1);

$start = max(1, $end - $range + 1);

$start_asc = ($page - 1) * $limit + 1;
$end_asc = $page * $limit;

if ($end_asc > $total_data) {
    $end_asc = $total_data;
}

$pelanggaran_query .= " AND u.role = 'Mahasiswa' ORDER BY p.tanggal DESC LIMIT $offset, $limit";

$pelanggaran_query_select = mysqli_query($conn, $pelanggaran_query);


function tanggalIndonesia($tanggal, $formatJam = true)
{
    $hari = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    ];

    $bulan = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'April' => 'April',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'September' => 'September',
        'October' => 'Oktober',
        'November' => 'November',
        'December' => 'Desember'
    ];

    $tgl = strtotime($tanggal);

    $hasil = $hari[date('l', $tgl)] . ", "
        . date('d', $tgl) . " "
        . $bulan[date('F', $tgl)] . " "
        . date('Y', $tgl);

    if ($formatJam) {
        $hasil .= " - " . date('H:i:s A', $tgl);
    }

    return $hasil;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggaran | Polibatam Surat Peringatan</title>
    <link rel="icon" href="../static/img/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="../framework/node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="../framework/node_modules/bootstrap/dist/js/bootstrap.js"></script>

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

        .select-wrapper {
            position: relative;
            width: 100%;
        }

        .select-display {
            border: 1px solid #ccc;
            padding: 10px;
            cursor: pointer;
            border-radius: 6px;
            background: #fff;
        }

        .select-dropdown {
            display: none;
            position: absolute;
            top: 110%;
            width: 100%;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 6px;
            z-index: 10;
        }

        .select-dropdown input {
            width: 100%;
            padding: 8px;
            border-bottom: 1px solid #ddd;
            outline: none;
        }

        .select-dropdown ul {
            list-style: none;
            max-height: 200px;
            overflow-y: auto;
            margin: 0;
            padding: 0;
        }

        .select-dropdown ul::-webkit-scrollbar {
            width: 4px;
        }

        .select-dropdown ul::-webkit-scrollbar-track {
            background: transparent;
            width: 4px;
        }

        .select-dropdown ul::-webkit-scrollbar-thumb {
            background-color: #adb5bd;
            border-radius: 10px;
            width: 2px;
        }

        .select-dropdown ul::-webkit-scrollbar-thumb:hover {
            background-color: #6c757d;
        }

        .select-dropdown li {
            padding: 8px 10px;
            cursor: pointer;
            border-radius: 0.5rem;
        }

        .select-dropdown li:hover {
            background: #f0f0f0;
        }

        .custom-search {
            width: 100%;
            padding: .375rem .75rem;
            font-size: 1rem;
            border: 1px solid #ced4da;
            border-radius: .375rem;
        }

        .custom-search:focus {
            outline: none;
            border-color: #86b7fe;
            box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .25);
        }

        .invalid-feedback.show {
            display: block;
        }

        .select-dropdown ul li.selected {
            background-color: #0d6efd;
            color: #fff;
            border-radius: 0.5rem;
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
                    <h2 class=" fs-6 mb-0 fw-bold text-end border-0"><?= $user['nama_user'] ?></h2>
                    <p style="font-size: 10px;" class="mb-0"><?= $user['email'] ?></p>
                </div>
                <a href="./profile.php" class="text-dark">
                    <?php
                    if ($user['profile']) { ?>
                        <img style="width: 40px; height: 40px;" class="rounded-circle border border-black object-fit-cover"
                            src="../static/img/profile_user/<?= $user['profile'] ?>" alt="">
                    <?php } else { ?>
                        <img style="width: 40px; height: 40px;" class="rounded-circle border border-black"
                            src="https://i.pinimg.com/736x/4c/85/31/4c8531dbc05c77cb7a5893297977ac89.jpg" alt="">
                    <?php }
                    ?>
                </a>
            </div>
        </header>

        <section id="tableMahasiswa" class="tableMahasiswa">
            <div class="container">
                <div class="button d-flex justify-content-between flex-column flex-lg-row gap-2">
                    <div class="button-group mb-2 mb-md-0 ">
                        <button type="button" class="btn btn-primary font-poppins" id="btnCreatePelanggaranModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus">
                                <path d="M5 12h14" />
                                <path d="M12 5v14" />
                            </svg>
                            Tambah Pelanggaran
                        </button>
                        <a href="./backend/eksport_pelanggaran.php" class="btn btn-primary">Ekspor</a>
                    </div>

                    <form action="" class="form-search">
                        <label for="search">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-search-icon lucide-search">
                                <path d="m21 21-4.34-4.34" />
                                <circle cx="11" cy="11" r="8" />
                            </svg>
                        </label>
                        <input type="text" name="search" id="search" value="<?= $search ?? '' ?>" placeholder="Cari...">
                    </form>
                </div>
            </div>

            <div class="position-relative container poppins mb-5 p-3">
                <div class="position-sticky top-0 start-0 row mb-2 w-100">
                    <div class="col-12 col-lg-6 mb-3 mb-lg-0 px-0 d-flex justify-content-start align-items-center">
                        <p class="mb-0">
                            <?= $start_asc ?> - <?= $end_asc ?> dari <?= $total_data ?>
                        </p>
                    </div>
                    <form action=""
                        class="col-12 col-lg-6 mb-3 mb-lg-0 px-0 d-flex justify-content-center align-items-center gap-2"
                        autocomplete="off">
                        <select name="prodi" id="" class="form-select">
                            <option value="">Program Studi</option>
                            <?php
                            foreach ($list_prodi as $row) { ?>
                                <option <?= $prodi_filter == $row['id_prodi'] ? "selected" : "" ?>
                                    value="<?= $row['id_prodi'] ?>"><?= $row['nama_prodi'] ?></option>
                            <?php } ?>
                        </select>
                        <select name="semester" id="" class="form-select">
                            <option value="">Semester</option>
                            <option <?= $semester_filter == "1" ? "selected" : "" ?> value="1">Semester 1</option>
                            <option <?= $semester_filter == "2" ? "selected" : "" ?> value="2">Semester 2</option>
                            <option <?= $semester_filter == "3" ? "selected" : "" ?> value="3">Semester 3</option>
                            <option <?= $semester_filter == "4" ? "selected" : "" ?> value="4">Semester 4</option>
                            <option <?= $semester_filter == "5" ? "selected" : "" ?> value="5">Semester 5</option>
                            <option <?= $semester_filter == "6" ? "selected" : "" ?> value="6">Semester 6</option>
                            <option <?= $semester_filter == "7" ? "selected" : "" ?> value="7">Semester 7</option>
                            <option <?= $semester_filter == "8" ? "selected" : "" ?> value="8">Semester 8</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
                <?php if ($pelanggaranCount > 0) { ?>
                    <table class="text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mahasiswa</th>
                                <th>Program Studi</th>
                                <th>Jenis SP</th>
                                <th>Kelas</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($row = mysqli_fetch_array($pelanggaran_query_select)) {
                                // // Tentukan badge class berdasarkan jenis SP
                                // $badge_class = '';
                                // $jenis_sp_text = $row['jenis_sp'];
                        
                                // if ($row['jenis_sp'] == 'SP 1') {
                                //     $badge_class = 'badge-sp1';
                                // } elseif ($row['jenis_sp'] == 'SP 2') {
                                //     $badge_class = 'badge-sp2';
                                // } elseif ($row['jenis_sp'] == 'SP 3') {
                                //     $badge_class = 'badge-sp3';
                                // }
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['nim'] ?> - <?= $row['nama_user'] ?></td>
                                    <td><?= $row['nama_prodi'] ?></td>
                                    <td><?= $row['jenis_sp'] ?></td>
                                    <td><?= $row['kode_prodi'] . " " . $row['semester'] . $row['nama_kelas'] . " - " . $row['jadwal'] ?>
                                    </td>
                                    <td class="text-nowrap">
                                        <?= strlen($row['keterangan']) > 50
                                            ? substr($row['keterangan'], 0, 50) . "..."
                                            : $row['keterangan'];
                                        ?>
                                    </td>
                                    <td><?= tanggalIndonesia($row['tanggal']); ?></td>
                                    <td class="d-flex align-items-center">
                                        <button type="button" class="btn btn-warning me-2 py-1 px-2" data-bs-toggle="modal"
                                            data-bs-target="#editPelanggaran" data-id="<?= $row['id_pelanggaran'] ?>"
                                            data-mahasiswa="<?= $row['mahasiswa_id'] ?>" data-jenis="<?= $row['jenis_sp'] ?>"
                                            data-tanggal="<?= date('Y-m-d', strtotime($row['tanggal'])) ?>"
                                            data-keterangan="<?= htmlspecialchars($row['keterangan']) ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="lucide lucide-square-pen-icon lucide-square-pen">
                                                <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                <path
                                                    d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
                                            </svg>
                                        </button>

                                        <form action="./backend/pelanggaran/delete.php" method="POST"
                                            onsubmit="return confirmRemove(event)">
                                            <input type="hidden" name="id_pelanggaran" value="<?= $row['id_pelanggaran'] ?>">
                                            <button class="btn btn-danger py-1 px-2" type="submit" name="submit" value="submit">
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
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <div class="container mb-0 shadow-none p-0">
                        <div class="alert alert-primary mb-0" role="alert">
                            Data Pelanggaran tidak ada. Silahkan isi data pelanggaran terlebih dahulu!!!!
                        </div>
                    </div>
                <?php } ?>
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
                                    <a href="?page=<?= $i ?>" class="btn <?= $page == $i ? 'btn-dark' : 'btn-outline-dark' ?>">
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


            <!-- Modal Create -->
            <div class="modal fade" id="createPelanggaran" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="createPelanggaranLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createPelanggaranLabel">Form Tambah Pelanggaran</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="formCreatePelanggaran" class="needs-validation" novalidate
                                autocomplete="off">

                                <div class="mb-3">
                                    <label for="mahasiswaCreate" class="form-label">
                                        Mahasiswa
                                    </label>

                                    <div class="select-wrapper">
                                        <div class="form-select" id="selectDisplay" tabindex="0">
                                            Pilih Mahasiswa
                                        </div>

                                        <div class="select-dropdown p-2" id="selectDropdown">
                                            <input type="text" class="custom-search mb-2" id="searchInput"
                                                placeholder="Cari berdasarkan NIM atau Nama...">


                                            <ul id="optionList">
                                                <?php foreach ($list_mahasiswa as $mhs): ?>
                                                    <li data-id="<?= $mhs['id_user']; ?>" data-nim="<?= $mhs['nim']; ?>"
                                                        data-nama="<?= $mhs['nama_user']; ?>">
                                                        <?= $mhs['nim']; ?> - <?= $mhs['nama_user']; ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <input type="hidden" id="mahasiswaCreate" name="mahasiswa_id" required>

                                    <div class="invalid-feedback">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="jenis_suratCreate" class="form-label">Jenis Surat Peringatan</label>
                                    <select class="form-select" name="jenis_sp" id="jenis_suratCreate" required>
                                        <option value="" selected>Pilih Jenis Surat Pelanggaran</option>
                                        <option value="SP 1">SP 1</option>
                                        <option value="SP 2">SP 2</option>
                                        <option value="SP 3">SP 3</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="keteranganCreate" class="form-label">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" id="keteranganCreate" rows="3"
                                        required></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <input type="submit" name="submit" value="Kirim" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit -->
            <div class="modal fade" id="editPelanggaran" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="editPelanggaranLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editPelanggaranLabel">Form Edit Pelanggaran</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="./backend/pelanggaran/update.php" id="formEditPelanggaran"
                                class="needs-validation" novalidate autocomplete="off">
                                <input type="hidden" name="id_pelanggaran" id="id_pelanggaran">
                                <div class="mb-3">
                                    <label for="mahasiswaEdit" class="form-label">
                                        Mahasiswa
                                    </label>

                                    <div class="select-wrapper">
                                        <div class="form-select" id="selectDisplayEdit" tabindex="0">
                                            Pilih Mahasiswa
                                        </div>

                                        <div class="select-dropdown p-2" id="selectDropdownEdit">
                                            <input type="text" class="custom-search mb-2" id="searchInputEdit"
                                                placeholder="Cari berdasarkan NIM atau Nama...">

                                            <ul id="optionListEdit">
                                                <?php foreach ($list_mahasiswa as $mhs): ?>
                                                    <li data-id="<?= $mhs['id_user']; ?>" data-nim="<?= $mhs['nim']; ?>"
                                                        data-nama="<?= $mhs['nama_user']; ?>">
                                                        <?= $mhs['nim']; ?> - <?= $mhs['nama_user']; ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <input type="hidden" id="mahasiswaEdit" name="mahasiswa_id" required>

                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="jenis_suratEdit" class="form-label">Jenis Surat Peringatan</label>
                                    <select class="form-select" name="jenis_sp" id="jenis_suratEdit" required>
                                        <option value="" selected>Pilih Jenis Surat Pelanggaran</option>
                                        <option value="SP 1">SP 1</option>
                                        <option value="SP 2">SP 2</option>
                                        <option value="SP 3">SP 3</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="keteranganEdit" class="form-label">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" id="keteranganEdit" rows="3"
                                        required></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div>
                                    <input type="hidden" name="id_pelanggaran" id="id_pelanggaranEdit" value="">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <input type="submit" name="submit" value="Kirim" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

<script src="../framework/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="../framework/node_modules/sweetalert2/dist/sweetalert2.min.css">

<script src="../static/js/validationFormPelanggaran.js"></script>
<script src="../static/js/confirmRemove.js"></script>
<script src="../static/js/confirmLogout.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        const display = document.getElementById("selectDisplay");
        const dropdown = document.getElementById("selectDropdown");
        const search = document.getElementById("searchInput");
        const options = [...document.querySelectorAll("#optionList li")];
        const hidden = document.getElementById("mahasiswaCreate");
        const label = document.querySelector('label[for="mahasiswaCreate"]');

        label.addEventListener("click", () => {
            dropdown.style.display = "block";
            display.focus();
        });

        display.addEventListener("click", (e) => {
            e.stopPropagation();

            dropdown.style.display =
                dropdown.style.display === "block" ? "none" : "block";
        });


        function showDefault() {
            options.forEach((opt, i) => {
                opt.style.display = i < 5 ? "block" : "none";
            });
        }
        showDefault();

        dropdown.addEventListener("click", e => e.stopPropagation());

        search.addEventListener("input", function () {
            const keyword = this.value.toLowerCase();

            if (!keyword) {
                showDefault();
                return;
            }

            options.forEach(opt => {
                const match =
                    opt.dataset.nim.toLowerCase().includes(keyword) ||
                    opt.dataset.nama.toLowerCase().includes(keyword);

                opt.style.display = match ? "block" : "none";
            });
        });

        options.forEach(option => {
            option.addEventListener("click", function (e) {
                e.stopPropagation();

                display.textContent =
                    `${this.dataset.nim} - ${this.dataset.nama}`;

                hidden.value = this.dataset.id;

                display.classList.remove('is-invalid');
                display.classList.add('is-valid');
                mahasiswaFeedbackCreate.classList.remove('show');

                dropdown.style.display = "none";
            });
        });


        document.addEventListener("click", function () {
            dropdown.style.display = "none";
        });

        document.querySelector("form").addEventListener("submit", function (e) {
            if (!hidden.value) {
                e.preventDefault();
                display.classList.add("is-invalid");
            }
        });

        document.addEventListener("click", e => {
            if (!e.target.closest(".select-wrapper")) {
                dropdown.style.display = "none";
            }
        });

        function setMahasiswaEditById(id) {
            hiddenEdit.value = id;

            // reset search
            searchEdit.value = '';

            optionsEdit.forEach(li => {
                li.style.display = 'block';

                if (li.dataset.id === String(id)) {
                    // set display dari data LI
                    displayEdit.textContent =
                        `${li.dataset.nim} - ${li.dataset.nama}`;

                    li.classList.add('selected');
                    displayEdit.classList.remove('is-invalid');
                    displayEdit.classList.add('is-valid');
                } else {
                    li.classList.remove('selected');
                }
            });
        }

        document.querySelectorAll('[data-bs-target="#editPelanggaran"]')
            .forEach(btn => {
                btn.addEventListener('click', function () {

                    const mahasiswaId = this.dataset.mahasiswa;

                    // 🔥 INI KUNCINYA
                    setMahasiswaEditById(mahasiswaId);

                });
            });

        const displayEdit = document.getElementById('selectDisplayEdit');
        const dropdownEdit = document.getElementById('selectDropdownEdit');
        const searchEdit = document.getElementById('searchInputEdit');
        const hiddenEdit = document.getElementById('mahasiswaEdit');
        const optionListEdit = document.getElementById('optionListEdit');
        const optionsEdit = optionListEdit.querySelectorAll('li');
        const feedbackEdit = hiddenEdit.nextElementSibling;

        displayEdit.addEventListener('click', function (e) {
            e.stopPropagation();
            dropdownEdit.style.display =
                dropdownEdit.style.display === 'block' ? 'none' : 'block';
        });

        dropdownEdit.addEventListener('click', e => e.stopPropagation());

        optionsEdit.forEach(option => {
            option.addEventListener("click", function (e) {
                e.stopPropagation();

                optionsEdit.forEach(li => li.classList.remove('selected'));

                this.classList.add('selected');

                displayEdit.textContent =
                    `${this.dataset.nim} - ${this.dataset.nama}`;

                hiddenEdit.value = this.dataset.id;

                displayEdit.classList.remove('is-invalid');
                displayEdit.classList.add('is-valid');
                feedbackEdit.classList.remove('show');

                dropdownEdit.style.display = 'none';
            });
        });

        searchEdit.addEventListener('input', function () {
            const val = this.value.toLowerCase();

            optionsEdit.forEach(li => {
                const text =
                    (li.dataset.nim + ' ' + li.dataset.nama).toLowerCase();

                li.style.display = text.includes(val) ? 'block' : 'none';
            });
        });

        document.addEventListener('click', function () {
            dropdownEdit.style.display = 'none';
        });

    });
</script>


<script>
    // Button Create Modal dengan validasi mahasiswa count
    document.getElementById('btnCreatePelanggaranModal').addEventListener('click', function () {
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

    // Edit Modal - Populate Data
    document.getElementById('editPelanggaran').addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;

        const id = button.getAttribute('data-id');
        const mahasiswa = button.getAttribute('data-mahasiswa');
        const jenis = button.getAttribute('data-jenis');
        const keterangan = button.getAttribute('data-keterangan');

        document.getElementById('id_pelanggaranEdit').value = id;
        document.getElementById('mahasiswaEdit').value = mahasiswa;
        document.getElementById('jenis_suratEdit').value = jenis;
        document.getElementById("keteranganEdit").value = keterangan;
    });
</script>


</html>