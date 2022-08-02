@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="h4 mb-4">احصائيات الطلاب</h1>
        <div class="table-responsive bg-white shadow-sm">
            <table class="table table-default mb-0">
                <thead>
                    <tr>
                        <th>المدرسة</th>
                        <th>الصف</th>
                        <th>الفصل</th>
                        <th>عدد الطلاب</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($classrooms as $classroom)
                        <tr>
                            <td>{{ $classroom->grade->school->name }}</td>
                            <td>{{ $classroom->grade->name }}</td>
                            <td>{{ $classroom->name }}</td>
                            <td>{{ $classroom->student_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection