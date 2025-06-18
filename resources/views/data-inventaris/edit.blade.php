@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Data Inventaris</h4>
        </div>
        <div class="card-body">
            <div class="basic-form">
                <form action="{{ route('data-inventaris.update', encrypt($dataInventaris->id)) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="ItemID" class="form-label">Item</label>
                            <select class="single-select-placeholder js-states @error('ItemID') is-invalid @enderror"
                                id="single-select" name="ItemID">
                                <option value="">Pilih Item</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}" {{ old('ItemID', $dataInventaris->ItemID) == $item->id ? 'selected' : '' }}>
                                        {{ $item->Nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ItemID')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="SerialNumber" class="form-label">Serial Number</label>
                            <input type="text" class="form-control @error('SerialNumber') is-invalid @enderror"
                                id="SerialNumber" name="SerialNumber"
                                value="{{ old('SerialNumber', $dataInventaris->SerialNumber) }}"
                                placeholder="Masukkan serial number">
                            @error('SerialNumber')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="Merk" class="form-label">Merk</label>
                            <select class="single-select-placeholder js-states @error('Merk') is-invalid @enderror"
                                id="Merk" name="Merk">
                                <option value="">Pilih Merk</option>
                                @foreach($merks as $merk)
                                    <option value="{{ $merk->id }}" {{ old('Merk', $dataInventaris->Merk) == $merk->id ? 'selected' : '' }}>
                                        {{ $merk->Merk }}
                                    </option>
                                @endforeach
                            </select>
                            @error('Merk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="Tipe" class="form-label">Tipe</label>
                            <input type="text" class="form-control @error('Tipe') is-invalid @enderror" id="Tipe"
                                name="Tipe" value="{{ old('Tipe', $dataInventaris->Tipe) }}" placeholder="Masukkan tipe">
                            @error('Tipe')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="TanggalBeli" class="form-label">Tanggal Beli</label>
                            <input type="date" class="form-control @error('TanggalBeli') is-invalid @enderror"
                                id="TanggalBeli" name="TanggalBeli"
                                value="{{ old('TanggalBeli', $dataInventaris->TanggalBeli) }}">
                            @error('TanggalBeli')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3 col-md-3">
                            <label for="Departemen" class="form-label">Departemen</label>
                            <select class="single-select-placeholder js-states @error('Departemen') is-invalid @enderror"
                                id="Departemen" name="Departemen"
                                data-url="{{ route('master-dept.get-item-by-departemen') }}">
                                <option value="">Pilih Departemen</option>
                                @foreach($departemens as $dept)
                                    <option value="{{ $dept->id }}" {{ old('Departemen', $dataInventaris->Departemen) == $dept->id ? 'selected' : '' }}>
                                        {{ $dept->NamaDepartemen }}
                                    </option>
                                @endforeach
                            </select>
                            @error('Departemen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-3">
                            <label for="Unit" class="form-label">Unit</label>
                            <select class="single-select-placeholder js-states @error('Unit') is-invalid @enderror"
                                id="Unit" name="Unit">
                                <option value="">Pilih Unit</option>
                                @if($dataInventaris->Unit)
                                    <option value="{{ $dataInventaris->Unit }}" {{ old('Unit', $dataInventaris->Unit) == $dataInventaris->Unit ? 'selected' : '' }}>
                                        {{ $dataInventaris->getUnit->NamaUnit }}
                                    </option>
                                @endif
                            </select>
                            @error('Unit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3 col-md-6">
                            <label for="ManualBook" class="form-label">Manual Book</label>
                            <input type="file" class="form-control @error('ManualBook') is-invalid @enderror"
                                id="ManualBook" name="ManualBook" placeholder="Pilih file manual book">
                            @if($dataInventaris->ManualBook)
                                <p class="mt-2">File saat ini: {{ $dataInventaris->ManualBook }}</p>
                            @endif
                            @error('ManualBook')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="Klasifikasi" class="form-label">Kategori Risiko</label>
                            <select class="single-select-placeholder js-states @error('Klasifikasi') is-invalid @enderror"
                                id="Klasifikasi" name="Klasifikasi">
                                <option value="">Pilih Kategori Risiko</option>
                                <option value="" {{ old('Klasifikasi', $dataInventaris->Klasifikasi) == '' ? 'selected' : '' }}>None</option>
                                <option value="HIGH-RISK" {{ old('Klasifikasi', $dataInventaris->Klasifikasi) == 'HIGH-RISK' ? 'selected' : '' }}>High Risk</option>
                                <option value="MEDIUM-RISK" {{ old('Klasifikasi', $dataInventaris->Klasifikasi) == 'MEDIUM-RISK' ? 'selected' : '' }}>Medium Risk</option>
                                <option value="LOW-TO-MEDIUM-RISK" {{ old('Klasifikasi', $dataInventaris->Klasifikasi) == 'LOW-TO-MEDIUM-RISK' ? 'selected' : '' }}>Low to Medium
                                    Risk</option>
                                <option value="LOW-RISK" {{ old('Klasifikasi', $dataInventaris->Klasifikasi) == 'LOW-RISK' ? 'selected' : '' }}>Low Risk</option>
                            </select>
                            @error('Klasifikasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="Keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control @error('Keterangan') is-invalid @enderror" id="Keterangan"
                                name="Keterangan" rows="3"
                                placeholder="Masukkan keterangan">{{ old('Keterangan', $dataInventaris->Keterangan) }}</textarea>
                            @error('Keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="Gambar" class="form-label">Gambar</label>
                            <input type="file" class="form-control @error('Gambar') is-invalid @enderror" id="Gambar"
                                name="Gambar" placeholder="Pilih file gambar" accept="image/*"
                                onchange="previewImage(this)">
                            @if($dataInventaris->Gambar)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/gambar-inventaris/' . $dataInventaris->Gambar) }}"
                                        alt="Current Image" style="max-width: 300px;">
                                </div>
                            @endif
                            @error('Gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-2">
                                <img id="preview" src="#" alt="Preview" style="max-width: 300px; display: none;">
                            </div>
                        </div>


                    </div>

                    <div class="d-flex mt-4">
                        <a href="{{ route('data-inventaris.index') }}" class="btn btn-secondary me-2">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#Departemen').on('change', function () {
                let departemenId = $(this).val();
                let url = $(this).data('url');

                $('#Unit').empty().append('<option value="">Loading...</option>');

                if (departemenId) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        data: { departemen_id: departemenId },
                        success: function (response) {
                            $('#Unit').empty().append('<option value="">Pilih Unit</option>');
                            $.each(response, function (key, unit) {
                                $('#Unit').append(`<option value="${unit.id}">${unit.NamaUnit}</option>`);
                            });
                        },
                        error: function () {
                            $('#Unit').empty().append('<option value="">Gagal mengambil data</option>');
                        }
                    });
                } else {
                    $('#Unit').empty().append('<option value="">Pilih Unit</option>');
                }
            });

            //Function
            previewImage();
        });
        function previewImage(input) {
            const preview = document.getElementById('preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.style.display = 'none';
            }
        }
    </script>
@endpush