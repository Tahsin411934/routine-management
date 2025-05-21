@extends('panel.index')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mt-4">Teacher List</h1>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-table me-1"></i>
                        List Of Teacher
                    </div>
                    <div class="">
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#create">Create
                            Teacher</button>
                    </div>
                    {{-- create modal start --}}
                    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ url('admin/teacher-store') }}" method="post">
                                    @csrf
                                    <div class="modal-header d-flex justify-content-between align-items-center">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Teacher</h1>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Name<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Email<span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Designation<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="designation" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Priority<span
                                                    class="text-danger">*</span><span>(Same value has same
                                                    priority And higher value has higher priority.)</span></label>
                                            <input type="number" class="form-control" name="priority" min="1"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">New Password<span
                                                    class="text-danger">*</span></label>
                                            <input type="password" class="form-control" name="password" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Confirm Password<span
                                                    class="text-danger">*</span></label>
                                            <input type="password" class="form-control" name="confirm_password" required>
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
                                <th>Email</th>
                                <th>Designation</th>
                                <th>Priority</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Designation</th>
                                <th>Priority</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($teachers as $user)
                                <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->designation }}</td>
                                    <td>{{ $user->priority }}</td>
                                    <td>
                                        <button class="btn btn-primary m-2" type="button" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $user->id }}">Edit</button>
                                        <button class="btn btn-danger m-2" type="button" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $user->id }}">Delete</button>
                                    </td>
                                </tr>
                                {{-- edit ngo modal start --}}
                                <div class="modal fade" id="edit{{ $user->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ url('admin/teacher-update/' . $user->id) }}" method="post">
                                                @csrf
                                                <div class="modal-header d-flex justify-content-between align-items-center">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update User</h1>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Name<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="name"
                                                            required value="{{ $user->name }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Email<span
                                                                class="text-danger">*</span></label>
                                                        <input type="email" class="form-control" name="email"
                                                            required value="{{ $user->email }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Designation<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="designation"
                                                            required value="{{ $user->designation }}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Prority<span
                                                                class="text-danger">*</span><span>(Same value has same
                                                                priority And higher value has higher
                                                                priority.)</span></label>
                                                        <input type="number" class="form-control" name="priority"
                                                            min="1" required value="{{ $user->priority }}">
                                                    </div>
                                                    <div>
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">New Password</label>
                                                            <input type="password" class="form-control" name="password">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Confirm
                                                                Password</label>
                                                            <input type="password" class="form-control"
                                                                name="confirm_password">
                                                        </div>
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
                                <div class="modal fade" id="delete{{ $user->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header text-danger">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete User</h1>
                                            </div>
                                            <div class="modal-body mb-0">
                                                <div class="text-center">
                                                    <p class="mt-3">Are you sure want to delete <br>
                                                        <b>Name : </b><span class="text-danger">{{ $user->name }}</span>
                                                        ?
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <a type="button" class="btn btn-danger"
                                                    href="/admin/teacher-delete/{{ $user->id }}">Delete</a>
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
