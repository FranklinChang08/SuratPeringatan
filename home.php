<?php
session_start();

if (!isset($_SESSION['nim'])) {
    echo "<script>location.href = './auth/login.php';</script>";
    session_unset();
    session_destroy();
    exit;
}

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
        $hasil .= " - " . date('H:i A', $tgl);
    }

    return $hasil;
}

include('conn.php');
$nim = $_SESSION['nim'];

$query = mysqli_query($conn, "SELECT *
                              FROM tb_user u
                              LEFT JOIN tb_prodi p ON u.prodi_id = p.id_prodi
                              LEFT JOIN tb_kelas k ON u.kelas_id = k.id_kelas
                              WHERE nim = '$nim'");

$data = mysqli_fetch_assoc($query);
$user = $data;

$select_pelanggaran = mysqli_query($conn, "SELECT * FROM tb_pelanggaran AS p INNER JOIN tb_user as u ON u.id_user = p.mahasiswa_id WHERE u.nim = '$nim' AND u.role = 'Mahasiswa' ORDER BY jenis_sp ASC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home | Polibatam Surat Peringatan</title>
    <link rel="icon" href="./static/img/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="./framework/node_modules/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="./static/style/font.css">
    <link rel="stylesheet" href="./static/style/home.css">
    <script src="./framework/node_modules/bootstrap/dist/js/bootstrap.js"></script>
</head>

<body class="font-poppins">
    <div class="bg-content"></div>
    <div class="content container-fluid p-2 p-lg-5">
        <div class="row g-3">
            <!-- SIDEBAR -->
            <div class="col-lg-4">
                <div class="p-4 rounded-3 bg-white shadow-md h-100 position-relative">
                    <div>
                        <h2 class="font-poppins text-uppercase fw-bold mb-4">DATA MAHASISWA</h2>
                    </div>
                    <!-- FOTO PROFIL -->
                    <div class="text-center">
                        <?php if (!empty($user['profile'])) { ?>
                            <img class="rounded-2 mt-2 shadow"
                                src="./static/img/profile_user/<?= htmlspecialchars($user['profile']) ?>"
                                alt="Foto Mahasiswa" class="object-fit-cover border border-1 rounded-2 shadow"
                                style="width: 300px; height: 300px; object-fit: cover; object-position: center;" />
                        <?php } else { ?>
                            <img class="rounded-2 mt-2 shadow"
                                src="https://i.pinimg.com/736x/f6/61/ea/f661ea61616909838a9fbfeda0d2ea14.jpg"
                                alt="Foto Mahasiswa" class="object-fit-cover border border-1 rounded-2 shadow"
                                style="width: 300px; height: 300px; object-fit: cover; object-position: center;" />
                        <?php } ?>
                    </div>
                    <div class="mt-3">
                        <!-- NIM -->
                        <div class="item-wrapper">
                            <div class="sidebar-card">
                                <div class="label">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                    <span>NIM</span>
                                </div>
                                <span class="fw-semibold fs-6"><?= $data['nim']; ?></span>
                            </div>
                        </div>
                        <!-- NAMA -->
                        <div class="item-wrapper">
                            <div class="sidebar-card">
                                <div class="label">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Z" />
                                        <path d="M20 21a8 8 0 0 0-16 0" />
                                    </svg>
                                    <span>Nama</span>
                                </div>
                                <span class="fw-semibold fs-6"><?= $data['nama_user']; ?></span>
                            </div>
                        </div>
                        <!-- EMAIL -->
                        <div class="item-wrapper">
                            <div class="sidebar-card">
                                <div class="label">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <rect x="3" y="5" width="18" height="14" rx="2" ry="2" />
                                        <polyline points="3,7 12,13 21,7" />
                                    </svg>
                                    <span>Email</span>
                                </div>
                                <span class="fw-semibold fs-6"><?= $data['email']; ?></span>
                            </div>
                        </div>
                        <!-- PRODI -->
                        <div class="item-wrapper">
                            <div class="sidebar-card">
                                <div class="label">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M2 3h6a4 4 0 0 1 4 4v14a4 4 0 0 0-4-4H2z" />
                                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a4 4 0 0 1 4-4h6z" />
                                    </svg>
                                    <span>Program Studi</span>
                                </div>
                                <span class="fw-semibold fs-6"><?= $data['nama_prodi']; ?></span>
                            </div>
                        </div>
                        <!-- KELAS -->
                        <div class="item-wrapper">
                            <div class="sidebar-card">
                                <div class="label">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M17 21v-2a4 4 0 0 0-3-3.87" />
                                        <path d="M7 21v-2a4 4 0 0 1 3-3.87" />
                                        <path d="M12 7a4 4 0 1 0-4 4 4 4 0 0 0 4-4Z" />
                                        <path d="M17 11a4 4 0 1 0-4-4" />
                                    </svg>
                                    <span>Kelas</span>
                                </div>
                                <span
                                    class="fw-semibold fs-6 mt-2"><?= $data['kode_prodi'] . " " . $data['semester'] . $data['nama_kelas'] . " - " . $data['jadwal']; ?></span>
                            </div>
                        </div>
                        <!-- NAMA -->
                        <div class="item-wrapper">
                            <div class="sidebar-card">
                                <div class="label">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Z" />
                                        <path d="M20 21a8 8 0 0 0-16 0" />
                                    </svg>
                                    <span>Dosen Wali</span>
                                </div>
                                <span class="fw-semibold fs-6"><?= $data['nama_dosen']; ?></span>
                            </div>
                        </div>
                        <!-- BUTTONS -->
                        <div class="mt-4 d-flex gap-2">
                            <button class="btn btn-primary btn-custom" data-bs-toggle="modal"
                                data-bs-target="#modalProfile">Ganti Profil</button>
                            <button class="btn btn-warning btn-custom" data-bs-toggle="modal"
                                data-bs-target="#modalPassword">Ganti Kata Sandi</button>
                        </div>
                        <div class="mt-2">
                            <form action="./auth/logout.php" method="POST" onsubmit="confirmLogout(event, this)">
                                <button type="submit" class="btn btn-danger w-100">
                                    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-log-out-icon lucide-log-out">
                                            <path d="m16 17 5-5-5-5" />
                                            <path d="M21 12H9" />
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                        </svg></span>
                                    <span>Keluar</span>
                                </button>
                            </form>
                        </div>
                        <!-- ================== MODAL GANTI PROFIL ================== -->
                        <div class="modal fade " id="modalProfile" tabindex="-1" aria-labelledby="modalProfileLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalProfileLabel">Ganti Profil</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formUpdateProfileMahasiswa" class="needs-validation" novalidate
                                            method="POST" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label class="form-label">Foto Profil</label>
                                                <input type="file" id="profile" name="profile" class="form-control"
                                                    accept="image/*">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <input type="hidden" name="id_user"
                                                value="<?= htmlspecialchars($user['id_user']) ?>">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ================== MODAL GANTI PASSWORD ================== -->
                        <div class="modal fade" id="modalPassword" tabindex="-1" aria-labelledby="modalPasswordLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalPasswordLabel">Ganti Kata Sandi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" class="needs-validation" novalidate
                                            id="changePasswordMahasiswa">
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Kata Sandi Baru</label>
                                                <input type="password" class="form-control" name="password"
                                                    id="password" placeholder="Masukkan kata sandi baru" required
                                                    minlength="8">
                                                <div class="invalid-feedback">Password minimal 8 karakter</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="confirm_password" class="form-label">Konfirmasi Kata
                                                    Sandi</label>
                                                <input type="password" class="form-control" name="confirm_password"
                                                    id="confirm_password" placeholder="Masukkan ulang kata sandi baru"
                                                    required>
                                                <div class="invalid-feedback">Password tidak cocok</div>
                                            </div>
                                            <input type="hidden" name="id_user" value="<?= $data['id_user'] ?>">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KONTEN KANAN -->
            <div class="col-lg-8">
                <div class="p-4 shadow-sm bg-white rounded-3 h-100">
                    <h2 class="fw-bold text-uppercase mb-4">Data Pelanggaran</h2>
                    <?php if (mysqli_num_rows($select_pelanggaran) > 0) {
                        while ($row = mysqli_fetch_array($select_pelanggaran)) { ?>
                            <div class="card bg-light shadow-sm p-3 mb-3">
                                <div class="w-100 row">
                                    <?php
                                    $mapJenis = [
                                        "SP 1" => "Surat Peringatan 1",
                                        "SP 2" => "Surat Peringatan 2",
                                        "SP 3" => "Surat Peringatan 3"
                                    ];

                                    $jenisLengkap = $mapJenis[$row['jenis_sp']] ?? $row['jenis_sp'];
                                    ?>
                                    <h4 class="col-12 col-lg-6 mb-0 fw-bold text-uppercase"><?= $jenisLengkap ?></h4>
                                    <p class="col-12 col-lg-6 mb-0 text-start text-lg-end p-lg-0">
                                        <?= tanggalIndonesia($row['tanggal']) ?>
                                    </p>
                                </div>
                                <p class="fs-6 mt-2"><?= $row['keterangan'] ?></p>
                                <div class="alert alert-warning mb-0 d-flex align-items-center gap-2" role="alert">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="lucide lucide-triangle-alert-icon lucide-triangle-alert">
                                        <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3" />
                                        <path d="M12 9v4" />
                                        <path d="M12 17h.01" />
                                    </svg>
                                    <span>Silahkan hubungi wali kelas segera!!!</span>
                                </div>
                            </div>
                        <?php }
                    } else { ?>
                        <div class="alert alert-primary mb-0" role="alert">
                            <div class="d-flex gap-4 align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-triangle-alert-icon lucide-triangle-alert">
                                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3" />
                                    <path d="M12 9v4" />
                                    <path d="M12 17h.01" />
                                </svg>
                                <div>
                                    <h4 class="fw-bold mb-0">Tidak terdapat surat peringatan untuk Mahasiswa ini.</h4>
                                    <p class="mb-0 fs-6">Mahasiswa tercatat tidak memiliki pelanggaran dan berada dalam
                                        status
                                        baik.</p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="./framework/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="./node_modules/sweetalert2/dist/sweetalert2.min.css">
<script src="./static/js/changePasswordMahasiswa.js"></script>
<script src="./static/js/confirmLogout.js"></script>
<script type="text/javascript" src="./static/js/updateProfileMahasiswa.js"></script>

</html>