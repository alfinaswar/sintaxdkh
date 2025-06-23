@extends('layouts.app')

@section('content')
    @include('data-inventaris.header-show')
    @include('data-inventaris.modal-preventif')
    @include('data-inventaris.modal-kalibrasi')
    <div class="tab-content" id="tabContentMyProfileBottom">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header pb-0 border-0">
                        <div class="clearfix">
                            <h4 class="card-title mb-0">Work Order</h4>
                            <small class="d-block">Daftar work order terbaru</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @forelse ($data->getWo->take(3) as $wo)
                                <div class="col-lg-12">
                                    <div class="card card-comment">
                                        <div class="card-body pb-0">
                                            <div class="d-flex justify-content-between mb-2">
                                                <div class="d-flex align-items-center py-2">
                                                    <div class="d-inline-block position-relative">
                                                        <img src="images/avatar/avatar1.jpg" alt=""
                                                            class="rounded avatar avatar-md style-1">
                                                    </div>
                                                    <div class="clearfix ms-2">
                                                        <h6 class="mb-0 fw-semibold">{{ $wo->getDitugaskanOleh->name }}</h6>
                                                        <span class="fs-13">{{ $wo->created_at }}</span>
                                                    </div>
                                                </div>
                                                <div class="clearfix ms-auto">
                                                    <button type="button"
                                                        class="btn btn-light btn-icon-xxs tp-btn fs-18 align-self-start"><i
                                                            class="bi bi-grid"></i></button>
                                                </div>
                                            </div>
                                            <div class="clearfix text-black">
                                                <p class="fs-14 mb-2 fw-bold">{{ $wo->Judul }}</p>
                                                <p class="fs-14 mb-2">{{ $wo->Kasus }}</p>
                                            </div>
                                            <div class="clearfix pt-1">
                                                <span class="badge badge-rounded badge-outline-primary me-2">
                                                    {{ $wo->getDepartemen ? $wo->getDepartemen->NamaDepartemen : '-' }}
                                                </span>
                                                <span class="badge badge-rounded badge-outline-primary">
                                                    {{ $wo->getUnit ? $wo->getUnit->NamaUnit : '-' }}
                                                </span>
                                            </div>
                                            <div
                                                class="position-relative border-top border-opacity-10 d-flex align-items-center mt-3">
                                                <div class="row mt-3">
                                                    <div class="col-12">
                                                        <label class="fw-bold">Keterangan:</label>
                                                        <div class="text-muted">
                                                            {{ $wo->Keterangan ?? 'Belum Dikerjakan' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-primary border-primary outline-dashed py-3 px-3 mt-4 mb-0 text-black">
                                    <strong class="text-primary">Tidak ada data</strong> untuk ditampilkan.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="row z-0">

                    <div class="col-xxl-12 col-xl-12 col-md-6">
                        <div class="card">
                            <div class="card-header pb-0 border-0">
                                <div class="clearfix">
                                    <h4 class="card-title mb-0">Preventif Maintenance</h4>
                                    <small class="d-block"></small>
                                </div>
                                <div class="clearfix ms-auto">
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalCenter">
                                        + Tambah Preventif
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                @forelse ($data->getPm->take(5) as $pm)
                                    <div class="d-flex align-items-start py-3 hover-bg-light rounded my-1 flex-column">
                                        <div class="d-flex align-items-center w-100">
                                            <div
                                                class="avatar avatar-md style-1 border border-opacity-10 rounded d-flex align-items-center justify-content-center bg-white">
                                                <img src="images/logo/google.png" alt="">
                                            </div>
                                            <div class="clearfix ms-3">
                                                <h6 class="mb-0 fw-semibold">{{ $pm->getDikerjakanOleh->name }}</h6>
                                                <span class="fs-13">{{ $pm->DiselesaikanTanggal }}</span>
                                            </div>
                                            <div class="clearfix ms-auto">
                                                <span class="badge badge-sm badge-success">{{ $pm->Status }}</span>
                                            </div>
                                        </div>

                                        <!-- Gambar Before & After -->
                                        <div class="row mt-3 w-100">
                                            <div class="col-6 text-center">
                                                <h6 class="fw-bold">Before</h6>
                                                @if ($pm->before)
                                                    <img src="{{ asset('storage/preventif/before/' . $pm->Before) }}" alt="Before"
                                                        class="img-fluid rounded" style="max-height:100px;">
                                                @else
                                                    <p class="text-muted">Tidak ada gambar</p>
                                                @endif
                                            </div>
                                            <div class="col-6 text-center">
                                                <h6 class="fw-bold">After</h6>
                                                @if ($pm->after)
                                                    <img src="{{ asset('storage/preventif/after/' . $pm->After) }}" alt="Before"
                                                        class="img-fluid rounded" style="max-height:100px;">
                                                @else
                                                    <p class="text-muted">Tidak ada gambar</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div
                                        class="alert alert-primary border-primary outline-dashed py-3 px-3 mt-4 mb-0 text-black">
                                        <strong class="text-primary">Tidak ada data</strong> untuk ditampilkan.
                                    </div>
                                @endforelse


                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-12 col-xl-12 col-md-6">
                        <div class="card">
                            <div class="card-header pb-0 border-0">
                                <div class="clearfix">
                                    <h4 class="card-title mb-0">Kalibrasi Terbaru</h4>
                                    <small class="d-block">Riwayat kalibrasi peralatan</small>
                                </div>
                                <div class="clearfix ms-auto">
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalKalibrasi">
                                        + Tambah Kalibrasi
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                @forelse ($data->getKalibrasi->take(5) as $kalibrasi)
                                    <div class="d-flex align-items-start py-3 hover-bg-light rounded my-1 flex-column">
                                        <div class="d-flex align-items-center w-100">
                                            <div
                                                class="avatar avatar-md style-1 border border-opacity-10 rounded d-flex align-items-center justify-content-center bg-white">
                                                <img src="images/logo/calibration.png" alt="">
                                            </div>
                                            <div class="clearfix ms-3">
                                                <h6 class="mb-0 fw-semibold">{{ $kalibrasi->NamaDokumen }}</h6>
                                                <span class="fs-13">{{ $kalibrasi->TanggalKalibrasi }}</span>
                                            </div>
                                            <div class="clearfix ms-auto">
                                                <span class="badge badge-sm badge-info">{{ $kalibrasi->StatusKalibrasi }}</span>
                                            </div>
                                            <div class="clearfix ms-auto">
                                                @if ($kalibrasi->Dokumen)
                                                    <a href="{{ asset('storage/dokumen/' . $kalibrasi->Dokumen) }}" target="_blank"
                                                        class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-file-pdf"></i> Lihat Sertifikat
                                                    </a>
                                                @else
                                                    <p class="text-muted">Tidak ada sertifikat</p>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Informasi Kalibrasi -->
                                        < </div>
                                @empty
                                            <div
                                                class="alert alert-primary border-primary outline-dashed py-3 px-3 mt-4 mb-0 text-black">
                                                <strong class="text-primary">Tidak ada data kalibrasi</strong> untuk
                                                ditampilkan.
                                            </div>
                                        @endforelse
                                </div>
                            </div>
                        </div>



                    </div>
                </div>

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
@endsection