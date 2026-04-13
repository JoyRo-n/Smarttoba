<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin SMARTTOBA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Admin Kelola Room</h3>
            <button class="btn btn-primary" onclick="bukaModalTambah()">+ Tambah Room</button>
        </div>

        @if(session('success'))
            <div class="alert alert-success" id="notif">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered bg-white">
            <thead class="table-dark">
                <tr><th>#</th><th>Nama</th><th>Lokasi</th><th>Harga</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($rooms as $i => $room)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $room->name }}</td>
                    <td>{{ $room->location }}</td>
                    <td>Rp {{ number_format($room->price) }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="bukaModalEdit({{ $room->id }}, '{{ $room->name }}', '{{ $room->location }}', {{ $room->price }})">
                            Edit
                        </button>
                        <form method="POST" action="{{ route('admin.destroy', $room) }}" style="display: inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus {{ $room->name }}?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="modalRoom" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="judulModal">Form Room</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formRoom" method="POST">
                    @csrf
                    <div id="metodePut"></div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama Room</label>
                            <input type="text" name="name" id="fNama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Lokasi</label>
                            <input type="text" name="location" id="fLokasi" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Harga (Rp)</label>
                            <input type="number" name="price" id="fHarga" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const modal = new bootstrap.Modal(document.getElementById('modalRoom'));

        // Buka modal untuk TAMBAH
        function bukaModalTambah() {
            document.getElementById('judulModal').textContent = 'Tambah Room';
            document.getElementById('formRoom').action = '{{ route("admin.store") }}';
            document.getElementById('metodePut').innerHTML = '';
            document.getElementById('fNama').value = '';
            document.getElementById('fLokasi').value = '';
            document.getElementById('fHarga').value = '';
            modal.show();
        }

        // Buka modal untuk EDIT (isi data dari tombol Edit)
        function bukaModalEdit(id, nama, lokasi, harga) {
            document.getElementById('judulModal').textContent = 'Edit Room';
            document.getElementById('formRoom').action = '/admin/' + id;
            document.getElementById('metodePut').innerHTML = '<input type="hidden" name="_method" value="PUT">';
            document.getElementById('fNama').value = nama;
            document.getElementById('fLokasi').value = lokasi;
            document.getElementById('fHarga').value = harga;
            modal.show();
        }

        // Auto-sembunyikan notifikasi setelah 3 detik
        window.onload = function() {
            var n = document.getElementById('notif');
            if (n) setTimeout(() => n.remove(), 3000);
        };
    </script>
</body>
</html>