<!-- Modal Kalibrasi -->
<div class="modal fade" id="modalKalibrasi" aria-labelledby="kalibrasiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-3">
            <div class="modal-header">
                <h5 class="modal-title" id="kalibrasiModalLabel">Dokumen Kalibrasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <form id="kalibrasiForm" enctype="multipart/form-data" method="POST"
                    action="{{ route('kalibrasi.store') }}">
                    @csrf
                    <div class="row">
                        <div class="mb-3">
                            <label for="itemID" class="form-label">Nama Item</label>
                            <input type="text" class="form-control" value="{{ $data->getItem->Nama }}" readonly>
                            <input type="text" class="form-control" id="itemID" name="ItemID"
                                value="{{ $data->ItemID }}" hidden>
                        </div>
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="namaDokumen" class="form-label">Nama Dokumen</label>
                                <input type="text" class="form-control" id="namaDokumen" name="NamaDokumen"
                                    placeholder="Masukkan nama dokumen" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggalBerlaku" class="form-label">Tanggal Berlaku</label>
                                <input type="date" class="form-control" id="tanggalBerlaku" name="TanggalBerlaku"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggalBerakhir" class="form-label">Tanggal Berakhir</label>
                                <input type="date" class="form-control" id="tanggalBerakhir" name="TanggalBerakhir"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="dokumen" class="form-label">Dokumen</label>
                                <input type="file" class="form-control" id="dokumen" name="Dokumen"
                                    accept=".pdf,.jpg,.jpeg,.png" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="Keterangan"
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