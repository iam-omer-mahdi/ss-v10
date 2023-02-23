@extends('layouts.app')

@section('content')
    <div class="container px-4 py-5">
        <h1 class="h3 mb-4">{{ $exam->name }}</h1>
        <div class="table-responsive bg-white shadow-sm">
            <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>المادة</th>
                            <th>الدرجة الكاملة</th>
                            <th>عدد الطلاب الممتحنين</th>
                            <th>مجموع الدرجات</th>
                            <th>نسبة النجاح</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rates as $index => $rate)
                            <tr>
                                <td>{{ $rate['name'] }}</td>
                                <td>{{ $subjects[$index]->full_mark }}</td>
                                <td>{{ $exam->result->count() }}</td>
                                <td>{{ $rate['total_degrees'] . '/' . $exam->result->count() * $subjects[$index]->full_mark  }}</td>
                                <td>{{ $rate['rate'] }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
@endsection
