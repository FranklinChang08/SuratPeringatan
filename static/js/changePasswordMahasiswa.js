const changePasswordMahasiswa = document.getElementById('changePasswordMahasiswa');
const passwordInput = document.getElementById('password');
const confirmpasswordInput = document.getElementById('confirm_password');

changePasswordMahasiswa.addEventListener('submit', function (event) {
  event.preventDefault();
  changePasswordMahasiswa.classList.add('was-validated');
  let isValid = true;

  const passwordFeedback = passwordInput.nextElementSibling;
  passwordInput.classList.remove('is-invalid', 'is-valid');

  if (passwordInput.value === '') {
    passwordFeedback.textContent = 'Silahkan masukkan password';
    passwordInput.classList.add('is-invalid');
    isValid = false;
  } else if (passwordInput.value.length < 6) {
    passwordFeedback.textContent = 'Password harus lebih dari 6 karakter';
    passwordInput.classList.add('is-invalid');
    isValid = false;
  } else {
    passwordFeedback.textContent = '';
    passwordInput.classList.add('is-valid'); // ✅ password benar → hijau
  }

  const passwordconfirmFeedback = confirmpasswordInput.nextElementSibling;
  confirmpasswordInput.classList.remove('is-invalid', 'is-valid');

  if (confirmpasswordInput.value === '') {
    passwordconfirmFeedback.textContent = 'Silahkan konfirmasi password anda';
    confirmpasswordInput.classList.add('is-invalid');
    isValid = false;
  } else if (confirmpasswordInput.value !== passwordInput.value) {
    passwordconfirmFeedback.textContent = 'Konfirmasi password harus sama dengan password baru';
    confirmpasswordInput.classList.add('is-invalid');
    isValid = false;
  } else if (confirmpasswordInput.value.length < 6) {
    passwordFeedback.textContent = 'Password harus lebih dari 6 karakter';
    passwordInput.classList.add('is-invalid');
    isValid = false;
  } else {
    passwordconfirmFeedback.textContent = '';
    confirmpasswordInput.classList.add('is-valid'); // ✅ cocok → hijau
  }


  if (isValid) {
    formChangePassword = new FormData(changePasswordMahasiswa)

    fetch('./staff/backend/changepass/update.php', {
      method: 'POST',
      body: formChangePassword
    }).then(response => response.json())
      .then(result => {
        Swal.close();

        if (result.status === "error") {
          Swal.fire({
            icon: "error",
            title: "Gagal!",
            text: result.message
          });
          return; // stop agar tidak lanjut ke success
        }

        changePasswordMahasiswa.reset();
        changePasswordMahasiswa.classList.remove("was-validated");

        Swal.fire({
          title: "success",
          text: "Kata Sandi berhasil diperbaharui!",
          icon: "success",
          customClass: {
            title: "swal-title",
            htmlContainer: "swal-text",
            confirmButton: "swal-button",
          },
        }).then(() => {
          location.href = './auth/logout.php';

          const modal = bootstrap.Modal.getInstance(
            document.getElementById("changePassword")
          );
          modal.hide();
        });

      })
      .catch(error => {
        Swal.close();

        Swal.fire({
          icon: "error",
          title: "Gagal!",
          text: "Terjadi kesalahan dalam mengirim data."
        });

        console.log(error);
      });
  }
});