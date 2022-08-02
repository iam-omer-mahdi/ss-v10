@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-4">الاقساط</h1>
            <a class="btn btn-sm btn-secondary px-4" href="{{ route('student.show', $student->id) }}">رجوع</a>
        </div>   

        
        <form action="{{ route('part.update', $student->id) }}" method="POST" class="card p-4 shadow-sm">
            @csrf
            @method('PUT')
            <div class="row">
                @foreach($parts as $part)
                <div class="col">
                    <input class="form-control" type="number" name="part_{{ $part->part_number }}" value="{{ $part->amount }}" @if($part->paid == 1) readonly style="cursor: not-allowed" @endif>
                    <input type="hidden" name="part_{{ $part->part_number }}_id" value="{{ $part->id }}">
                </div>
                @endforeach
                
                <input type="hidden" name="student_id" value="{{ $student->id }}">
            </div>
            
            @error('part_1')
                <small class="text-danger mt-2">
                    يجب ان يكون المجموع = {{ $parts_total }}
                </small>
            @enderror

            <button class="btn btn-primary mt-4">حفظ</button>
        </form>
    </div>

   
@endsection