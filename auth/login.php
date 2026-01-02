<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page | Polibatam Surat Peringatan</title>

    <link rel="icon" href="../static/img/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="../static/style/font.css">
    <link rel="stylesheet" href="../static/style/login.css">
</head>

<body class="font-poppins">
    <div class="container">
        <div class="title">
            <div class="text font-poppins">
                <img src="../static/img/logo.png" alt="">
                <h1 style="text-transform: uppercase; font-weight:900;">Polibatam Surat Peringatan</h1>
                <p>Selamat datang di web polibatam surat peringatan</p>
            </div>
        </div>
        <div class="formLogin font-poppins">
            <div class="formWrapper">
                <h2 class="">LOGIN</h2>
                <form method="POST" action="proses_login.php" id="formLogin">
                    <div class="input-group">
                        <label for="username">NIM, NIK atau Email</label>
                        <input type="text" name="username" id="username" placeholder="Masukkan NIM, NIK atau Email">
                        <div class="error-message" id="usernameMessage">Silahkan masukkan NIM, NIK atau Email anda</div>
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Masukkan password">
                        <div class="error-message" id="passwordMessage">Silahkan isi password anda</div>
                    </div>
                    <button type="submit" id="submitButton">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

<script src="../framework/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="../framework/node_modules/sweetalert2/dist/sweetalert2.min.css">
<script src="../static/js/validationLogin.js"></script>

</html>