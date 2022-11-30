@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="h4 mb-4">{{ $result->student->name }} / {{ $result->exam->name }}</h1>
        <form action="{{ route('result.update', $result->id) }}" method="POST" class="card shadow-sm p-4">
            @csrf
            @method('PUT')
            {{-- Subjects --}}
            <div class="mb-3 d-flex gap-2" id="subjects">
                @foreach($result->exam->subject as $index => $subject)
                    <div>
                        <label for="" class="form-label"> {{ $subject->name }} </label>
                        <input type="text" name="mark[]" class="form-control form-control-sm" value="{{ $result->mark[$index]->mark }}">
                        <input type="hidden" name="mark_id[]" value="{{ $result->mark[$index]->id }}">
                    </div>
                @endforeach
            </div>

            {{-- Submit --}}
            <button class="btn btn-primary w-100">تعديل</button>

        </form>
    </div>
@endsection