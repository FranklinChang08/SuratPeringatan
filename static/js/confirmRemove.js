function confirmRemove(event, form) {
    event.preventDefault(); // cegah submit otomatis

    Swal.fire({
        title: 'Yakin ingin hapus ini?',
        text: 'Data yang dihapus tidak dapat dikembalikan.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "success",
                text: "Data berhasil dihapus!",
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