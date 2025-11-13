<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modal Form Validation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Tombol untuk buka modal -->
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal">
        Buka Form
    </button>

    <!-- Modal -->
    <div class="modal fade" id="formModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="userForm" class="modal-content needs-validation" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title">Form Validasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" required>
                        <div class="invalid-feedback">Nama wajib diisi.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                        <div class="invalid-feedback">Masukkan email yang valid.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Kirim</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('userForm').addEventListener('submit', function(e) {
            e.preventDefault(); // cegah form reload halaman

            // cek validasi form bootstrap
            if (!this.checkValidity()) {
                e.stopPropagation();
                this.classList.add('was-validated'); // tampilkan pesan error
            } else {
                // kalau valid, baru boleh tutup modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('formModal'));
                modal.hide();

                alert('Form berhasil dikirim!');
            }
        });
    </script>

</body>

</html>