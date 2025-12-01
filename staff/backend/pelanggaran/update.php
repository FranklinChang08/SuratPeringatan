<?php
include_once("../../../conn.php");

$id_pelanggaran    = $_POST['id_pelanggaran'] ?? null;
if (!$id_pelanggaran) {
    header('location:../../pelanggaran.php');
}

$mahasiswa_id    = $_POST['mahasiswa_id'] ?? null;
$jenis_sp        = $_POST['jenis_sp'] ?? null;
$keterangan      = $_POST['keterangan'] ?? null;

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