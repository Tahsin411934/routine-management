@extends('panel.index')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mt-4">Session List</h1>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-table me-1"></i>
                        List Of Session
                    </div>
                    <div class="">
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#create">Create
                            Session</button>
                    </div>
                    {{-- create modal start --}}
                    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ url('admin/session-store') }}" method="post">
                                    @csrf
                                    <div class="modal-header d-flex justify-content-between align-items-center">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Session</h1>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Name<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" required>
                                        </div>
                                        <div class="">
                                            <label for="" class="form-label">Status</label>
                                            <select name="status" id="" class="form-control">
                                                <option value="Running">Running</option>
                                                <option value="Completed">Completed</option>
                                            </select>
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
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($sessions as $session)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $session->name }}</td>
                                    <td>{{ $session->status }}</td>
                                    <td>
                                        <button class="btn btn-primary m-2" type="button" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $session->id }}">Edit</button>
                                        <button class="btn btn-danger m-2" type="button" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $session->id }}">Delete</button>
                                    </td>
                                </tr>
                                {{-- edit ngo modal start --}}
                                <div class="modal fade" id="edit{{ $session->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ url('admin/session-update/' . $session->id) }}" method="post">
                                                @csrf
                                                <div class="modal-header d-flex justify-content-between align-items-center">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Session</h1>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Name<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="name" required
                                                            value="{{ $session->name }}">
                                                    </div>
                                                    <div class="">
                                                        <label for="" class="form-label">Status</label>
                                                        <select name="status" id="" class="form-control">
                                                            <option value="Running"
                                                                @if ($session->status == 'Running') selected @endif>Running
                                                            </option>
                                                            <option
                                                                value="Completed"@if ($session->status == 'Completed') selected @endif>
                                                                Completed</option>
                                                        </select>
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
                                <div class="modal fade" id="delete{{ $session->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header text-danger">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Session</h1>
                                            </div>
                                            <div class="modal-body mb-0">
                                                <div class="text-center">
                                                    <p class="mt-3">Are you sure want to delete <br>
                                                        <b>Name : </b><span
                                                            class="text-danger">{{ $session->name }}</span>
                                                        ?
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <a type="button" class="btn btn-danger"
                                                    href="/admin/session-delete/{{ $session->id }}">Delete</a>
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
