@extends('panel.index')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mt-4">Offer List</h1>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-table me-1"></i>
                        List Of Offer
                    </div>
                    <div class="">
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#create">Create
                            Offer</button>
                    </div>
                    {{-- create modal start --}}
                    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ url('admin/offer-list-store') }}" method="post">
                                    @csrf
                                    <div class="modal-header d-flex justify-content-between align-items-center">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Offer</h1>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Session<span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" name="session_id">
                                                <option value="" selected>--Select--</option>
                                                @foreach ($sessions as $session)
                                                    <option value="{{ $session->id }}">
                                                        {{ $session->name }}({{ $session->status }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Semester<span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select" name="semester_id">
                                                <option value="" selected>--Select--</option>
                                                @foreach ($semesters as $semester)
                                                    <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Section<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="section" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Cource Code<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="course_code" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Cource Title<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="course_title" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Cource Credit<span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" name="course_credit" min="0"
                                                step="0.01" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex align-items-center">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Create</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- create modal end --}}
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
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
                                <th>Actions</th>
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
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($offerList as $offer)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $offer->session?->name }}({{ $offer->session?->status }})</td>
                                    <td>{{ $offer->semester->name }}</td>
                                    <td>{{ $offer->section }}</td>
                                    <td>{{ $offer->course_code }}</td>
                                    <td>{{ $offer->course_title }}</td>
                                    <td>{{ $offer->course_credit }}</td>
                                    <td>
                                        <button class="btn btn-primary m-2" type="button" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $offer->id }}">Edit</button>
                                        <button class="btn btn-danger m-2" type="button" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $offer->id }}">Delete</button>
                                    </td>
                                </tr>
                                {{-- edit ngo modal start --}}
                                <div class="modal fade" id="edit{{ $offer->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ url('admin/offer-list-update/' . $offer->id) }}"
                                                method="post">
                                                @csrf
                                                <div class="modal-header d-flex justify-content-between align-items-center">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Offer</h1>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Session<span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-select" name="session_id">
                                                            <option value="" selected>--Select--</option>
                                                            @foreach ($sessions as $session)
                                                                <option value="{{ $session->id }}"
                                                                    @if ($offer->session_id == $session->id) selected @endif>
                                                                    {{ $session->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Semester<span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-select" name="semester_id">
                                                            <option value="" selected>--Select--</option>
                                                            @foreach ($semesters as $semester)
                                                                <option value="{{ $semester->id }}"
                                                                    @if ($offer->semester_id == $semester->id) selected @endif>
                                                                    {{ $semester->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Section<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="section"
                                                            value="{{ $offer->section }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Cource Code<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="course_code"
                                                            value="{{ $offer->course_code }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Cource Title<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="course_title"
                                                            value="{{ $offer->course_title }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Cource Credit<span
                                                                class="text-danger">*</span></label>
                                                        <input type="number" class="form-control" name="course_credit"
                                                            min="0" step="0.01"
                                                            value="{{ $offer->course_credit }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer d-flex align-items-center">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- edit ngo modal end --}}
                                {{-- delete modal start --}}
                                <div class="modal fade" id="delete{{ $offer->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header text-danger">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Offer</h1>
                                            </div>
                                            <div class="modal-body mb-0">
                                                <div class="text-center">
                                                    <p class="mt-3">Are you sure want to delete <br>
                                                        <b>Cource Code : </b><span
                                                            class="text-danger">{{ $offer->course_code }}</span><br>
                                                        <b>Cource Title : </b><span
                                                            class="text-danger">{{ $offer->course_title }}</span>
                                                        ?
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <a type="button" class="btn btn-danger"
                                                    href="/admin/offer-list-delete/{{ $offer->id }}">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- delete modal end --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {

        });
    </script>
@endpush
