function confirmLogout(event, form) {
    event.preventDefault(); // cegah submit otomatis

    Swal.fire({
        title: 'Yakin ingin logout?',
        text: 'Jika logout maka anda harus login kembali.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Logout!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "success",
                text: "Anda berhasil logout!",
                icon: "success",
                customClass: {
                    title: "swal-title",
                    htmlContainer: "swal-text",
                    confirmButton: "swal-button",
                },
            }).then((result) => {
                form.submit();
            })
        }
    });

    return false; // pastikan form nggak submit sebelum konfirmasi
}