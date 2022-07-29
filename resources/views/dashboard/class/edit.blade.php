@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="h4 mb-4">تعديل الفصل</h1>

        <form action="{{ route('class.update', $classroom->id) }}" method="POST" class="card shadow-sm p-4">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">اسم الفصل</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $classroom->name }}"
                    required>

                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <input type="hidden" name="grade_id" value="{{ $classroom->grade_id }}">

            <button class="btn btn-primary w-100">تعديل</button>
        </form>

    </div>
@endsection
