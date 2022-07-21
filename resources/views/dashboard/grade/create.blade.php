@extends('layouts.app')

@section('content')
    <div class="container">
      <h1 class="h4 mb-4">اضافة صف</h1>
        @if (isset($schools))
            <form action="{{ route('grade.store') }}" method="POST" class="card p-4 shadow-sm">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">المدرسة</label>
                    <select name="school_id" id="school" class="form-select" required>
                        @foreach ($schools as $school)
                            <option value="{{ $school->id }}">{{ $school->name }}</option>
                        @endforeach
                    </select>
                    @error('school_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">اسم الصف</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                        required>

                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button class="btn btn-primary w-100">اضافة</button>
            </form>
        @else
            <div class="alert alert-warning">قم باضافة المدارس اولا</div>
        @endif
    </div>
@endsection
