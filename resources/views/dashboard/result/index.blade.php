@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="h4 mb-4">النتائج</h1>
        <form action="{{ route('result.result_report') }}" method="GET" class="card p-4 shadow-sm">
            <div class="mb-3">
                <label for="school_id" class="form-label">المدرسة</label>
                <select onchange="getGrades(this.value)" name="school_id" id="school_id" class="form-select" required>
                    <option selected disabled value="">- اختر المدرسة -</option>
                    @foreach($schools as $school)
                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- Grade --}}
            <div class="mb-3">
                <label for="grade" class="form-label">الصف</label>

                <select onchange="getClassrooms(this.value)" name="grade" id="grade" class="form-select mb-2" required>
                    <option selected disabled value="">- اختر الصف -</option>
                </select>
            </div>
            {{-- Exam --}}
            <div class="mb-3">
                <label for="exam" class="form-label">الامتحان</label>
                <select name="exam" id="exam" class="form-select mb-2" required>
                    <option selected disabled value="">- اختر الامتحان -</option>
                </select>
            </div>
            {{-- Classroom --}}
            <div class="mb-3">
                <label for="classroom" class="form-label">الفصل</label>
                <select name="classroom" id="classroom" class="form-select mb-2">
                    <option selected disabled value="0">- اختر الفصل -</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">عرض</button>
            
        </form>
    </div>

    {{-- Ajax --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
            function getGrades(value) {
                if (value != 0) {
                    $.ajax({
                        url: "{{ route('report.getGrades') }}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: value
                        },
                        success: function (grades) {
                            $('#grade').html('<option selected disabled value="">- كل الصفوف -</option>');
                            $('#classroom').html('<option selected disabled value="">- كل الفصول -</option>');

                            grades.forEach(grade => {
                                $('#grade').append(
                                    `<option value='${grade.id}'>${grade.name}</option>`
                                )
                            });
                        },
                    })
                }
            }
            function getClassrooms(value) {
                if (value != 0) {
                    $.ajax({
                        url: "{{ route('report.getClasses') }}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: value
                        },
                        success: function (classes) {
                            $('#classroom').html('<option selected disabled value="">- كل الفصول -</option>');
                            classes.forEach(classroom => {
                                $('#classroom').append(
                                    `<option value='${classroom.id}'>${classroom.name}</option>`
                                )
                            });
                            getExams(value);
                            console.log(';;');
                        },
                    })
                }
            }
            function getExams(value) {
                if (value != 0) {
                    $.ajax({
                        url: "{{ route('report.getExams') }}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: value
                        },
                        success: function (exams) {
                            $('#exam').html('<option selected disabled value="">- اختر الامتحان -</option>');
                            exams.forEach(exam => {
                                $('#exam').append(
                                    `<option value='${exam.id}'>${exam.name}</option>`
                                )
                            });
                        },
                    })
                }
            }
    </script>
@endsection