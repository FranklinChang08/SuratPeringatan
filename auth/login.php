<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page | Polibatam Surat Peringatan</title>

    <link rel="icon" href="./static/img/logo.png" type="image/x-icon">

    <link rel="stylesheet" href="../static/style/font.css">
    <link rel="stylesheet" href="../static/style/login.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .swal-title,
        .swal-text,
        .swal-button {
            font-family: 'Poppins', sans-serif;
        }

        .container {
            width: 100%;
            height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr;
        }

        .container .title {
            background-image: linear-gradient(180deg,
                    rgba(0, 0, 0, 0.75),
                    rgba(0, 0, 0, 0.5),
                    rgba(0, 0, 0, 0.75)),
                url("../static/img/loginBackground.jpg");
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;

            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
        }

        .no-select {
            -webkit-user-select: none;
            /* Safari */
            -ms-user-select: none;
            /* IE 10 and IE 11 */
            user-select: none;
            /* Standard syntax */
        }

        .container .title img {
            width: 200px;
            margin-bottom: 20px;
            filter: drop-shadow(0 0 10px white);
        }

        .formLogin {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .formLogin .formWrapper {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 20px;
        }

        .formLogin form {
            width: 60%;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .formLogin h2 {
            font-size: 80px;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        input {
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            padding: 12px;
            border-radius: 8px;
            border: none;

            text-transform: uppercase;
            font-weight: 800;
            font-size: 16px;

            color: white;
            background-color: #0d6efd;
        }

        button:hover {
            background-color: #0b5ed7;
        }

        .background-fixed {
            display: none;
        }

        .error-message {
            display: none;
            color: red;
        }

        @media screen and (max-width: 746px) {
            .container {
                grid-template-columns: 1fr;
            }

            .container .title {
                display: none;
            }

            .formLogin {
                background-color: rgba(255, 255, 255, 0.8);
            }

            .formLogin {
                background-image: linear-gradient(180deg,
                        rgba(0, 0, 0, 0.75),
                        rgba(0, 0, 0, 0.5),
                        rgba(0, 0, 0, 0.75)),
                    url("../static/img/loginBackground.jpg");
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }

            .formLogin .formWrapper {
                width: 90%;
                height: 90%;
                padding: 20px;
                background-color: rgba(255, 255, 255, 0.5);
                border-radius: 8px;
                backdrop-filter: blur(2px);
                border: 2px solid rgba(255, 255, 255, 0.7);
            }
        }
    </style>
</head>

<body>
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

<script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">

<script type="text/javascript">
    document.getElementById('formLogin').addEventListener('submit', async function(event) {
        let username = document.getElementById('username').value;
        let password = document.getElementById('password').value;
        value = true
        event.preventDefault()

        if (username === '') {
            document.getElementById('usernameMessage').style.display = 'block';
            document.getElementById('usernameMessage').textContent = "Silahkan masukkan NIM, NIK atau Email anda";
            value = false
        } else {
            document.getElementById('usernameMessage').style.display = 'none';
        }

        if (password != '') {
            if (password.length < 6) {
                document.getElementById('passwordMessage').style.display = 'block';
                document.getElementById('passwordMessage').textContent = "Password anda harus lebih dari 6";
                value = false

            } else {
                document.getElementById('passwordMessage').style.display = 'none';
            }
        } else {
            document.getElementById('passwordMessage').style.display = 'block';
            document.getElementById('passwordMessage').textContent = "Silahkan isi password anda";
            value = false
        }

        if (value) {
            try {
                const response = await fetch('proses_login.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}`
                });

                const result = await response.json(); // backend kirim JSON

                if (result.status === 'success') {
                    localStorage.setItem('message', result.message);
                    localStorage.setItem('status', result.status);
                    window.location.href = result.redirect; // arahkan ke halaman dari backend
                } else {
                    Swal.fire({
                        title: result.status,
                        text: result.message,
                        icon: result.status
                    });
                }

                document.getElementById("formLogin").reset();
            } catch (error) {
                Swal.fire({
                    title: "error",
                    text: "Terjadi kesalahan saat mengirim data.",
                    icon: "error",
                    customClass: {
                        title: 'swal-title',
                        htmlContainer: 'swal-text',
                        confirmButton: 'swal-button'
                    }
                });
                console.error(error);
            }
        }
    })
</script>

</html>