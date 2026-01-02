<?php
require '../../../../framework/vendor/autoload.php';
require '../../../conn.php';

use Shuchkin\SimpleXLSX;

if (isset($_FILES['file']['tmp_name'])) {
    if ($xlsx = SimpleXLSX::parse($_FILES['file']['tmp_name'])) {
        $rows = $xlsx->rows();

        $errors = [];

        for ($i = 1; $i < count($rows); $i++) {

            $nim = $rows[$i][0];
            $nama = $rows[$i][1];
            $prodi = $rows[$i][2];
            $email = $rows[$i][3];
            $kelas = $rows[$i][4];

            if ($nim === '' && $nama === '' && $prodi === '' && $email === '' && $kelas === '') {
                break;
            }

            if ($nim === '' || $nama === '' || $prodi === '' || $kelas === '') {
                $errors[] = "Baris $i: Data tidak lengkap.";
                continue;
            }

            $cek_user = mysqli_query($conn, "SELECT * FROM tb_user WHERE (email = '$email' OR nim = '$nim') AND role!='Staf'");
            if (mysqli_num_rows($cek_user) > 0) {
                $errors[] = "Baris $i: Data Mahasiswa sudah ada silahkan masukkan data mahasiswa yang lain!";
                continue;
            }

            $prodiQuery = $conn->query("SELECT id_prodi FROM tb_prodi WHERE nama_prodi = '$prodi'");
            $prodiData = $prodiQuery->fetch_assoc();
            if (!$prodiData) {
                $errors[] = "Baris $i: Prodi '$prodi' tidak ditemukan.";
                continue;
            }

            list($kelasCode, $jadwal) = explode(" - ", $kelas);

            if (preg_match('/^([A-Za-z]+)(\d+)([A-Za-z]+)$/', $kelasCode, $match)) {
                $kode_prodi = $match[1];
                $semester = $match[2];
                $nama_kelas = $match[3];
            } else {
                $errors[] = "Kombinasi Kelas tidak sesuai";
                continue;
            }

            $kelasQuery = $conn->query("SELECT id_kelas FROM tb_kelas AS k INNER JOIN tb_prodi AS p ON p.id_prodi = k.prodi_id
                                WHERE p.kode_prodi='$kode_prodi' AND k.nama_kelas='$nama_kelas'
                                AND k.semester='$semester'
                                AND k.jadwal='$jadwal'");
            $kelasData = $kelasQuery->fetch_assoc();
            if (!$kelasData) {
                $errors[] = "Baris $i: Kelas '$kelasCode - $jadwal' tidak ditemukan.";
                continue;
            }

            $idProdi = $prodiData['id_prodi'];
            $idKelas = $kelasData['id_kelas'];

            $query = $conn->query("INSERT INTO tb_user 
                           (nama_user, nim, email, prodi_id, kelas_id, role) 
                           VALUES ('$nama', '$nim', '$email', '$idProdi', '$idKelas', 'Mahasiswa')");

            if (!$query) {
                $errors[] = "Baris $i: Insert gagal. (" . $conn->error . ")";
            }
        }

        if (count($errors) > 0) {
            echo json_encode(["status" => "error", "message" => $errors[0]]);
        } else {
            echo json_encode(["status" => "success"]);
        }
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Terjadi Kesalahan pada file yang dikirim"
    ]);
}
