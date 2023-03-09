@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-4 no-print">
            <div class="col-md-3 card bg-primary text-white border-0 rounded-0 p-4">
                <article class="flex flex-column text-center gap-2">
                    <aside>المدارس</aside>
                    <aside class="fw-bold pt-2 fs-4">{{ $schools }}</aside>
                </article>
            </div>
            <div class="col-md-3 card bg-primary text-white border-0 rounded-0 p-4 border-start">
                <article class="flex flex-column text-center gap-2">
                    <aside>الصفوف</aside>
                    <aside class="fw-bold pt-2 fs-4">{{ $grades }}</aside>
                </article>
            </div>
            <div class="col-md-3 card bg-primary text-white border-0 rounded-0 p-4 border-start border-end">
                <article class="flex flex-column text-center gap-2">
                    <aside>الفصول</aside>
                    <aside class="fw-bold pt-2 fs-4">{{ $classrooms }}</aside>
                </article>
            </div>
            <div class="col-md-3 card bg-primary text-white border-0 rounded-0 p-4">
                <article class="flex flex-column text-center gap-2">
                    <aside>الطلاب</aside>
                    <aside class="fw-bold pt-2 fs-4">{{ $students }}</aside>
                </article>
            </div>
        </div>
        @can(['read_fee'])
            <h4 class="h5 mt-4">الرسوم الدراسية</h4>
            <div class="table-responsive bg-white mt-4">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>عدد التلاميذ</th>
                            <th>الرسوم الكلية</th>
                            <th>المتحصل</th>
                            <th>باقي التحصيل</th>
                            <th>نسبة التحصيل</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $students }}</td>
                            <td>{{ number_format($total_fees) }}</td>
                            <td>{{ number_format($paid_fees) }}</td>
                            <td>{{ number_format($unpaid_fees) }}</td>
                            @if ($total_fees > 0)
                                <td>{{ round(($paid_fees / $total_fees) * 100) }} %</td>
                            @else
                                <td>0 %</td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>

            <h4 class="h5 mt-4">رسوم الترحيل</h4>
            <div class="table-responsive bg-white mt-4">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>الرسوم الكلية</th>
                            <th>المتحصل</th>
                            <th>باقي التحصيل</th>
                            <th>نسبة التحصيل</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ number_format($transportation_fees['total']) }}</td>
                            <td>{{ number_format($transportation_fees['paid']) }}</td>
                            <td>{{ number_format($transportation_fees['unpaid']) }}</td>
                            @if ($transportation_fees['total'] > 0)
                                <td>{{ round(($transportation_fees['paid'] / $transportation_fees['total']) * 100) }} %</td>
                            @else
                                <td>0 %</td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>

            <h4 class="h5 mt-4">الرسوم الدراسية و رسوم الترحيل</h4>
            <div class="table-responsive bg-white mt-4">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>الرسوم الكلية</th>
                            <th>المتحصل</th>
                            <th>باقي التحصيل</th>
                            <th>نسبة التحصيل</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ number_format($transportation_fees['total'] + $total_fees) }}</td>
                            <td>{{ number_format($transportation_fees['paid'] + $paid_fees) }}</td>
                            <td>{{ number_format($transportation_fees['unpaid'] + $unpaid_fees) }}</td>
                            @if ($total_fees > 0 || $transportation_fees['total'] > 0)
                                <td>{{ round((($transportation_fees['paid'] + $paid_fees) / ($transportation_fees['total'] + $total_fees)) * 100) }}
                                    %</td>
                            @else
                                <td>0 %</td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        @endcan
    </div>
@endsection
