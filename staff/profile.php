<?php
session_start();

if (!isset($_SESSION['nik'])) {
    echo "<script>location.href = '../auth/login.php';</script>";
    session_unset();
    session_destroy();
    exit;
}

include('../conn.php');

$nik = $_SESSION['nik'];

$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE nik = '$nik'");
$user = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page | Polibatam Surat Peringatan</title>
    <link rel="icon" href="../static/img/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="../node_modules/bootstrap/dist/js/bootstrap.js"></script>

    <link rel="stylesheet" href="../static/style/font.css">
    <link rel="stylesheet" href="../static/style/sidebar.css">
    <link rel="stylesheet" href="../static/style/dashboard.css">

    <style>
        .profile-preview {
            width: 250px;
            height: 250px;
            aspect-ratio: 1/1;
            object-fit: cover;
            border: 1px solid #CCC;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-light-subtle font-poppins">
    <?php
    include('../component/sidebar.php')
    ?>

    <div class="main-content">
        <header class="header">
            <h2 class="fw-bold fs-3 text-uppercase m-0">Profile</h2>
            <div class="account">
                <div class="account-desc">
                    <h2 class="nama fs-6 mb-0 fw-bold">Gilang</h2>
                    <h2 style="font-size: 10px;" class="email mb-0">gilang@gmail.com</h2>
                </div>
                <a href="./profile.php" class="text-dark">
                    <?php
                    if ($user['profile']) { ?>
                        <img style="width: 40px; height: 40px;" class="rounded-circle border border-black object-fit-cover" src="../static/img/profile_user/<?= $user['profile'] ?>" alt="">
                    <?php } else { ?>
                        <img style="width: 40px; height: 40px;" class="rounded-circle border border-black" src="https://i.pinimg.com/736x/4c/85/31/4c8531dbc05c77cb7a5893297977ac89.jpg" alt="">
                    <?php }
                    ?>
                </a>
            </div>
        </header>

        <section id="settingsUser" class="settings-users">
            <div class="container p-3">
                <div class="p-4 bg-white shadow-sm rounded-1">
                    <h5 class="fw-bold text-uppercase">Pengaturan Akun</h5>
                    <form id="formUpdateProfile" method="POST" class="row row-cols-1 row-cols-md-2 needs-validation" enctype="multipart/form-data" novalidate>
                        <div class="d-flex flex-column justify-content-center align-items-center gap-2 mb-3">
                            <?php
                            if ($user['profile'] != null) { ?>
                                <img class="profile-preview" src="../static/img/profile_user/<?= $user['profile'] ?>" alt="">
                            <?php } else {
                            ?>
                                <img class="profile-preview" src="https://i.pinimg.com/736x/f6/61/ea/f661ea61616909838a9fbfeda0d2ea14.jpg" alt="">

                            <?php } ?>
                        </div>
                        <div>
                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="text" class="form-control text-secondary" name="nik" id="nik"
                                    value="<?= $user['nik']; ?>" readonly>

                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control text-secondary" name="email" id="email"
                                    value="<?= $user['email']; ?>" readonly>

                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control text-secondary" name="nama" id="nama"
                                    value="<?= $user['nama_user']; ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="profile">Profil File</label>
                                <input type="file" id="profile" name="profile" class="form-control w-100" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div>
                                <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                                <button class="btn btn-primary" type="submit">Kirim</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class=" p-4 bg-white shadow-sm rounded-1 mt-3">
                    <h5 class="fw-bold text-uppercase">Ganti Kata Sandi</h5>
                    <form method="POST" class="row row-cols-2 needs-validation" id="formChangePassword" novalidate autocomplete="off">
                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi Baru</label>
                            <input type="text" class="form-control" name="password" required id="password" placeholder="Masukkan Password anda...">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Konfirmasi Kata Sandi</label>
                            <input type="confirm_password" class="form-control" name="confirm_password" required id="confirm_password" placeholder="Konfirmasi Password anda...">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div>
                            <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                            <button class="btn btn-primary" type="submit">Kirim</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>
<script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
<script type="text/javascript" src="../static/js/changePasswordStaff.js"></script>
<script type="text/javascript" src="../static/js/updateProfile.js"></script>

</html>