
document.getElementById('formLogin').addEventListener('submit', async function (event) {
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
        if (password.length < 8) {
            document.getElementById('passwordMessage').style.display = 'block';
            document.getElementById('passwordMessage').textContent = "Password anda harus lebih dari 8";
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
        Swal.fire({
            title: "success",
            text: "Login Berhasil, Selamat Datang di Pengelolahan Surat Peringatan",
            icon: "success",
            customClass: {
                title: 'swal-title',
                htmlContainer: 'swal-text',
                confirmButton: 'swal-button',
            }
        }).then(() => {
            window.location.href = '../staff/dashboard.php'
        })
    }
})