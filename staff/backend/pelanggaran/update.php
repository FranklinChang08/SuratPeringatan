<?php
session_start();

if (!isset($_SESSION['nik'])) {
    echo "<script>location.href = '../auth/login.php';</script>";
    session_unset();
    session_destroy();
    exit;
}

include_once("../../../conn.php");

$id_pelanggaran = $_POST['id_pelanggaran'] ?? null;

if (!$id_pelanggaran) {
    header('location:../../pelanggaran.php');
}

$mahasiswa_id = $_POST['mahasiswa_id'] ?? null;
$jenis_sp = $_POST['jenis_sp'] ?? null;
$keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);

$cek_duplikat = mysqli_query($conn, "SELECT * FROM tb_pelanggaran
                                     WHERE mahasiswa_id = '$mahasiswa_id' 
                                     AND jenis_sp = '$jenis_sp' AND id_pelanggaran != '$id_pelanggaran'");

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
                                     AND jenis_sp = '$sp_prev' AND id_pelanggaran != '$id_pelanggaran'");

    if (mysqli_num_rows($cek_prev) == 0) {
        echo json_encode([
            "status" => "error",
            "message" => "$sp_prev harus ada terlebih dahulu sebelum mengubah menjadi $jenis_sp!"
        ]);
        exit;
    }
}

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
