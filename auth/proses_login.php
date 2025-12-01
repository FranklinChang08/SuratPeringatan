<?php
session_start();
include('../conn.php');

$usernameLogin = $_POST['username'] ?? '';
$passwordLogin = $_POST['password'] ?? '';

// Cek di tabel mahasiswa
$queryUser = mysqli_query($conn, "SELECT * FROM tb_user WHERE nim='$usernameLogin' OR nik='$usernameLogin' OR email='$usernameLogin' LIMIT 1");
$row = mysqli_fetch_assoc($queryUser);

if ($row) {
    if ($row['nim'] === $usernameLogin or $row['email'] === $usernameLogin) {

        $validPassword = ($row['password'] == "")
            ? $row['nim'] == $passwordLogin
            : $row['password'] == $passwordLogin;
    } elseif ($row['nik'] === $usernameLogin or $row['email'] === $usernameLogin) {

        $validPassword = ($row['password'] == "")
            ? $row['nik'] == $passwordLogin
            : $row['password'] == $passwordLogin;
    } else {
        $validPassword = false;
    }


    if ($validPassword) {
        if ($row['nim'] === $usernameLogin) {
            $_SESSION['nim'] = $row['nim'];
        } else {
            $_SESSION['nik'] = $row['nik'];
        }

        $_SESSION['email'] = $row['email'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['nama_user'] = $row['nama_user'];

        // TENTUKAN REDIRECT
        $redirect = ($row['role'] == 'Mahasiswa')
            ? "../home.php"
            : "../staff/dashboard.php";

        echo json_encode([
            "status" => "success",
            "message" => "Login Berhasil, Selamat Datang di Pengelolahan Surat Peringatan",
            "redirect" => $redirect
        ]);
        exit;
    }
}

// jika gagal
echo json_encode([
    "status" => "error",
    "message" => "Username atau password salah."
]);
exit;
