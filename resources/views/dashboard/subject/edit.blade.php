@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="h4 mb-4">تعديل مادة</h1>
        <form action="{{ route('subject.update', $subject->id) }}" method="post" class="card shadow-sm p-4">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">اسم المادة</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $subject->name }}">
                @error('name')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="full_mark" class="form-label">الدرجة الكاملة</label>
                <input type="number" class="form-control" id="full_mark" name="full_mark" value="{{ $subject->full_mark }}">
                @error('full_mark')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>

            <input type="hidden" name="exam_id" value="{{ $subject->exam_id }}">

            <button class="btn btn-primary w-100">تعديل</button>
        </form>
    </div>
@endsection