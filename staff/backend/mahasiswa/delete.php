<?php
// Halaman ini digunakan untuk menghapus data mahasiswa

session_start();

if (!isset($_SESSION['nik'])) {
    header("Location: ../auth/login.php");
    exit;
}

try {
    include_once("../../../conn.php");

    $id_user = $_POST['id_user'];
    if (!$id_user) {
        header('location:../../dashboard.php');
    }

    $create_mahasiswa = mysqli_query(
        $conn,
        "DELETE FROM tb_user WHERE id_user = $id_user"
    );

    header('location:../../dashboard.php');
} catch (Exception $e) {
    header('location:../../dashboard.php');
}
