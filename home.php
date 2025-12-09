<?php
session_start();

if (!isset($_SESSION['nim'])) {
    echo "<script>location.href = './auth/login.php';</script>";
    session_unset();
    session_destroy();
    exit;
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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home | Polibatam Surat Peringatan</title>

    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="./static/style/font.css">
    <script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>

    <style>
        body {
            background-color: #f4f5f6;
        }

        .sidebar-card {
            padding: 0.6rem 0.8rem !important;
            border-radius: 6px;
            background: #fff;
        }

        .sidebar-card span.label {
            font-size: 0.85rem;
            color: #6c757d;
            margin-bottom: 1px;
        }

        .sidebar-card span.value {
            font-size: 1rem;
            font-weight: 600;
            line-height: 1;
        }

        .item-wrapper {
            margin-bottom: 6px;
        }

        .btn-custom {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.2s;
        }

        .btn-custom:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body class="font-poppins">
    <div class="container-fluid py-4">
        <div class="row g-3">
            <!-- SIDEBAR -->
            <div class="col-lg-4">
                <div class="p-4 rounded-3 bg-white shadow-sm h-100 position-relative">
                    <div>
                        <h2 class="font-poppins text-uppercase fw-bold mb-4">DATA MAHASISWA</h2>
                    </div>
                    <!-- FOTO PROFIL -->
                    <div class="text-center">
                        <?php if (!empty($user['profile'])) { ?>
                            <img class="rounded-circle mt-2 shadow"
                                src="./static/img/profile_user/<?= htmlspecialchars($user['profile']) ?>"
                                alt="Foto Mahasiswa"
                                class="object-fit-cover border border-1 rounded-2 shadow"
                                style="width: 300px; height: 300px; object-fit: cover; object-position: top;" />
                        <?php } else { ?>
                            <img class="rounded-circle mt-2 shadow"
                                src="https://i.pinimg.com/736x/f6/61/ea/f661ea61616909838a9fbfeda0d2ea14.jpg"
                                alt="Foto Mahasiswa"
                                class="object-fit-cover border border-1 rounded-2 shadow"
                                style="width: 300px; height: 300px; object-fit: cover; object-position: top;" />
                        <?php } ?>
                    </div>
                    <div class="mt-3">
                        <!-- NIM -->
                        <div class="item-wrapper">
                            <div class="sidebar-card">
                                <span class="label d-flex align-items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                        <circle cx="12" cy="7" r="4" />
                                    </svg>
                                    NIM
                                </span>
                                <span class="fw-semibold fs-6 mt-2"><?= $data['nim']; ?></span>
                            </div>
                        </div>
                        <!-- NAMA -->
                        <div class="item-wrapper">
                            <div class="sidebar-card">
                                <span class="label d-flex align-items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5Z" />
                                        <path d="M20 21a8 8 0 0 0-16 0" />
                                    </svg>
                                    Nama
                                </span>
                                <span class="fw-semibold fs-6 mt-2"><?= $data['nama_user']; ?></span>
                            </div>
                        </div>
                        <!-- EMAIL -->
                        <div class="item-wrapper">
                            <div class="sidebar-card">
                                <span class="label d-flex align-items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <rect x="3" y="5" width="18" height="14" rx="2" ry="2" />
                                        <polyline points="3,7 12,13 21,7" />
                                    </svg>
                                    Email
                                </span>
                                <span class="fw-semibold fs-6 mt-2"><?= $data['email']; ?></span>
                            </div>
                        </div>
                        <!-- PRODI -->
                        <div class="item-wrapper">
                            <div class="sidebar-card">
                                <span class="label d-flex align-items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M2 3h6a4 4 0 0 1 4 4v14a4 4 0 0 0-4-4H2z" />
                                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a4 4 0 0 1 4-4h6z" />
                                    </svg>
                                    Program Studi
                                </span>
                                <span class="fw-semibold fs-6 mt-2"><?= $data['nama_prodi']; ?></span>
                            </div>
                        </div>
                        <!-- KELAS -->
                        <div class="item-wrapper">
                            <div class="sidebar-card">
                                <span class="label d-flex align-items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M17 21v-2a4 4 0 0 0-3-3.87" />
                                        <path d="M7 21v-2a4 4 0 0 1 3-3.87" />
                                        <path d="M12 7a4 4 0 1 0-4 4 4 4 0 0 0 4-4Z" />
                                        <path d="M17 11a4 4 0 1 0-4-4" />
                                    </svg>
                                    Kelas
                                </span>
                                <span class="fw-semibold fs-6 mt-2"><?= $data['kode_prodi'] . " " . $data['semester'] . $data['nama_kelas'] . " - " . $data['jadwal']; ?></span>
                            </div>
                        </div>
                        <!-- BUTTONS -->
                        <div class="mt-4 d-flex gap-2">
                            <button class="btn btn-primary btn-custom" data-bs-toggle="modal"
                                data-bs-target="#modalProfile">Ganti Profil</button>
                            <button class="btn btn-warning btn-custom" data-bs-toggle="modal"
                                data-bs-target="#modalPassword">Ganti Kata Sandi</button>
                        </div>
                        <!-- ================== MODAL GANTI PROFIL ================== -->
                        <div class="modal fade " id="modalProfile" tabindex="-1" aria-labelledby="modalProfileLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalProfileLabel">Ganti Profil</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form action="./staff/backend/update_profile.php" id="formUpdateProfile" method="POST" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Foto Profil</label>
                                                <input type="file" id="profile" name="profile" class="form-control" accept="image/*">
                                            </div>
                                        </div>
                                        <input type="hidden" name="id_user" value="<?= htmlspecialchars($user['id_user']) ?>">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- ================== MODAL GANTI PASSWORD ================== -->
                        <div class="modal fade" id="modalPassword" tabindex="-1" aria-labelledby="modalPasswordLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalPasswordLabel">Ganti Kata Sandi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form method="POST" class="needs-validation" novalidate id="changePasswordMahasiswa">
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Kata Sandi Baru</label>
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan kata sandi baru" required minlength="8">
                                            <div class="invalid-feedback">Password minimal 8 karakter</div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="confirm_password" class="form-label">Konfirmasi Kata Sandi</label>
                                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Masukkan ulang kata sandi baru" required>
                                            <div class="invalid-feedback">Password tidak cocok</div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="id_user" value="<?= $data['id_user'] ?>">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
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

                    <?php for ($i = 1; $i <= 3; $i++) { ?>
                        <div class="card bg-light shadow-sm p-3 mb-3">
                            <h4 class="fw-bold text-uppercase">Surat Peringatan <?= $i ?></h4>
                            <p class="mt-2">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consectetur voluptates corporis quam quas aspernatur enim quidem, saepe similique minus repudiandae consequuntur natus nisi magni ipsum repellendus vel amet, adipisci omnis.</p>
                            <p class="mt-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, ea porro sequi quas nesciunt quod voluptatum repellendus recusandae, consequuntur, ipsum culpa amet obcaecati sint architecto reiciendis eius modi minus sit?</p>
                            <p class="mt-1">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Soluta, similique debitis ut mollitia dolore iure! Commodi, reiciendis. Aliquam ullam pariatur quos cupiditate, cum, ipsum est quia, consequatur iure rerum facere?</p>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <form action="./auth/logout.php" class="position-fixed bottom-0 end-0 p-3" onsubmit="confirmLogout(event, this)">
        <button class="btn btn-danger shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out-icon lucide-log-out">
                <path d="m16 17 5-5-5-5" />
                <path d="M21 12H9" />
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
            </svg>
        </button>
    </form>
</body>

<script src="./node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="./node_modules/sweetalert2/dist/sweetalert2.min.css">
<script src="./static/js/changePasswordMahasiswa.js"></script>
<script src="./static/js/confirmLogout.js"></script>
<script type="text/javascript" src="../static/js/updateProfile.js"></script>

</html>