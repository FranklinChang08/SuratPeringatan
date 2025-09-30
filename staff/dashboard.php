<!-- <?php
session_start();
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
    <link rel="stylesheet" href="../static/style/dashboard.css">

    <style>
        body {
            background-color: #F4F5F6;
        }

    </style>
</head>

<body class="font-poppins">
    <?php
    include('../component/sidebar.php')
    ?>
    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <h1 class="page-title">Data Staff Akademik</h1>
            <div class="user-profile">G</div>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Toolbar -->
            <div class="toolbar">
                <div class="toolbar-left">
                    <button class="btn btn-primary" onclick="tambahStaff()">
                        ➕ Tambah Staff
                    </button>
                    <button class="btn btn-secondary" onclick="importData()">
                        📁 Import
                    </button>
                </div>
                <input type="text" class="search-box" placeholder="🔍" onkeyup="cariStaff(this.value)">
            </div>

            <!-- Table -->
            <div class="table-container">
                <div class="table-wrapper">
                    <div class="watermark">
                        <img src="../static/img/logo.png" alt="">
                    </div>
                    <table id="staffTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Staff</th>
                                <th>NIK</th>
                                <th>Email</th>
                                <th>Mata Kuliah</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Budi A.Md Kom</td>
                                <td>123456789</td>
                                <td>budi@polibatam.ac.id</td>
                                <td>Pengantar Proyek Perangkat Lunak</td>
                                <td class="action-buttons">
                                    <button class="action-btn" onclick="editStaff(1)">✏️</button>
                                    <button class="action-btn" onclick="hapusStaff(1)">🗑️</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <div class="pagination-info">
                        20 dari 100
                    </div>
                    <div class="pagination-controls">
                        <button class="page-btn">‹</button>
                        <button class="page-btn active">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <button class="page-btn">4</button>
                        <button class="page-btn">5</button>
                        <button class="page-btn">›</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- <h1><?= $email ?></h1>
        <h1><?= $nama_staff ?></h1>
        <h1><?= $nik ?></h1> -->
    </div>
</body>

</html>