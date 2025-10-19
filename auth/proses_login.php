<?php
session_start();
include('../conn.php');

$usernameLogin = $_POST['username'] ?? '';
$passwordLogin = $_POST['password'] ?? '';

// Cek di tabel mahasiswa
$queryMahasiswa = mysqli_query($conn, "SELECT * FROM tb_mahasiswa WHERE nim='$usernameLogin' OR email='$usernameLogin' LIMIT 1");
$row = mysqli_fetch_assoc($queryMahasiswa);

if ($row) {
    $validPassword = ($row['password'] == "")
        ? $row['nim'] == $passwordLogin    // kalau belum punya password, pakai nim
        : $row['password'] == $passwordLogin; // kalau sudah punya password

    if ($validPassword) {
        $_SESSION['nim'] = $row['nim'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['nama_mahasiswa'] = $row['nama_mahasiswa'];

        $nama = $row['nama_mahasiswa'];

        echo '
        <script>
   Swal.fire({
                title: "success",
                text: "Login Berhasil, Selamat Datang di Pengelolahan Surat Peringatan",
                icon: "success",
                customClass: {
                    title: "swal-title",
                    htmlContainer: "swal-text",
                    confirmButton: "swal-button",
                }
            }).then(() => {
                window.location.href = "../home.php"
            })
        </script>
        ';
        exit;
    }
}

// Cek di tabel staff
$queryStaff = mysqli_query($conn, "SELECT * FROM tb_staff_akademik WHERE nik='$usernameLogin' OR email='$usernameLogin' LIMIT 1");
$row = mysqli_fetch_assoc($queryStaff);

if ($row) {
    $validPassword = ($row['password'] == "")
        ? $row['nik'] == $passwordLogin
        : $row['password'] == $passwordLogin;

    if ($validPassword) {
        $_SESSION['nik'] = $row['nik'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['nama_staff'] = $row['nama_staff'];
        $nama = $row['nama_staff'];
        echo json_encode([
            'status' => 'success',
            'message' => 'Login Berhasil, Selamat Datang Staff Akademik',
            'redirect' => '../staff/dashboard.php'
        ]);
        exit;
    }
}

// Kalau gagal semua
echo "<script>alert('Login Gagal, Username dan Password salah'); window.location.href='login.php';</script>";
