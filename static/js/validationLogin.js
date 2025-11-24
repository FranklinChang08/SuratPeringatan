document.getElementById('formLogin').addEventListener('submit', async function (event) {
    event.preventDefault();

    let username = document.getElementById('username').value;
    let password = document.getElementById('password').value;

    let value = true;

    // VALIDASI USERNAME
    if (username === '') {
        document.getElementById('usernameMessage').style.display = 'block';
        document.getElementById('usernameMessage').textContent = "Silahkan masukkan NIM, NIK atau Email anda";
        value = false;
    } else {
        document.getElementById('usernameMessage').style.display = 'none';
    }

    // VALIDASI PASSWORD
    if (password === '') {
        document.getElementById('passwordMessage').style.display = 'block';
        document.getElementById('passwordMessage').textContent = "Silahkan isi password anda";
        value = false;
    } else if (password.length < 8) {
        document.getElementById('passwordMessage').style.display = 'block';
        document.getElementById('passwordMessage').textContent = "Password anda harus lebih dari 8 karakter";
        value = false;
    } else {
        document.getElementById('passwordMessage').style.display = 'none';
    }

    if (!value) return;

    let formData = new FormData(this);

    fetch("./proses_login.php", {
        method: "POST",
        body: formData
    })
        .then(response => response.json())
        .then(result => {

            if (result.status === "success") {
                Swal.fire({
                    title: "Success",
                    text: result.message,
                    icon: "success"
                }).then(() => {
                    window.location.href = result.redirect;
                });
            } else {
                Swal.fire({
                    title: "Gagal",
                    text: result.message,
                    icon: "error"
                });
            }

        })
        .catch(error => {
            Swal.fire({
                icon: "error",
                title: "Gagal!",
                text: "Terjadi kesalahan dalam mengirim data."
            });
            console.error(error);
        });
});
