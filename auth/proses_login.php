<?php
session_start();
include('../conn.php');

$usernameLogin = $_POST['username'];
$passwordLogin = $_POST['password'];

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

        echo "<script>alert('Login Berhasil'); window.location.href='../home.php';</script>";
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

        echo "<script>alert('Login Berhasil'); window.location.href='../staff/dashboard.php';</script>";
        exit;
    }
}

// Kalau gagal semua
echo "<script>alert('Login Gagal, Username dan Password salah'); window.location.href='login.php';</script>";
