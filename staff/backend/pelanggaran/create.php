<?php
session_start();

if (!isset($_SESSION['nik'])) {
    echo "<script>location.href = '../auth/login.php';</script>";
    session_unset();
    session_destroy();
    exit;
}

include_once("../../../conn.php");

$mahasiswa_id    = $_POST['mahasiswa_id'] ?? null;
$jenis_sp  = $_POST['jenis_sp'] ?? null;
$keterangan      = $_POST['keterangan'] ?? null;

$query = mysqli_query(
    $conn,
    "INSERT INTO tb_pelanggaran
    VALUES (NULL, '$mahasiswa_id', '$jenis_sp', '$keterangan', NULL, NULL)"
);

if ($query) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => mysqli_error($conn)
    ]);
}
