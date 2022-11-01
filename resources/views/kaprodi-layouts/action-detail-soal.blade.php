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
                    <h5 class="modal-title" id="editModalLabel">{{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label class="form-label">Soal</label>
                            <textarea name="soal" id="" cols="40" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jawaban 1</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jawaban 2</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jawaban 3</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jawaban 4</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jawaban</label>
                            <select class="form-control">
                                <option value="">Pilih Jawaban</option>
                                <option value="">Jawaban 1</option>
                                <option value="">Jawaban 2</option>
                                <option value="">Jawaban 3</option>
                                <option value="">Jawaban 4</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="b-update">Update</button>
                </div>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-danger btn-sm ml-4"><i class="fas fa-trash"></i></button>
</td>