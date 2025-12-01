const formCreateMahasiswa = document.getElementById("FormCreateMahasiswa");
const namaInputCreate = document.getElementById("namaCreate");
const nimInputCreate = document.getElementById("nimCreate");
const emailInputCreate = document.getElementById("emailCreate");
const prodiInputCreate = document.getElementById("prodiCreate");
const kelasInputCreate = document.getElementById("kelasCreate");
const keteranganInputCreate = document.getElementById("keteranganCreate");

formCreateMahasiswa.addEventListener("submit", function (event) {
  event.preventDefault();
  formCreateMahasiswa.classList.add("was-validated");
  let isValid = true;

  const namaFeedbackCreate = namaInputCreate.nextElementSibling;
  namaFeedbackCreate.textContent = "";
  namaInputCreate.classList.remove("is-invalid");

  if (namaInputCreate.value === "") {
    namaFeedbackCreate.textContent = "Silakan masukkan nama.";
    namaInputCreate.classList.add("is-invalid");
    isValid = false;
  }

  const emailFeedbackCreate = emailInputCreate.nextElementSibling;
  emailInputCreate.classList.remove("is-invalid");
  if (emailInputCreate.value === "" || !emailInputCreate.value.includes("@")) {
    emailFeedbackCreate.textContent = "Silakan masukkan email yang valid.";
    emailInputCreate.classList.add("is-invalid");
    isValid = false;
  }

  const nimFeedbackCreate = nimInputCreate.nextElementSibling;
  nimInputCreate.classList.remove("is-invalid");
  if (nimInputCreate.value === "") {
    nimFeedbackCreate.textContent = "Silakan masukkan nim.";
    nimInputCreate.classList.add("is-invalid");
    isValid = false;
  }

  const prodiFeedbackCreate = prodiInputCreate.nextElementSibling;
  prodiInputCreate.classList.remove("is-invalid");
  if (prodiInputCreate.value === "") {
    prodiFeedbackCreate.textContent = "Silakan pilih program studi terlebih dahulu";
    prodiInputCreate.classList.add("is-invalid");
    isValid = false;
  }

  const kelasFeedbackCreate = kelasInputCreate.nextElementSibling;
  kelasInputCreate.classList.remove("is-invalid");
  if (kelasInputCreate.value === "") {
    kelasFeedbackCreate.textContent = "Silakan masukkan kelas.";
    kelasInputCreate.classList.add("is-invalid");
    isValid = false;
  }

  if (isValid) {
    formData = new FormData(formCreateMahasiswa)

    fetch('./backend/mahasiswa/create.php', {
      method: 'POST',
      body: formData
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

        formCreateMahasiswa.reset();
        formCreateMahasiswa.classList.remove("was-validated");

        Swal.fire({
          title: "success",
          text: "Data Mahasiswa berhasil dikirim!",
          icon: "success",
          customClass: {
            title: "swal-title",
            htmlContainer: "swal-text",
            confirmButton: "swal-button",
          },
        }).then(() => {
          location.reload();

          const modal = bootstrap.Modal.getInstance(
            document.getElementById("createMahasiswa")
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

const formEditMahasiswa = document.getElementById("FormEditMahasiswa");
const namaInputEdit = document.getElementById("namaEdit");
const nimInputEdit = document.getElementById("nimEdit");
const emailInputEdit = document.getElementById("emailEdit");
const prodiInputEdit = document.getElementById("prodiEdit");
const kelasInputEdit = document.getElementById("kelasEdit");

formEditMahasiswa.addEventListener("submit", function (event) {
  event.preventDefault();
  formEditMahasiswa.classList.add("was-validated");
  let isValid = true;

  const namaFeedbackEdit = namaInputEdit.nextElementSibling;
  namaFeedbackEdit.textContent = "";
  namaInputEdit.classList.remove("is-invalid");

  if (namaInputEdit.value === "") {
    namaFeedbackEdit.textContent = "Silakan masukkan nama.";
    namaInputEdit.classList.add("is-invalid");
    isValid = false;
  }

  const emailFeedbackEdit = emailInputEdit.nextElementSibling;
  emailInputEdit.classList.remove("is-invalid");
  if (emailInputEdit.value === "" || !emailInputEdit.value.includes("@")) {
    emailFeedbackEdit.textContent = "Silakan masukkan email yang valid.";
    emailInputEdit.classList.add("is-invalid");
    isValid = false;
  }

  const nimFeedbackEdit = nimInputEdit.nextElementSibling;
  nimInputEdit.classList.remove("is-invalid");
  if (nimInputEdit.value === "") {
    nimFeedbackEdit.textContent = "Silakan masukkan nim.";
    nimInputEdit.classList.add("is-invalid");
    isValid = false;
  }

  const prodiFeedbackEdit = prodiInputEdit.nextElementSibling;
  prodiInputEdit.classList.remove("is-invalid");
  if (prodiInputEdit.value === "") {
    prodiFeedbackEdit.textContent = "Silakan pilih program studi terlebih dahulu";
    prodiInputEdit.classList.add("is-invalid");
    isValid = false;
  }

  const kelasFeedbackEdit = kelasInputEdit.nextElementSibling;
  kelasInputEdit.classList.remove("is-invalid");
  if (kelasInputEdit.value === "") {
    kelasFeedbackEdit.textContent = "Silakan masukkan kelas.";
    kelasInputEdit.classList.add("is-invalid");
    isValid = false;
  }

  if (isValid) {
    formDataEdit = new FormData(formEditMahasiswa)

    fetch('./backend/mahasiswa/update.php', {
      method: 'POST',
      body: formDataEdit
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

        formEditMahasiswa.reset();
        formEditMahasiswa.classList.remove("was-validated");

        Swal.fire({
          title: "success",
          text: "Data Mahasiswa berhasil diupdate!",
          icon: "success",
          customClass: {
            title: "swal-title",
            htmlContainer: "swal-text",
            confirmButton: "swal-button",
          },
        }).then(() => {
          location.reload();

          const modal = bootstrap.Modal.getInstance(
            document.getElementById("editMahasiswa")
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
