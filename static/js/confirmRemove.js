function confirmRemove(event) {
    event.preventDefault();

    const form = event.target; // ini pasti elemen <form>

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
                title: "Success",
                text: "Data berhasil dihapus!",
                icon: "success"
            }).then(() => {

                // native submit agar tidak kena preventDefault
                HTMLFormElement.prototype.submit.call(form);
            });
        }
    });

    return false;
}
