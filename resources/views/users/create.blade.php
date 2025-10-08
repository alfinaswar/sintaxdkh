@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Buat Pengguna Baru</h4>
        </div>
        <div class="card-body">
            <div class="basic-form">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Oops!</strong> Terjadi kesalahan pada input Anda.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="row">

                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama"
                                value="{{ old('name') }}">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                value="{{ old('email') }}">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="confirm-password" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="confirm-password" name="confirm-password"
                                placeholder="Konfirmasi Password">
                            @error('confirm-password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="KodeRS" class="form-label">Kode RS</label>
                            <select name="KodeRS" class="single-select-placeholder js-states" id="single-select" required>
                                <option value="" disabled selected>Pilih Rumah Sakit</option>
                                @foreach($rs as $r)
                                    <option value="{{ $r->id }}" {{ old('KodeRS') == $r->id ? 'selected' : '' }}>{{ $r->Nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('KodeRS')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="roles" class="form-label">Role</label>
                            @if(auth()->user()->hasRole('Rumah Sakit'))
                                <select name="roles[]" class="form-select" id="roles" required>
                                    <option value="Rumah Sakit" selected>Rumah Sakit</option>
                                </select>
                                <input type="hidden" name="roles[]" value="Rumah Sakit">
                            @else
                                <select name="roles[]" class="form-select" id="roles" required>
                                    <option value="" disabled selected>Pilih Role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role }}" {{ (collect(old('roles'))->contains($role)) ? 'selected' : '' }}>{{ $role }}</option>
                                    @endforeach
                                </select>
                            @endif
                            @error('roles')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tambahan Departemen dan Unit -->
                        <div class="mb-3 col-md-6">
                            <label for="Departemen" class="form-label">Departemen</label>
                            <select class="single-select-placeholder js-states @error('Departemen') is-invalid @enderror"
                                id="Departemen" name="Departemen"
                                data-url="{{ route('master-dept.get-item-by-departemen') }}">
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
                            <select class="single-select-placeholder js-states @error('Unit') is-invalid @enderror"
                                id="Unit" name="Unit">
                                <option value="">Pilih Unit</option>
                                @if(old('Unit'))
                                    <option value="{{ old('Unit') }}" selected>{{ old('Unit') }}</option>
                                @endif
                            </select>
                            @error('Unit')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- End Tambahan Departemen dan Unit -->

                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
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
                            if (Array.isArray(response) && response.length > 0) {
                                $.each(response, function (key, unit) {
                                    $('#Unit').append(`<option value="${unit.id}">${unit.NamaUnit}</option>`);
                                });
                            } else {
                                $('#Unit').append('<option value="">Tidak ada unit tersedia</option>');
                            }
                        },
                        error: function () {
                            $('#Unit').empty().append('<option value="">Gagal mengambil data</option>');
                        }
                    });
                } else {
                    $('#Unit').empty().append('<option value="">Pilih Unit</option>');
                }
            });

            // Optional: Trigger change on page load if old('Departemen') is set, to repopulate Unit
            @if(old('Departemen'))
                $('#Departemen').trigger('change');
            @endif
                });
    </script>
@endpush