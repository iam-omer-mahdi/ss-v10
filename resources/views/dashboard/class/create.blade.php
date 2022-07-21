@extends('layouts.app')

@section('content')
<div class="container">

   @if(isset($schools))
   <form action="{{ route('class.store') }}" method="POST">
      @csrf
            <div class="mb-3">
               <label for="name" class="form-label">المدرسة</label>
               <select name="school_id" id="school" class="form-select" required>
                  @foreach($schools as $school)
                     <option value="{{ $school->id }}">{{ $school->name }}</option>
                  @endforeach
               </select>
               @error('school_id')
                  <span class="text-danger">{{ $message }}</span>
               @enderror
            </div>

            {{-- <div class="mb-3">
               <label for="name" class="form-label">الصف</label>
               <select name="grade_id" id="grade" class="form-select" required>
                  @foreach($schools->grades as $grade)
                     <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                  @endforeach
               </select>
               @error('grade_id')
                  <span class="text-danger">{{ $message }}</span>
               @enderror
            </div> --}}
            
            <div class="mb-3">
               <label for="name" class="form-label">اسم الفصل</label>
               <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
               
               @error('name')
               <span class="text-danger">{{ $message }}</span>
               @enderror
            </div>
            
            <button class="btn btn-primary w-100">اضافة</button>
         </form>
      @else
         <div class="alert alert-warning">قم باضافة الصفوف اولا</div>
      @endif
</div>
@endsection

@section('js')

@endsection
