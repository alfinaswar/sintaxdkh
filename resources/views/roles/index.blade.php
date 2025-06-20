@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Manajemen Role</h4>
            @can('role-create')
                <a class="btn btn-primary" href="{{ route('roles.create') }}">Tambah Role Baru</a>
            @endcan
        </div>
        <div class="card-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Nama</th>
                            <th style="width: 220px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="{{ route('roles.show', $role->id) }}">Detail</a>
                                    @can('role-edit')
                                        <a class="btn btn-warning btn-sm" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                                    @endcan
                                    @can('role-delete')
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}
                                        {!! Form::submit('Hapus', ['class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Yakin ingin menghapus role ini?')"]) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        @if($roles->isEmpty())
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada data role.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {!! $roles->render() !!}
            </div>
        </div>
    </div>
@endsection