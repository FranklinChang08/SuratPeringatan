<?php
include '../../../conn.php';

$id_user = $_POST['id_user'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if ($password == $confirm_password) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $changePassword = mysqli_query($conn, "UPDATE tb_user SET password = '$hashed_password' WHERE id_user = '$id_user'");

    if ($changePassword) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => mysqli_error($conn)
        ]);
    }
}
