@extends('layouts.app')

@section('content')
    <div class="container-fluid px-4">  
        <h1 class="h4 mb-4">{{ $exam->grade->school->name ?? '' }} / {{ $exam->grade->name ?? '' }} / {{ $exam->name }} / {{ $classroom->name }}</h1>
        <div class="table-responsive shadow-sm bg-white">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        @foreach($exam->subject as $index => $subject)
                        <th>{{ $subject->name }}</th>
                        @endforeach
                        <th>المجموع</th>
                        <th>النسبة المئوية</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $subjects = $exam->subject->count();
                    @endphp
                    @foreach($results as $result)
                        <tr>
                            <td>{{ $result->student->name }}</td>
                            {{-- Calculate Total And Precentage --}}
                            @php 
                                $total_marks = 0;
                            @endphp
                            @foreach($result->exam->subject as $index => $subject)
                                {{-- Subject Mark --}}
                                <td>{{ $result->mark[$index]->mark }}</td>
                                {{-- Calculate Total --}}
                                @php $total_marks += $result->mark[$index]->mark  @endphp
                            @endforeach
                            {{-- Total And Precentage --}}
                            <td>{{ $total_marks }}</td>
                            <td>{{ round($total_marks / $subjects, 1) }} %</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>      
        </div>
    </div>
@endsection