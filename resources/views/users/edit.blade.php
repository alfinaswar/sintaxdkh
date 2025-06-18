@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Pengguna</h4>
        </div>
        <div class="card-body">
            <div class="basic-form">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Oops!</strong> Terjadi kesalahan pada input Anda.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- untuk update -->

                    <div class="row">

                        <!-- Data Perwakilan -->
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Nama Perwakilan</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $user->name) }}" placeholder="Nama Perwakilan">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Email Perwakilan</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email', $user->email) }}" placeholder="Email">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="password" class="form-label">Password <small>(kosongkan jika tidak
                                    diubah)</small></label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="Konfirmasi Password">
                        </div>

                        <!-- Role (multiple select jika diperlukan) -->
                        <div class="mb-3 col-md-6">
                            <label for="roles" class="form-label">Role</label>
                            <select name="roles" id="roles" class="form-control">
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}"
                                        {{ in_array($role, old('roles', $userRoles ?? [])) ? 'selected' : '' }}>
                                        {{ $role }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Informasi Sekolah -->
                        <div class="mb-3 col-md-6">
                            <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                            <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah"
                                value="{{ old('nama_sekolah', $user->nama_sekolah) }}" placeholder="Nama Sekolah">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="npsn" class="form-label">NPSN</label>
                            <input type="text" class="form-control" id="npsn" name="npsn"
                                value="{{ old('npsn', $user->npsn) }}" placeholder="NPSN">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="jenjang" class="form-label">Jenjang</label>
                            <select class="form-control" id="jenjang" name="jenjang">
                                <option value="">-- Pilih Jenjang --</option>
                                @foreach (['SD', 'SMP', 'SMA', 'SMK'] as $jenjang)
                                    <option value="{{ $jenjang }}"
                                        {{ old('jenjang', $user->jenjang) == $jenjang ? 'selected' : '' }}>
                                        {{ $jenjang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="status_sekolah" class="form-label">Status Sekolah</label>
                            <select class="form-control" id="status_sekolah" name="status_sekolah">
                                <option value="">-- Pilih Status --</option>
                                @foreach (['Negeri', 'Swasta'] as $status)
                                    <option value="{{ $status }}"
                                        {{ old('status_sekolah', $user->status_sekolah) == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-12">
                            <label for="alamat_sekolah" class="form-label">Alamat Sekolah</label>
                            <textarea class="form-control" id="alamat_sekolah" name="alamat_sekolah" rows="2"
                                placeholder="Alamat lengkap sekolah">{{ old('alamat_sekolah', $user->alamat_sekolah) }}</textarea>
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                value="{{ old('kecamatan', $user->kecamatan) }}" placeholder="Kecamatan">
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="kota" class="form-label">Kota/Kabupaten</label>
                            <input type="text" class="form-control" id="kota" name="kota"
                                value="{{ old('kota', $user->kota) }}" placeholder="Kota atau Kabupaten">
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="provinsi" class="form-label">Provinsi</label>
                            <input type="text" class="form-control" id="provinsi" name="provinsi"
                                value="{{ old('provinsi', $user->provinsi) }}" placeholder="Provinsi">
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="kode_pos" class="form-label">Kode Pos</label>
                            <input type="text" class="form-control" id="kode_pos" name="kode_pos"
                                value="{{ old('kode_pos', $user->kode_pos) }}" placeholder="Kode Pos">
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="telepon_sekolah" class="form-label">Telepon Sekolah</label>
                            <input type="text" class="form-control" id="telepon_sekolah" name="telepon_sekolah"
                                value="{{ old('telepon_sekolah', $user->telepon_sekolah) }}"
                                placeholder="Nomor Telepon Sekolah">
                        </div>

                        <div class="mb-3 col-md-4">
                            <label for="email_sekolah" class="form-label">Email Sekolah</label>
                            <input type="email" class="form-control" id="email_sekolah" name="email_sekolah"
                                value="{{ old('email_sekolah', $user->email_sekolah) }}" placeholder="Email Sekolah">
                        </div>

                        <div class="mb-3 col-md-12">
                            <label for="website_sekolah" class="form-label">Website Sekolah</label>
                            <input type="text" class="form-control" id="website_sekolah" name="website_sekolah"
                                value="{{ old('website_sekolah', $user->website_sekolah) }}" placeholder="https://...">
                        </div>

                        <div class="mb-3 col-md-12">
                            <label for="deskripsi_sekolah" class="form-label">Deskripsi Sekolah</label>
                            <textarea class="form-control" id="deskripsi_sekolah" name="deskripsi_sekolah" rows="3"
                                placeholder="Deskripsi singkat tentang sekolah...">{{ old('deskripsi_sekolah', $user->deskripsi_sekolah) }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
