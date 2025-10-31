const formCreateSurat = document.getElementById('formCreateSurat');
const SuratInputCreate = document.getElementById('nama');

formCreateSurat.addEventListener('submit', function (event) {
    event.preventDefault();
    formCreateSurat.classList.add('was-validated');
    let isValid = true;

    const SuratFeedbackCreate = SuratInputCreate.nextElementSibling;
    SuratInputCreate.classList.remove('is-invalid', 'is-valid');

    if (SuratInputCreate.value === '') {
        SuratFeedbackCreate.textContent = 'Silahkan masukkan nama Surat';
        SuratInputCreate.classList.add('is-invalid');
        isValid = false;
    } else {
        SuratFeedbackCreate.textContent = 'Silahkan masukkan nama Surat';
        SuratInputCreate.classList.add('is-valid');
    }

    if (isValid) {
        const modal = bootstrap.Modal.getInstance(
            document.getElementById("createSurat")
        );
        modal.hide();

        Swal.fire({
            title: "success",
            text: "Data Surat berhasil dikirim!",
            icon: "success",
            customClass: {
                title: "swal-title",
                htmlContainer: "swal-text",
                confirmButton: "swal-button",
            },
        });
        formCreateSurat.reset();
        formCreateSurat.classList.remove("was-validated");
    }
});