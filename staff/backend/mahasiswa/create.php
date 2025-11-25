<?php

include_once("../../../conn.php");

$nim         = $_POST['nim'] ?? null;
$nama_user   = $_POST['nama_user'] ?? null;
$email       = $_POST['email'] ?? null;
$prodi_id    = $_POST['prodi_id'] ?? null;
$kelas_id    = $_POST['kelas_id'] ?? null;
$profile     = $_POST['profile'] ?? null;

$cek_user = mysqli_query($conn, "SELECT * FROM tb_user WHERE email = '$email' OR nim = '$nim'");
if (mysqli_num_rows($cek_user) > 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Email sudah digunakan!"
    ]);
    exit;
}

// ===============================
// JIKA LOLOS VALIDASI → INSERT
// ===============================
$query = mysqli_query(
    $conn,
    "INSERT INTO tb_user 
     VALUES(null, '$nim', null, '$nama_user', '$email', null, '$prodi_id', '$kelas_id', '$profile', 'Mahasiswa', NULL, NULL)"
);

if ($query) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => mysqli_error($conn)
    ]);
}
