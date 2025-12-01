<?php
session_start();

if (!isset($_SESSION['nim'])) {
    echo "<script>location.href = './auth/login.php';</script>";
    session_unset();
    session_destroy();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page | Polibatam Surat Peringatan</title>
    <link rel="icon" href="./static/img/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>

    <link rel="stylesheet" href="./static/style/font.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .navbar {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .hero {
            width: 100%;
            height: 60vh;
            background: linear-gradient(90deg,
                    rgba(0, 0, 0, 0.8),
                    rgba(0, 0, 0, 0.5),
                    rgba(0, 0, 0, 0.8)),
                url("./static/img/homeBackground.jpg") no-repeat top center/cover;

            display: flex;
            justify-content: start;
            align-items: center;

            padding: 0 100px;
            color: white;
            font-weight: bold;
        }

        .hero h1 {
            width: 50%;
            font-size: 5rem;
            line-height: 0.8;
        }

        .data-list {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
        }

        .content-data {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 90%;
        }

        .footer {
            background: linear-gradient(rgba(0, 0, 0, 0.7)),
                url("./static/img/loginBackground.jpg") no-repeat bottom center/cover;
            height: 30vh;
            width: 100%;
            color: white;
            margin: 0;
        }

        .footer .container-fluid {
            backdrop-filter: grayscale(100);
            width: 100%;
            height: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            padding: 0 100px;
            gap: 20px;
        }

        .form-medsos {
            display: flex;
            justify-content: end;
            align-items: end;
            flex-direction: column;
        }

        .form-medsos form {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 10px;
        }

        .form-medsos form .input-message {
            background-color: white;
            border: white 2px solid;
            border-radius: 4px;
            padding: 8px;
            color: black;
            outline: none;
        }

        .form-medsos form button {
            padding: 8px;
            border-radius: 4px;
            border: none;
        }

        .form-medsos ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: start;
            gap: 20px;
            margin-top: 1rem;
        }

        .form-medsos ul li {
            border: white 1.5px solid;
            width: 40px;
            height: 40px;
            border-radius: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }

        @media screen and (max-width:1200px) {
            .hero {
                padding: 0 30px;
                height: 600px;
            }

            .hero h1 {
                width: 80%;
                font-size: 4rem;
                line-height: 0.8;
            }

            .content-data {

                width: 95%;
                padding: 0;
            }

            .form-medsos {
                justify-content: center;
                align-items: center;
            }
        }

        @media screen and (max-width:820px) {
            .hero {
                padding: 0 22px;
                height: 400px;
            }

            .hero h1 {
                width: 70%;
                font-size: 4rem;
                line-height: 0.8;
            }

            .content-data {

                width: 95%;
                padding: 0;
            }


            .footer .container-fluid {
                text-align: center;
            }

            .footer .container-fluid {
                padding: 0 20px;
                grid-template-columns: 1fr;
            }
        }


        @media screen and (max-width:768px) {


            .hero h1 {
                width: 80%;
                font-size: 4rem;
                line-height: 0.8;
            }

            .content-data {

                width: 95%;
                padding: 0;
            }

            .footer {
                height: 400px;
            }
        }

        @media screen and (max-width:576px) {
            .hero h1 {
                width: 100%;
                font-size: 3rem;
                line-height: 0.8;
            }

            .content-data {

                width: 95%;
                padding: 0;
            }

            .footer {
                height: 500px;
                padding: 0;
            }

            .form-medsos form {
                flex-direction: column;
            }

            .form-medsos ul {
                justify-content: center;
            }

            .form-medsos form button {
                width: 100%;
            }
        }

        @media screen and (max-width:390px) {
            .hero {
                height: 400px;
            }

            .hero h1 {
                width: 100%;
                font-size: 2rem;
                line-height: 0.8;
            }

            .content-data {

                width: 95%;
                padding: 0;
            }
        }
    </style>
</head>


