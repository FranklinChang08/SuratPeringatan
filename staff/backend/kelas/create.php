<?php
session_start();

if (!isset($_SESSION['nik'])) {
    echo "<script>location.href = '../auth/login.php';</script>";
    session_unset();
    session_destroy();
    exit;
}
include_once("../../../conn.php");

$prodi_id = $_POST['prodi_id'] ?? null;
$semester = $_POST['semester'] ?? null;
$nama_kelas = $_POST['nama_kelas'] ?? null;
$jadwal = $_POST['jadwal'] ?? null;
$nama_dosen = $_POST['nama_dosen'] ?? null;

$cek_kelas = mysqli_query($conn, "SELECT * FROM tb_kelas WHERE nama_kelas = '$nama_kelas' AND semester = '$semester' AND jadwal = '$jadwal' AND prodi_id = '$prodi_id'");
if (mysqli_num_rows($cek_kelas) > 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Kelas sudah ada silahkan tambahkan kelas lain!"
    ]);
    exit;
}

$query = mysqli_query(
    $conn,
    "INSERT INTO tb_kelas 
    VALUES (NULL, '$prodi_id', '$semester', '$nama_kelas', '$jadwal', '$nama_dosen', NULL, NULL)"
);

if ($query) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => mysqli_error($conn)
    ]);
}
