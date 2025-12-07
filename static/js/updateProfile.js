const formUpdateProfile = document.getElementById("formUpdateProfile");
const profileInput = document.getElementById("profile");

formUpdateProfile.addEventListener("submit", function (event) {
    event.preventDefault();

    let isValid = true;
    const profileFeedback = profileInput.nextElementSibling;
    const profile = profileInput.files[0];

    profileFeedback.textContent = "";
    profileInput.classList.remove("is-invalid", "is-valid");

    // Validasi file harus dipilih
    if (!profile) {
        profileFeedback.textContent = "Silakan pilih foto profil untuk diunggah.";
        profileInput.classList.add("is-invalid");
        isValid = false;
    }
    // Validasi ekstensi file
    else {
        const allowedExtensions = ["png", "jpg", "jpeg"];
        const fileExtension = profile.name.split(".").pop().toLowerCase();

        if (!allowedExtensions.includes(fileExtension)) {
            profileFeedback.textContent = "File harus berformat .png, .jpg, atau .jpeg!";
            profileInput.classList.add("is-invalid");
            isValid = false;
        }
        else {
            profileInput.classList.add("is-valid");
        }
    }

    // Jika valid → show modal sukses
    if (isValid) {
        form = new FormData(formUpdateProfile)

        fetch('./backend/update_profile.php', {
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

                formUpdateProfile.reset();
                formUpdateProfile.classList.remove("was-validated");

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
