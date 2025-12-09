<?php
require '../../../vendor/autoload.php';
require '../../../conn.php';

use Shuchkin\SimpleXLSX;

if (isset($_FILES['file']['tmp_name'])) {
    if ($xlsx = SimpleXLSX::parse($_FILES['file']['tmp_name'])) {
        $rows = $xlsx->rows();

        for ($i = 1; $i < count($rows); $i++) {
            $nim = $rows[$i][0];
            $nama = $rows[$i][1];
            $prodi = $rows[$i][2];
            $email = $rows[$i][3];
            $kelas = $rows[$i][4];

            $prodiQuery = $conn->query("SELECT id_prodi FROM tb_prodi WHERE nama_prodi = '$prodi'");
            $prodiData = $prodiQuery->fetch_assoc();
            if (!$prodiData) continue;

            $input = $kelas;
            list($kelas, $jadwal) = explode(" - ", $input);

            $kode_prodi = substr($kelas, 0, 2);
            $semester = substr($kelas, 2, 1);
            $nama_kelas = substr($kelas, 3, 1);

            $kelasQuery = $conn->query("SELECT id_kelas FROM tb_kelas WHERE nama_kelas = '$nama_kelas' AND semester = '$semester' AND jadwal = '$jadwal'");
            $kelasData = $kelasQuery->fetch_assoc();
            if (!$kelasData) continue;

            $idProdi = $prodiData['id_prodi'];
            $idKelas = $kelasData['id_kelas'];

            $query = mysqli_query($conn, "INSERT INTO tb_user (nama_user, nim, email, prodi_id, kelas_id, role) VALUES ('$nama', '$nim','$email', '$idProdi', '$idKelas', 'Mahasiswa')");

            if ($query) {
                echo json_encode(["status" => "success"]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => mysqli_error($conn)
                ]);
            }
        }
    }
}
