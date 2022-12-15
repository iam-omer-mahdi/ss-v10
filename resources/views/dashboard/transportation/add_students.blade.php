@extends('layouts.app')

@section('content')
<div class="container">
    <header class="d-flex justify-content-between">
        <h1 class="h5 fw-bold">اضافة الطلاب</h1>
    </header>

    <form action="{{ route('transportation.store_students') }}" method="POST" class="bg-white shadow-sm p-4 mt-4">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center"><input type="checkbox" id="checkAll"></th>
                    <th>اسم الطالب</th>
                    <th>المدرسة</th>
                    <th>الصف</th>
                    <th>الفصل</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr>
                    <td class="text-center">
                        <input type="checkbox" name="students[]" class="student" id="student_{{$loop->iteration}}" value="{{ $student->id }}">
                    </td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->classroom->grade->school->name }}</td>
                    <td>{{ $student->classroom->grade->name }}</td>
                    <td>{{ $student->classroom->name }}</td>
                </tr>
                @empty
                    <tr class="text-center">
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <input type="hidden" name="transportation_id" value="{{ $transportation_id }}">
        <button type="submit" class="btn btn-primary w-100">اضافة</button>
    </form>
</div>

<script>
    let checkAll = document.querySelector('#checkAll');
    
    checkAll.addEventListener('change', function() {
        let students = document.querySelectorAll('.student');

        students.forEach(student => {
            student.checked = checkAll.checked
        });
    }) 
    
</script>

@endsection