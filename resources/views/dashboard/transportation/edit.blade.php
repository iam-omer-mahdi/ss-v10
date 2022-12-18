@extends('layouts.app')

@section('content')
<div class="container">
    <header class="d-flex justify-content-between">
        <h1 class="h5 fw-bold">تعديل ترحيل</h1>
    </header>

    <form action="{{ route('transportation.update', $transportation->id) }}" method="POST" class="bg-white shadow-sm p-4 mt-4">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="name" class="form-label">اسم الخط</label>
            <input type="text" class="form-control my-1" name="name" id="name" value="{{ old('name', $transportation->name) }}">
            @error('name')
                <small class="text-danger d-inline-block">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="supervisor_name" class="form-label">اسم المشرفة</label>
            <input type="text" class="form-control my-1" name="supervisor_name" id="supervisor_name" value="{{ old('supervisor_name', $transportation->supervisor_name) }}">
            @error('supervisor_name')
                <small class="text-danger d-inline-block">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="supervisor_phone" class="form-label">هاتف المشرفة</label>
            <input type="text" class="form-control my-1" name="supervisor_phone" id="supervisor_phone" value="{{ old('supervisor_phone', $transportation->supervisor_phone) }}">
            @error('supervisor_phone')
                <small class="text-danger d-inline-block">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="car_plate" class="form-label">رقم اللوحة</label>
            <input type="text" class="form-control my-1" name="car_plate" id="car_plate" value="{{ old('car_plate', $transportation->car_plate) }}">
            @error('car_plate')
                <small class="text-danger d-inline-block">{{ $message }}</small>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="fee" class="form-label">رسوم الترحيل</label>
            <input type="number" min="0" class="form-control my-1" name="fee" id="fee" value="{{ old('fee', $transportation->fee) }}">
            @error('fee')
                <small class="text-danger d-inline-block">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">تعديل</button>
    </form>
</div>
@endsection