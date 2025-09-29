<?php
session_start();
$email = $_SESSION['email'];
$nama_staff = $_SESSION['nama_staff'];
$nim = $_SESSION['nim'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="../static/img/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="../static/style/font.css">
</head>

<body class="font-poppins">
    Dashboard Page

    <h1><?= $email ?></h1>
    <h1><?= $nama_staff ?></h1>
    <h1><?= $nim ?></h1>
</body>

</html>