<?php
session_start();
if (!isset($_SESSION['nik'])) {
    header("Location: ./login.php");
    exit;
}

$email = $_SESSION['email'];
$nama_staff = $_SESSION['nama_staff'];
$nik = $_SESSION['nik'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="./static/img/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="./static/style/font.css">
</head>

<body class="font-poppins">
    Home Page

    <h1><?= $email ?></h1>
    <h1><?= $nama_mahasiswa ?></h1>
    <h1><?= $nim ?></h1>
</body>

</html>