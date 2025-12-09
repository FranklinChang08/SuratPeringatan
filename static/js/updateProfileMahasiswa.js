
const formUpdateProfileMahasiswa = document.getElementById("formUpdateProfileMahasiswa");
const profileInputMahasiswa = document.getElementById("profile");

formUpdateProfileMahasiswa.addEventListener("submit", function (event) {
    event.preventDefault();

    let isValid = true;
    const profileFeedbackMahasiswa = profileInputMahasiswa.nextElementSibling;
    const profileMahasiswa = profileInputMahasiswa.files[0];

    profileFeedbackMahasiswa.textContent = "";
    profileInputMahasiswa.classList.remove("is-invalid", "is-valid");

    // Validasi file harus dipilih
    if (!profileMahasiswa) {
        profileFeedbackMahasiswa.textContent = "Silakan pilih foto profil untuk diunggah.";
        profileInputMahasiswa.classList.add("is-invalid");
        isValid = false;
    }
    // Validasi ekstensi file
    else {
        const allowedExtensions = ["png", "jpg", "jpeg"];
        const fileExtension = profileMahasiswa.name.split(".").pop().toLowerCase();

        if (!allowedExtensions.includes(fileExtension)) {
            profileFeedbackMahasiswa.textContent = "File harus berformat .png, .jpg, atau .jpeg!";
            profileInputMahasiswa.classList.add("is-invalid");
            isValid = false;
        }
        else {
            profileInputMahasiswa.classList.add("is-valid");
            profileFeedbackMahasiswa.textContent = "";
        }
    }

    // Jika valid → show modal sukses
    if (isValid) {
        form = new FormData(formUpdateProfileMahasiswa)

        fetch('./staff/backend/update_profile.php', {
            method: 'POST',
            body: form
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

                formUpdateProfileMahasiswa.reset();
                formUpdateProfileMahasiswa.classList.remove("was-validated");

                Swal.fire({
                    title: "success",
                    text: "Profile Staff berhasil diperbaharui!",
                    icon: "success",
                    customClass: {
                        title: "swal-title",
                        htmlContainer: "swal-text",
                        confirmButton: "swal-button",
                    },
                }).then(() => {
                    window.location.reload()
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
