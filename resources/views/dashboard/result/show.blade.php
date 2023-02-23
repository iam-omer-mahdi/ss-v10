@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        
        @foreach($results as $result)
        <div class="card border-0 mb-4" id="print-{{ $result->id }}">
            <div class="card-body">
                <img src="{{ asset('school-logo.png') }}" alt="logo" width="100" class="mx-auto d-block mb-2">
                <p class="fw-bold text-center text-danger">مدارس مدينتي الخاصة ( بنين - بنات )</p>
                <div class="d-flex align-items-center justify-content-center gap-4">
                    <p class="h5 p-2">{{ $result->exam->name }}</p> -
                    <p class="h5 p-2">{{ $student->name }}</p>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>المواد</th>
                            <th>الدرجة القصوي</th>
                            <th>درجة الطالب</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($result->exam->subject as $index => $subject)
                            <tr>
                                <td>{{ $subject->name }}</td>
                                <td>{{ $subject->full_mark }}</td>
                                <td>{{ $result->mark[$index]->mark }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="">المجموع</td>
                            <td colspan="">{{ $result->exam->subject->sum('full_mark') }} </td>
                            <td colspan=""> 
                                @php
                                    $total_mark = 0;
                                    foreach($result->mark as $mark) { 
                                        $total_mark += $mark->mark;
                                    }
                                @endphp
                                {{ $total_mark }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="">النسبة</td>
                            <td colspan=""> 100 % </td>
                            <td colspan=""> {{ round(($total_mark / $result->exam->subject->sum('full_mark')) * 100, 1) }} % </td>
                        </tr>
                        <tr>
                            <td colspan="">التقدير</td>
                            <td colspan="2">
                                @php
                                    $scoring = round(($total_mark / $result->exam->subject->sum('full_mark')) * 100, 1);
                                    $level = '';
                                    switch ($scoring) {
                                        case ($scoring >= 90):
                                                $level = 'ممتاز';
                                            break;
                                        case ($scoring <= 89 && $scoring >= 80):
                                                $level = 'جيد جدا';
                                            break;
                                        
                                        case ($scoring <= 79 && $scoring >= 70):
                                                $level = 'جيد';
                                            break;
                                        case ($scoring <= 69 && $scoring >= 60):
                                                $level = 'وسط';
                                            break;
                                        case ($scoring <= 59 && $scoring >= 50):
                                                $level = 'مقبول';
                                            break;
                                        case ($scoring < 50):
                                                $level = 'يحتاج مساعدة';
                                            break;
                                        default:
                                                $level;
                                        break;
                                    }
                                @endphp
                                {{ $level }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="">توقيع مرشد الصف</td>
                            <td colspan="2"> </td>
                        </tr>
                        <tr>
                            <td colspan="">توقيع المدير</td>
                            <td colspan="2"> </td>
                        </tr>
                        <tr>
                            <td colspan="">توقيع ولي الامر</td>
                            <td colspan="2"> </td>
                        </tr>
                        <tr>
                            <td colspan="">ملحوظات</td>
                            <td colspan="2" class="py-5">
                                
                            </td>
                        </tr>
                    </tbody>
                </table>      
                    
                    <div class="d-flex gap-2 no-print">
                        @permission('Result-update')
                        <a href="{{ route('result.edit', $result->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                        @endpermission
                        @permission('Result-delete')
                        <form action="{{ route('result.destroy', $result->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل انت متأكد ؟ ')">حذف</button>
                        </form>
                        @endpermission
                    </div>
            </div>
        </div>
        @endforeach

    </div>
@endsection