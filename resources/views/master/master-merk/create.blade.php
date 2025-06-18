@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Buat Merk Baru</h4>
        </div>
        <div class="card-body">
            <div class="basic-form">
                <form action="{{ route('master-merk.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="merk" class="form-label">Nama Merk</label>
                            <input type="text" class="form-control @error('Merk') is-invalid @enderror" id="Merk"
                                name="Merk" placeholder="Masukkan nama merk" value="{{ old('Merk') }}">
                            @error('Merk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex mt-4">
                        <a href="{{ route('master-merk.index') }}" class="btn btn-secondary me-2">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection