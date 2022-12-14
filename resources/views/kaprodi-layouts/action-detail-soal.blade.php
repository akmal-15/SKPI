<td class="d-flex">
    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{ $v['soal_id'] }}">
        <i class="fas fa-pencil-alt"></i>
    </button>

    {{-- modal --}}
    <div class="modal fade " id="editModal{{ $v['soal_id'] }}" data-backdrop="static" data-keyboard="false" tabindex="-1"
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
                    <form method="POST" action="/kaprodi/update-soal">
                        @csrf
                        <input type="hidden" name="id" value="{{ $v['soal_id'] }}">
                        <div class="mb-3">
                            <label class="form-label">Soal</label>
                            <input type="text" name="soal" class="form-control" value="{{ $v['soal'] }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jawaban A</label>
                            <input type="text" class="form-control" name="jawabanA" value="{{ $v['jawaban_1'] }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jawaban B</label>
                            <input type="text" class="form-control" name="jawabanB" value="{{ $v['jawaban_2'] }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jawaban C</label>
                            <input type="text" class="form-control" name="jawabanC" value="{{ $v['jawaban_3'] }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jawaban D</label>
                            <input type="text" class="form-control" name="jawabanD" value="{{ $v['jawaban_4'] }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jawaban</label>
                            <select class="form-control" name="jawaban">
                                <option value="">Pilih Jawaban</option>
                                <option value="A" <?= $v['jawaban'] == 'A' ? 'selected' : ''?>>Jawaban A</option>
                                <option value="B" <?= $v['jawaban'] == 'B' ? 'selected' : ''?>>Jawaban B</option>
                                <option value="C" <?= $v['jawaban'] == 'C' ? 'selected' : ''?>>Jawaban C</option>
                                <option value="D" <?= $v['jawaban'] == 'D' ? 'selected' : ''?>>Jawaban D</option>
                            </select>
													</div>
													<button type="submit" class="btn btn-primary" name="b-update">Update</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <form action="/kaprodi/hapus-soal" method="post">
        @csrf()
        <input type="hidden" name="id" value="{{ $v['soal_id'] }}">
        <button type="submit" class="btn btn-danger btn-sm ml-4"><i class="fas fa-trash"></i></button>
    </form>
</td>