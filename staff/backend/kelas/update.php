<?php
include_once("../../../conn.php");

$id_kelas    = $_POST['id_kelas'] ?? null;
if (!$id_kelas) {
    header('location:../../kelas.php');
}

$prodi_id    = $_POST['prodi_id'] ?? null;
$semester    = $_POST['semester'] ?? null;
$nama_kelas  = $_POST['nama_kelas'] ?? null;
$jadwal      = $_POST['jadwal'] ?? null;
$nama_dosen  = $_POST['nama_dosen'] ?? null;

$query = mysqli_query(
    $conn,
    "UPDATE tb_kelas SET
    prodi_id = '$prodi_id', semester = '$semester', nama_kelas = '$nama_kelas', jadwal = '$jadwal', nama_dosen = '$nama_dosen' WHERE id_kelas = '$id_kelas'"
);

if ($query) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => mysqli_error($conn)
    ]);
}
