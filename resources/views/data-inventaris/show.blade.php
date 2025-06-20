@extends('layouts.app')

@section('content')

    @include('data-inventaris.header-show')
    <div class="tab-content" id="tabContentMyProfileBottom">
        <div class="row">
            <div class="col-xl-6">
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
                                                <h6 class="mb-0 fw-semibold">{{$wo->getDitugaskanOleh->name}}</h6>
                                                <span class="fs-13">{{$wo->created_at}}</span>
                                            </div>
                                        </div>
                                        <div class="clearfix ms-auto">
                                            <button type="button"
                                                class="btn btn-light btn-icon-xxs tp-btn fs-18 align-self-start"><i
                                                    class="bi bi-grid"></i></button>
                                        </div>
                                    </div>
                                    <div class="clearfix text-black">
                                        <p class="fs-14 mb-2 fw-bold">{{$wo->Judul}}</p>
                                        <p class="fs-14 mb-2">{{$wo->Kasus}}</p>
                                    </div>
                                    <div class="clearfix pt-1">
                                        <span class="badge badge-rounded badge-outline-primary me-2">
                                            {{ $wo->getDepartemen ? $wo->getDepartemen->NamaDepartemen : '-' }}
                                        </span>
                                        <span class="badge badge-rounded badge-outline-primary">
                                            {{ $wo->getUnit ? $wo->getUnit->NamaUnit : '-' }}
                                        </span>
                                    </div>
                                    <div class="position-relative border-top border-opacity-10 d-flex align-items-center mt-3">
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
                        s
                    @endforelse




                </div>
            </div>
            <div class="col-xl-6">
                <div class="row sticky-top z-0">

                    <div class="col-xxl-12 col-xl-12 col-md-6">
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

                    {{-- <div class="col-xxl-12 col-xl-6 col-md-6">
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
                    </div> --}}



                </div>
            </div>
        </div>
    </div>
@endsection