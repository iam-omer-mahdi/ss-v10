@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="h4 mb-4">احصائيات المدارس</h1>
        <div class="table-responsive bg-white shadow-sm">
            <table class="table table-default mb-0">
                <thead>
                    <tr>
                        <th>المدرسة</th>
                        <th>عدد الطلاب</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($schools as $school)
                        <tr>
                            <td>{{ $school->name }}</td>
                            <td>{{ $school->students_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection