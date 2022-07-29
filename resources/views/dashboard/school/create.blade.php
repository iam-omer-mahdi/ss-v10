@extends('layouts.app')

@section('content')
<div class="container">
   <h1 class="h4 mb-4">اضافة مدرسة</h1>

   <form action="{{ route('school.store') }}" method="POST" class="shadow-sm p-4 card">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">اسم المدرسة</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
               <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary w-100">اضافة</button>
   </form>
</div>
@endsection
