<?php
// Halaman ini digunakan untuk mengupdate data mahasiswa berdasarkan id

session_start();

if (!isset($_SESSION['nik'])) {
    header("Location: ../auth/login.php");
    exit;
}

try {

    include_once("../../../conn.php");

    // Mengambil data dari form
    $id_user = $_POST['id_user'] ?? null;
    $nim = $_POST['nim'] ?? null;
    $nama_user = $_POST['nama_user'] ?? null;
    $email = $_POST['email'] ?? null;
    $prodi_id = $_POST['prodi_id'] ?? null;
    $kelas_id = $_POST['kelas_id'] ?? null;

    // Cek email dan nim selain user tersebut
    $cek_user = mysqli_query($conn, "SELECT * FROM tb_user WHERE (email = '$email' OR nim = '$nim') AND id_user != '$id_user' AND role != 'Staff'");
    if (mysqli_num_rows($cek_user) > 0) {
        if (mysqli_num_rows($cek_user) > 0)
            throw new Exception("Email dan NIM sudah digunakan, silahkan gunakan Email dan NIM lainnya");
    }

    // JIKA LOLOS VALIDASI → INSERT
    $query = mysqli_query(
        $conn,
        "UPDATE tb_user SET 
     nim = '$nim', nama_user = '$nama_user', email = '$email', prodi_id = '$prodi_id', kelas_id = '$kelas_id' WHERE id_user = '$id_user' AND role = 'Mahasiswa'"
    );

    echo json_encode(["status" => "success"]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
