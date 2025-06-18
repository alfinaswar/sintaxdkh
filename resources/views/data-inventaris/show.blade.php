@extends('layouts.app')

@section('content')
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
                                    {{$data->getUnit->NamaUnit}}</h3>
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
                    <div class="clearfix mb-3 text-xl-end">
                        <a href="javascript:void(0);" class="btn btn-light text-dark">Follow</a>
                        <a href="javascript:void(0);" class="btn btn-primary ms-2">Offer a Deal</a>
                    </div>
                    <div class="mt-auto d-flex align-items-center">
                        <div class="clearfix me-3">
                            <span class="fw-medium text-black d-block mb-1">Progress</span>
                            <p class="mb-0 d-flex">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.83334 14.1668L14.1667 5.8335" stroke="var(--bs-success)" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M5.83334 5.8335H14.1667V14.1668" stroke="var(--bs-success)" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <span class="text-success me-1">+3.50%</span>
                            </p>
                        </div>
                        <div id="chartProfileProgress"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer py-0 d-flex flex-wrap justify-content-between align-items-center px-0">
            <ul class="nav nav-underline nav-underline-primary nav-underline-text-dark nav-underline-gap-x-0"
                id="tabMyProfileBottom" role="tablist">
                <li class="nav-item ms-1" role="presentation">
                    <a href="profile/overview.html" class="nav-link py-3 border-3 text-black active">Overview</a>
                </li>
                <li class="nav-item ms-1" role="presentation">
                    <a href="profile/work-order.html" class="nav-link py-3 border-3 text-black">Work Order</a>
                </li>
                <li class="nav-item ms-1" role="presentation">
                    <a href="profile/preventif-maintenance.html" class="nav-link py-3 border-3 text-black">Preventif
                        Maintenance</a>
                </li>
                <li class="nav-item ms-1" role="presentation">
                    <a href="profile/kalibrasi.html" class="nav-link py-3 border-3 text-black">Kalibrasi</a>
                </li>
            </ul>
            <ul class="d-md-flex d-none py-2">
                <li class="px-1">
                    <a class="btn btn-light text-dark" href="javascript:void(0);">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                </li>
                <li class="px-1">
                    <a class="btn btn-light text-dark" href="javascript:void(0);">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                </li>
                <li class="px-1">
                    <a class="btn btn-light text-dark" href="javascript:void(0);">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                </li>
                <li class="px-1">
                    <a class="btn btn-light text-dark" href="javascript:void(0);">
                        <i class="fa-brands fa-telegram"></i>
                    </a>
                </li>
                <li class="px-1">
                    <a class="btn btn-light text-dark" href="javascript:void(0);">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="tab-content" id="tabContentMyProfileBottom">
        <div class="row">
            <div class="col-xl-6">
                <div class="row">

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
                                            <h6 class="mb-0 fw-semibold">Jackson</h6>
                                            <span class="fs-13">Yestarday at 4:30 PM</span>
                                        </div>
                                    </div>
                                    <div class="clearfix ms-auto">
                                        <button type="button"
                                            class="btn btn-light btn-icon-xxs tp-btn fs-18 align-self-start"><i
                                                class="bi bi-grid"></i></button>
                                    </div>
                                </div>
                                <div class="clearfix text-black">
                                    <p class="fs-14 mb-2">Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                        text ever since the 1500s.</p>
                                </div>
                                <div class="clearfix pt-1">
                                    <a href="javascript:void(0);" class="me-3">
                                        <i class="fa-regular fa-image"></i> 25
                                    </a>
                                    <a href="javascript:void(0);" class="post-like">
                                        <i class="fa-regular fa-heart"></i> 75
                                    </a>
                                </div>
                                <div class="position-relative border-top border-opacity-10 d-flex align-items-center mt-3">
                                    <input type="text" class="form-control p-0 rounded-0 border-0 pe-2 bg-transparent"
                                        placeholder="Reply..">
                                    <div class="d-flex">
                                        <a href="javascript:void(0);" class="p-2">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M14.2934 7.36665L8.1667 13.4933C7.41613 14.2439 6.39815 14.6655 5.3367 14.6655C4.27524 14.6655 3.25726 14.2439 2.5067 13.4933C1.75613 12.7428 1.33447 11.7248 1.33447 10.6633C1.33447 9.60186 1.75613 8.58388 2.5067 7.83332L8.63336 1.70665C9.13374 1.20628 9.81239 0.925171 10.52 0.925171C11.2277 0.925171 11.9063 1.20628 12.4067 1.70665C12.9071 2.20703 13.1882 2.88568 13.1882 3.59332C13.1882 4.30096 12.9071 4.97961 12.4067 5.47999L6.27336 11.6067C6.02318 11.8568 5.68385 11.9974 5.33003 11.9974C4.97621 11.9974 4.63688 11.8568 4.3867 11.6067C4.13651 11.3565 3.99596 11.0171 3.99596 10.6633C3.99596 10.3095 4.13651 9.97017 4.3867 9.71999L10.0467 4.06665"
                                                    stroke="#888888" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                        </a>
                                        <a href="javascript:void(0);" class="p-2">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M14 6.66669C14 11.3334 8 15.3334 8 15.3334C8 15.3334 2 11.3334 2 6.66669C2 5.07539 2.63214 3.54927 3.75736 2.42405C4.88258 1.29883 6.4087 0.666687 8 0.666687C9.5913 0.666687 11.1174 1.29883 12.2426 2.42405C13.3679 3.54927 14 5.07539 14 6.66669Z"
                                                    stroke="#888888" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M8 8.66669C9.10457 8.66669 10 7.77126 10 6.66669C10 5.56212 9.10457 4.66669 8 4.66669C6.89543 4.66669 6 5.56212 6 6.66669C6 7.77126 6.89543 8.66669 8 8.66669Z"
                                                    stroke="#888888" stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                </div>
            </div>
            <div class="col-xl-6">
                <div class="row sticky-top z-0">

                    <div class="col-xxl-12 col-xl-6 col-md-6">
                        <div class="card">
                            <div class="card-header pb-0 border-0">
                                <div class="clearfix">
                                    <h4 class="card-title mb-0">Projects Contributions</h4>
                                    <small class="d-block">84 New Tasks & 29 Guides</small>
                                </div>
                                <div class="clearfix ms-auto">
                                    <button type="button"
                                        class="btn btn-light btn-icon-xxs tp-btn fs-18 align-self-start"><i
                                            class="bi bi-grid"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center py-2 hover-bg-light rounded my-1">
                                    <div
                                        class="avatar avatar-md style-1 border border-opacity-10 rounded d-flex align-items-center justify-content-center bg-white">
                                        <img src="images/logo/google.png" alt="">
                                    </div>
                                    <div class="clearfix ms-3">
                                        <h6 class="mb-0 fw-semibold">Piper Aerostar</h6>
                                        <span class="fs-13">piper-aircraft-class.jsp</span>
                                    </div>
                                    <div class="clearfix ms-auto">
                                        <span class="badge badge-sm badge-light">0</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center py-2 hover-bg-light rounded my-1">
                                    <div
                                        class="avatar avatar-md style-1 border border-opacity-10 rounded d-flex align-items-center justify-content-center bg-white">
                                        <img src="images/logo/figma.png" alt="">
                                    </div>
                                    <div class="clearfix ms-3">
                                        <h6 class="mb-0 fw-semibold">Cirrus SR22</h6>
                                        <span class="fs-13">cirrus-aircraft.jsp</span>
                                    </div>
                                    <div class="clearfix ms-auto">
                                        <span class="badge badge-sm badge-light">3</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center py-2 hover-bg-light rounded my-1">
                                    <div
                                        class="avatar avatar-md style-1 border border-opacity-10 rounded d-flex align-items-center justify-content-center bg-white">
                                        <img src="images/logo/slack.png" alt="">
                                    </div>
                                    <div class="clearfix ms-3">
                                        <h6 class="mb-0 fw-semibold">Beachcraft Baron</h6>
                                        <span class="fs-13">baron-class.pyt</span>
                                    </div>
                                    <div class="clearfix ms-auto">
                                        <span class="badge badge-sm badge-light">0</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center py-2 hover-bg-light rounded my-1">
                                    <div
                                        class="avatar avatar-md style-1 border border-opacity-10 rounded d-flex align-items-center justify-content-center bg-white">
                                        <img src="images/logo/html.png" alt="">
                                    </div>
                                    <div class="clearfix ms-3">
                                        <h6 class="mb-0 fw-semibold">Cessna SF150</h6>
                                        <span class="fs-13">cessna-aircraft-class.jsp</span>
                                    </div>
                                    <div class="clearfix ms-auto">
                                        <span class="badge badge-sm badge-light">0</span>
                                    </div>
                                </div>
                                <div
                                    class="alert alert-primary border-primary outline-dashed py-3 px-3 mt-4 mb-0 text-black">
                                    <strong class="text-primary">Intive New .NET Collaborators</strong> to creating
                                    great outstanding business to business .jsp modutr class scripts
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-12 col-xl-6 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Activity</h4>
                            </div>
                            <div class="card-body">
                                <div class="widget-timeline-status">
                                    <ul class="timeline">
                                        <li>
                                            <span class="timeline-status">08:30</span>
                                            <div class="timeline-badge border-dark"></div>
                                            <div class="timeline-panel">
                                                <span>Quisque a consequat ante Sit amet magna at volutapt.</span>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="timeline-status">10:30</span>
                                            <div class="timeline-badge border-success"></div>
                                            <div class="timeline-panel">
                                                <span class="text-black fs-14 fw-semibold">Video Sharing</span>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="timeline-status">02:42</span>
                                            <div class="timeline-badge border-danger"></div>
                                            <div class="timeline-panel">
                                                <span class="text-black fs-14 fw-semibold">john just buy your
                                                    product Sell <span class="text-primary">$250</span></span>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="timeline-status">15:40</span>
                                            <div class="timeline-badge border-info"></div>
                                            <div class="timeline-panel">
                                                <span>Mashable, a news website and blog, goes live.</span>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="timeline-status">23:12</span>
                                            <div class="timeline-badge border-warning"></div>
                                            <div class="timeline-panel">
                                                <span class="text-black fs-14 fw-semibold">StumbleUpon is acquired
                                                    by <span class="text-primary">eBay</span></span>
                                            </div>
                                        </li>
                                        <li>
                                            <span class="timeline-status">11:12</span>
                                            <div class="timeline-badge border-primary"></div>
                                            <div class="timeline-panel">
                                                <span>shared this on my fb wall a few months back.</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection