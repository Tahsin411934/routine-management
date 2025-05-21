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

                    <form action="/teacher/offers" method="get">
                        <div class="d-flex">
                            <div class="mx-4">
                                <select name="session" id="" class="form-control">
                                    <option value="">--All Running Sessions--</option>
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
                <div class="card-body">
                    <form action="{{ url('teacher/offers-store') }}" method="POST">
                        @csrf
                        <table id="" class="table table-striped table-bordered">
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
                                @forelse ($offerList as $offer)
                                    <tr style="{{ $offer->disabled ? 'background-color: #f8d7da;' : '' }}">
                                        <td>{{ $count }}</td>
                                        <td>{{ $offer->session->name }}</td>
                                        <td>{{ $offer->semester->name }}</td>
                                        <td>{{ $offer->section }}</td>
                                        <td>{{ $offer->course_code }}</td>
                                        <td>{{ $offer->course_title }}</td>
                                        <td>{{ $offer->course_credit }}</td>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input p-2 offerlist-id"
                                                    data-credit="{{ $offer->course_credit }}" name="offerlist_id[]"
                                                    value="{{ $offer->id }}" {{ $offer->disabled ? 'disabled' : '' }}>
                                            </div>
                                        </td>
                                    </tr>
                                    @php
                                        $count++;
                                    @endphp
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            <p>No offers left to choose or available.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between">
                            <div>Total Course Credit Selected: <span id="total-course-credit">0</span> <span>(Minimum 15
                                    credits)</span></div>
                            <button type="submit" id="submit-offer" class="btn btn-primary">Submit Offer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            console.log("svfsdv");

            function updateTotalCourseCredit() {
                let total = 0;

                $('.offerlist-id:checked').each(function() {
                    total += parseFloat($(this).data('credit'));
                });

                $('#total-course-credit').text(total.toFixed(2));

                if (total < 15) {
                    $('#submit-offer').prop('disabled', true);
                } else {
                    $('#submit-offer').prop('disabled', false);
                }
            }

            $('.offerlist-id').change(function() {
                updateTotalCourseCredit();
            });

            updateTotalCourseCredit();
        });
    </script>
@endpush