<body class="font-poppins">
    <header class="navbar position-sticky top-0 start-0 z-3 bg-primary w-100 text-light d-flex align-items-center p-3 px-4">
        <h1 class="fw-bold fs-5 m-0">Polibatam Surat Peringatan</h1>
    </header>

    <section class="hero bebas-neue">
        <h1>Selamat Datang di Surat Peringatan Polibatam</h1>
    </section>

    <section class="data-list">
        <div class="content-data container-fluid row row-cols-1 p-0">
            <div class="container bg-white p-4 border border-1 rounded-2 shadow">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-10 mahasiswa-data font-poppins">
                        <h2 class="bebas-neue text-uppercase fw-bold mb-4 text-center">Data Mahasiswa</h2>

                        <div class="row align-items-center g-3">
                            <!-- FOTO MAHASISWA -->
                            <div class="col-12 col-md-4 d-flex justify-content-center">
                                <img
                                    src="https://i.pinimg.com/736x/f6/61/ea/f661ea61616909838a9fbfeda0d2ea14.jpg"
                                    alt="Foto Mahasiswa"
                                    class="object-fit-cover border border-1 rounded-2 shadow"
                                    style="width: 300px; height: 300px; object-fit: cover; object-position: top;" />
                            </div>

                            <!-- DATA MAHASISWA -->
                            <div class="col-12 col-md-8">
                                <div class="row row-cols-1 row-cols-sm-2 g-2">
                                    <!-- NIM -->
                                    <div class="col">
                                        <div class="card p-3 d-flex flex-column">
                                            <span class="d-flex align-items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-user">
                                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                                    <circle cx="12" cy="7" r="4" />
                                                </svg>
                                                NIM
                                            </span>
                                            <span class="fw-semibold fs-6 mt-2">123456789</span>
                                        </div>
                                    </div>

                                    <!-- NAMA -->
                                    <div class="col">
                                        <div class="card p-3 d-flex flex-column">
                                            <span class="d-flex align-items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-user">
                                                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                                    <circle cx="12" cy="7" r="4" />
                                                </svg>
                                                Nama
                                            </span>
                                            <span class="fw-semibold fs-6 mt-2">Franklin Sebastian Felix</span>
                                        </div>
                                    </div>

                                    <!-- EMAIL -->
                                    <div class="col">
                                        <div class="card p-3 d-flex flex-column">
                                            <span class="d-flex align-items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-mail">
                                                    <rect x="3" y="5" width="18" height="14" rx="2" ry="2" />
                                                    <polyline points="3,7 12,13 21,7" />
                                                </svg>
                                                Email
                                            </span>
                                            <span class="fw-semibold fs-6 mt-2">franklin08@gmail.com</span>
                                        </div>
                                    </div>

                                    <!-- JURUSAN -->
                                    <div class="col">
                                        <div class="card p-3 d-flex flex-column">
                                            <span class="d-flex align-items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-book">
                                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                                                    <path d="M4 4.5A2.5 2.5 0 0 1 6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5z" />
                                                </svg>
                                                Jurusan
                                            </span>
                                            <span class="fw-semibold fs-6 mt-2">Teknik Informatika</span>
                                        </div>
                                    </div>

                                    <!-- PROGRAM STUDI -->
                                    <div class="col">
                                        <div class="card p-3 d-flex flex-column">
                                            <span class="d-flex align-items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-book-open">
                                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a4 4 0 0 0-4-4H2z" />
                                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a4 4 0 0 1 4-4h6z" />
                                                </svg>
                                                Program Studi
                                            </span>
                                            <span class="fw-semibold fs-6 mt-2">Teknik Informatika</span>
                                        </div>
                                    </div>

                                    <!-- KELAS -->
                                    <div class="col">
                                        <div class="card p-3 d-flex flex-column">
                                            <span class="d-flex align-items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="lucide lucide-users">
                                                    <path d="M17 21v-2a4 4 0 0 0-3-3.87" />
                                                    <path d="M7 21v-2a4 4 0 0 1 3-3.87" />
                                                    <path d="M12 7a4 4 0 1 0-4 4 4 4 0 0 0 4-4Z" />
                                                    <path d="M17 11a4 4 0 1 0-4-4" />
                                                </svg>
                                                Kelas
                                            </span>
                                            <span class="fw-semibold fs-6 mt-2">IF 1A - Pagi</span>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="d-flex flex-column">
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changePassword">
                                                Ubah Password
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Password</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="" method="POST" class="needs-validation" novalidate id="changePasswordMahasiswa">
                                                                <div class="mb-3">
                                                                    <label for="password" class="form-label">Password</label>
                                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password mahasiswa" required>
                                                                    <div class="invalid-feedback"></div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                                                                    <input type="password" class="form-control" name="confrim_password" id="confirm_password" placeholder="Masukkan Konfirmasi Password mahasiswa..." required>
                                                                    <div class="invalid-feedback"></div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col sp-data font-poppins d-flex flex-column gap-2 p-0 mt-4 bg-white p-4 border border-1 rounded-2 shadow">
                <h2 class="bebas-neue text-uppercase fw-bold">Data Pelanggaran</h2>
                <?php
                for ($i = 1; $i <= 3; $i++) { ?>
                    <div class="card bg-body-tertiary shadow-sm p-3">
                        <h2 class="montserrat text-uppercase fs-4 fw-bold">Surat Peringatan <?= $i ?></h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab harum distinctio quis dolore vel, deleniti, veritatis porro obcaecati aliquid nisi expedita saepe dolorem autem rerum cumque doloremque corrupti dolor explicabo.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab harum distinctio quis dolore vel, deleniti, veritatis porro obcaecati aliquid nisi expedita saepe dolorem autem rerum cumque doloremque corrupti dolor explicabo.</p>
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

    <form action="./auth/logout.php" class="position-fixed bottom-0 end-0 p-3" onsubmit="confirmLogout(event, this)">
        <button class="btn btn-danger shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out-icon lucide-log-out">
                <path d="m16 17 5-5-5-5" />
                <path d="M21 12H9" />
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
            </svg>
        </button>
    </form>
</body>

<script src="./node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="./node_modules/sweetalert2/dist/sweetalert2.min.css">
<script src="./static/js/changePasswordMahasiswa.js"></script>
<script src="./static/js/confirmLogout.js"></script>

</html>