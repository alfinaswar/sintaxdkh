<!-- Modal Preventif Maintenance -->
<div class="modal fade" id="exampleModalCenter" aria-labelledby="preventiveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-3">
            <div class="modal-header">
                <h5 class="modal-title" id="preventiveModalLabel">Preventif Maintenance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="preventiveForm" enctype="multipart/form-data" method="POST" action="{{ route('pm.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="itemID" class="form-label">Nama Item</label>
                                <input type="text" class="form-control" value="{{ $data->getItem->Nama }}" readonly>
                                <input type="text" class="form-control" id="itemID" name="ItemID"
                                    placeholder="Masukkan Item ID" value="{{ $data->ItemID }}" hidden>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="Status">
                                    <option value="">Pilih Status</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Kurang Baik">Kurang Baik</option>
                                    <option value="Rusak">Rusak</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="dikerjakanOleh" class="form-label">Dikerjakan Oleh</label>
                                <input type="text" class="form-control" id="dikerjakanOleh" name="DikerjakanOleh"
                                    placeholder="Masukkan nama yang mengerjakan" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="diselesaikanTanggal" class="form-label">Diselesaikan Tanggal</label>
                                <input type="date" class="form-control" id="diselesaikanTanggal"
                                    name="DiselesaikanTanggal" value="{{ date('Y-m-d') }}" readonly>
                            </div>



                            <div class="mb-3">
                                <label for="before" class="form-label">Before</label>
                                <input type="file" class="form-control" id="before" name="Before"
                                    placeholder="Masukkan kondisi sebelum">
                            </div>

                            <div class="mb-3">
                                <label for="after" class="form-label">After</label>
                                <input type="file" class="form-control" id="after" name="After"
                                    placeholder="Masukkan kondisi setelah">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan"
                                placeholder="Masukkan keterangan"></textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>