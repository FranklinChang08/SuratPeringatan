<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="icon" href="../static/img/logo.png" type="image/x-icon">

  <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
  <script src="../node_modules/bootstrap/dist/js/bootstrap.js"></script>

  <link rel="stylesheet" href="../static/style/font.css">
  <link rel="stylesheet" href="../static/style/sidebar.css">

  <style>
    :root {
      --primary: #1e88e5;
      --warning: #fdd835;
      --destroy: #e53935;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background-color: #f4f5f6;
    }

    .main-content {
      margin-left: 20rem;
      width: calc(100%-20rem);
    }

    .main-content .header {
      background-color: white;
      padding: 1rem;
      display: flex;
      justify-content: space-between;
      align-items: center;

      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }


    .main-content .header .account .account-desc {
      text-align: end;
    }

    .main-content .header .account svg {
      border: black solid 1px;
      width: 35px;
      height: 35px;
      aspect-ratio: 35px;
      border-radius: 100%;
      padding: 0.5rem;
    }

    .main-content .header .account {
      line-height: 1.2;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .main-content .header .account .email {
      font-weight: 400;
      font-size: 12px;
    }

    .tableMahasiswa {
      padding: 1rem;
    }

    .tableMahasiswa .container {
      background-color: white;
      padding: 0.5rem;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      margin-bottom: 1rem;
      overflow-x: auto;
    }

    .tableMahasiswa .container .button-search .btnTambah,
    .tableMahasiswa .container .button-search .btnImport {
      padding: 0.5rem 1rem;
      border: none;
      border-radius: 4px;
      font-size: 1rem;
      font-weight: 600;
    }

    .tableMahasiswa .container .button-search .btnTambah {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      background-color: var(--primary);
      color: white;
    }

    .tableMahasiswa .container .button-search .btnImport {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      background-color: var(--primary);
      color: white;
    }

    .tableMahasiswa .container .button-search form {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      border: 1px solid #ccc;
      padding: 0 0.5rem;
      border-radius: 8px;
    }

    .tableMahasiswa .container .button .form-search {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      border: 1px solid #ccc;
      padding: 0 0.5rem;
      border-radius: 8px;
    }

    .tableMahasiswa .container .button .form-search label {
      display: flex;
      align-items: center;
      justify-content: center;
      color: rgba(0, 0, 0, 0.5);
    }

    .tableMahasiswa .container .button form input {
      padding: 0.5rem;
      border: none;
      outline: none;
      background-color: transparent;
    }


    .group-card {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      gap: 10px;
    }

    .group-card .card {
      position: relative;
    }

    .group-card .card .card-icon{
      position: absolute;
      bottom: 10px;
      right: 10px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-family: Arial, sans-serif;
      font-size: 14px;
    }

    thead {
      background: #f1f5f9;
    }

    th,
    td {
      padding: 10px 12px;
      text-align: left;
      border-bottom: 1px solid #e2e8f0;
    }

    tbody tr:nth-child(odd) {
      background: #f9fafb;
    }

    tbody tr:hover {
      background: #f1f5f9;
    }

    @media screen and (max-width: 746px) {
      .tableMahasiswa .container .button .button-group {
        display: grid;
        grid-template-columns: 1fr;
        gap: 0.5rem;
      }

      .group-card {
        grid-template-columns: 1fr 1fr;
      }

      .main-content {
        margin: 0;
        width: 100%;
      }
    }

  </style>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>

<body class="bg-light-subtle font-poppins">
  <?php
  include('../component/sidebar.php')
  ?>

  <div class="main-content">
    <header class="header">
      <h2 class="fw-bold">Data Surat Peringatan</h2>

      <div class="account">
        <div class="account-desc">
          <h2 class="nama fs-6 mb-0 fw-bold">Gilang</h2>
          <h2 class="email">gilang@gmail.com</h2>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-icon lucide-user">
          <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
          <circle cx="12" cy="7" r="4" />
        </svg>
      </div>
    </header>


    <section id="tableMahasiswa" class="tableMahasiswa">
      <div class="container w-100">
        <div class="button d-flex justify-content-between flex-column flex-md-row gap-2">
          <div class="button-group">
            <button type="button" class="btn btn-primary font-poppins" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createMahasiswa">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus">
                <path d="M5 12h14" />
                <path d="M12 5v14" />
              </svg>
              Tambah SP</button>
          </div>

          <form action="" class="form-search">
            <label for="search"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search">
                <path d="m21 21-4.34-4.34" />
                <circle cx="11" cy="11" r="8" />
              </svg></label>
            <input type="text" name="search" id="search" placeholder="Cari...">
          </form>

        </div>

        <!-- Tambahkan bagian ini di bawah -->
        <div class="sp-form">
          <div class="sp-left">
            <label for="nama-sp">Nama SP</label>
            <input type="text" id="nama-sp" placeholder="Masukkan nama surat peringatan">
          </div>

          <div class="sp-right">
            <label for="status-sp">Status SP</label>
            <select id="status-sp">
              <option value="">Pilih status</option>
              <option value="active">Activate</option>
              <option value="nonactive">Deactivate</option>
            </select>
          </div>

          <div class="sp-buttons">
            <button type="button" class="btn btn-success">Tambah</button>
            <button type="button" class="btn btn-danger">Cancel</button>
          </div>
        </div>

      </div>
    </section>
    <div class="container group-card">
      <?php for ($i = 0; $i < 3; $i++) { ?>
        <div class="card" style="height: 10rem">
          <div class="card-body">
            <h4 class="card-title">Surat Peringatan 1 </h4>
            <div class="card-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2">
                <path d="M10 11v6" />
                <path d="M14 11v6" />
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                <path d="M3 6h18" />
                <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
              </svg>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="createMahasiswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createMahasiswaLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="createMahasiswaLabel">Form Manejement Pelanggaran</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" method="POST">
              <div class="mb-3">
                <label for="nama" class="form-label">Mahasiswa</label>
                <input type="text" class="form-control" id="nama">
              </div>
              <div class="mb-3">
                <label for="nim" class="form-label">Jenis Surat Peringatan</label>
                <input type="text" class="form-control" id="nim">
              </div>
              <div class="mb-3">
                <label for="prodi" class="form-label">Tanggal</label>
                <input type="text" class="form-control" id="prodi">
              </div>
              <div class="mb-3">
                <label for="kelas" class="form-label">Status Pelanggaran</label>
                <input type="text" class="form-control" id="kelas">
              </div>
              <div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>

      <!-- Modal -->
      <div class="modal fade" id="createMahasiswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createMahasiswaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="createMahasiswaLabel">Form Mahasiswa</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="" method="POST">
                <div class="mb-3">
                  <label for="nama" class="form-label">Nama Mahasiswa</label>
                  <input type="text" class="form-control" id="nama" placeholder="Masukkan nama mahasiswa">
                </div>
                <div class="mb-3">
                  <label for="nim" class="form-label">Nomor Induk Mahasiswa</label>
                  <input type="text" class="form-control" id="nim" placeholder="Masukkan nim mahasiswa...">
                </div>
                <div class="mb-3">
                  <label for="jurusan" class="form-label">Jurusan</label>
                  <select class="form-select" aria-label="Default select example">
                    <option selected>Pilih jurusan Mahasiswa</option>
                    <option value="if">Teknik Informatika</option>
                    <option value="mesin">Teknik Mesin</option>
                    <option value="elektro">Teknik Elektro</option>
                    <option value="mb">Manejement Bisni</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="prodi" class="form-label">Program Studi</label>
                  <input type="text" class="form-control" id="prodi" placeholder="Masukkan nim mahasiswa...">
                </div>
                <div class="mb-3">
                  <label for="kelas" class="form-label">Kelas</label>
                  <input type="text" class="form-control" id="kelas" placeholder="Masukkan nim mahasiswa...">
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="Masukkan email mahasiswa">
                </div>
                <div>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</body>

</html>