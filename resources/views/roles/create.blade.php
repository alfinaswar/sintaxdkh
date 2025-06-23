@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Buat Role Baru</h4>
            <a class="btn btn-secondary" href="{{ route('roles.index') }}">Kembali</a>
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

                {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="name" class="form-label">Nama Role</label>
                        {!! Form::text('name', null, ['placeholder' => 'Nama Role', 'class' => 'form-control', 'id' => 'name']) !!}
                    </div>
                    <div class="mb-3 col-md-12">
                        <label class="form-label">Permission</label>
                        <div class="row">
                            @foreach($permission as $value)
                                <div class="col-md-4 mb-2">
                                    <div class="form-check">
                                        {!! Form::checkbox('permission[]', $value->id, false, ['class' => 'form-check-input', 'id' => 'perm_' . $value->id]) !!}
                                        <label class="form-check-label" for="perm_{{ $value->id }}">{{ $value->name }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection