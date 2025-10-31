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
    } else if (passwordInput.value.length < 8) {
        passwordFeedback.textContent = 'Password harus lebih dari 8 karakter';
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
    } else if (confirmpasswordInput.value.length < 8) {
        passwordFeedback.textContent = 'Password harus lebih dari 8 karakter';
        passwordInput.classList.add('is-invalid');
        isValid = false;
    } else {
        passwordconfirmFeedback.textContent = '';
        confirmpasswordInput.classList.add('is-valid'); // ✅ cocok → hijau
    }


    if (isValid) {
        const modal = bootstrap.Modal.getInstance(
            document.getElementById("changePassword")
        );
        modal.hide();

        Swal.fire({
            title: "success",
            text: "Password berhasil diubah!",
            icon: "success",
            customClass: {
                title: "swal-title",
                htmlContainer: "swal-text",
                confirmButton: "swal-button",
            },
        });
        formEditMahasiswa.reset();
        formEditMahasiswa.classList.remove("was-validated");
    }
});