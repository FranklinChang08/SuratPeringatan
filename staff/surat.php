<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="icon" href="../static/img/logo.png" type="image/x-icon">

  <link rel="stylesheet" href="../static/style/font.css">
  <link rel="stylesheet" href="../static/style/sidebar.css">
  <link rel="stylesheet" href="../static/style/dashboard.css">
  <link rel="stylesheet" href="../static/style/surat.css">

  <style>
    /* Buat custom backdrop */
    .modal-backdrop {
      background-color: rgba(0, 0, 0, 0.8) !important;
      backdrop-filter: blur(1000px) !important;
      -webkit-backdrop-filter: blur(1000px) !important;
    }

    .modal-backdrop.show {
      background-color: rgba(0, 0, 0, 0.25);
      backdrop-filter: blur(100px);
      -webkit-backdrop-filter: blur(100px);
    }

    .modal-backdrop {
      transition: opacity 0.3s ease;
    }

    .card-group2 .container {
      background-color: white;
      padding: 0.5rem;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      margin-bottom: 1rem;
    }

    .card-group2 .container .button {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .card-group2 .container .button .button-group {
      display: flex;
      gap: 8px;
    }

    .card-group2 .container .button .btnTambah,
    .card-group2 .container .button .btnImport {
      padding: 0.5rem 1rem;
      border: none;
      border-radius: 4px;
      font-size: 1rem;
      font-weight: 600;
    }

    .card-group2 .container .button .btnTambah {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      background-color: var(--primary);
      color: white;
    }

    .card-group2 .container .button .btnImport {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      background-color: var(--primary);
      color: white;
    }

    .card-group2 .container .button .form-search {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      border: 1px solid #ccc;
      padding: 0 0.5rem;
      border-radius: 8px;
    }

    .card-group2 .container .button .form-search label {
      display: flex;
      align-items: center;
      justify-content: center;
      color: rgba(0, 0, 0, 0.5);
    }

    .card-group2 .container .button form input {
      padding: 0.5rem;
      border: none;
      outline: none;
      background-color: transparent;
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
      <h2 class="fw-bold">Data Mahasiswa</h2>
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

    <section id="card-group" class="card-group">

<div class="header-container">
    <button class="btn-tambah">+ Tambah SP</button>
    <input type="text" class="input-cari" placeholder="Cari...">
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
      <div class="container">
        <div class="card" style="width: 15rem; height: 10rem">
          <div class="card-body2">
            <h4 class="card-title2">Surat Peringatan 1 </h4>
            <div class="card-icon2">
              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2">
                <path d="M10 11v6" />
                <path d="M14 11v6" />
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                <path d="M3 6h18" />
                <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
              </svg>
              </svg>
            </div>
          </div>
        </div>
        <div class="card" style="width: 15rem; height: 10rem">
          <div class="card-body2">
            <!-- <div class="card-body"> -->
            <h4 class="card-title2">Surat Peringatan 1</h4>
            <div class="card-icon2">
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
        <div class="card" style="width: 15rem; height: 10rem">
          <div class="card-body2">
            <h4 class="card-title2">Surat Peringatan 1</h4>
            <div class="card-icon2">
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