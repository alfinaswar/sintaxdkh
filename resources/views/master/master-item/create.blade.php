@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Buat Item Baru</h4>
        </div>
        <div class="card-body">
            <div class="basic-form">


                <form action="{{ route('master-item.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="name" class="form-label">Nama Item</label>
                            <input type="text" class="form-control @error('Nama') is-invalid @enderror" id="Nama"
                                name="Nama" placeholder="Masukkan nama item" value="{{ old('Nama') }}">
                            @error('Nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex mt-4">
                        <a href="{{ route('master-item.index') }}" class="btn btn-secondary me-2">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection