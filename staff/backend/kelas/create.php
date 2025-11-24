<?php
include_once("../../../conn.php");

$prodi_id    = $_POST['prodi_id'] ?? null;
$semester    = $_POST['semester'] ?? null;
$nama_kelas  = $_POST['nama_kelas'] ?? null;
$jadwal      = $_POST['jadwal'] ?? null;
$nama_dosen  = $_POST['nama_dosen'] ?? null;

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
