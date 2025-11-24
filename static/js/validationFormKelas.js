function createKelas() {
    const form = document.getElementById("FormCreateKelas");

    // Jalankan validasi bootstrap
    if (!form.checkValidity()) {
        form.classList.add("was-validated");

        return;
    }

    // Ambil semua data dari form
    const formData = new FormData(form);

    Swal.fire({
        title: "Menyimpan data...",
        text: "Mohon tunggu",
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });

    fetch("./backend/kelas/create.php", {
        method: "POST",
        body: formData
    })
        .then(response => response.text()) // bisa response.json() jika PHP return json
        .then(result => {
            Swal.close();


            // Reset form setelah sukses
            form.reset();
            form.classList.remove("was-validated");

            // Reload table atau halaman jika diperlukan
            Swal.fire({
                icon: "success",
                title: "Berhasil!",
                text: "Data kelas berhasil ditambahkan."
            }).then(() => {
                location.reload();

                const modal = bootstrap.Modal.getInstance(
                    document.getElementById("createKelas")
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


function editKelas() {
    const form = document.getElementById("FormEditKelas");

    // Jalankan validasi bootstrap
    if (!form.checkValidity()) {
        form.classList.add("was-validated");

        return;
    }

    // Ambil semua data dari form
    const formData = new FormData(form);

    Swal.fire({
        title: "Menyimpan data...",
        text: "Mohon tunggu",
        allowOutsideClick: false,
        didOpen: () => Swal.showLoading()
    });

    fetch("./backend/kelas/update.php", {
        method: "POST",
        body: formData
    })
        .then(response => response.text()) // bisa response.json() jika PHP return json
        .then(result => {
            Swal.close();

            // Reset form setelah sukses
            form.reset();
            form.classList.remove("was-validated");

            // Reload table atau halaman jika diperlukan
            Swal.fire({
                icon: "success",
                title: "Berhasil!",
                text: "Data kelas berhasil ditambahkan."
            }).then(() => {
                location.reload();
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

