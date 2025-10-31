const formImportMahasiswa = document.getElementById("formImportMahasiswa");
const fileInput = document.getElementById("file");

formImportMahasiswa.addEventListener("submit", function (event) {
    event.preventDefault();

    let isValid = true;
    const fileFeedback = fileInput.nextElementSibling;
    const file = fileInput.files[0];

    fileFeedback.textContent = "";
    fileInput.classList.remove("is-invalid", 'is-valid');

    if (!file) {
        fileFeedback.textContent = "Silakan pilih file untuk diunggah.";
        fileInput.classList.add("is-invalid");
        isValid = false;
    } else if (!file.name.endsWith(".xlsx")) {
        fileFeedback.textContent = "File harus berformat .xlsx!";
        fileInput.classList.add("is-invalid");
        isValid = false;
    } else if (file.size > 2 * 1024 * 1024) {
        fileFeedback.textContent = "Ukuran file maksimal 2MB!";
        fileInput.classList.add("is-invalid");
        isValid = false;
    } else {
        fileFeedback.textContent = "";
        fileInput.classList.add("is-valid");
    }

    if (isValid) {
        const modal = bootstrap.Modal.getInstance(
            document.getElementById("ImportMahasiswa")
        );
        modal.hide();

        Swal.fire({
            title: "Success!",
            text: "Data Mahasiswa berhasil diimpor!",
            icon: "success",
            customClass: {
                title: "swal-title",
                htmlContainer: "swal-text",
                confirmButton: "swal-button",
            },
        });

        formImportMahasiswa.reset();
        formImportMahasiswa.classList.remove("was-validated");
    }
});