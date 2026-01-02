<?php
session_start();

if (!isset($_SESSION['nik'])) {
  echo "<script>location.href = '../auth/login.php';</script>";
  session_unset();
  session_destroy();
  exit;
}

include '../conn.php';
// Filter dan Searching data pada data kelas

$nik = $_SESSION['nik'];

$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE nik = '$nik'");
$user = mysqli_fetch_assoc($query);


$search = isset($_GET['search']) ? $_GET['search'] : '';
$prodi_filter = isset($_GET['prodi']) ? $_GET['prodi'] : '';
$semester_filter = isset($_GET['semester']) ? $_GET['semester'] : '';

$query_kelas = "SELECT * FROM tb_kelas AS k INNER JOIN tb_prodi AS p ON k.prodi_id = p.id_prodi WHERE 1=1";
$kelas_count_query = "SELECT COUNT(*) AS total FROM tb_kelas AS k INNER JOIN tb_prodi AS p ON k.prodi_id = p.id_prodi WHERE 1=1";

if ($search) {
  $query_kelas .= " AND k.nama_dosen LIKE '%$search%'";
  $kelas_count_query .= " AND k.nama_dosen LIKE '%$search%'";
}

if ($prodi_filter) {
  $query_kelas .= " AND k.prodi_id = $prodi_filter ";
  $kelas_count_query .= " AND k.prodi_id = $prodi_filter";
}

if ($semester_filter) {
  $kelas_count_query .= " AND k.semester = $semester_filter ";
}

$kelas_count_select = mysqli_query($conn, $kelas_count_query);
$kelas_count = mysqli_fetch_assoc($kelas_count_select);


// Penggunaan Pagination pada halaman kelas
// yang memiliki limit 10

$limit = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

$total_data = $kelas_count['total'];

$offset = ($page - 1) * $limit;
$total_page = ceil($total_data / $limit);

$range = 3;

$start = max(1, $page - floor($range / 2));
$end = min($total_page, $start + $range - 1);

$start = max(1, $end - $range + 1);

$start_asc = ($page - 1) * $limit + 1;
$end_asc = $page * $limit;

if ($end_asc > $total_data) {
  $end_asc = $total_data;
}

// SELECT data dengan limit untuk pagination

$query_kelas .= " ORDER BY nama_kelas ASC LIMIT $offset, $limit";

$select_kelas = mysqli_query($conn, $query_kelas);

// Penyimpanan loop data prodi di database
$prodi = mysqli_query($conn, 'SELECT * FROM tb_prodi');

