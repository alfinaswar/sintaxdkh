@extends('layouts.app')

@section('content')
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Buat Rumah Sakit Baru</h4>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('master-rs.store') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="Nama" class="form-label">Nama Rumah Sakit</label>
                                                            <input type="text" name="Nama" id="NamaRS"
                                                                class="form-control @error('NamaRS') is-invalid @enderror"
                                                                placeholder="Masukkan nama rumah sakit" value="{{ old('Nama') }}">
                                                            @error('Nama')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="KelasRs" class="form-label">Kelas RS / </label>
                                                            <select name="KelasRs" id="KelasRs" class="form-control @error('KelasRs') is-invalid @enderror">
                                                                <option value="">==Pilih Kelas Rumah Sakit==</option>
                                                                <option value="A" {{ old('KelasRs') == 'A' ? 'selected' : '' }}>Kelas A</option>
                                                                <option value="B" {{ old('KelasRs') == 'B' ? 'selected' : '' }}>Kelas B</option>
                                                                <option value="C" {{ old('KelasRs') == 'C' ? 'selected' : '' }}>Kelas C</option>
                                                                <option value="D" {{ old('KelasRs') == 'D' ? 'selected' : '' }}>Kelas D</option>
                                                                <option value="Klinik" {{ old('KelasRs') == 'Klinik' ? 'selected' : '' }}>Klinik</option>
                                                            </select>
                                                            @error('KelasRs')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="NamaDirektur" class="form-label">Nama Direktur</label>
                                                            <input type="text" name="NamaDirektur" id="NamaDirektur"
                                                                class="form-control @error('NamaDirektur') is-invalid @enderror"
                                                                placeholder="Masukkan nama direktur" value="{{ old('NamaDirektur') }}">
                                                            @error('NamaDirektur')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="Telepon" class="form-label">Telepon</label>
                                                            <input type="text" name="Telepon" id="Telepon"
                                                                class="form-control @error('Telepon') is-invalid @enderror"
                                                                placeholder="Masukkan nomor telepon" value="{{ old('Telepon') }}">
                                                            @error('Telepon')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="Email" class="form-label">Email</label>
                                                            <input type="email" name="Email" id="Email"
                                                                class="form-control @error('Email') is-invalid @enderror" placeholder="Masukkan email"
                                                                value="{{ old('Email') }}">
                                                            @error('Email')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="Alamat" class="form-label">Alamat</label>
                                                            <input type="text" name="Alamat" id="Alamat"
                                                                class="form-control @error('Alamat') is-invalid @enderror" placeholder="Masukkan alamat"
                                                                value="{{ old('Alamat') }}">
                                                            @error('Alamat')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="Provinsi" class="form-label">Provinsi</label>
                                                            @php
    $provinces = new App\Http\Controllers\DependantDropdownController;
    $provinces = $provinces->provinces();
                                                            @endphp
                                                            <select class="single-select-placeholder js-states" name="Provinsi" id="provinsi" required>
                                                                <option>==Pilih Salah Satu==</option>
                                                                @foreach ($provinces as $item)
                                                                    <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('Provinsi')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    <div class=" mb-3">
                                                        <label class="col-md-3 col-form-label" for="kota">Kabupaten / Kota</label>
                                                        <div class="col-md-9">
                                                            <select class="single-select-placeholder js-states" name="Kota" id="kota" required>
                                                                <option>==Pilih Salah Satu==</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class=" mb-3">
                                                        <label class="col-md-3 col-form-label" for="kecamatan">Kecamatan</label>
                                                        <div class="col-md-9">
                                                            <select class="single-select-placeholder js-states" name="Kecamatan" id="kecamatan" required>
                                                                <option>==Pilih Salah Satu==</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                        <div class="mb-3">
                                                            <label for="StatusPenyelenggara" class="form-label">Status Penyelenggara</label>
                                                            <select name="StatusPenyelenggara" id="StatusPenyelenggara"
                                                                class="form-control @error('StatusPenyelenggara') is-invalid @enderror">
                                                                <option value="">==Pilih Status Penyelenggara==</option>
                                                                <option value="Pemerintah" {{ old('StatusPenyelenggara') == 'Pemerintah' ? 'selected' : '' }}>Pemerintah</option>
                                                                <option value="Swasta" {{ old('StatusPenyelenggara') == 'Swasta' ? 'selected' : '' }}>Swasta</option>
                                                                <option value="TNI/POLRI" {{ old('StatusPenyelenggara') == 'TNI/POLRI' ? 'selected' : '' }}>TNI/POLRI</option>
                                                                <option value="BUMN/BUMD" {{ old('StatusPenyelenggara') == 'BUMN/BUMD' ? 'selected' : '' }}>BUMN/BUMD</option>
                                                                <option value="Lainnya" {{ old('StatusPenyelenggara') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                                            </select>
                                                            @error('StatusPenyelenggara')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="Logo" class="form-label">Logo</label>
                                                            <input type="file" name="Logo" id="Logo"
                                                                class="form-control @error('Logo') is-invalid @enderror">
                                                            @error('Logo')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex mt-4">
                                                    <a href="{{ route('master-rs.index') }}" class="btn btn-secondary me-2">Kembali</a>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
@endsection
@push('scripts')
    <script>
        function onChangeSelect(url, id, name) {
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    id: id
                },
                success: function (data) {
                    $('#' + name).empty();
                    $('#' + name).append('<option>==Pilih Salah Satu==</option>');

                    $.each(data, function (key, value) {
                        $('#' + name).append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }
        $(function () {
            $('#provinsi').on('change', function () {
                onChangeSelect('{{ route("cities") }}', $(this).val(), 'kota');
            });
            $('#kota').on('change', function () {
                onChangeSelect('{{ route("districts") }}', $(this).val(), 'kecamatan');
            })
            $('#kecamatan').on('change', function () {
                onChangeSelect('{{ route("villages") }}', $(this).val(), 'desa');
            })
        });
    </script>
@endpush