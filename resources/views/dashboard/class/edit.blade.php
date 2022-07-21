@extends('layouts.app')

@section('content')
<div class="container">
   <form action="{{ route('class.edit', $class->id) }}" method="POST">
        @csrf
         <div class="mb-3">
           <label for="name" class="form-label">الصف</label>
           @if($grades)
               <select name="grade_id" id="grade" class="form-select" required>
                  @foreach($grades as $grade)
                     <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                  @endforeach
               </select>
               @error('grade_id')
                  <span class="text-danger">{{ $message }}</span>
               @enderror
            @endif
         </div>
         
         <div class="mb-3">
            <label for="name" class="form-label">اسم الفصل</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            
            @error('name')
               <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        
        <button class="btn btn-primary w-100">اضافة</button>
   </form>
</div>
@endsection
