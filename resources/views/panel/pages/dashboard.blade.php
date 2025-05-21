@extends('panel.index')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            @if (Auth::user()->role == 'admin')
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card mb-4"
                            style="background-color: #BBDEFF; color:black; font-size:24px; font-weight:600">
                            <div class="card-body">Sessions</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small stretched-link" href="/admin/session"><b>{{ $sessionsCount }}</b></a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mb-4"
                            style="background-color: #F4F7FF; color:black; font-size:24px; font-weight:600">
                            <div class="card-body">Semesters </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small stretched-link" href="/admin/semester"><b>{{ $semesters }}</b></a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mb-4"
                            style="background-color: #BBDEFF; color:black; font-size:24px; font-weight:600">
                            <div class="card-body">Teachers</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small stretched-link" href="/admin/teachers"><b>{{ $teachers }}</b></a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card mb-4"
                            style="background-color: #F4F7FF; color:black; font-size:24px; font-weight:600">
                            <div class="card-body">Offers </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small stretched-link" href="/admin/offer-list"><b>{{ $offers }}</b></a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <i class="fas fa-table me-1"></i>
                            Choosen offers history
                        </div>
                        <div>
                            <form action="/dashboard" method="get">
                                <div class="d-flex">
                                    <div class="mx-4">
                                        <select name="session" id="" class="form-control">
                                            <option value="">--All Sessions--</option>
                                            @foreach ($sessions as $session)
                                                <option value="{{ $session->name }}"
                                                    @if ($session->name == $selectedSession) selected @endif>{{ $session->name }}
                                                    ({{ $session->status }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="">
                                        <button class="btn btn-info" type="submit">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple" class="table">
                            @php
                                $count = 1;
                            @endphp
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Session</th>
                                    <th>Semester</th>
                                    <th>Section</th>
                                    <th>Course Code</th>
                                    <th>Course Title</th>
                                    <th>Course Credit</th>
                                    <th>Teacher Name</th>
                                    <th>Teacher Email</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>S/N</th>
                                    <th>Session</th>
                                    <th>Semester</th>
                                    <th>Section</th>
                                    <th>Course Code</th>
                                    <th>Course Title</th>
                                    <th>Course Credit</th>
                                    <th>Teacher Name</th>
                                    <th>Teacher Email</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($selectedOffers as $offer)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $offer->offerList->session->name }}</td>
                                        <td>{{ $offer->offerList->semester->name }}</td>
                                        <td>{{ $offer->offerList->section }}</td>
                                        <td>{{ $offer->offerList->course_code }}</td>
                                        <td>{{ $offer->offerList->course_title }}</td>
                                        <td>{{ $offer->offerList->course_credit }}</td>
                                        <td>{{ $offer->user->name }}</td>
                                        <td>{{ $offer->user->email }}</td>
                                    </tr>
                                    @php
                                        $count++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            <i class="fas fa-table me-1"></i>
                            Choosen offers history
                        </div>
                        <div>
                            <p>Total Credits : {{ $totalCredit }} credits</p>
                        </div>
                        <div>
                            <form action="/dashboard" method="get">
                                <div class="d-flex">
                                    <div class="mx-4">
                                        <select name="session" id="" class="form-control">
                                            <option value="">--All Sessions--</option>
                                            @foreach ($sessions as $session)
                                                <option value="{{ $session->name }}"
                                                    @if ($session->name == $selectedSession) selected @endif>{{ $session->name }}
                                                    ({{ $session->status }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="">
                                        <button class="btn btn-info" type="submit">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple" class="table">
                            @php
                                $count = 1;
                            @endphp
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Session</th>
                                    <th>Semester</th>
                                    <th>Section</th>
                                    <th>Course Code</th>
                                    <th>Course Title</th>
                                    <th>Course Credit</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>S/N</th>
                                    <th>Session</th>
                                    <th>Semester</th>
                                    <th>Section</th>
                                    <th>Course Code</th>
                                    <th>Course Title</th>
                                    <th>Course Credit</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($selectedOffers as $offer)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $offer->offerList->session->name }}</td>
                                        <td>{{ $offer->offerList->semester->name }}</td>
                                        <td>{{ $offer->offerList->section }}</td>
                                        <td>{{ $offer->offerList->course_code }}</td>
                                        <td>{{ $offer->offerList->course_title }}</td>
                                        <td>{{ $offer->offerList->course_credit }}</td>
                                    </tr>
                                    @php
                                        $count++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </main>
@endsection
