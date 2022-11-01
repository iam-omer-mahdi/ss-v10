@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">
        
        <h1 class="h4 mb-4">{{ $student->name }}</h1>
        @foreach($results as $result)
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="h4 p-2">{{ $result->exam->name }}</h2>
                <table class="table table-bordered table-light">
                    <thead>
                        <tr>
                            @foreach($result->exam->subject as $index => $subject)
                                <th>{{ $subject->name }}</th>
                            @endforeach
                            <th>المجموع</th>
                            <th>النسبة المئوية</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                {{-- Calculate Total And Precentage --}}
                                @php 
                                    $total_marks = $full_mark = 0;
                                    $subjects = $result->exam->subject->count();
                                @endphp
                                @foreach($result->exam->subject as $index => $subject)
                                    {{-- Subject Mark --}}
                                    <td>{{ $result->mark[$index]->mark }}</td>
                                    {{-- Calculate Total --}}
                                    @php $total_marks += $result->mark[$index]->mark  @endphp
                                    @php $full_mark += $subject->full_mark  @endphp

                                @endforeach
                                {{-- Total And Precentage --}}
                                <td>{{ $full_mark }} / {{ $total_marks }}</td>
                                <td>{{ round($total_marks / $subjects, 1) }} %</td>
                            </tr>
                        </tbody>
                    </table>      
                    
                    <div class="d-flex gap-2">
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