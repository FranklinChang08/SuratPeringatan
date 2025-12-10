const formCreate = document.getElementById("FormCreateKelas");

formCreate.addEventListener("submit", function (event) {
    event.preventDefault();
    formCreate.classList.add("was-validated");
    let isValid = true;

    const prodi = document.getElementById("programstudi");
    const semester = document.getElementById("semester");
    const namaKelas = document.getElementById("kelas");
    const jadwal = document.getElementById("jadwal");
    const waliDosen = document.getElementById("walidosen");

    const prodiFeedback = prodi.nextElementSibling;
    prodiFeedback.textContent = "";
    prodi.classList.remove("is-invalid");

    if (prodi.value === "") {
        prodiFeedback.textContent = "Silakan pilih program studi.";
        prodi.classList.add("is-invalid");
        isValid = false;
    }

    const semesterFeedback = semester.nextElementSibling;
    semesterFeedback.textContent = "";
    semester.classList.remove("is-invalid");

    if (semester.value === "") {
        semesterFeedback.textContent = "Silakan masukkan semester.";
        semester.classList.add("is-invalid");
        isValid = false;
    }

    const namaKelasFeedback = namaKelas.nextElementSibling;
    namaKelasFeedback.textContent = "";
    namaKelas.classList.remove("is-invalid");

    if (namaKelas.value === "") {
        namaKelasFeedback.textContent = "Silakan masukkan nama kelas.";
        namaKelas.classList.add("is-invalid");
        isValid = false;
    }

    const jadwalFeedback = jadwal.nextElementSibling;
    jadwalFeedback.textContent = "";
    jadwal.classList.remove("is-invalid");

    if (jadwal.value === "") {
        jadwalFeedback.textContent = "Silakan masukkan jadwal.";
        jadwal.classList.add("is-invalid");
        isValid = false;
    }

    const waliDosenFeedback = waliDosen.nextElementSibling;
    waliDosenFeedback.textContent = "";
    waliDosen.classList.remove("is-invalid");

    if (waliDosen.value === "") {
        waliDosenFeedback.textContent = "Silakan masukkan nama wali dosen.";
        waliDosen.classList.add("is-invalid");
        isValid = false;
    }


    if (isValid) {
        // Kirim data jika valid
        const formData = new FormData(formCreate);

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
            .then(res => res.json())
            .then(result => {
                Swal.close();

                if (result.status === "error") {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal!",
                        text: result.message,
                    });
                    return;
                }

                Swal.fire({
                    icon: "success",
                    title: "Berhasil!",
                    text: "Data kelas berhasil ditambahkan."
                }).then(() => location.reload());
            })
            .catch(err => {
                Swal.close();
                Swal.fire({
                    icon: "error",
                    title: "Gagal!",
                    text: "Terjadi kesalahan dalam mengirim data."
                });
                console.log(err);
            });
    }
});

const formUpdate = document.getElementById("FormUpdateKelas");

formUpdate.addEventListener("submit", function (event) {
    event.preventDefault();
    formUpdate.classList.add("was-validated");
    let isValid = true;

    const prodi = document.getElementById("editprogramstudi");
    const semester = document.getElementById("editsemester");
    const namaKelas = document.getElementById("editkelas");
    const jadwal = document.getElementById("editjadwal");
    const waliDosen = document.getElementById("editwalidosen");

    const prodiFeedback = prodi.nextElementSibling;
    prodiFeedback.textContent = "";
    prodi.classList.remove("is-invalid");

    if (prodi.value === "") {
        prodiFeedback.textContent = "Silakan pilih program studi.";
        prodi.classList.add("is-invalid");
        isValid = false;
    }

    const semesterFeedback = semester.nextElementSibling;
    semesterFeedback.textContent = "";
    semester.classList.remove("is-invalid");

    if (semester.value === "") {
        semesterFeedback.textContent = "Silakan masukkan semester.";
        semester.classList.add("is-invalid");
        isValid = false;
    }

    const namaKelasFeedback = namaKelas.nextElementSibling;
    namaKelasFeedback.textContent = "";
    namaKelas.classList.remove("is-invalid");

    if (namaKelas.value === "") {
        namaKelasFeedback.textContent = "Silakan masukkan nama kelas.";
        namaKelas.classList.add("is-invalid");
        isValid = false;
    }

    const jadwalFeedback = jadwal.nextElementSibling;
    jadwalFeedback.textContent = "";
    jadwal.classList.remove("is-invalid");

    if (jadwal.value === "") {
        jadwalFeedback.textContent = "Silakan masukkan jadwal.";
        jadwal.classList.add("is-invalid");
        isValid = false;
    }

    const waliDosenFeedback = waliDosen.nextElementSibling;
    waliDosenFeedback.textContent = "";
    waliDosen.classList.remove("is-invalid");

    if (waliDosen.value === "") {
        waliDosenFeedback.textContent = "Silakan masukkan nama wali dosen.";
        waliDosen.classList.add("is-invalid");
        isValid = false;
    }


    if (isValid) {
        // Kirim data jika valid
        const formData = new FormData(formUpdate);

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
            .then(res => res.json())
            .then(result => {
                Swal.close();

                if (result.status === "error") {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal!",
                        text: result.message,
                    });
                    return;
                }

                Swal.fire({
                    icon: "success",
                    title: "Berhasil!",
                    text: "Data kelas berhasil diperbaharui."
                }).then(() => location.reload());
            })
            .catch(err => {
                Swal.close();
                Swal.fire({
                    icon: "error",
                    title: "Gagal!",
                    text: "Terjadi kesalahan dalam mengirim data."
                });
                console.log(err);
            });
    }
});
