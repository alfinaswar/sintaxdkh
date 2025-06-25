@extends('layouts.app')

@section('content')
    <div class="row mb-3">
        <div class="col text-end">
            <a href="{{ route('data-inventaris.create') }}" class="btn btn-success">Tambah Inventaris Baru</a>
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
            <h4 class="card-title">Data Inventaris</h4>
        </div>
        <div class="card-body">
            <!-- Filter -->

            <div class="row mb-3">
                <div class="col-md-3"><label for="filter_rs" class="form-label">Rumah Sakit</label><select
                        class="single-select-placeholder js-states" id="filter_rs" name="filter_rs">
                        <option value="">Semua Rumah Sakit</option>@foreach($rs as $r)<option value="{{ $r->id }}">
                            {{ $r->Nama }}
                        </option>@endforeach
                    </select></div>
                <div class="col-md-3"><label for="filter_item" class="form-label">Item</label><select
                        class="single-select-placeholder js-states" id="filter_item" name="filter_item">
                        <option value="">Semua Item</option>@foreach($items as $item)<option value="{{ $item->id }}">
                            {{ $item->getItem->Nama }}
                        </option>@endforeach
                    </select></div>
                <div class="col-md-3"><label for="filter_dept" class="form-label">Departemen</label><select
                        class="single-select-placeholder js-states" id="filter_dept" name="filter_dept">
                        <option value="">Semua Departemen</option>@foreach($departemen as $dept)<option
                        value="{{ $dept->id }}">{{ $dept->NamaDepartemen }}</option>@endforeach
                    </select></div>
                <div class="col-md-3"><label for="filter_unit" class="form-label">Unit</label><select
                        class="single-select-placeholder js-states" id="filter_unit " name="filter_unit">
                        <option value="">Semua Unit</option>
                    </select>
                </div>
                <div class="col-12 text-end mt-3">
                    <button type="button" id="btnFilter" class="btn btn-primary">Filter</button>
                    <span style="display:inline-block; width: 10px;"></span>
                    <button type="button" id="btnReset" class="btn btn-secondary">Reset</button>
                </div>
            </div>

            <!-- End Filter -->
            <div class="table-responsive">
                <table id="example" class="display table" style="width: 100%;">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>No Inventaris</th>
                            <th>Item</th>
                            <th>Serial Number</th>
                            <th>Merk</th>
                            <th>Tipe</th>
                            <th>Tanggal Beli</th>
                            <th>Dept / Unit</th>
                            <th>Manual Book</th>
                            <th>Gambar</th>
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
            $('#filter_dept').on('change', function () {
                let departemenId = $(this).val();
                let url = $(this).data('url');

                $('#Unit').empty().append('<option value="">Loading...</option>');

                if (departemenId) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        data: { departemen_id: departemenId },
                        success: function (response) {
                            $('#filter_unit').empty().append('<option value="">Pilih Unit</option>');
                            $.each(response, function (key, unit) {
                                $('#filter_unit').append(`<option value="${unit.id}">${unit.NamaUnit}</option>`);
                            });
                        },
                        error: function () {
                            $('#filter_unit').empty().append('<option value="">Gagal mengambil data</option>');
                        }
                    });
                } else {
                    $('#filter_unit').empty().append('<option value="">Pilih Unit</option>');
                }
            });

            $('#btnFilter').click(function () {
                $('#example').DataTable().ajax.reload();
            });
            $('#btnReset').on('click', function () {
                $('#filterForm')[0].reset();
                table.ajax.reload();
            });
            $('body').on('click', '.btn-delete', function () {
                var id = $(this).data('id');

                Swal.fire({
                    title: 'Hapus Data',
                    text: "Anda Ingin Menghapus Data?",
                    icon: 'Peringatan',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('data-inventaris.destroy', ':id') }}'.replace(':id', id),
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

            // Memperbaiki inisialisasi DataTable dan penempatan properti columns
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
                    ajax: {
                        url: '{{ route('data-inventaris.index') }}',
                        data: function (d) {
                            d.filter_rs = $('#filter_rs').val();
                            d.filter_item = $('#filter_item').val();
                            d.filter_dept = $('#filter_dept').val();
                            d.filter_unit = $('#filter_unit').val();
                        }
                    },
                    columns: [
                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'NoInventaris',
                            name: 'NoInventaris'
                        },
                        {
                            data: 'get_item.Nama',
                            name: 'get_item.Nama'
                        },
                        {
                            data: 'SerialNumber',
                            name: 'SerialNumber'
                        },
                        {
                            data: 'get_merk.Merk',
                            name: 'get_merk.Merk'
                        },
                        {
                            data: 'Tipe',
                            name: 'Tipe'
                        },
                        {
                            data: 'TanggalBeli',
                            name: 'TanggalBeli'
                        },
                        {
                            data: 'PosisiBarang',
                            name: 'PosisiBarang'
                        },
                        {
                            data: 'ManualBook',
                            name: 'ManualBook'
                        },
                        {
                            data: 'Gambar',
                            name: 'Gambar'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });
            };
            dataTable();
        });
    </script>
@endpush