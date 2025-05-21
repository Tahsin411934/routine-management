@extends('panel.index')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mt-4">Profile</h1>
                </div>
                <div>
                    <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#change_pass">Change
                        Password</button>
                    {{-- change pass modal start --}}
                    <div class="modal fade" id="change_pass" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header text-danger">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Change Password</h1>
                                </div>
                                <div class="modal-body mb-0">
                                    <form action="{{ url('change-password') }}" method="post">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="" class="form-label">Current Password<span
                                                    class="text-danger">*</span></label>
                                            <input type="password" class="form-control" name="current_password" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">New Password<span
                                                    class="text-danger">*</span></label>
                                            <input type="password" class="form-control" name="new_password" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Confirm Password<span
                                                    class="text-danger">*</span></label>
                                            <input type="password" class="form-control" name="confirm_password" required>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Change</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- change pass modal end --}}
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <p><b>Name : </b>{{ Auth::user()->name }}</p>
                    <p><b>Email : </b>{{ Auth::user()->email }}</p>
                    <p><b>Role : </b>{{ Auth::user()->role }}</p>
                </div>
            </div>
        </div>
    </main>
@endsection
