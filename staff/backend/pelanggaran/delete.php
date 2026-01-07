<?php
// Halaman ini digunakan untuk menghapus data pelanggaran

session_start();

if (!isset($_SESSION['nik'])) {
    header("Location: ../auth/login.php");
    exit;
}

try {

    include_once("../../../conn.php");

    $id_pelanggaran = $_POST['id_pelanggaran'] ?? null;

    if (!$id_pelanggaran) {
        throw new Exception("ID pelanggaran tidak ditemukan");
    }

    // Eksekusi delete
    mysqli_query(
        $conn,
        "DELETE FROM tb_pelanggaran WHERE id_pelanggaran = '$id_pelanggaran'"
    );

    // Jika berhasil
    header('location:../../pelanggaran.php');
    exit;

} catch (Exception $e) {
    // Bisa ditambahkan logging di sini jika perlu
    header('location:../../pelanggaran.php');
    exit;
}
