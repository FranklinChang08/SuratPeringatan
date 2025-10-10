<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page | Polibatam Surat Peringatan</title>

    <link rel="icon" href="./static/img/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="../static/style/font.css">
    <link rel="stylesheet" href="../static/style/login.css">
</head>

<body>
    <div class="container">
        <div class="title">
            <div class="text font-poppins">
                <img src="./static/img/logo.png" alt="">
                <h1 style="text-transform: uppercase; font-weight:900;">Polibatam Surat Peringatan</h1>
                <p>Selamat datang di web polibatam surat peringatan</p>
            </div>
        </div>
        <div class="formLogin font-poppins">
            <div class="formWrapper">
                <h2 class="">LOGIN</h2>
                <form action="./proses_login.php" method="POST" class="">
                    <div class="input-group">
                        <label for="username">NIM, NIK atau Email</label>
                        <input type="text" name="username" id="username" placeholder="Masukkan NIM, NIK atau Email" require>
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Masukkan password" require>
                    </div>
                    <button type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>