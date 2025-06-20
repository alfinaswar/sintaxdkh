@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Data Rumah Sakit</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('master-rs.update', \Crypt::encrypt($rs->id)) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="Nama" class="form-label">Nama Rumah Sakit</label>
                            <input type="text" name="Nama" id="NamaRS"
                                class="form-control @error('Nama') is-invalid @enderror"
                                value="{{ old('Nama', $rs->Nama) }}">
                            @error('Nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="KelasRs" class="form-label">Kelas RS</label>
                            <select name="KelasRs" id="KelasRs" class="form-control @error('KelasRs') is-invalid @enderror">
                                <option value="">==Pilih Kelas Rumah Sakit==</option>
                                @foreach(['A', 'B', 'C', 'D', 'Klinik'] as $kelas)
                                    <option value="{{ $kelas }}" {{ old('KelasRs', $rs->KelasRs) == $kelas ? 'selected' : '' }}>
                                        Kelas {{ $kelas }}
                                    </option>
                                @endforeach
                            </select>
                            @error('KelasRs')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="NamaDirektur" class="form-label">Nama Direktur</label>
                            <input type="text" name="NamaDirektur" id="NamaDirektur"
                                class="form-control @error('NamaDirektur') is-invalid @enderror"
                                value="{{ old('NamaDirektur', $rs->NamaDirektur) }}">
                            @error('NamaDirektur')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Telepon" class="form-label">Telepon</label>
                            <input type="text" name="Telepon" id="Telepon"
                                class="form-control @error('Telepon') is-invalid @enderror"
                                value="{{ old('Telepon', $rs->Telepon) }}">
                            @error('Telepon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Email" class="form-label">Email</label>
                            <input type="email" name="Email" id="Email"
                                class="form-control @error('Email') is-invalid @enderror"
                                value="{{ old('Email', $rs->Email) }}">
                            @error('Email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="Alamat" class="form-label">Alamat</label>
                            <input type="text" name="Alamat" id="Alamat"
                                class="form-control @error('Alamat') is-invalid @enderror"
                                value="{{ old('Alamat', $rs->Alamat) }}">
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
                                    <option value="{{ $item->id }}" {{ old('Provinsi', $rs->Provinsi) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('Provinsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="Kota" class="form-label">Kabupaten / Kota</label>
                            <select name="Kota" id="kota" class="form-control" required>
                                <option value="{{ $rs->Kota }}" selected>{{ $rs->getKota->name ?? 'Terpilih' }}</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="Kecamatan" class="form-label">Kecamatan</label>
                            <select name="Kecamatan" id="kecamatan" class="form-control" required>
                                <option value="{{ $rs->Kecamatan }}" selected>{{ $rs->getKecamatan->name ?? 'Terpilih' }}</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="StatusPenyelenggara" class="form-label">Status Penyelenggara</label>
                            <select name="StatusPenyelenggara" id="StatusPenyelenggara"
                                class="form-control @error('StatusPenyelenggara') is-invalid @enderror">
                                <option value="">==Pilih Status Penyelenggara==</option>
                                @foreach(['Pemerintah','Swasta','TNI/POLRI','BUMN/BUMD','Lainnya'] as $status)
                                    <option value="{{ $status }}" {{ old('StatusPenyelenggara', $rs->StatusPenyelenggara) == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
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
                            @if($rs->Logo)
                                <small class="d-block mt-2">Logo saat ini: <br><img src="{{ asset('storage/'.$rs->Logo) }}" alt="Logo RS" height="80"></small>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="d-flex mt-4">
                    <a href="{{ route('master-rs.index') }}" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Perbarui</button>
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
                data: { id: id },
                success: function (data) {
                    $('#' + name).empty().append('<option>==Pilih Salah Satu==</option>');
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
            });
        });
    </script>
@endpush
