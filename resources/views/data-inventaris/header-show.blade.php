            <div class="card profile-overview profile-overview-wide">
                <div class="card-body d-flex">
                    <div class="clearfix">
                        <div class="d-inline-block position-relative me-sm-4 me-3 mb-3 mb-lg-0">
                            <img src="{{asset('storage/gambar-inventaris/' . $data->Gambar)}}" alt=""
                                class="rounded-4 profile-avatar" width="220px">
                        </div>
                    </div>
                    <div class="clearfix d-xl-flex flex-grow-1">
                        <div class="clearfix pe-md-5">
                            <h3 class="fw-semibold mb-1">{{$data->getItem->Nama}}</h3>
                            <ul class="d-flex flex-wrap fs-6 align-items-center">
                                <li class="me-3 d-inline-flex align-items-center"><i class="las la-barcode me-1 fs-18"></i>Serial
                                    Number: {{$data->SerialNumber}}</li>
                                <li class="me-3 d-inline-flex align-items-center"><i class="las la-tag me-1 fs-18"></i>Merk:
                                    {{$data->getMerk->Merk}}
                                </li>
                                <li class="me-3 d-inline-flex align-items-center"><i class="las la-info-circle me-1 fs-18"></i>Tipe:
                                    {{$data->Tipe}}
                                </li>
                            </ul>
                            <div class="d-md-flex d-none flex-wrap">
                                <div class="border outline-dashed rounded p-2 d-flex align-items-center me-3 mt-3">
                                    <div
                                        class="avatar avatar-md style-1 bg-primary-light text-primary rounded d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-dollar-sign fa-lg"></i>
                                    </div>
                                    <div class="clearfix ms-2">
                                        <h3 class="mb-0 fw-semibold lh-1">{{$data->getDepartemen->NamaDepartemen}} -
                                            {{$data->getUnit->NamaUnit}}
                                        </h3>
                                        <span class="fs-14">Departemen / Unit</span>

                                    </div>
                                </div>
                                <div class="border outline-dashed rounded p-2 d-flex align-items-center me-3 mt-3">
                                    <div
                                        class="avatar avatar-md style-1 bg-primary-light text-primary rounded d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-users fa-lg"></i>
                                    </div>
                                    <div class="clearfix ms-2">
                                        <h3 class="mb-0 fw-semibold lh-1">125</h3>
                                        <span class="fs-14">Kalibrasi</span>
                                    </div>
                                </div>
                                <div class="border outline-dashed rounded p-2 d-flex align-items-center me-3 mt-3">
                                    <div
                                        class="avatar avatar-md style-1 bg-primary-light text-primary rounded d-flex align-items-center justify-content-center">
                                        <i class="fa-solid fa-briefcase fa-lg"></i>
                                    </div>
                                    <div class="clearfix ms-2">
                                        <h3 class="mb-0 fw-semibold lh-1">25</h3>
                                        <span class="fs-14">New Deals</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix mt-3 mt-xl-0 ms-auto d-flex flex-column col-xl-3">
                            @php
    $klasifikasi = $data->Klasifikasi;
    $warna = '';
    $label = '';

    switch ($klasifikasi) {
        case 'HIGH-RISK':
            $warna = 'danger';
            $label = 'High Risk';
            break;
        case 'MEDIUM-RISK':
            $warna = 'warning';
            $label = 'Medium Risk';
            break;
        case 'LOW-RISK':
            $warna = 'success';
            $label = 'Low Risk';
            break;
        case 'LOW-TO-MEDIUM-RISK':
            $warna = 'info';
            $label = 'Low to Medium Risk';
            break;
        default:
            $warna = 'secondary';
            $label = $klasifikasi;
    }
                            @endphp
                            <div class="clearfix mb-3 text-xl-end">
                                <span class="badge bg-{{ $warna }} fs-6 py-2 px-3">
                                    {{ $label }}
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
                {{-- <div class="card-footer py-0 d-flex flex-wrap justify-content-between align-items-center px-0">
                    <ul class="nav nav-underline nav-underline-primary nav-underline-text-dark nav-underline-gap-x-0"
                        id="tabMyProfileBottom" role="tablist">
                        <li class="nav-item ms-1" role="presentation">
                            <a href="profile/overview.html" class="nav-link py-3 border-3 text-black active">Overview</a>
                        </li>
                        <li class="nav-item ms-1" role="presentation">
                            <a href="{{route('data-inventaris.Wo', encrypt($data->id))}}" class="nav-link py-3 border-3 text-black">Work Order</a>
                        </li>
                        <li class="nav-item ms-1" role="presentation">
                            <a href="{{route('data-inventaris.Pm', encrypt($data->id))}}" class="nav-link py-3 border-3 text-black">Preventif
                                Maintenance</a>
                        </li>
                        <li class="nav-item ms-1" role="presentation">
                            <a href="{{route('data-inventaris.Pm', encrypt($data->id))}}" class="nav-link py-3 border-3 text-black">Kalibrasi</a>
                        </li>
                    </ul>

                </div> --}}
            </div>