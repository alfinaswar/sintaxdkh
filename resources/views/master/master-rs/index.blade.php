@extends('layouts.app')

@section('content')
    <div class="row mb-3">
        <div class="col text-end">
            <a href="{{ route('master-rs.create') }}" class="btn btn-success">Tambah Rumah Sakit Baru</a>
        </div>
    </div>
    @if (session()->has('success'))
        <script>
            setTimeout(function () {
                swal.fire({
                    title: "{{ __('Success!') }}",
                    text: "{!! \Session::get('success') !!}",
                    icon: "success",
                    type: "success"
                });
            }, 1000);
        </script>
    @endif

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Master Rumah Sakit</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="display table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Status Penyelenggara</th>
                            <th class="text-center" width="15%">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {

            $('body').on('click', '.btn-delete', function () {
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Hapus Data',
                    text: "Anda Ingin Menghapus Data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('master-rs.destroy', ':id') }}'.replace(':id', id),
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                Swal.fire(
                                    'Dihapus',
                                    'Data Berhasil Dihapus',
                                    'success'
                                );

                                $('#example').DataTable().ajax.reload();
                            },
                            error: function (xhr) {
                                Swal.fire(
                                    'Failed!',
                                    'Error',
                                    'error'
                                );
                                console.log(xhr.responseText);
                            }
                        });
                    }
                });
            });
            var dataTable = function () {
                var table = $('#example');
                table.DataTable({
                    responsive: true,
                    serverSide: true,
                    bDestroy: true,
                    processing: true,
                    language: {
                        processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Memuat...</span> ',
                        paginate: {
                            next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                            previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
                        }
                    },
                    ajax: "{{ route('master-rs.index') }}",
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'Nama', name: 'Nama' },
                        { data: 'KelasRs', name: 'KelasRs' },
                        { data: 'Telepon', name: 'Telepon' },
                        { data: 'Email', name: 'Email' },
                        { data: 'Alamat', name: 'Alamat' },
                        { data: 'StatusPenyelenggara', name: 'StatusPenyelenggara' },
                        { data: 'action', name: 'action', orderable: false, searchable: false }
                    ]
                });
            };
            dataTable();
        });
    </script>
@endpush