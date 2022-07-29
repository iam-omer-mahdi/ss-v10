@extends('layouts.app')

@section('content')
   <div class="container">
      <h1 class="h4 mb-4">
         {{ $grade->school->name }} / {{ $grade->name }} /
         اضافة فصل
      </h1>
         <form action="{{ route('class.store') }}" method="POST" class="card shadow-sm p-4">
            @csrf
            <div class="mb-3">
               <label for="name" class="form-label">اسم الفصل</label>
               <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
               
               @error('name')
                  <span class="text-danger">{{ $message }}</span>
               @enderror
            </div>

            <input type="hidden" name="grade_id" value="{{ $grade->id }}">

            <button class="btn btn-primary w-100">اضافة</button> 
         </form>
   </div>
@endsection