@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Work Order</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('work-order.update', encrypt($workOrder->id)) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="Tanggal" class="form-label">Tanggal</label>
                            <input type="date" name="Tanggal" id="Tanggal"
                                class="form-control @error('Tanggal') is-invalid @enderror"
                                value="{{ old('Tanggal', $workOrder->Tanggal) }}" readonly>
                            @error('Tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="Judul" class="form-label">Judul</label>
                            <input type="text" name="Judul" id="Judul"
                                class="form-control @error('Judul') is-invalid @enderror"
                                placeholder="Masukkan judul work order" value="{{ old('Judul', $workOrder->Judul) }}"
                                readonly>
                            @error('Judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="Departemen" class="form-label">Departemen</label>
                                    <select
                                        class="single-select-placeholder js-states @error('Departemen') is-invalid @enderror"
                                        id="Departemen" name="Departemen"
                                        data-url="{{ route('master-dept.get-item-by-departemen') }}">
                                        <option value="">Pilih Departemen</option>
                                        @foreach($departemens as $dept)
                                            <option value="{{ $dept->id }}" {{ old('Departemen', $workOrder->Departemen) == $dept->id ? 'selected' : '' }}>
                                                {{ $dept->NamaDepartemen }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('Departemen')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="Unit" class="form-label">Unit</label>
                                    <select class="single-select-placeholder js-states @error('Unit') is-invalid @enderror"
                                        id="Unit" name="Unit">
                                        <option value="">Pilih Unit</option>
                                        @foreach($units as $unit)
                                            <option value="{{ $unit->id }}" {{ old('Unit', $workOrder->Unit) == $unit->id ? 'selected' : '' }}>
                                                {{ $unit->NamaUnit }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('Unit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="Kasus" class="form-label">Kasus</label>
                            <textarea name="Kasus" id="Kasus" rows="3"
                                class="form-control @error('Kasus') is-invalid @enderror" placeholder="Deskripsikan kasus"
                                readonly>{{ old('Kasus', $workOrder->Kasus) }}</textarea>
                            @error('Kasus')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="KategoriKasus" class="form-label">Kategori Kasus</label>
                                    <select name="KategoriKasus" id="KategoriKasus"
                                        class="single-select-placeholder js-states @error('KategoriKasus') is-invalid @enderror">
                                        <option value="">Pilih Kategori</option>
                                        <option value="HARDWARE" {{ old('KategoriKasus', $workOrder->KategoriKasus) == 'HARDWARE' ? 'selected' : '' }}>Hardware</option>
                                        <option value="SOFTWARE" {{ old('KategoriKasus', $workOrder->KategoriKasus) == 'SOFTWARE' ? 'selected' : '' }}>Software</option>
                                    </select>
                                    @error('KategoriKasus')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="ItemID" class="form-label">Item</label>
                                    <select
                                        class="single-select-placeholder js-states @error('ItemID') is-invalid @enderror"
                                        id="single-select" name="ItemID">
                                        <option value="">Pilih Item</option>
                                        @foreach($items as $item)
                                            <option value="{{ $item->id }}" {{ old('ItemID', $workOrder->ItemID) == $item->id ? 'selected' : '' }}>
                                                {{ $item->getItem->Nama }} - {{ $item->NoInventaris }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('ItemID')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="Prioritas" class="form-label">Prioritas</label>
                            <select name="Prioritas" id="Prioritas"
                                class="form-select @error('Prioritas') is-invalid @enderror">
                                <option value="">Pilih Prioritas</option>
                                <option value="Rendah" {{ old('Prioritas', $workOrder->Prioritas) == 'Rendah' ? 'selected' : '' }}>Low</option>
                                <option value="Sedang" {{ old('Prioritas', $workOrder->Prioritas) == 'Sedang' ? 'selected' : '' }}>Medium</option>
                                <option value="Tinggi" {{ old('Prioritas', $workOrder->Prioritas) == 'Tinggi' ? 'selected' : '' }}>High</option>
                                <option value="Kritis" {{ old('Prioritas', $workOrder->Prioritas) == 'Kritis' ? 'selected' : '' }}>Critical</option>
                            </select>
                            @error('Prioritas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="DitugaskanKe" class="form-label">Ditugaskan Ke</label>
                            <select name="DitugaskanKe" id="DitugaskanKe"
                                class="single-select-placeholder js-states @error('DitugaskanKe') is-invalid @enderror">
                                <option value="">Pilih Staff</option>
                                @foreach($staffs as $staff)
                                    <option value="{{ $staff->id }}" {{ old('DitugaskanKe', $workOrder->DitugaskanKe) == $staff->id ? 'selected' : '' }}>
                                        {{ $staff->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('DitugaskanKe')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="StatusID" class="form-label">Status</label>
                            <select name="StatusID" id="StatusID"
                                class="form-select @error('StatusID') is-invalid @enderror">
                                <option value="">Pilih Status</option>
                                <option value="Open" {{ old('StatusID', $workOrder->StatusID) == 'Open' ? 'selected' : '' }}>
                                    Open</option>
                                <option value="In Progress" {{ old('StatusID', $workOrder->StatusID) == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="Pending" {{ old('StatusID', $workOrder->StatusID) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Closed" {{ old('StatusID', $workOrder->StatusID) == 'Closed' ? 'selected' : '' }}>Closed</option>
                                <option value="Cancelled" {{ old('StatusID', $workOrder->StatusID) == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('StatusID')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="Keterangan" class="form-label">Keterangan</label>
                            <textarea name="Keterangan" id="Keterangan" rows="3"
                                class="form-control @error('Keterangan') is-invalid @enderror">{{ old('Keterangan', $workOrder->Keterangan) }}</textarea>
                            @error('Keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="d-flex mt-4">
                    <a href="{{ route('work-order.index') }}" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
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
                            $.each(response, function (key, unit) {
                                $('#Unit').append(`<option value="${unit.id}">${unit.NamaUnit}</option>`);
                            });
                        },
                        error: function () {
                            $('#Unit').empty().append('<option value="">Gagal mengambil data</option>');
                        }
                    });
                } else {
                    $('#Unit').empty().append('<option value="">Pilih Unit</option>');
                }
            });
        });
    </script>
@endpush