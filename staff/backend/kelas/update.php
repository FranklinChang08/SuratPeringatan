<?php
// Halaman ini digunakan untuk mengupdate data kelas berdasarkan id

session_start();

if (!isset($_SESSION['nik'])) {
    header("Location: ../auth/login.php");
    exit;
}

try {
    include_once("../../../conn.php");

    $id_kelas = $_POST['id_kelas'] ?? null;
    if (!$id_kelas) {
        header('location:../../kelas.php');
    }

    $prodi_id = trim($_POST['prodi_id']);
    $semester = trim($_POST['semester']);
    $nama_kelas = trim($_POST['nama_kelas']);
    $jadwal = trim($_POST['jadwal']);
    $nama_dosen = trim($_POST['nama_dosen']);


    $cek_kelas = mysqli_query($conn, "SELECT * FROM tb_kelas as k INNER JOIN tb_prodi as p ON p.id_prodi = k.prodi_id WHERE nama_kelas = '$nama_kelas' AND semester = '$semester' AND jadwal = '$jadwal' AND prodi_id = '$prodi_id' AND id_kelas != '$id_kelas'");
    $row = mysqli_fetch_assoc($cek_kelas);
    if ($row > 0) {
        throw new Exception("Kelas sudah ada silahkan tambahkan kelas lain! {$row['kode_prodi']} {$row['semester']}{$row['nama_kelas']} - {$row['jadwal']} {$row['nama_dosen']}");
    }

    $query = mysqli_query(
        $conn,
        "UPDATE tb_kelas SET
    prodi_id = '$prodi_id', semester = '$semester', nama_kelas = '$nama_kelas', jadwal = '$jadwal', nama_dosen = '$nama_dosen' WHERE id_kelas = '$id_kelas'"
    );

    echo json_encode(["status" => "success"]);
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}

