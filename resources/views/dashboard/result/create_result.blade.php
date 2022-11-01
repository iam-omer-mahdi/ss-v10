@extends('layouts.app')

@section('content')
    <div class="container-fluid position-relative max-vh-100">
        <table class="table table-bordred mb-0">
            <thead class="bg-primary text-white" style="position: sticky; top:0px;">
                <tr>
                    <th>الاسم</th>
                    @foreach($exam->subject as $subject)
                        <th>{{ $subject->name }}</th>
                    @endforeach
                    <th></th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <form action="{{ route('store_result') }}" method="POST" class="shadow bg-white">
                    @csrf
                    <input type="hidden" name="subjects_count" value="{{ count($exam->subject) }}">
                    <input type="hidden" name="students_count" value="{{ count($students) }}">
                    <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                    @foreach ($students as $key => $student)
                            <input type="hidden" name="students[{{$key}}][student_id]" value="{{ $student->id }}">
                            <tr>
                                <td>{{ $student->name }}</td>
                                @foreach($exam->subject as $index => $subject)
                                    <td>
                                        <input type="hidden" name="students[{{$key}}][subjects][{{$index}}][subject_id]" value="{{ $subject->id }}">
                                        <input type="number" id="mark_{{ $subject->id }}" min="0" max="{{$subject->full_mark}}" step="any" class="form-control form-control-sm" name="students[{{$key}}][subjects][{{$index}}][mark]" required>
                                    </td>
                                @endforeach
                            </tr>
                    @endforeach
                    
                
                    <td colspan="7" class="pt-4">
                        <button class="btn btn-sm btn-primary w-100">حفظ</button>
                    </td>
                </form>
            </tbody>
        </table>
    </div>
@endsection
