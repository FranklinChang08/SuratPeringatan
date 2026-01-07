<?php
// Halaman ini digunakan untuk mengupdate data pelanggaran


session_start();
if (!isset($_SESSION['nik'])) {
    header("Location: ../auth/login.php");
    exit;
}
try {

    include_once("../../../conn.php");

    // Mengambil data dari form yang dikirim
    $id_pelanggaran = $_POST['id_pelanggaran'] ?? null;
    $mahasiswa_id = $_POST['mahasiswa_id'] ?? null;
    $jenis_sp = $_POST['jenis_sp'] ?? null;
    $keterangan = $_POST['keterangan'] ?? '';

    if (!$id_pelanggaran || !$mahasiswa_id || !$jenis_sp) {
        throw new Exception("Data wajib tidak lengkap");
    }

    $keterangan = mysqli_real_escape_string($conn, $keterangan);

    // Cek duplikat
    $cek_duplikat = mysqli_query(
        $conn,
        "SELECT 1 FROM tb_pelanggaran 
         WHERE mahasiswa_id='$mahasiswa_id' 
         AND jenis_sp='$jenis_sp' 
         AND id_pelanggaran!='$id_pelanggaran'"
    );

    if (mysqli_num_rows($cek_duplikat) > 0) {
        throw new Exception("$jenis_sp sudah pernah dibuat untuk mahasiswa ini");
    }

    // Validasi urutan SP
    $sp_number = intval(str_replace("SP ", "", $jenis_sp));
    if ($sp_number > 1) {
        $sp_prev = "SP " . ($sp_number - 1);

        $cek_prev = mysqli_query(
            $conn,
            "SELECT 1 FROM tb_pelanggaran 
             WHERE mahasiswa_id='$mahasiswa_id' 
             AND jenis_sp='$sp_prev'"
        );

        if (mysqli_num_rows($cek_prev) == 0) {
            throw new Exception("$sp_prev harus ada sebelum $jenis_sp");
        }
    }

    // Update data
    mysqli_query(
        $conn,
        "UPDATE tb_pelanggaran SET
            mahasiswa_id='$mahasiswa_id',
            jenis_sp='$jenis_sp',
            keterangan='$keterangan'
         WHERE id_pelanggaran='$id_pelanggaran'"
    );

    echo json_encode(["status" => "success"]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
