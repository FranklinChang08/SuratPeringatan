<?php
session_start();

if (!isset($_SESSION['nik'])) {
    echo "<script>location.href = '../auth/login.php';</script>";
    session_unset();
    session_destroy();
    exit;
}

include_once("../../../conn.php");

$id_pelanggaran    = $_POST['id_pelanggaran'] ?? null;

if (!$id_pelanggaran) {
    header('location:../../pelanggaran.php');
}

$mahasiswa_id    = $_POST['mahasiswa_id'] ?? null;
$jenis_sp        = $_POST['jenis_sp'] ?? null;
$keterangan   = mysqli_real_escape_string($conn, $_POST['keterangan']);

$query = mysqli_query(
    $conn,
    "UPDATE tb_pelanggaran SET
    mahasiswa_id = '$mahasiswa_id', jenis_sp = '$jenis_sp', keterangan = '$keterangan' WHERE id_pelanggaran = '$id_pelanggaran'"
);

if ($query) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => mysqli_error($conn)
    ]);
}
