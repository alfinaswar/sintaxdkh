@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Departemen</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('master-dept.update', encrypt($departemen->id)) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="NamaDepartemen" class="form-label">Nama Departemen</label>
                    <input type="text" name="NamaDepartemen" id="NamaDepartemen"
                        class="form-control @error('NamaDepartemen') is-invalid @enderror"
                        placeholder="Masukkan nama departemen"
                        value="{{ old('NamaDepartemen', $departemen->NamaDepartemen) }}">
                    @error('NamaDepartemen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr>
                <label class="form-label">Unit di bawah Departemen</label>
                <table class="table table-bordered" id="unitTable">
                    <thead>
                        <tr>
                            <th>Nama Unit</th>
                            <th style="width: 50px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departemen->getUnit as $unit)
                            <tr>
                                <td>
                                    <input type="text" name="NamaUnit[]" class="form-control" placeholder="Masukkan nama unit"
                                        value="{{ $unit->NamaUnit }}">
                                    <input type="hidden" name="unit_id[]" value="{{ $unit->id }}">
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="hapusBaris(this)">🗑</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="text-end">
                        <button type="button" class="btn btn-info btn-md" onclick="tambahBaris()">+ Tambah Unit</button>
                    </div>
                </div>

                <div class="d-flex mt-4">
                    <a href="{{ route('master-dept.index') }}" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function tambahBaris() {
            const tbody = document.querySelector("#unitTable tbody");
            const row = document.createElement("tr");
            row.innerHTML = `
                                <td>
                                    <input type="text" name="NamaUnit[]" class="form-control" placeholder="Masukkan nama unit">
                                    <input type="hidden" name="unit_id[]" value="">
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="hapusBaris(this)">🗑</button>
                                </td>
                            `;
            tbody.appendChild(row);
        }

        function hapusBaris(button) {
            const row = button.closest("tr");
            row.remove();
        }
    </script>
@endpush