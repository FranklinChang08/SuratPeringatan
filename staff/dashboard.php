<!-- <?php
session_start();
if (!isset($_SESSION['nik'])) {
    header("Location: ../login.php");
    exit;
}

$email = $_SESSION['email'];
$nama_staff = $_SESSION['nama_staff'];
$nik = $_SESSION['nik'];
?> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="../static/img/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="../static/style/font.css">
    <link rel="stylesheet" href="../static/style/sidebar.css">

    <style>
        body {
            background-color: #F4F5F6;
        }

        .content {
            width: calc(100%-20rem);
            margin-left: 20rem;
        }
    </style>
</head>

<body class="font-poppins">
    <?php
    include('../component/sidebar.php')
    ?>
    <div class="content">
        <h1>Data Staff Akademik</h1>
        <div>
            <tr>
                <td>
                    
                </td>
            </tr>
        </div>

        <!-- <h1><?= $email ?></h1>
        <h1><?= $nama_staff ?></h1>
        <h1><?= $nik ?></h1> -->
    </div>
</body>

</html>