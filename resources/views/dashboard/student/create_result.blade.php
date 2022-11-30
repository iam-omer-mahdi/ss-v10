@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="h4 mb-4">{{ $student->name }}</h1>
        
        <div class="table-responsive bg-white shadow-sm">
            <form action="{{ route('student.store_result') }}" method="POST" class="p-2">
                @csrf
                <label for="exam" class="form-label">الامتحان</label>
                <select name="exam_id" id="exam" class="form-select mb-4">
                    @foreach($exams as $exam)
                        <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                    @endforeach
                </select>

                <input type="hidden" name="student_id" value="{{ $student->id }}">

                <table class="table table-default mb-0">
                    <thead>
                        <tr>
                            @foreach($subjects as $subject)
                                <th> {{ $subject->name }} </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach($subjects as $subject)
                                <td>
                                    <input type="number" step="any" min="00.00" max="{{ $subject->full_mark }}" name="mark[]" class="form-control">
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
                <button class="btn btn-primary w-100 mt-4">حفظ</button>
            </form>
        </div>
    </div>
@endsection