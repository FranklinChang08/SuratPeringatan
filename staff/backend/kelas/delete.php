<?php
session_start();

if (!isset($_SESSION['nik'])) {
    echo "<script>location.href = '../auth/login.php';</script>";
    session_unset();
    session_destroy();
    exit;
}
include_once("../../../conn.php");

$id_kelas = $_POST['id_kelas'];
if (!$id_kelas) {
    header('location:../../kelas.php');
}

$create_kelas = mysqli_query(
    $conn,
    "DELETE FROM tb_kelas WHERE id_kelas = '$id_kelas'"
);

if ($create_kelas) {
    header('location:../../kelas.php');
} else {
    header('location:../../kelas.php');
}

exit();
