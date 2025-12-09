const formImportMahasiswa = document.getElementById("formImportMahasiswa");
const fileInput = document.getElementById("file");

formImportMahasiswa.addEventListener("submit", function (event) {
  event.preventDefault();

  let isValid = true;
  const fileFeedback = fileInput.nextElementSibling;
  const file = fileInput.files[0];

  fileFeedback.textContent = "";
  fileInput.classList.remove("is-invalid", "is-valid");

  if (!file) {
    fileFeedback.textContent = "Silakan pilih file untuk diunggah.";
    fileInput.classList.add("is-invalid");
    isValid = false;
  } else if (!file.name.endsWith(".xlsx")) {
    fileFeedback.textContent = "File harus berformat .xlsx!";
    fileInput.classList.add("is-invalid");
    isValid = false;
  } else {
    fileFeedback.textContent = "";
    fileInput.classList.add("is-valid");
  }



  if (isValid) {
    // Ambil semua data dari form
    const formData = new FormData(formImportMahasiswa);

    Swal.fire({
      title: "Menyimpan data...",
      text: "Mohon tunggu",
      allowOutsideClick: false,
      didOpen: () => Swal.showLoading(),
    });

    fetch("./backend/mahasiswa/import.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json()) // bisa response.json() jika PHP return json
      .then((result) => {
        Swal.close();

        if (result.status === "error") {
          Swal.fire({
            icon: "error",
            title: "Gagal!",
            text: result.message
          })
          return; // stop agar tidak lanjut ke success
        }

        // Reset form setelah sukses
        formImportMahasiswa.reset();
        formImportMahasiswa.classList.remove("was-validated");

        // Reload table atau halaman jika diperlukan
        Swal.fire({
          icon: "success",
          title: "Berhasil!",
          text: "Data Mahasiswa berhasil ditambahkan.",
        }).then(() => {
          location.reload();

          const modal = bootstrap.Modal.getInstance(
            document.getElementById("ImportMahasiswa")
          );
          modal.hide();
        });
      })
      .catch((error) => {
        Swal.close();

        Swal.fire({
          icon: "error",
          title: "Gagal!",
          text: "Terjadi kesalahan dalam mengirim data.",
        });

        console.log(error);
      });
  }
});
