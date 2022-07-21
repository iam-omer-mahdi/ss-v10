@extends('layouts.app')

@section('content')
<div class="container">
   <form action="{{ route('school.update', $school->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">اسم المدرسة</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $school->name }}">
        </div>
        
        <button type="submit" class="btn btn-primary w-100">تعديل</button>
   </form>
</div>
@endsection
