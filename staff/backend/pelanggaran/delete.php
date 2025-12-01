<?php
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
