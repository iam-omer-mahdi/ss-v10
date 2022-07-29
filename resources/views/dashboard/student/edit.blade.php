@extends('layouts.app')

@section('content')
<div class="container">
   <h1 class="h4 mb-4">تعديل طالب</h1>
   
   <form action="{{ route('student.update', $student->id) }}" method="POST" class="card shadow-sm p-4">
      @csrf
      @method('PUT')
      <div class="row mb-3">
         <div class="col-md-4">
            <label for="name" class="form-label">اسم الطالب *</label>
            <input type="text" name="name" id="name" value="{{ $student->name }}" class="form-control" required>
            @error('name')
               <span class="text-danger">{{ $message }}</span>
            @enderror
         </div>
         <div class="col-md-4">
            <label for="address" class="form-label">العنوان *</label>
            <input type="text" name="address" id="address" value="{{ $student->address }}" class="form-control" required>
            @error('address')
               <span class="text-danger">{{ $message }}</span>
            @enderror
         </div>
         <div class="col-md-4">
            <label for="nationality" class="form-label">الجنسية *</label>
            <select name="nationality" id="nationality" value="{{ $student->nationality_id }}" class="form-select" required>
               @foreach($nationalities as $nationality)
                  <option @if($nationality->id == $student->nationality_id) selected @endif value="{{ $nationality->id }}">{{ $nationality->country }}</option>
               @endforeach
            </select>
            @error('nationality')
               <span class="text-danger">{{ $message }}</span>
            @enderror
         </div>
      </div>

      <hr>

      <div class="row mb-3">
         <div class="col-md-4">
            <label for="guardian" class="form-label">اسم ولي الامر *</label>
            <input type="text" name="guardian" id="guardian" value="{{ $student->guardian }}" class="form-control" required>
            @error('guardian')
               <span class="text-danger">{{ $message }}</span>
            @enderror
         </div>
         <div class="col-md-4">
            <label for="guardian_relation" class="form-label">صلة القرابة *</label>
            <select name="guardian_relation" id="guardian_relation" value="{{ $student->guardian_relation_id }}" class="form-select" required>
                  @foreach($relations as $relation)
                     <option @if($relation->id == $student->guardian_relation_id) selected @endif value="{{ $relation->id }}">{{ $relation->relation }}</option>
                  @endforeach
            </select>
            @error('guardian_relation')
               <span class="text-danger">{{ $message }}</span>
            @enderror
         </div>
         <div class="col-md-4">
            <label for="workplace" class="form-label">مكان العمل</label>
            <input type="text" name="workplace" id="workplace" value="{{ $student->guardian_workplace }}" class="form-control" />
            @error('workplace')
               <span class="text-danger">{{ $message }}</span>
            @enderror
         </div>
      </div>
      <div class="row mb-3">
         <div class="col-md-6">
            <label for="guardian_f_phone" class="form-label">رقم الهاتف الاول *</label>
            <input type="text" name="guardian_f_phone" id="guardian_f_phone" value="{{ $student->guardian_f_phone }}" class="form-control" required>
            @error('guardian_f_phone')
               <span class="text-danger">{{ $message }}</span>
            @enderror
         </div>
         <div class="col-md-6">
            <label for="guardian_s_phone" class="form-label">رقم الهاتف الثاني </label>
            <input type="text" name="guardian_s_phone" id="guardian_s_phone" value="{{ $student->guardian_s_phone }}" class="form-control">
            @error('guardian_s_phone')
            <span class="text-danger">{{ $message }}</span>
            @enderror
         </div>
      </div>
      
      <hr>

      <div class="row mb-3">
         <div class="col-md-4">
            <label for="mother_name" class="form-label">اسم الوالدة *</label>
            <input type="text" name="mother_name" id="mother_name" value="{{ $student->mother_name }}" class="form-control" required>
            @error('mother_name')
               <span class="text-danger">{{ $message }}</span>
            @enderror
         </div>
         <div class="col-md-4">
            <label for="mother_f_phone" class="form-label">هاتف الوالدة الاول *</label>
            <input type="text" name="mother_f_phone" id="mother_f_phone" value="{{ $student->mother_f_phone }}" class="form-control" required>
            @error('mother_f_phone')
               <span class="text-danger">{{ $message }}</span>
            @enderror
         </div>
         <div class="col-md-4">
            <label for="mother_s_phone" class="form-label">هاتف الوالدة الثاني </label>
            <input type="text" name="mother_s_phone" id="mother_s_phone" value="{{ $student->mother_s_phone }}" class="form-control">
            @error('mother_s_phone')
               <span class="text-danger">{{ $message }}</span>
            @enderror
         </div>
      </div>

      <div class="mb-3">
         <label for="discount" class="form-label">التخفيض</label>
         <select class="form-select" value="{{ $student->discount_id }}" name="discount">
               @if ($discounts->count() > 0)                   
                  @foreach($discounts as $discount)
                     <option @if($discount->id == $student->discount_id) selected @endif value="{{ $discount->id }}">% {{ $discount->amount }}  -  {{ $discount->name }}</option>
                  @endforeach
               @endif
         </select>
      </div>

      <input type="hidden" name="classroom_id" value="{{ $student->classroom_id }}">

      <button type="submit" class="btn btn-primary mt-3">تعديل</button>

   </form>
   
</div>
@endsection
