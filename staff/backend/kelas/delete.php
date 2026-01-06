<?php
// Halaman ini digunakan untuk menghapus data kelas

session_start();

if (!isset($_SESSION['nik'])) {
    header("Location: ../auth/login.php");
    exit;
}
try {

    include_once("../../../conn.php");

    $id_kelas = $_POST['id_kelas'];
    if (!$id_kelas) {
        header('location:../../kelas.php');
    }

    $create_kelas = mysqli_query(
        $conn,
        "DELETE FROM tb_kelas WHERE id_kelas = '$id_kelas'"
    );

    header('location:../../kelas.php');

} catch (Exception $e) {
    header('location:../../kelas.php');
}
