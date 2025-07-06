@extends('panel.index')

@section('content')
<main>
    <div class="container-fluid px-4">
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-5">
                <h1 class="mt-4">Routine Management: </h1>
                <form method="GET" action="{{ route('routines.manage') }}">
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
            <div>
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#create">Create
                    Routine</button>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i> List of Routines
            </div>

            {{-- Create Modal --}}
            <div class="modal fade" id="create" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('routines.store') }}" method="POST" id="createRoutineForm">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Create Routine</h5>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="session">Session<span class="text-danger">*</span></label>
                                    <select class="form-select" name="session" required>
                                        <option value="">-- Select Session --</option>
                                        @foreach($sessions as $session)
                                        <option value="{{ $session->id }}">{{ $session->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="date">Date<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="date" required>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col">
                                        <label for="start_time">Start Time<span class="text-danger">*</span></label>
                                        <input type="time" class="form-control" name="start_time" required>
                                    </div>
                                    <div class="col">
                                        <label for="end_time">End Time<span class="text-danger">*</span></label>
                                        <input type="time" class="form-control" name="end_time" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="semester">Semester<span class="text-danger">*</span></label>
                                    <select class="form-select" name="semester" required>
                                        <option value="">-- Select Semester --</option>
                                        @foreach($semesters as $semester)
                                        <option value="{{ $semester->name }}">{{ $semester->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="course_name">Course Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="course_name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="course_code">Course Code<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="course_code" required>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0">Sections with Teachers</h5>
                                    <button type="button" class="btn btn-sm btn-primary" id="addSection">
                                        <i class="fas fa-plus"></i> Add Section
                                    </button>
                                </div>
                                <div id="sections">
                                    <div class="section-group mb-4 border p-3 rounded">
                                        <div class="row g-2 mb-3 align-items-end">
                                            <div class="col-5">
                                                <label>Section<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="sections[0][section]"
                                                    required>
                                            </div>
                                            <div class="col-5">
                                                <label>Room<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="sections[0][room]"
                                                    required>
                                            </div>
                                            <div class="col-2">
                                                <button type="button" class="btn btn-sm btn-danger remove-section"
                                                    disabled>
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="teachers-container" data-section-index="0">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="mb-0">Teachers for this section</h6>
                                                <button type="button" class="btn btn-sm btn-primary add-teacher"
                                                    data-section-index="0">
                                                    <i class="fas fa-plus"></i> Add Teacher
                                                </button>
                                            </div>
                                            <div class="teacher-rows">
                                                <div class="row g-2 mb-3 align-items-end">
                                                    <div class="col-10">
                                                        <label>Teacher<span class="text-danger">*</span></label>
                                                        <select class="form-select"
                                                            name="sections[0][teachers][0][teacher_id]" required>
                                                            <option value="">-- Select Teacher --</option>
                                                            @foreach($teachers as $teacher)
                                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">This teacher is already assigned to another section.</div>
                                                    </div>
                                                    <div class="col-2">
                                                        <button type="button"
                                                            class="btn btn-sm btn-danger remove-teacher" disabled>
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Edit Modals --}}
            @foreach($routines as $date => $dayRoutines)
            @foreach($dayRoutines as $routine)
            <div class="modal fade" id="edit{{ $routine->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('routines.update', $routine->id) }}" method="POST" id="editRoutineForm{{ $routine->id }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Routine</h5>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="session">Session<span class="text-danger">*</span></label>
                                    <select class="form-select" name="session" required>
                                        @foreach($sessions as $session)
                                        <option value="{{ $session->id }}"
                                            {{ $session->id == $routine->session_id ? 'selected' : '' }}>
                                            {{ $session->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="date">Date<span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="date" value="{{ $routine->date }}"
                                        required>
                                </div>
                                @php
                                $times = explode(' - ', $routine->time);
                                $start = \Carbon\Carbon::createFromFormat('g:i A',
                                $times[0])->format('H:i');
                                $end = \Carbon\Carbon::createFromFormat('g:i A', $times[1])->format('H:i');
                                @endphp

                                <div class="mb-3 row">
                                    <div class="col">
                                        <label>Start Time<span class="text-danger">*</span></label>
                                        <input type="time" class="form-control" name="start_time" value="{{ $start }}"
                                            required>
                                    </div>
                                    <div class="col">
                                        <label>End Time<span class="text-danger">*</span></label>
                                        <input type="time" class="form-control" name="end_time" value="{{ $end }}"
                                            required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="semester">Semester<span class="text-danger">*</span></label>
                                    <select class="form-select" name="semester" required>
                                        @foreach($semesters as $semester)
                                        <option value="{{ $semester->name }}"
                                            {{ $semester->name == $routine->semester ? 'selected' : '' }}>
                                            {{ $semester->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="course_name">Course Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="course_name"
                                        value="{{ $routine->course_name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="course_code">Course Code<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="course_code"
                                        value="{{ $routine->course_code }}" required>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0">Sections with Teachers</h5>
                                    <button type="button" class="btn btn-sm btn-primary"
                                        onclick="addEditSection({{ $routine->id }})">
                                        <i class="fas fa-plus"></i> Add Section
                                    </button>
                                </div>
                                <div id="edit-sections-{{ $routine->id }}">
                                    @foreach($routine->routineSections as $sectionIndex => $section)
                                    <div class="section-group mb-4 border p-3 rounded">
                                        <div class="row g-2 mb-3 align-items-end">
                                            <div class="col-5">
                                                <label>Section<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    name="sections[{{ $sectionIndex }}][section]"
                                                    value="{{ $section->section }}" required>
                                            </div>
                                            <div class="col-5">
                                                <label>Room<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    name="sections[{{ $sectionIndex }}][room]"
                                                    value="{{ $section->room }}" required>
                                            </div>
                                            <div class="col-2">
                                                <button type="button" class="btn btn-sm btn-danger remove-section"
                                                    @if($sectionIndex===0) disabled @endif>
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="teachers-container" data-section-index="{{ $sectionIndex }}">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="mb-0">Teachers for this section</h6>
                                                <button type="button" class="btn btn-sm btn-primary add-teacher"
                                                    data-section-index="{{ $sectionIndex }}">
                                                    <i class="fas fa-plus"></i> Add Teacher
                                                </button>
                                            </div>
                                            <div class="teacher-rows">
                                                @foreach($section->teachers as $teacherIndex => $teacher)
                                                <div class="row g-2 mb-3 align-items-end">
                                                    <div class="col-10">
                                                        <label>Teacher<span class="text-danger">*</span></label>
                                                        <select class="form-select"
                                                            name="sections[{{ $sectionIndex }}][teachers][{{ $teacherIndex }}][teacher_id]"
                                                            required>
                                                            <option value="">-- Select Teacher --</option>
                                                            @foreach($teachers as $t)
                                                            <option value="{{ $t->id }}"
                                                                {{ $t->id == $teacher->id ? 'selected' : '' }}>
                                                                {{ $t->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">This teacher is already assigned to another section.</div>
                                                    </div>
                                                    <div class="col-2">
                                                        <button type="button"
                                                            class="btn btn-sm btn-danger remove-teacher"
                                                            @if($teacherIndex===0) disabled @endif>
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
            @endforeach

            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th class="text-center">S/N</th>
                            <th>Date & Day</th>
                            <th>Semester</th>
                            <th>Time</th>
                            <th>Course Name & Code</th>
                            <th style="min-width: 250px">Section-Room with Teachers</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach ($routines as $date => $dayRoutines)
                        <tr>
                            <td class="text-center">{{ $count++ }}</td>
                            <td>
                                <div class="d-flex flex-column justify-content-center" style="height: 100%">
                                    <div>{{ $date }}</div>
                                    <div class="text-muted small">{{ \Carbon\Carbon::parse($date)->format('l') }}</div>
                                </div>
                            </td>
                            <td>
                                @foreach ($dayRoutines as $routine)
                                <div class="d-flex align-items-center" style="height: 100%; min-height: 80px">
                                    {{ $routine->semester }}
                                </div>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($dayRoutines as $routine)
                                <div class="d-flex align-items-center" style="height: 100%; min-height: 80px">
                                    {{ $routine->time }}
                                </div>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($dayRoutines as $routine)
                                <div class="d-flex flex-column justify-content-center"
                                    style="height: 100%; min-height: 80px">
                                    <div>{{ $routine->course_name }}</div>
                                    <div class="text-muted small">{{ $routine->course_code }}</div>
                                </div>
                                @endforeach
                            </td>
                            <td>
                                <div style="max-height: 300px; overflow-y: auto;">
                                    @foreach ($dayRoutines as $routine)
                                    <div class="p-2 mb-2 border rounded bg-light">
                                        @foreach ($routine->routineSections as $section)
                                        <div class="mb-2">
                                            <span class="badge bg-primary text-white mb-1">
                                                {{ $section->section }} - {{ $section->room }}
                                            </span>

                                            @foreach ($section->routineTeachers as $routineTeacher)
                                            <span class="text-black">
                                                {{ $routineTeacher->teacher->name }}({{ $routineTeacher->teacher->shortName }}) ,
                                            </span>
                                            @endforeach

                                        </div>
                                        @endforeach
                                    </div>
                                    @endforeach
                                </div>
                            </td>
                            <td class="text-center">
                                @foreach ($dayRoutines as $routine)
                                <div class="d-flex flex-column gap-1 justify-content-center"
                                    style="height: 100%; min-height: 80px">
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#edit{{ $routine->id }}">
                                        Edit
                                    </button>
                                    <form action="{{ route('routines.destroy', $routine->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                            </i> Delete
                                        </button>
                                    </form>
                                </div>
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <style>
            #datatablesSimple tbody tr {
                height: auto;
            }

            #datatablesSimple td {
                vertical-align: middle;
                padding: 0.75rem;
            }

            .table-striped tbody tr:nth-of-type(odd) {
                background-color: rgba(0, 0, 0, 0.02);
            }

            .table-striped tbody tr:hover {
                background-color: rgba(0, 0, 0, 0.04);
            }
            
            .is-invalid {
                border-color: #dc3545 !important;
            }

            .invalid-feedback {
                display: none;
                width: 100%;
                margin-top: 0.25rem;
                font-size: 0.875em;
                color: #dc3545;
            }

            .is-invalid ~ .invalid-feedback {
                display: block;
            }
            </style>
        </div>
    </div>
</main>
@endsection

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Function to check for duplicate teachers
    function checkForDuplicateTeachers(container) {
        const allTeacherSelects = container.querySelectorAll('select[name*="[teacher_id]"]');
        const selectedValues = {};
        let hasDuplicates = false;

        allTeacherSelects.forEach(select => {
            if (select.value && select.value !== '') {
                if (selectedValues[select.value]) {
                    hasDuplicates = true;
                    select.classList.add('is-invalid');
                } else {
                    selectedValues[select.value] = true;
                    select.classList.remove('is-invalid');
                }
            }
        });

        return hasDuplicates;
    }

    // Add Section in Create Modal
    const addSectionBtn = document.getElementById('addSection');
    if (addSectionBtn) {
        addSectionBtn.addEventListener('click', function() {
            const sectionsContainer = document.getElementById('sections');
            const sectionIndex = document.querySelectorAll('#sections .section-group').length;

            const sectionGroup = document.createElement('div');
            sectionGroup.classList.add('section-group', 'mb-4', 'border', 'p-3', 'rounded');
            sectionGroup.innerHTML = `
                <div class="row g-2 mb-3 align-items-end">
                    <div class="col-5">
                        <label>Section<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="sections[${sectionIndex}][section]" required>
                    </div>
                    <div class="col-5">
                        <label>Room<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="sections[${sectionIndex}][room]" required>
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-sm btn-danger remove-section">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="teachers-container" data-section-index="${sectionIndex}">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0">Teachers for this section</h6>
                        <button type="button" class="btn btn-sm btn-primary add-teacher" data-section-index="${sectionIndex}">
                            <i class="fas fa-plus"></i> Add Teacher
                        </button>
                    </div>
                    <div class="teacher-rows">
                        <div class="row g-2 mb-3 align-items-end">
                            <div class="col-10">
                                <label>Teacher<span class="text-danger">*</span></label>
                                <select class="form-select" name="sections[${sectionIndex}][teachers][0][teacher_id]" required>
                                    <option value="">-- Select Teacher --</option>
                                    @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">This teacher is already assigned to another section.</div>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-sm btn-danger remove-teacher" disabled>
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>`;

            sectionsContainer.appendChild(sectionGroup);
            updateRemoveButtons();
            
            // Add change event to new teacher selects
            sectionGroup.querySelectorAll('select[name*="[teacher_id]"]').forEach(select => {
                select.addEventListener('change', function() {
                    checkForDuplicateTeachers(document.getElementById('create'));
                });
            });
        });
    }

    // Add Teacher to Section in Create Modal
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('add-teacher') ||
            (e.target.parentElement && e.target.parentElement.classList.contains('add-teacher'))) {
            const btn = e.target.classList.contains('add-teacher') ? e.target : e.target.parentElement;
            const sectionIndex = btn.getAttribute('data-section-index');
            const teachersContainer = btn.closest('.teachers-container').querySelector('.teacher-rows');
            const teacherIndex = teachersContainer.querySelectorAll('.row').length;

            // Check for duplicates before adding
            if (checkForDuplicateTeachers(document.getElementById('create'))) {
                alert('This teacher is already assigned to another section in this routine.');
                return;
            }

            const teacherRow = document.createElement('div');
            teacherRow.classList.add('row', 'g-2', 'mb-3', 'align-items-end');
            teacherRow.innerHTML = `
                <div class="col-10">
                    <label>Teacher<span class="text-danger">*</span></label>
                    <select class="form-select" name="sections[${sectionIndex}][teachers][${teacherIndex}][teacher_id]" required>
                        <option value="">-- Select Teacher --</option>
                        @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">This teacher is already assigned to another section.</div>
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-sm btn-danger remove-teacher">
                        <i class="fas fa-times"></i>
                    </button>
                </div>`;

            teachersContainer.appendChild(teacherRow);
            updateRemoveButtons();
            
            // Add change event to new teacher select
            teacherRow.querySelector('select').addEventListener('change', function() {
                checkForDuplicateTeachers(document.getElementById('create'));
            });
        }
    });

    // Remove section/teacher handlers for Create Modal
    document.addEventListener('click', function(e) {
        // Remove section
        if (e.target.classList.contains('remove-section') ||
            (e.target.parentElement && e.target.parentElement.classList.contains('remove-section'))) {
            const btn = e.target.classList.contains('remove-section') ? e.target : e.target.parentElement;
            const sectionGroup = btn.closest('.section-group');
            if (sectionGroup) {
                sectionGroup.remove();
                updateRemoveButtons();
                checkForDuplicateTeachers(document.getElementById('create'));
            }
        }

        // Remove teacher
        if (e.target.classList.contains('remove-teacher') ||
            (e.target.parentElement && e.target.parentElement.classList.contains('remove-teacher'))) {
            const btn = e.target.classList.contains('remove-teacher') ? e.target : e.target.parentElement;
            const teacherRow = btn.closest('.row');
            if (teacherRow) {
                teacherRow.remove();
                updateRemoveButtons();
                checkForDuplicateTeachers(document.getElementById('create'));
            }
        }
    });

    // Function to update remove buttons state
    function updateRemoveButtons() {
        // Sections - only allow removing if more than one exists
        const sectionGroups = document.querySelectorAll('.section-group');
        sectionGroups.forEach((group, index) => {
            const removeBtn = group.querySelector('.remove-section');
            if (removeBtn) {
                removeBtn.disabled = sectionGroups.length <= 1;
            }

            // Teachers in each section - keep at least one teacher per section
            const teacherRows = group.querySelectorAll('.teacher-rows .row');
            teacherRows.forEach((row, rowIndex) => {
                const removeBtn = row.querySelector('.remove-teacher');
                if (removeBtn) {
                    removeBtn.disabled = teacherRows.length <= 1;
                }
            });
        });
    }

    // Form submission validation for create modal
    document.getElementById('createRoutineForm')?.addEventListener('submit', function(e) {
        if (checkForDuplicateTeachers(document.getElementById('create'))) {
            e.preventDefault();
            alert('Please fix duplicate teacher assignments before submitting.');
        }
    });
});

// Edit Modal Functions
function addEditSection(routineId) {
    const container = document.getElementById(`edit-sections-${routineId}`);
    const sectionIndex = container.querySelectorAll('.section-group').length;

    const sectionGroup = document.createElement('div');
    sectionGroup.classList.add('section-group', 'mb-4', 'border', 'p-3', 'rounded');
    sectionGroup.innerHTML = `
        <div class="row g-2 mb-3 align-items-end">
            <div class="col-5">
                <label>Section<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="sections[${sectionIndex}][section]" required>
            </div>
            <div class="col-5">
                <label>Room<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="sections[${sectionIndex}][room]" required>
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-sm btn-danger remove-section">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="teachers-container" data-section-index="${sectionIndex}">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0">Teachers for this section</h6>
                <button type="button" class="btn btn-sm btn-primary add-teacher" data-section-index="${sectionIndex}">
                    <i class="fas fa-plus"></i> Add Teacher
                </button>
            </div>
            <div class="teacher-rows">
                <div class="row g-2 mb-3 align-items-end">
                    <div class="col-10">
                        <label>Teacher<span class="text-danger">*</span></label>
                        <select class="form-select" name="sections[${sectionIndex}][teachers][0][teacher_id]" required>
                            <option value="">-- Select Teacher --</option>
                            @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">This teacher is already assigned to another section.</div>
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-sm btn-danger remove-teacher" disabled>
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>`;

    container.appendChild(sectionGroup);
    updateEditRemoveButtons(routineId);
    
    // Add change event to new teacher selects
    sectionGroup.querySelectorAll('select[name*="[teacher_id]"]').forEach(select => {
        select.addEventListener('change', function() {
            checkForDuplicateTeachers(document.getElementById(`edit${routineId}`));
        });
    });
}

function addEditTeacherToSection(routineId, sectionIndex) {
    const container = document.querySelector(
        `#edit-sections-${routineId} .teachers-container[data-section-index="${sectionIndex}"] .teacher-rows`);
    const teacherIndex = container.querySelectorAll('.row').length;

    // Check for duplicates before adding
    if (checkForDuplicateTeachers(document.getElementById(`edit${routineId}`))) {
        alert('This teacher is already assigned to another section in this routine.');
        return;
    }

    const teacherRow = document.createElement('div');
    teacherRow.classList.add('row', 'g-2', 'mb-3', 'align-items-end');
    teacherRow.innerHTML = `
        <div class="col-10">
            <label>Teacher<span class="text-danger">*</span></label>
            <select class="form-select" name="sections[${sectionIndex}][teachers][${teacherIndex}][teacher_id]" required>
                <option value="">-- Select Teacher --</option>
                @foreach($teachers as $teacher)
                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">This teacher is already assigned to another section.</div>
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-sm btn-danger remove-teacher">
                <i class="fas fa-times"></i>
            </button>
        </div>`;

    container.appendChild(teacherRow);
    updateEditRemoveButtons(routineId);
    
    // Add change event to new teacher select
    teacherRow.querySelector('select').addEventListener('change', function() {
        checkForDuplicateTeachers(document.getElementById(`edit${routineId}`));
    });
}

function updateEditRemoveButtons(routineId) {
    const container = document.getElementById(`edit-sections-${routineId}`);
    if (!container) return;

    // Sections - only allow removing if more than one exists
    const sectionGroups = container.querySelectorAll('.section-group');
    sectionGroups.forEach((group, index) => {
        const removeBtn = group.querySelector('.remove-section');
        if (removeBtn) {
            removeBtn.disabled = sectionGroups.length <= 1;
        }

        // Teachers in each section - keep at least one teacher per section
        const teacherRows = group.querySelectorAll('.teacher-rows .row');
        teacherRows.forEach((row, rowIndex) => {
            const removeBtn = row.querySelector('.remove-teacher');
            if (removeBtn) {
                removeBtn.disabled = teacherRows.length <= 1;
            }
        });
    });
}

// Handle remove buttons in Edit Modals
document.addEventListener('click', function(e) {
    // Remove section in edit modal
    if (e.target.classList.contains('remove-section') ||
        (e.target.parentElement && e.target.parentElement.classList.contains('remove-section'))) {
        const btn = e.target.classList.contains('remove-section') ? e.target : e.target.parentElement;
        const sectionGroup = btn.closest('.section-group');
        if (sectionGroup) {
            const modal = sectionGroup.closest('.modal');
            const routineId = modal.id.replace('edit', '');
            sectionGroup.remove();
            updateEditRemoveButtons(routineId);
            checkForDuplicateTeachers(modal);
        }
    }

    // Remove teacher in edit modal
    if (e.target.classList.contains('remove-teacher') ||
        (e.target.parentElement && e.target.parentElement.classList.contains('remove-teacher'))) {
        const btn = e.target.classList.contains('remove-teacher') ? e.target : e.target.parentElement;
        const teacherRow = btn.closest('.row');
        if (teacherRow) {
            const modal = teacherRow.closest('.modal');
            const routineId = modal.id.replace('edit', '');
            teacherRow.remove();
            updateEditRemoveButtons(routineId);
            checkForDuplicateTeachers(modal);
        }
    }

    // Add teacher to section in edit modal
    if (e.target.classList.contains('add-teacher') ||
        (e.target.parentElement && e.target.parentElement.classList.contains('add-teacher'))) {
        const btn = e.target.classList.contains('add-teacher') ? e.target : e.target.parentElement;
        const sectionIndex = btn.getAttribute('data-section-index');
        const modal = btn.closest('.modal');
        const routineId = modal.id.replace('edit', '');
        addEditTeacherToSection(routineId, sectionIndex);
    }
});

// Add change event listeners to existing teacher selects in edit modals
document.querySelectorAll('.modal[id^="edit"] select[name*="[teacher_id]"]').forEach(select => {
    select.addEventListener('change', function() {
        const modal = this.closest('.modal');
        checkForDuplicateTeachers(modal);
    });
});

// Form submission validation for edit modals
document.querySelectorAll('form[id^="editRoutineForm"]').forEach(form => {
    form.addEventListener('submit', function(e) {
        const modal = this.closest('.modal');
        if (checkForDuplicateTeachers(modal)) {
            e.preventDefault();
            alert('Please fix duplicate teacher assignments before submitting.');
        }
    });
});
</script>