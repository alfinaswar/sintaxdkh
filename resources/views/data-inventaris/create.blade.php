@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Buat Data Inventaris Baru</h4>
        </div>
        <div class="card-body">
            <div class="basic-form">
                <form action="{{ route('data-inventaris.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="NoInventaris" class="form-label">Nomor Inventaris</label>
                            <input type="text" class="form-control @error('NoInventaris') is-invalid @enderror"
                                id="NoInventaris" name="NoInventaris" value="{{ old('NoInventaris') }}"
                                placeholder="Masukkan nomor inventaris">
                            @error('NoInventaris')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="ItemID" class="form-label">Item</label>
                            <select class="form-select @error('ItemID') is-invalid @enderror" id="ItemID" name="ItemID">
                                <option value="">Pilih Item</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}" {{ old('ItemID') == $item->id ? 'selected' : '' }}>
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
                                id="SerialNumber" name="SerialNumber" value="{{ old('SerialNumber') }}"
                                placeholder="Masukkan serial number">
                            @error('SerialNumber')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="Merk" class="form-label">Merk</label>
                            <select class="form-select @error('Merk') is-invalid @enderror" id="Merk" name="Merk">
                                <option value="">Pilih Merk</option>
                                @foreach($merks as $merk)
                                    <option value="{{ $merk->id }}" {{ old('Merk') == $merk->id ? 'selected' : '' }}>
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
                                name="Tipe" value="{{ old('Tipe') }}" placeholder="Masukkan tipe">
                            @error('Tipe')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="TanggalBeli" class="form-label">Tanggal Beli</label>
                            <input type="date" class="form-control @error('TanggalBeli') is-invalid @enderror"
                                id="TanggalBeli" name="TanggalBeli" value="{{ old('TanggalBeli') }}">
                            @error('TanggalBeli')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="Departemen" class="form-label">Departemen</label>
                            <select class="form-select @error('Departemen') is-invalid @enderror" id="Departemen"
                                name="Departemen">
                                <option value="">Pilih Departemen</option>
                                @foreach($departemens as $dept)
                                    <option value="{{ $dept->id }}" {{ old('Departemen') == $dept->id ? 'selected' : '' }}>
                                        {{ $dept->NamaDepartemen }}
                                    </option>
                                @endforeach
                            </select>
                            @error('Departemen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="Unit" class="form-label">Unit</label>
                            <select class="form-select @error('Unit') is-invalid @enderror" id="Unit" name="Unit">
                                <option value="">Pilih Unit</option>
                            </select>
                            @error('Unit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="Jenis" class="form-label">Jenis</label>
                            <input type="text" class="form-control @error('Jenis') is-invalid @enderror" id="Jenis"
                                name="Jenis" value="{{ old('Jenis') }}" placeholder="Masukkan jenis">
                            @error('Jenis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="ManualBook" class="form-label">Manual Book</label>
                            <input type="file" class="form-control @error('ManualBook') is-invalid @enderror"
                                id="ManualBook" name="ManualBook" placeholder="Pilih file manual book">
                            @error('ManualBook')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="Klasifikasi" class="form-label">Klasifikasi</label>
                            <input type="text" class="form-control @error('Klasifikasi') is-invalid @enderror"
                                id="Klasifikasi" name="Klasifikasi" value="{{ old('Klasifikasi') }}"
                                placeholder="Masukkan klasifikasi">
                            @error('Klasifikasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="Keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control @error('Keterangan') is-invalid @enderror" id="Keterangan"
                                name="Keterangan" rows="3"
                                placeholder="Masukkan keterangan">{{ old('Keterangan') }}</textarea>
                            @error('Keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="Gambar" class="form-label">Gambar</label>
                            <input type="file" class="form-control @error('Gambar') is-invalid @enderror" id="Gambar"
                                name="Gambar" placeholder="Pilih file gambar">
                            @error('Gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="KodeRS" class="form-label">Kode RS</label>
                            <input type="text" class="form-control @error('KodeRS') is-invalid @enderror" id="KodeRS"
                                name="KodeRS" value="{{ old('KodeRS') }}" placeholder="Masukkan kode RS">
                            @error('KodeRS')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
            $('#Departemen').change(function () {
                var deptId = $(this).val();
                if (deptId) {
                    $.ajax({
                        url: '/get-units/' + deptId,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            $('#Unit').empty();
                            $('#Unit').append('<option value="">Pilih Unit</option>');
                            $.each(data, function (key, value) {
                                $('#Unit').append('<option value="' + value.id + '">' + value.NamaUnit + '</option>');
                            });
                        }
                    });
                } else {
                    $('#Unit').empty();
                    $('#Unit').append('<option value="">Pilih Unit</option>');
                }
            });
        });
    </script>
@endpush