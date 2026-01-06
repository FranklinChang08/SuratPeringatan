<?php
// Halaman ini merupakan fitur tambahan untuk pengupdate profile user masing masing

session_start();

if (!isset($_SESSION['nik'])) {
    header("Location: ../auth/login.php");
    exit;
}

try {
    include_once("../../conn.php");

    $id_user = $_POST['id_user'] ?? null;

    $profile = $_FILES['profile']['name'];
    $tmp_name = $_FILES['profile']['tmp_name'];
    $target_dir = '../../static/img/profile_user/';

    $target_file = $target_dir . $profile;

    move_uploaded_file($tmp_name, $target_file);

    // Update profile user dengan id user
    $query = "UPDATE tb_user SET profile = '$profile' WHERE id_user = $id_user";
    $result = mysqli_query($conn, $query);

    echo json_encode(["status" => "success"]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
