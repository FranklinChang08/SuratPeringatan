<?php
// Halaman ini digunakan untuk membuat data pelanggaran baru

session_start();

if (!isset($_SESSION['nik'])) {
    header("Location: ../auth/login.php");
    exit;
}

try {

    include_once("../../../conn.php");

    // Mengambil data dari form yang dikirim
    $mahasiswa_id = $_POST['mahasiswa_id'] ?? null;
    $jenis_sp = $_POST['jenis_sp'] ?? null;
    $keterangan = $_POST['keterangan'] ?? null;

    // Cek duplikasi data
    $cek_duplikat = mysqli_query($conn, "SELECT * FROM tb_pelanggaran
                                     WHERE mahasiswa_id = '$mahasiswa_id' 
                                     AND jenis_sp = '$jenis_sp'");

    if (mysqli_num_rows($cek_duplikat) > 0) {
        throw new Exception("$jenis_sp sudah pernah dibuat untuk mahasiswa ini!");
    }

    $sp_number = intval(str_replace("SP ", "", $jenis_sp));

    if ($sp_number > 1) {
        $sp_prev = "SP " . ($sp_number - 1);

        $cek_prev = mysqli_query($conn, "SELECT * FROM tb_pelanggaran
                                     WHERE mahasiswa_id = '$mahasiswa_id' 
                                     AND jenis_sp = '$sp_prev'");

        if (mysqli_num_rows($cek_prev) == 0) {
            throw new Exception("$sp_prev harus dibuat terlebih dahulu sebelum membuat $jenis_sp!");
        }
    }


    $query = mysqli_query(
        $conn,
        "INSERT INTO tb_pelanggaran
    VALUES (NULL, '$mahasiswa_id', '$jenis_sp', '$keterangan', NULL, NULL)"
    );

    echo json_encode(["status" => "success"]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}