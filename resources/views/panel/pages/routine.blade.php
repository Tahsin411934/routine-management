@extends('panel.index')

@section('content')
<main>
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <h1 class="mt-4">Routine For: </h1>
                <form method="GET" action="{{ route('routines.index') }}">
                    <div class="mt-4">
                        <select name="session" id="session" class="form-select" onchange="this.form.submit()">
                            <option value="">-- Select Session --</option>
                            @foreach($sessions as $session)
                            <option value="{{ $session->id }}" {{ $session->id == $selectedSession ? 'selected' : '' }}>
                                {{ $session->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <table class="table align-middle">
                    <thead class="border border-dark">
                        <tr class="border border-dark">
                            <th class="text-center border border-dark">S/N</th>
                            <th class="border border-dark">Date & Day</th>
                            <th class="border border-dark">Semester</th>
                            <th class="border border-dark">Time</th>
                            <th class="border border-dark">Course Name & Code</th>
                            <th class="border border-dark" style="min-width: 250px">Section-Room</th>
                            <th class="border border-dark" style="min-width: 250px">Assign Teacher/s</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach ($routines as $date => $dayRoutines)
                        @php $rowCount = count($dayRoutines); @endphp
                        @foreach ($dayRoutines as $index => $routine)
                        <tr class="border border-dark">
                            {{-- S/N and Date & Day --}}
                            @if ($index === 0)
                            <td class="text-center align-middle border border-dark" rowspan="{{ $rowCount }}">
                                {{ $count++ }}
                            </td>
                            <td class="align-middle border border-dark" rowspan="{{ $rowCount }}">
                                <div class="d-flex flex-column justify-content-center h-100 p-2">
                                    <div>{{ $date }}</div>
                                    <div class="text-muted small">{{ \Carbon\Carbon::parse($date)->format('l') }}</div>
                                </div>
                            </td>
                            @endif

                            {{-- Semester --}}
                            <td class="align-middle border border-dark">{{ $routine->semester }}</td>

                            {{-- Time --}}
                            <td class="align-middle border border-dark">{{ $routine->time }}</td>

                            {{-- Course Name & Code --}}
                            <td class="align-middle border border-dark">
                                <div class="d-flex flex-column">
                                    <div>{{ $routine->course_name }} ({{ $routine->course_code }})</div>
                                    <div class="text-muted small"></div>
                                </div>
                            </td>

                            {{-- Section-Room --}}
                            <td class="align-middle border border-dark">
                                @foreach ($routine->routineSections as $section)
                                    <span class="badge bg-primary text-white mb-1 ">
                                        {{ $section->section }} - {{ $section->room }}
                                    </span>
                                @endforeach
                            </td>

                            {{-- Assign Teachers --}}
                            <td class="align-middle border border-dark">
                                @foreach ($routine->routineSections as $section)
                                    <div class="mb-2">
                                        <span class="mb-1">
                                            {{ $section->room }} -->
                                        </span>
                                     
                                            @foreach ($section->routineTeachers as $routineTeacher)
                                                <span class="text-black">
                                                    {{ $routineTeacher->teacher->name }}
                                                    @if(!$loop->last), @endif
                                                </span>
                                            @endforeach
                                      
                                    </div>
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection