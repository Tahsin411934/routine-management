@extends('panel.index')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mt-4">Semester List</h1>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-table me-1"></i>
                        List Of Semester
                    </div>
                    <div class="">
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#create">Create
                            Semester</button>
                    </div>
                    {{-- create modal start --}}
                    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ url('admin/semester-store') }}" method="post">
                                    @csrf
                                    <div class="modal-header d-flex justify-content-between align-items-center">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Semester</h1>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Name<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" required>
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
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($semesters as $semester)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $semester->name }}</td>
                                    <td>
                                        <button class="btn btn-primary m-2" type="button" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $semester->id }}">Edit</button>
                                        <button class="btn btn-danger m-2" type="button" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $semester->id }}">Delete</button>
                                    </td>
                                </tr>
                                {{-- edit ngo modal start --}}
                                <div class="modal fade" id="edit{{ $semester->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ url('admin/semester-update/' . $semester->id) }}"
                                                method="post">
                                                @csrf
                                                <div class="modal-header d-flex justify-content-between align-items-center">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Semester</h1>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Name<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="name" required
                                                            value="{{ $semester->name }}">
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
                                <div class="modal fade" id="delete{{ $semester->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header text-danger">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Semester</h1>
                                            </div>
                                            <div class="modal-body mb-0">
                                                <div class="text-center">
                                                    <p class="mt-3">Are you sure want to delete <br>
                                                        <b>Name : </b><span class="text-danger">{{ $semester->name }}</span>
                                                        ?
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <a type="button" class="btn btn-danger"
                                                    href="/admin/semester-delete/{{ $semester->id }}">Delete</a>
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
