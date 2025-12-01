<?php
session_start();

if (!isset($_SESSION['nik'])) {
    echo "<script>location.href = '../auth/login.php';</script>";
    session_unset();
    session_destroy();
    exit;
}

include_once("../../../conn.php");

$nim         = $_POST['nim'] ?? null;
$nama_user   = $_POST['nama_user'] ?? null;
$email       = $_POST['email'] ?? null;
$prodi_id    = $_POST['prodi_id'] ?? null;
$kelas_id    = $_POST['kelas_id'] ?? null;

$cek_user = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email' OR nim = '$nim'");
if (mysqli_num_rows($cek_user) > 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Email atau NIM sudah digunakan!"
    ]);
    exit;
}

$query = mysqli_query(
    $conn,
    "INSERT INTO tb_user 
     VALUES(NULL, '$nim', NULL, '$nama_user', '$email', NULL, '$prodi_id', '$kelas_id', NULL, 'Mahasiswa', NULL, NULL)"
);

if ($query) {
    echo json_encode([
        "status" => "success",
        "message" => "Data berhasil ditambahkan!"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => mysqli_error($conn)
    ]);
}
