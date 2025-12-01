<?php


include_once("../../../conn.php");

$id_user = $_POST['id_user'];
if (!$id_user) {
    header('location:../../dashboard.php');
}

$create_mahasiswa = mysqli_query(
    $conn,
    "DELETE FROM tb_user WHERE id_user = $id_user"
);

if ($create_mahasiswa) {
    header('location:../../dashboard.php');
} else {
    header('location:../../dashboard.php');
}

exit();
