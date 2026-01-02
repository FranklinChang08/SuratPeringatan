<?php
// HAPUS SEMUA OUTPUT SEBELUM PDF
while (ob_get_level()) {
    ob_end_clean();
}

require __DIR__ . '/../../framework/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Koneksi database
include_once("../../conn.php");

// Pastikan MySQL menampilkan error (untuk debug)
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function tanggalIndonesia($tanggal, $formatJam = true)
{
    $hari = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    ];

    $bulan = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'April' => 'April',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'September' => 'September',
        'October' => 'Oktober',
        'November' => 'November',
        'December' => 'Desember'
    ];

    $tgl = strtotime($tanggal);

    $hasil = $hari[date('l', $tgl)] . ", "
        . date('d', $tgl) . " "
        . $bulan[date('F', $tgl)] . " "
        . date('Y', $tgl);

    if ($formatJam) {
        $hasil .= " - " . date('H:i', $tgl);
    }

    return $hasil;
}

try {
    // Ambil data pelanggaran dengan pengurutan
    $query = "SELECT p.*, u.nama_user, u.nim, k.semester, k.nama_kelas, k.jadwal, 
                     s.nama_prodi, s.kode_prodi, k.nama_dosen
              FROM tb_pelanggaran p
              INNER JOIN tb_user u ON p.mahasiswa_id = u.id_user
              INNER JOIN tb_kelas k ON k.id_kelas = u.kelas_id
              INNER JOIN tb_prodi s ON s.id_prodi = u.prodi_id
              ORDER BY 
                FIELD(p.jenis_sp, 'SP 1', 'SP 2', 'SP 3', 'SP 4', 'SP 5'),
                s.nama_prodi ASC,
                FIELD(k.jadwal, 'Pagi', 'Malam'),
                u.nim ASC";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        throw new Exception("Error: " . mysqli_error($conn));
    }

    // Kelompokkan data berdasarkan jenis SP dan prodi
    $dataGrouped = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $jenisSp = $row['jenis_sp'];
        $prodi = $row['nama_prodi'];

        if (!isset($dataGrouped[$jenisSp])) {
            $dataGrouped[$jenisSp] = [];
        }
        if (!isset($dataGrouped[$jenisSp][$prodi])) {
            $dataGrouped[$jenisSp][$prodi] = [];
        }

        $dataGrouped[$jenisSp][$prodi][] = $row;
    }

    // Mulai HTML untuk PDF
    $html = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <style>
            body { 
                font-family: Arial, sans-serif;
                margin: 20px;
            }
            
            .page-break {
                page-break-after: always;
            }
            
            .sp-header {
                background-color: #2c3e50;
                color: white;
                padding: 15px;
                margin: 30px 0 20px 0;
                text-align: center;
                font-size: 16px;
                font-weight: bold;
                border-radius: 5px;
            }
            
            .prodi-header {
                background-color: #34495e;
                color: white;
                padding: 12px;
                margin: 20px 0 15px 0;
                font-size: 14px;
                font-weight: bold;
                border-radius: 3px;
            }
            
            table { 
                border-collapse: collapse; 
                width: 100%; 
                font-size: 10px;
                margin-bottom: 30px;
            }
            
            table, th, td { 
                border: 1px solid #333; 
            }
            
            th {
                background-color: #ecf0f1;
                padding: 8px;
                font-weight: bold;
                text-align: center;
                color: #2c3e50;
            }
            
            td {
                padding: 6px;
                vertical-align: top;
            }
            
            h2 { 
                text-align: center; 
                margin-bottom: 10px;
                color: #2c3e50;
                font-size: 18px;
            }
            
            .header-info {
                text-align: center;
                margin-bottom: 30px;
                font-size: 10px;
                color: #7f8c8d;
            }
            
            .text-center { 
                text-align: center; 
            }
            
            .kelas-pagi {
                background-color: #fff9e6;
            }
            
            .kelas-malam {
                background-color: #e6f3ff;
            }
            
            .summary {
                background-color: #d5f4e6;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <h2>Laporan Data Pelanggaran Mahasiswa</h2>
        <div class="header-info">
            Tanggal Cetak: ' . date('d-m-Y H:i:s') . '
        </div>';

    // Loop untuk setiap jenis SP
    $spCounter = 0;
    foreach ($dataGrouped as $jenisSp => $prodis) {
        if ($spCounter > 0) {
            $html .= '<div class="page-break"></div>';
        }

        $html .= '<div class="sp-header">SURAT PERINGATAN: ' . strtoupper(htmlspecialchars($jenisSp)) . '</div>';

        // Loop untuk setiap prodi dalam jenis SP
        foreach ($prodis as $namaProdi => $mahasiswaList) {
            $html .= '<div class="prodi-header">Program Studi: ' . htmlspecialchars($namaProdi) . '</div>';

            $html .= '
            <table>
                <thead>
                    <tr>
                        <th width="4%">No</th>
                        <th width="10%">NIM</th>
                        <th width="18%">Nama</th>
                        <th width="12%">Kelas</th>
                        <th width="8%">Jadwal</th>
                        <th width="25%">Keterangan</th>
                        <th width="20%">Tanggal</th>
                        <th width="20%">Dosen Wali</th>
                    </tr>
                </thead>
                <tbody>';

            $no = 1;
            foreach ($mahasiswaList as $row) {
                // Escape HTML untuk keamanan
                $nama = htmlspecialchars($row['nama_user'], ENT_QUOTES, 'UTF-8');
                $nim = htmlspecialchars($row['nim'], ENT_QUOTES, 'UTF-8');
                $kode_prodi = htmlspecialchars($row['kode_prodi'], ENT_QUOTES, 'UTF-8');
                $semester = htmlspecialchars($row['semester'], ENT_QUOTES, 'UTF-8');
                $nama_kelas = htmlspecialchars($row['nama_kelas'], ENT_QUOTES, 'UTF-8');
                $jadwal = htmlspecialchars($row['jadwal'], ENT_QUOTES, 'UTF-8');
                $keterangan = htmlspecialchars($row['keterangan'], ENT_QUOTES, 'UTF-8');
                $tanggal = tanggalIndonesia($row['tanggal'], false);
                $nama_dosen = htmlspecialchars($row['nama_dosen'], ENT_QUOTES, 'UTF-8');

                // Tambahkan class berdasarkan jadwal
                $rowClass = strtolower($jadwal) == 'pagi' ? 'kelas-pagi' : 'kelas-malam';

                $html .= '
                    <tr class="' . $rowClass . '">
                        <td class="text-center">' . $no++ . '</td>
                        <td class="text-center">' . $nim . '</td>
                        <td>' . $nama . '</td>
                        <td class="text-center">' . $kode_prodi . $semester . $nama_kelas . '</td>
                        <td class="text-center">' . $jadwal . '</td>
                        <td>' . $keterangan . '</td>
                        <td class="text-center">' . $tanggal . '</td>
                        <td class="text-center">' . $nama_dosen . '</td>
                    </tr>';
            }

            // Tambahkan summary row
            $totalMahasiswa = count($mahasiswaList);
            $html .= '
                <tr class="summary">
                    <td colspan="8" class="text-center">
                        Total Mahasiswa ' . htmlspecialchars($namaProdi) . ': ' . $totalMahasiswa . ' orang
                    </td>
                </tr>';

            $html .= '
                </tbody>
            </table>';
        }

        $spCounter++;
    }

    // Jika tidak ada data
    if (empty($dataGrouped)) {
        $html .= '
        <table>
            <tr>
                <td class="text-center" style="padding: 20px;">Tidak ada data pelanggaran</td>
            </tr>
        </table>';
    }

    $html .= '
    </body>
    </html>';

    // Konfigurasi Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);
    $options->set('defaultFont', 'Arial');
    $options->set('chroot', realpath(''));

    // Render PDF
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'potrait');
    $dompdf->render();

    // Nama file dengan timestamp
    $filename = "laporan_pelanggaran_" . date('Ymd_His') . ".pdf";

    // Download PDF
    $dompdf->stream($filename, ["Attachment" => 1]);
} catch (Exception $e) {
    // Tangani error
    die("Terjadi kesalahan: " . $e->getMessage());
}

exit;
