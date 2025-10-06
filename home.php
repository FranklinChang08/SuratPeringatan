<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="./static/img/logo.png" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="./static/style/font.css">
    <link rel="stylesheet" href="./static/style/home.css">
</head>


<body class="font-poppins">
    <header class="navbar position-sticky top-0 start-0 z-3 bg-primary w-100 text-light d-flex align-items-center p-3 px-4">
        <h1 class="fw-bold fs-5 m-0">Polibatam Surat Peringatan</h1>
    </header>

    <section class="hero bebas-neue">
        <h1>Selamat Datang di Surat Peringatan Polibatam</h1>
    </section>

    <section class="data-list">
        <div class="container">
            <div class="mahasiswa-data font-poppins">
                <h2 class="bebas-neue text-uppercase fw-bold">Data Mahasiswa</h2>
                <ul class="d-flex flex-column gap-2">
                    <li class="d-flex flex-column card p-2">
                        <span class="d-flex align-items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-icon lucide-user">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>Nama</span>
                        <span class="fw-semibold fs-6 mt-2">Franklin Sebastian Felix</span>
                    </li>
                    <li class="d-flex flex-column card p-2">
                        <span class="d-flex align-items-center gap-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-id-card-icon lucide-id-card">
                                <path d="M16 10h2" />
                                <path d="M16 14h2" />
                                <path d="M6.17 15a3 3 0 0 1 5.66 0" />
                                <circle cx="9" cy="11" r="2" />
                                <rect x="2" y="5" width="20" height="14" rx="2" />
                            </svg>NIM</span>
                        <span class="fw-semibold fs-6 mt-2">123456789</span>
                    </li>
                </ul>
            </div>
            <div class="sp-data font-poppins">
                <?php
                for ($i = 0; $i < 5; $i++) { ?>
                    <div class="card bg-body-tertiary shadow-sm p-3">
                        <h2 class="montserrat text-uppercase fs-4 fw-bold">Surat Peringatan 1</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab harum distinctio quis dolore vel, deleniti, veritatis porro obcaecati aliquid nisi expedita saepe dolorem autem rerum cumque doloremque corrupti dolor explicabo.</p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container-fluid">
            <div class="text">
                <h2>Surat Peringatan</h2>
                <p>Polibatam Surat Peringatan — platform digital untuk mempermudah pembuatan, pengarsipan, dan pelacakan surat peringatan secara efisien.</p>
            </div>
            <div class="form-medsos">
                <div class="wrapper">
                    <h2 class="fs-6 fw-bold">Send Us Message</h2>
                    <form action="">
                        <input type="text" name="message" class="input-message">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <ul>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-facebook-icon lucide-facebook">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                            </svg>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-instagram-icon lucide-instagram">
                                <rect width="20" height="20" x="2" y="2" rx="5" ry="5" />
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                <line x1="17.5" x2="17.51" y1="6.5" y2="6.5" />
                            </svg>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-linkedin-icon lucide-linkedin">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" />
                                <rect width="4" height="12" x="2" y="9" />
                                <circle cx="4" cy="4" r="2" />
                            </svg>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>