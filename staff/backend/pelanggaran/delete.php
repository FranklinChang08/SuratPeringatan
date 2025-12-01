<?php
session_start();

if (!isset($_SESSION['nik'])) {
    echo "<script>location.href = '../auth/login.php';</script>";
    session_unset();
    session_destroy();
    exit;
}

include_once("../../../conn.php");

$id_pelanggaran = $_POST['id_pelanggaran'];
if (!$id_pelanggaran) {
    header('location:../../pelanggaran.php');
}

$create_pelanggaran = mysqli_query(
    $conn,
    "DELETE FROM tb_pelanggaran WHERE id_pelanggaran= $id_pelanggaran"
);

if ($create_pelanggaran) {
    header('location:../../pelanggaran.php');
} else {
    header('location:../../pelanggaran.php');
}

exit();
