<?php
// Halaman ini digunakan untuk memberikan logika login untuk user

session_start();

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    include('../conn.php');

    $usernameLogin = $_POST['username'] ?? '';
    $passwordLogin = $_POST['password'] ?? '';

    // Ambil user
    $queryUser = mysqli_query(
        $conn,
        "SELECT * FROM tb_user 
         WHERE nim='$usernameLogin' 
            OR nik='$usernameLogin' 
            OR email='$usernameLogin' 
         LIMIT 1"
    );

    $row = mysqli_fetch_assoc($queryUser);

    if (!$row) {
        throw new Exception("Akun tidak ditemukan");
    }

    // Validasi password
    if ($row['nim'] === $usernameLogin || $row['email'] === $usernameLogin) {
        $validPassword = ($row['password'] == "")
            ? $row['nim'] == $passwordLogin
            : password_verify($passwordLogin, $row['password']);
    } elseif ($row['nik'] === $usernameLogin) {
        $validPassword = ($row['password'] == "")
            ? $row['nik'] == $passwordLogin
            : password_verify($passwordLogin, $row['password']);
    } else {
        $validPassword = false;
    }

    if (!$validPassword) {
        throw new Exception("Username atau password salah");
    }

    // Set session
    if (!empty($row['nim'])) {
        $_SESSION['nim'] = $row['nim'];
    }

    if (!empty($row['nik'])) {
        $_SESSION['nik'] = $row['nik'];
    }

    $_SESSION['email'] = $row['email'];
    $_SESSION['role'] = $row['role'];
    $_SESSION['nama_user'] = $row['nama_user'];

    // Redirect berdasarkan role
    $redirect = ($row['role'] === 'Mahasiswa')
        ? "../home.php"
        : "../staff/dashboard.php";

    echo json_encode([
        "status" => "success",
        "message" => "Login berhasil, selamat datang",
        "redirect" => $redirect
    ]);
    exit;

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
    exit;
}
