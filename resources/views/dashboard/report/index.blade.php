@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('report.report') }}" method="POST" x-data="{ type: 0 }" class="card p-4">
            @csrf
            <div class="mb-3">
                <label for="report_type" class="form-label">نوع التقرير</label>
                <select name="report_type" id="report_type" class="form-select" x-model="type">
                    <option selected disabled value="0">- التقارير -</option>
                    <option value="1">احصائيات المدارس</option>
                    <option value="2">احصائيات الطلاب</option>
                    <option value="3">سداد الطلاب</option>
                </select>
            </div>

            <template x-if="type == 3">
                <div>
                    <label for="report_type" class="form-label">المدرسة</label>
                    <select onchange="getGrades(this.value)" name="school" id="school" class="form-select mb-2">
                        <option selected disabled value="0">- اختر المدرسة -</option>
                        @foreach($schools as $school)
                            <option value="{{ $school->id }}">{{ $school->name }}</option>
                        @endforeach
                    </select>
                    <label for="report_type" class="form-label">الصف</label>
                    <select onchange="getClassrooms(this.value)" name="grade" id="grade" class="form-select mb-2">
                        <option selected disabled value="0">- اختر الصف -</option>
                    </select>
                    <label for="report_type" class="form-label">الفصل</label>
                    <select name="classroom" id="classroom" class="form-select mb-2">
                        <option selected disabled value="0">- اختر الفصل -</option>
                    </select>
                </div>
            </template>

            <button type="submit" class="btn btn-primary mt-4">عرض</button>
        </form>
    </div>

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
                            $('#grade').html('<option selected disabled value="0">- كل الصفوف -</option>');
                            $('#classroom').html('<option selected disabled value="0">- كل الفصول -</option>');

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
                            $('#classroom').html('<option selected disabled value="0">- كل الفصول -</option>');
                            classes.forEach(classroom => {
                                $('#classroom').append(
                                    `<option value='${classroom.id}'>${classroom.name}</option>`
                                )
                            });
                        },
                    })
                }
            }
    </script>

@endsection


