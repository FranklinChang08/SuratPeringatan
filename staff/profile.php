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
                    <h2 class="email">gilang@gmail.com</h2>
                </div>
                <a href="./profile.php" class="text-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-user-icon lucide-user">
                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                </a>
            </div>
        </header>

        <section id="settingsUser" class="settings-users">
            <div class="container p-3">
                <div class="p-4 bg-white shadow-sm rounded-1">
                    <h5 class="fw-bold text-uppercase">Account Settings</h5>
                    <form action="" class="row row-cols-1 row-cols-md-2">
                        <div class="d-flex flex-column justify-content-center align-items-center gap-2 mb-3">
                            <img class="profile-preview" src="https://i.pinimg.com/736x/f6/61/ea/f661ea61616909838a9fbfeda0d2ea14.jpg" alt="">

                            <div>
                                <label for="profile">Profile File</label>
                                <input type="file" id="profile" name="profile" class="form-control w-100">
                            </div>
                        </div>
                        <div>
                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="text" class="form-control" name="nik" required id="nik" readonly placeholder="Masukkan NIK anda...">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" required id="email" readonly placeholder="Masukkan Email anda...">
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" required id="nama" placeholder="Masukkan Nama anda...">
                            </div>
                            <div class="mb-3">
                                <label for="jurusan" class="form-label">Jurusan</label>
                                <select class="form-select" id="jurusan" aria-label="Default select example">
                                    <option selected>Pilih Jurusan</option>
                                    <option value="TI">Teknik Jurusan</option>
                                    <option value="TE">Teknik Elektro</option>
                                    <option value="TM">Teknik Mesin</option>
                                    <option value="MB">Manajemen Bisnis</option>
                                </select>
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit">Kirim</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class=" p-4 bg-white shadow-sm rounded-1 mt-3" style="margin-bottom: 70px;">
                    <h5 class="fw-bold text-uppercase">Change Password</h5>
                    <form action="" class="needs-validation row row-cols-1 row-cols-lg-2" id="formChangePassword" novalidate>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Masukkan Password anda..." required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password"
                                placeholder="Konfirmasi Password anda..." required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div>
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
<script type="text/javascript">
    const formChangePassword = document.getElementById('formChangePassword');
    const passwordInput = document.getElementById('password');
    const confirmpasswordInput = document.getElementById('confirm_password');

    formChangePassword.addEventListener('submit', function(event) {
        event.preventDefault();
        formChangePassword.classList.add('was-validated');
        let isValid = true;

        const passwordFeedback = passwordInput.nextElementSibling;
        passwordInput.classList.remove('is-invalid', 'is-valid');

        if (passwordInput.value === '') {
            passwordFeedback.textContent = 'Silahkan masukkan password';
            passwordInput.classList.add('is-invalid');
            isValid = false;
        } else if (passwordInput.value.length < 8) {
            passwordFeedback.textContent = 'Password harus lebih dari 8 karakter';
            passwordInput.classList.add('is-invalid');
            isValid = false;
        } else {
            passwordFeedback.textContent = '';
            passwordInput.classList.add('is-valid'); // ✅ password benar → hijau
        }

        const passwordconfirmFeedback = confirmpasswordInput.nextElementSibling;
        confirmpasswordInput.classList.remove('is-invalid', 'is-valid');

        if (confirmpasswordInput.value === '') {
            passwordconfirmFeedback.textContent = 'Silahkan konfirmasi password anda';
            confirmpasswordInput.classList.add('is-invalid');
            isValid = false;
        } else if (confirmpasswordInput.value !== passwordInput.value) {
            passwordconfirmFeedback.textContent = 'Konfirmasi password harus sama dengan password baru';
            confirmpasswordInput.classList.add('is-invalid');
            isValid = false;
        } else if (confirmpasswordInput.value.length < 8) {
            passwordFeedback.textContent = 'Password harus lebih dari 8 karakter';
            passwordInput.classList.add('is-invalid');
            isValid = false;
        } else {
            passwordconfirmFeedback.textContent = '';
            confirmpasswordInput.classList.add('is-valid'); // ✅ cocok → hijau
        }

        if (isValid) {

            Swal.fire({
                title: "success",
                text: "Password berhasil diubah!",
                icon: "success",
                customClass: {
                    title: "swal-title",
                    htmlContainer: "swal-text",
                    confirmButton: "swal-button",
                },
            });
            formChangePassword.reset();
            formChangePassword.classList.remove("was-validated");
        }
    });
</script>

</html>