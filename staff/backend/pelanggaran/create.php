<?php
session_start();

if (!isset($_SESSION['nik'])) {
    echo "<script>location.href = '../auth/login.php';</script>";
    session_unset();
    session_destroy();
    exit;
}

include_once("../../../conn.php");

$mahasiswa_id = $_POST['mahasiswa_id'] ?? null;
$jenis_sp = $_POST['jenis_sp'] ?? null;
$keterangan = $_POST['keterangan'] ?? null;

$cek_duplikat = mysqli_query($conn, "SELECT * FROM tb_pelanggaran
                                     WHERE mahasiswa_id = '$mahasiswa_id' 
                                     AND jenis_sp = '$jenis_sp'");

if (mysqli_num_rows($cek_duplikat) > 0) {
    echo json_encode([
        "status" => "error",
        "message" => "$jenis_sp sudah pernah dibuat untuk mahasiswa ini!"
    ]);
    exit;
}

$sp_number = intval(str_replace("SP ", "", $jenis_sp));

if ($sp_number > 1) {
    $sp_prev = "SP " . ($sp_number - 1);

    $cek_prev = mysqli_query($conn, "SELECT * FROM tb_pelanggaran
                                     WHERE mahasiswa_id = '$mahasiswa_id' 
                                     AND jenis_sp = '$sp_prev'");

    if (mysqli_num_rows($cek_prev) == 0) {
        echo json_encode([
            "status" => "error",
            "message" => "$sp_prev harus dibuat terlebih dahulu sebelum membuat $jenis_sp!"
        ]);
        exit;
    }
}


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
