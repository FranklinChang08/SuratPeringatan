<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Surat Peringatan | Polibatam Surat Peringatan</title>
  <link rel="icon" href="../static/img/logo.png" type="image/x-icon">

  <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
  <script src="../node_modules/bootstrap/dist/js/bootstrap.js"></script>

  <link rel="stylesheet" href="../static/style/font.css">
  <link rel="stylesheet" href="../static/style/sidebar.css">
  <link rel="stylesheet" href="../static/style/surat.css">


</head>

<body class="bg-light-subtle font-poppins">
  <?php
  include '../component/sidebar.php';
  ?>

  <div class="main-content">
    <header class="header">
      <h2 class="fw-bold">Data Surat Peringatan</h2>

      <div class="account">
        <div class="account-desc">
          <h2 class="nama fs-6 mb-0 fw-bold">Gilang</h2>
          <h2 class="email">gilang@gmail.com</h2>
        </div>
        <a href="./profile.php" class="text-dark">
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-user-icon lucide-user">
            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
            <circle cx="12" cy="7" r="4" />
          </svg>
        </a>
      </div>
    </header>

    <section id="tableSurat" class="tableSurat">
      <div class="container w-100 mb-0">
        <div class="button d-flex justify-content-between flex-column flex-md-row gap-2">
          <div class="button-group">
            <button type="button" class="btn btn-primary font-poppins" data-bs-toggle="modal"
              data-bs-target="#createSurat">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus">
                <path d="M5 12h14" />
                <path d="M12 5v14" />
              </svg>
              Tambah SP</button>
          </div>

          <form action="" class="form-search">
            <label for="search"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-search-icon lucide-search">
                <path d="m21 21-4.34-4.34" />
                <circle cx="11" cy="11" r="8" />
              </svg></label>
            <input type="text" name="search" id="search" placeholder="Cari...">
          </form>
        </div>
      </div>
      <div class="container mt-4 px-4 py-3 " style="margin-bottom: 70px;">
        <div class="row">
          <?php for ($i = 1; $i <= 3; $i++) { ?>
            <div class="card col-lg-4 p-2" style="height: 12rem">
              <h4 class="card-title">Surat Peringatan <?= $i ?> </h4>
              <div class="card-icon">
                <form action="" class="position-absolute bottom-0 end-0 m-2" onsubmit="confirmRemove(event, this)">
                  <button type="submit" class="btn btn-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                      viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                      stroke-linecap="round" stroke-linejoin="round"
                      class="lucide lucide-trash2-icon lucide-trash-2">
                      <path d="M10 11v6" />
                      <path d="M14 11v6" />
                      <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                      <path d="M3 6h18" />
                      <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                    </svg>
                  </button>
                </form>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="createSurat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="createSuratLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="createSuratLabel">Form Surat Peringatan</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
              aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST" class="needs-validation" novalidate
              id="formCreateSurat">
              <div class="mb-3">
                <label for="nama" class="form-label">Nama Surat Peringatan</label>
                <input type="text" class="form-control" id="nama" name="nama_surat"
                  required>
                <div class="invalid-feedback"></div>
              </div>
              <div>
                <button type="button" class="btn btn-secondary"
                  data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Kirim</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
<script src="../static/js/confirmRemove.js"></script>
<script src="../static/js/validationFormSP.js"></script>

</html>
