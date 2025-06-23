@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Pengguna</h4>
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

                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama"
                                value="{{ old('name', $user->name) }}">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                value="{{ old('email', $user->email) }}">
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Kosongkan jika tidak ingin mengubah password">
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
                                <option value="" disabled {{ (old('KodeRS', $user->KodeRS) == null) ? 'selected' : '' }}>Pilih
                                    Rumah Sakit</option>
                                @foreach($rs as $r)
                                    <option value="{{ $r->id }}" {{ (old('KodeRS', $user->KodeRS) == $r->id) ? 'selected' : '' }}>
                                        {{ $r->Nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('KodeRS')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="roles" class="form-label">Role</label>
                            <select name="roles[]" class="form-select" id="roles" required>
                                <option value="" disabled {{ (empty(old('roles', $userRole))) ? 'selected' : '' }}>Pilih
                                    Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role }}" {{ (collect(old('roles', $userRole))->contains($role)) ? 'selected' : '' }}>{{ $role }}</option>
                                @endforeach
                            </select>
                            @error('roles')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
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