<?php
// Halaman ini digunakan untuk membuat data mahasiswa baru

session_start();

if (!isset($_SESSION['nik'])) {
    header("Location: ../auth/login.php");
    exit;
}

try {
    include_once("../../../conn.php");

    $nim = $_POST['nim'] ?? null;
    $nama_user = $_POST['nama_user'] ?? null;
    $email = $_POST['email'] ?? null;
    $prodi_id = $_POST['prodi_id'] ?? null;
    $kelas_id = $_POST['kelas_id'] ?? null;
    $profile = $_POST['profile'] ?? null;

    $cek_user = mysqli_query($conn, "SELECT * FROM tb_user WHERE (email = '$email' OR nim = '$nim') AND role!='Staf'");
    if (mysqli_num_rows($cek_user) > 0) {
        throw new Exception("Data Mahasiswa sudah ada silahkan masukkan data mahasiswa yang lain!");
    }

    // ===============================
// JIKA LOLOS VALIDASI → INSERT
// ===============================
    $query = mysqli_query(
        $conn,
        "INSERT INTO tb_user 
     VALUES(null, '$nim', null, '$nama_user', '$email', null, '$prodi_id', '$kelas_id', '$profile', 'Mahasiswa', NULL, NULL)"
    );

    echo json_encode(["status" => "success"]);
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
