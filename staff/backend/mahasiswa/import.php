<?php
// Halaman ini digunakan untuk melakukan import data mahasiswa menggunakan excel

session_start();
require '../../../framework/vendor/autoload.php';
require '../../../conn.php';

use Shuchkin\SimpleXLSX;

try {
    // CEK SESSION (WAJIB LOGIN / STAF)
    if (!isset($_SESSION['nik'])) {
        echo json_encode([
            "status" => "error",
            "redirect" => "../auth/login.php"
        ]);
        exit;
    }

    if (!isset($_FILES['file']['tmp_name'])) {
        throw new Exception("Terjadi kesalahan pada file yang dikirim");
    }

    if (!$xlsx = SimpleXLSX::parse($_FILES['file']['tmp_name'])) {
        throw new Exception("File Excel tidak valid");
    }

    $rows = $xlsx->rows();
    $errors = [];

    for ($i = 1; $i < count($rows); $i++) {

        $nim = $rows[$i][0];
        $nama = $rows[$i][1];
        $prodi = $rows[$i][2];
        $email = $rows[$i][3];
        $kelas = $rows[$i][4];

        // Stop jika baris kosong semua
        if ($nim === '' && $nama === '' && $prodi === '' && $email === '' && $kelas === '') {
            break;
        }

        if ($nim === '' || $nama === '' || $prodi === '' || $kelas === '') {
            $errors[] = "Baris $i: Data tidak lengkap.";
            continue;
        }

        // CEK DUPLIKAT
        $cek_user = mysqli_query(
            $conn,
            "SELECT * FROM tb_user 
             WHERE (email = '$email' OR nim = '$nim') 
             AND role != 'Staf'"
        );

        if (mysqli_num_rows($cek_user) > 0) {
            $errors[] = "Baris $i: Data Mahasiswa sudah ada.";
            continue;
        }

        // CEK PRODI
        $prodiQuery = $conn->query("SELECT id_prodi FROM tb_prodi WHERE nama_prodi = '$prodi'");
        $prodiData = $prodiQuery->fetch_assoc();

        if (!$prodiData) {
            $errors[] = "Baris $i: Prodi '$prodi' tidak ditemukan.";
            continue;
        }

        // PARSING KELAS
        list($kelasCode, $jadwal) = explode(" - ", $kelas);

        if (!preg_match('/^([A-Za-z]+)(\d+)([A-Za-z]+)$/', $kelasCode, $match)) {
            $errors[] = "Baris $i: Format kelas tidak sesuai.";
            continue;
        }

        $kode_prodi = $match[1];
        $semester = $match[2];
        $nama_kelas = $match[3];

        // CEK KELAS
        $kelasQuery = $conn->query("
            SELECT id_kelas FROM tb_kelas k
            INNER JOIN tb_prodi p ON p.id_prodi = k.prodi_id
            WHERE p.kode_prodi='$kode_prodi'
              AND k.nama_kelas='$nama_kelas'
              AND k.semester='$semester'
              AND k.jadwal='$jadwal'
        ");

        $kelasData = $kelasQuery->fetch_assoc();
        if (!$kelasData) {
            $errors[] = "Baris $i: Kelas '$kelasCode - $jadwal' tidak ditemukan.";
            continue;
        }

        // INSERT
        $idProdi = $prodiData['id_prodi'];
        $idKelas = $kelasData['id_kelas'];

        $insert = $conn->query("
            INSERT INTO tb_user 
            (nama_user, nim, email, prodi_id, kelas_id, role)
            VALUES ('$nama', '$nim', '$email', '$idProdi', '$idKelas', 'Mahasiswa')
        ");

        if (!$insert) {
            $errors[] = "Baris $i: Insert gagal (" . $conn->error . ")";
        }
    }


    echo json_encode([
        "status" => "success"
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
