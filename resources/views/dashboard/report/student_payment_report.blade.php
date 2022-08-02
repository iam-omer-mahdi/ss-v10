@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="h4 mb-4">سداد الطلاب</h1>
        <div class="table-responsive bg-white shadow-sm">
            <table class="table table-default mb-0">
                <thead>
                    <tr>
                        <th>المدرسة</th>
                        <th>الصف</th>
                        <th>الفصل</th>
                        <th>الطالب</th>
                        <th>اجمالي المبلغ المطلوب</th>
                        <th>المدفوع</th>
                        <th>المتبقي</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->grade->school->name }}</td>
                            <td>{{ $student->grade->name }}</td>
                            <td>{{ $student->classroom->name }}</td>
                            <td>{{ $student->name }}</td>
                            <td>
                                @php 
                                    $total_payment = 0; 
                                    foreach($student->student_part as $part) {
                                        $total_payment += $part->amount;
                                    }
                                @endphp
                                {{ $total_payment }}
                            </td>
                            <td>
                                @php 
                                    $total_paid = 0; 
                                    foreach($student->student_part as $part) {
                                        if ($part->paid == 1) {
                                            $total_paid += $part->amount;
                                        }
                                    }
                                @endphp
                                {{ $total_paid }}
                            </td>
                            <td>
                                @php 
                                    $total_not_paid = 0; 
                                    foreach($student->student_part as $part) {
                                        if ($part->paid == 0) {
                                            $total_not_paid += $part->amount;
                                        }
                                    }
                                @endphp
                                {{ $total_not_paid }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection