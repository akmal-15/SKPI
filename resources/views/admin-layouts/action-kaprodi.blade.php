<td>
    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal">
        <i class="fas fa-pencil-alt"></i>
    </button>

    {{-- modal --}}
    <div class="modal fade " id="editModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Ubah Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label class="form-label">Kode Dosen</label>
                            <input type="number" class="form-control" name="tnim">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Dosen</label>
                            <input type="text" class="form-control">
                        </div>
                        
                        <label for="prodi">Prodi</label>
                        <select name="prodi" id="prodi" class="form-control">
                            <option value="pilih prodi">Pilih Prodi</option>
                            <option value="ti">Teknik Informatika</option>
                            <option value="si">Sistem Informasi</option>
                            <option value="sk">Sistem Komputer</option>
                        </select>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="b-update">Update</button>
                </div>
            </div>
        </div>
    </div>
</td>
<td><button type="button" class="btn btn-danger btn-sm ml-2"><i class="fas fa-trash"></i></button></td>