@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="h4 mb-4">اضافة امتحان</h1>
        <form action="{{ route('exam.create') }}" method="post" class="card p-4 shadow-sm">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">اسم الامتحان</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                @error('name')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">تاريخ الامتحان</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}">
                @error('date')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>

            <input type="hidden" name="grade_id" value="{{ $grade->id }}">

            <button class="btn btn-primary w-100">اضافة</button>
        </form>
    </div>
@endsection