<?php
include_once("../../conn.php");

$id_user    = $_POST['id_user'] ?? null;

$profile = $_FILES['profile']['name'];
$tmp_name = $_FILES['profile']['tmp_name'];
$target_dir = '../../static/img/profile_user/';

$target_file = $target_dir . $profile;

move_uploaded_file($tmp_name, $target_file);

// insert to database
$query = "UPDATE tb_user SET profile = '$profile' WHERE id_user = $id_user";
$result = mysqli_query($conn, $query);

if ($query) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => mysqli_error($conn)
    ]);
}
