<?php
session_start();

if (!isset($_SESSION['nik'])) {
    echo "<script>location.href = '../auth/login.php';</script>";
    session_unset();
    session_destroy();
    exit;
}

include_once("../../../conn.php");

$id_user = $_POST['id_user'];
if (!$id_user) {
    header('location:../../dashboard.php');
}

$delete_user = mysqli_query(
    $conn,
    "DELETE FROM tb_user WHERE id_user = '$id_user'"
);

if ($delete_user) {
    header('location:../../dashboard.php');
} else {
    header('location:../../dashboard.php');
}

exit();
