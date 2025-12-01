const formCreatePelanggaran = document.getElementById('formCreatePelanggaran');
const mahasiswaInputCreate = document.getElementById('mahasiswaCreate');
const jenisSuratInputCreate = document.getElementById('jenis_suratCreate');
const tanggalInputCreate = document.getElementById('tanggalCreate');
const statusInputCreate = document.getElementById('statusCreate');
const keteranganInputCreate = document.getElementById('keteranganCreate');

formCreatePelanggaran.addEventListener('submit', function (event) {
  event.preventDefault()
  formCreatePelanggaran.classList.add('was-validated')
  let isValid = true

  const mahasiswaFeedbackCreate = mahasiswaInputCreate.nextElementSibling;
  mahasiswaInputCreate.classList.remove('is-invalid')
  if (mahasiswaInputCreate.value === '') {
    mahasiswaFeedbackCreate.textContent = 'Silahkan masukkan atau pilih nama mahasiswa'
    mahasiswaInputCreate.classList.add('is-invalid')
    isValid = false
  }

  const jenisSuratFeedbackCreate = jenisSuratInputCreate.nextElementSibling;
  jenisSuratInputCreate.classList.remove('is-invalid')
  if (jenisSuratInputCreate.value === '') {
    jenisSuratFeedbackCreate.textContent = 'Silahkan pilih jenis surat'
    jenisSuratInputCreate.classList.add('is-invalid')
    isValid = false
  }
  const tanggalFeedbackCreate = tanggalInputCreate.nextElementSibling;
  tanggalInputCreate.classList.remove('is-invalid')
  if (tanggalInputCreate.value === '') {
    tanggalFeedbackCreate.textContent = 'Silahkan pilih tanggal'
    tanggalInputCreate.classList.add('is-invalid')
    isValid = false
  }

  // const statusFeedbackCreate = statusInputCreate.nextElementSibling;
  // statusInputCreate.classList.remove('is-invalid')
  // if (statusInputCreate.value === '') {
  //   statusFeedbackCreate.textContent = 'Silahkan pilih status'
  //   statusInputCreate.classList.add('is-invalid')
  //   isValid = false
  // }

  const keteranganFeedbackCreate = keteranganInputCreate.nextElementSibling;
  keteranganInputCreate.classList.remove('is-invalid')
  if (keteranganInputCreate.value === '') {
    keteranganFeedbackCreate.textContent = 'Silahkan Isi Keterangan'
    keteranganInputCreate.classList.add('is-invalid')
    isValid = false
  }

  if (isValid) {
    formData = new FormData(formCreatePelanggaran)

    fetch('./backend/pelanggaran/create.php', {
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

        formCreatePelanggaran.reset();
        formCreatePelanggaran.classList.remove("was-validated");

        Swal.fire({
          title: "success",
          text: "Data Pelanggaran berhasil dikirim!",
          icon: "success",
          customClass: {
            title: "swal-title",
            htmlContainer: "swal-text",
            confirmButton: "swal-button",
          },
        }).then(() => {
          location.reload();

          const modal = bootstrap.Modal.getInstance(
            document.getElementById("createPelanggaran")
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
})

const formEditPelanggaran = document.getElementById('formEditPelanggaran');
const mahasiswaInputEdit = document.getElementById('mahasiswaEdit');
const jenisSuratInputEdit = document.getElementById('jenis_suratEdit');
const tanggalInputEdit = document.getElementById('tanggalEdit');
const statusInputEdit = document.getElementById('statusEdit');
const keteranganInputEdit = document.getElementById('keteranganEdit');

formEditPelanggaran.addEventListener('submit', function (event) {
  event.preventDefault()
  formEditPelanggaran.classList.add('was-validated')
  let isValid = true

  const mahasiswaFeedbackEdit = mahasiswaInputEdit.nextElementSibling;
  mahasiswaInputEdit.classList.remove('is-invalid')
  if (mahasiswaInputEdit.value === '') {
    mahasiswaFeedbackEdit.textContent = 'Silahkan masukkan atau pilih nama mahasiswa'
    mahasiswaInputEdit.classList.add('is-invalid')
    isValid = false
  }

  const jenisSuratFeedbackEdit = jenisSuratInputEdit.nextElementSibling;
  jenisSuratInputEdit.classList.remove('is-invalid')
  if (jenisSuratInputEdit.value === '') {
    jenisSuratFeedbackEdit.textContent = 'Silahkan pilih jenis surat'
    jenisSuratInputEdit.classList.add('is-invalid')
    isValid = false
  }
  const tanggalFeedbackEdit = tanggalInputEdit.nextElementSibling;
  tanggalInputEdit.classList.remove('is-invalid')
  if (tanggalInputEdit.value === '') {
    tanggalFeedbackEdit.textContent = 'Silahkan pilih tanggal'
    tanggalInputEdit.classList.add('is-invalid')
    isValid = false
  }

  const statusFeedbackEdit = statusInputEdit.nextElementSibling;
  statusInputEdit.classList.remove('is-invalid')
  if (statusInputEdit.value === '') {
    statusFeedbackEdit.textContent = 'Silahkan pilih status'
    statusInputEdit.classList.add('is-invalid')
    isValid = false
  }

  const keteranganFeedbackEdit = keteranganInputEdit.nextElementSibling;
  keteranganInputEdit.classList.remove('is-invalid')
  if (keteranganInputEdit.value === '') {
    keteranganFeedbackEdit.textContent = 'Silahkan Isi Keterangan'
    keteranganInputEdit.classList.add('is-invalid')
    isValid = false
  }

  if (isValid) {
    const modal = bootstrap.Modal.getInstance(
      document.getElementById("EditPelanggaran")
    );
    modal.hide();

    alert("Data pelanggaran berhasil dikirim!");
    formEditPelanggaran.reset();
    formEditPelanggaran.classList.remove("was-validated");
  }
})