while ($row = mysqli_fetch_assoc($prodi)) {
  $data_prodi[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Kelas | Polibatam Surat Peringatan</title>
  <link rel="icon" href="../static/img/logo.png" type="image/x-icon">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="../framework/node_modules/bootstrap/dist/css/bootstrap.css">
  <script src="../framework/node_modules/bootstrap/dist/js/bootstrap.js"></script>

  <link rel="stylesheet" href="../static/style/font.css">
  <link rel="stylesheet" href="../static/style/sidebar.css">
  <link rel="stylesheet" href="../static/style/kelas.css">
</head>

<body class="bg-light-subtle font-poppins">
  <?php
  include '../component/sidebar.php';
  ?>

  <div class="main-content">
    <header class="header">
      <h2 class="fw-bold mb-0">Data Kelas</h2>
      <div class="account">
        <div class="account-desc">
          <h2 class=" fs-6 mb-0 fw-bold text-end border-0"><?= $user['nama_user'] ?></h2>
          <p style="font-size: 10px;" class="mb-0"><?= $user['email'] ?></p>
        </div>
        <a href="./profile.php" class="text-dark">
          <?php
          if ($user['profile']) { ?>
            <img style="width: 40px; height: 40px;" class="rounded-circle border border-black object-fit-cover"
              src="../static/img/profile_user/<?= $user['profile'] ?>" alt="">
          <?php } else { ?>
            <img style="width: 40px; height: 40px;" class="rounded-circle border border-black"
              src="https://i.pinimg.com/736x/4c/85/31/4c8531dbc05c77cb7a5893297977ac89.jpg" alt="">
          <?php }
          ?>
        </a>
      </div>
    </header>

    <section id="tableKelas" class="tableKelas">
      <div class="container">
        <div class="button d-flex justify-content-between flex-column flex-lg-row gap-2">
          <button type="button" class="btn btn-primary font-poppins" data-bs-toggle="modal"
            data-bs-target="#createKelas">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="lucide lucide-plus-icon lucide-plus">
              <path d="M5 12h14" />
              <path d="M12 5v14" />
            </svg>
            Tambah Kelas</button>

          <form action="" class="form-search">
            <label for="search">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-search-icon lucide-search">
                <path d="m21 21-4.34-4.34" />
                <circle cx="11" cy="11" r="8" />
              </svg>
            </label>
            <input type="text" name="search" id="search" value="<?= $search ?? '' ?>" placeholder="Cari">
          </form>
        </div>
      </div>
      <div class="container poppins p-3">
        <div class="row mb-2 px-2">
          <div class="col-12 col-lg-6 mb-3 mb-lg-0 px-0 d-flex justify-content-start align-items-center">
            <p class="mb-0">
              <?= $start_asc ?> - <?= $end_asc ?> dari <?= $total_data ?>
            </p>
          </div>
          <form action=""
            class="col-12 col-lg-6 mb-3 mb-lg-0 px-0 d-flex justify-content-center align-items-center gap-2"
            autocomplete="off">
            <select name="prodi" id="" class="form-select">
              <option value="">Program Studi</option>
              <?php
              foreach ($list_prodi as $row) { ?>
                <option <?= $prodi_filter == $row['id_prodi'] ? "selected" : "" ?> value="<?= $row['id_prodi'] ?>">
                  <?= $row['nama_prodi'] ?></option>
              <?php } ?>
            </select>
            <select name="semester" id="" class="form-select">
              <option value="">Semester</option>
              <option <?= $semester_filter == "1" ? "selected" : "" ?> value="1">Semester 1</option>
              <option <?= $semester_filter == "2" ? "selected" : "" ?> value="2">Semester 2</option>
              <option <?= $semester_filter == "3" ? "selected" : "" ?> value="3">Semester 3</option>
              <option <?= $semester_filter == "4" ? "selected" : "" ?> value="4">Semester 4</option>
              <option <?= $semester_filter == "5" ? "selected" : "" ?> value="5">Semester 5</option>
              <option <?= $semester_filter == "6" ? "selected" : "" ?> value="6">Semester 6</option>
              <option <?= $semester_filter == "7" ? "selected" : "" ?> value="7">Semester 7</option>
              <option <?= $semester_filter == "8" ? "selected" : "" ?> value="8">Semester 8</option>
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
          </form>
        </div>
        <?php if ($total_data > 0) { ?>
          <table class="text-nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Program Studi</th>
                <th>Nama Kelas</th>
                <th>Semester</th>
                <th>Jadwal</th>
                <th>Wali Dosen</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = $offset + 1;
              while ($row = mysqli_fetch_array($select_kelas)) {
                ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $row['nama_prodi'] ?></td>
                  <td><?= $row['nama_kelas'] ?></td>
                  <td><?= $row['semester'] ?></td>
                  <td><?= $row['jadwal'] ?></td>
                  <td><?= $row['nama_dosen'] ?></td>
                  <td class="d-flex align-items-center">
                    <button type="button" class="btn btn-warning me-2 py-1 px-2" class="btn btn-primary"
                      data-bs-toggle="modal" data-bs-target="#editKelas" data-id="<?= $row['id_kelas'] ?>"
                      data-prodi="<?= $row['prodi_id'] ?>" data-semester="<?= $row['semester'] ?>"
                      data-nama="<?= $row['nama_kelas'] ?>" data-jadwal="<?= $row['jadwal'] ?>"
                      data-dosen="<?= $row['nama_dosen'] ?>">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-square-pen-icon lucide-square-pen">
                        <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                        <path
                          d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
                      </svg>
                    </button>

                    <form action="./backend/kelas/delete.php" method="POST" onsubmit="return confirmRemove(event)">
                      <input type="hidden" name="id_kelas" value="<?= $row['id_kelas'] ?>">
                      <button class="btn btn-danger py-1 px-2" type="submit" name="submit" value="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                          stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M10 11v6" />
                          <path d="M14 11v6" />
                          <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                          <path d="M3 6h18" />
                          <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                        </svg>
                      </button>
                    </form>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        <?php } else { ?>
          <div class="container mb-0 shadow-none p-0">
            <div class="alert alert-primary mb-0" role="alert">
              Data Kelas tidak ada. Silahkan isi data Kelas terlebih dahulu!!!!
            </div>
          </div>
        <?php } ?>
        <?php if ($total_data > 10) { ?>
          <div class="my-4 d-flex justify-content-center align-items-center gap-4">

            <!-- PREV -->
            <?php if ($page > 1): ?>
              <a href="?page=<?= $page - 1 ?>" class="btn btn-outline-dark mb-0 text-center">Prev</a>
            <?php endif; ?>

            <div class="d-flex justify-content-center align-items-center">
              <!-- jika halaman awal > 1, tampilkan  -->

              <div class="d-flex justify-content-center align-items-center gap-2">
                <!-- range halaman -->
                <?php for ($i = $start; $i <= $end; $i++): ?>
                  <a href="?page=<?= $i ?>" class="btn
           <?= $page == $i ? 'btn-dark' : 'btn-outline-dark' ?>">
                    <?= $i ?>
                  </a>
                <?php endfor; ?>
              </div>

            </div>

            <!-- NEXT -->
            <?php if ($page < $total_page): ?>
              <a href="?page=<?= $page + 1 ?>" class="btn btn-outline-dark mb-0 text-center">Next</a>
            <?php endif; ?>

          </div>
        <?php } ?>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="createKelas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="createKelasLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="createKelasLabel">Form Kelas</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="POST" class="needs-validation" novalidate id="FormCreateKelas" autocomplete="off">
                <div class="mb-3">
                  <label for="prodi" class="form-label">Program Studi</label>
                  <select class="form-select" name="prodi_id" id="programstudi" required>
                    <option value="">Pilih Program Studi</option>
                    <?php
                    foreach ($data_prodi as $row) { ?>
                      <option value="<?= $row['id_prodi'] ?>"><?= $row['nama_prodi'] ?></option>
                    <?php } ?>
                  </select>
                  <div class="invalid-feedback"></div>
                </div>

                <div class="mb-3 row">
                  <div class="col">
                    <label for="semester" class="form-label">Semester</label>
                    <input type="number" min="1" max="8" name="semester" class="form-control" id="semester" required
                      placeholder="Masukkan semester">
                    <div class="invalid-feedback"></div>
                  </div>

                  <div class="col">
                    <label for="kelas" class="form-label">Nama Kelas</label>
                    <input type="text" class="form-control" name="nama_kelas" id="kelas" required
                      placeholder="Masukkan nama kelas">
                    <div class="invalid-feedback"></div>
                  </div>
                </div>

                <div class="mb-3">
                  <label for="jadwal" class="form-label">Jadwal</label>
                  <select class="form-select" name="jadwal" id="jadwal" required>
                    <option value="">Pilih Jadwal</option>
                    <option value="Pagi">Pagi</option>
                    <option value="Malam">Malam</option>
                  </select>
                  <div class="invalid-feedback"></div>
                </div>

                <div class="mb-3">
                  <label for="walidosen" class="form-label">Wali Dosen</label>
                  <input type="text" class="form-control" name="nama_dosen" id="walidosen" required
                    placeholder="Masukkan wali dosen">
                  <div class="invalid-feedback"></div>
                </div>

                <div>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                  <input type="submit" name="submit" class="btn btn-primary" value="Kirim">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="editKelas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editKelasLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="editKelasLabel">Form Kelas</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="FormUpdateKelas" method="POST" class="needs-validation" novalidate autocomplete="off">
                <div class="mb-3">
                  <label for="prodi" class="form-label">Program Studi</label>
                  <select class="form-select" name="prodi_id" id="editprogramstudi" required>
                    <option value="">Pilih Program Studi</option>
                    <?php
                    foreach ($data_prodi as $prodi) { ?>
                      <option value="<?= $prodi['id_prodi'] ?>"><?= $prodi['nama_prodi'] ?></option>
                    <?php } ?>
                  </select>
                  <div class="invalid-feedback"></div>
                </div>

                <div class="row mb-3">
                  <div class="col">
                    <label for="semester" class="form-label">Semester</label>
                    <input type="number" name="semester" min="1" max="8" class="form-control" id="editsemester" value=""
                      required placeholder="Masukkan semester">
                    <div class="invalid-feedback"></div>
                  </div>

                  <div class="col">
                    <label for="kelas" class="form-label">Nama Kelas</label>
                    <input type="text" name="nama_kelas" class="form-control" id="editkelas" value="" required
                      placeholder="Masukkan nama kelas">
                    <div class="invalid-feedback"></div>
                  </div>
                </div>

                <div class="mb-3">
                  <label for="jadwal" class="form-label">Jadwal</label>
                  <select class="form-select" name="jadwal" id="editjadwal" required>
                    <option value="">Pilih Jadwal</option>
                    <option value="Pagi">Pagi</option>
                    <option value="Malam">Malam</option>
                  </select>
                  <div class="invalid-feedback"></div>
                </div>

                <div class="mb-3">
                  <label for="walidosen" class="form-label">Wali Dosen</label>
                  <input type="text" name="nama_dosen" class="form-control" id="editwalidosen" value="" required
                    placeholder="Masukkan wali dosen">
                  <div class="invalid-feedback"></div>
                </div>

                <div>
                  <input type="hidden" name="id_kelas" id="id_kelas" value="">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                  <input type="submit" name="submit" class="btn btn-warning" value="Simpan">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</body>
<script src="../framework/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="../framework/node_modules/sweetalert2/dist/sweetalert2.min.css">
<script src="../static/js/confirmRemove.js"></script>
<script src="../static/js/validationFormKelas.js"></script>
<script src="../static/js/confirmLogout.js"></script>
<script>
  document.getElementById('editKelas').addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget; // tombol yang diklik

    // Ambil data dari tombol
    const id = button.getAttribute('data-id');
    const prodi = button.getAttribute('data-prodi');
    const semester = button.getAttribute('data-semester');
    const nama = button.getAttribute('data-nama');
    const jadwal = button.getAttribute('data-jadwal');
    const dosen = button.getAttribute('data-dosen');

    // Isi ke dalam form modal
    document.getElementById('id_kelas').value = id;
    document.getElementById('editprogramstudi').value = prodi;
    document.getElementById('editsemester').value = semester;
    document.getElementById('editkelas').value = nama;
    document.getElementById('editjadwal').value = jadwal;
    document.getElementById('editwalidosen').value = dosen;
  });
</script>

</html>