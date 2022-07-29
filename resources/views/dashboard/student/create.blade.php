@extends('layouts.app')

@section('content')
<div class="container">
   <h1 class="h4 mb-4">اضافة طالب</h1>
   
   <form action="{{ route('student.store') }}" method="POST" class="card shadow-sm p-4">
      @csrf
      <div class="row mb-3">
         <div class="col-md-4">
            <label for="name" class="form-label">اسم الطالب *</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" required>
            @error('name')
               <span class="text-danger">{{ $message }}</span>
            @enderror
         </div>
         <div class="col-md-4">
            <label for="address" class="form-label">العنوان *</label>
            <input type="text" name="address" id="address" value="{{ old('address') }}" class="form-control" required>
            @error('address')
               <span class="text-danger">{{ $message }}</span>
            @enderror
         </div>
         <div class="col-md-4">
            <label for="nationality" class="form-label">الجنسية *</label>
            <select name="nationality" id="nationality" value="{{ old('nationality') }}" class="form-select" required>
               <option value="0" disabled selected>- اختر الجنسية -</option>
               @foreach($nationalities as $nationality)
                  <option value="{{ $nationality->id }}">{{ $nationality->country }}</option>
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
            <input type="text" name="guardian" id="guardian" value="{{ old('guardian') }}" class="form-control" required>
            @error('guardian')
               <span class="text-danger">{{ $message }}</span>
            @enderror
         </div>
         <div class="col-md-4">
            <label for="guardian_relation" class="form-label">صلة القرابة *</label>
            <select name="guardian_relation" id="guardian_relation" value="{{ old('guardian_relation') }}" class="form-select" required>
               <option value="0" disabled selected>- اختر صلة القرابة -</option>
                  @foreach($relations as $relation)
                     <option value="{{ $relation->id }}">{{ $relation->relation }}</option>
                  @endforeach
            </select>
            @error('guardian_relation')
               <span class="text-danger">{{ $message }}</span>
            @enderror
         </div>
         <div class="col-md-4">
            <label for="workplace" class="form-label">مكان العمل</label>
            <input type="text" name="workplace" id="workplace" value="{{ old('workplace') }}" class="form-control" />
            @error('workplace')
               <span class="text-danger">{{ $message }}</span>
            @enderror
         </div>
      </div>
      <div class="row mb-3">
         <div class="col-md-6">
            <label for="guardian_f_phone" class="form-label">رقم الهاتف الاول *</label>
            <input type="text" name="guardian_f_phone" id="guardian_f_phone" value="{{ old('guardian_f_phone') }}" class="form-control" required>
            @error('guardian_f_phone')
               <span class="text-danger">{{ $message }}</span>
            @enderror
         </div>
         <div class="col-md-6">
            <label for="guardian_s_phone" class="form-label">رقم الهاتف الثاني </label>
            <input type="text" name="guardian_s_phone" id="guardian_s_phone" value="{{ old('guardian_s_phone') }}" class="form-control">
            @error('guardian_s_phone')
            <span class="text-danger">{{ $message }}</span>
            @enderror
         </div>
      </div>
      
      <hr>

      <div class="row mb-3">
         <div class="col-md-4">
            <label for="mother_name" class="form-label">اسم الوالدة *</label>
            <input type="text" name="mother_name" id="mother_name" value="{{ old('mother_name') }}" class="form-control" required>
            @error('mother_name')
               <span class="text-danger">{{ $message }}</span>
            @enderror
         </div>
         <div class="col-md-4">
            <label for="mother_f_phone" class="form-label">هاتف الوالدة الاول *</label>
            <input type="text" name="mother_f_phone" id="mother_f_phone" value="{{ old('mother_f_phone') }}" class="form-control" required>
            @error('mother_f_phone')
               <span class="text-danger">{{ $message }}</span>
            @enderror
         </div>
         <div class="col-md-4">
            <label for="mother_s_phone" class="form-label">هاتف الوالدة الثاني </label>
            <input type="text" name="mother_s_phone" id="mother_s_phone" value="{{ old('mother_s_phone') }}" class="form-control">
            @error('mother_s_phone')
               <span class="text-danger">{{ $message }}</span>
            @enderror
         </div>
      </div>

      <div class="mb-3">
         <label for="discount" class="form-label">التخفيض</label>
         <select class="form-select" name="discount">
            <option value="0" disabled selected>- اختر التخفيض -</option>
               @if ($discounts->count() > 0)                   
                  @foreach($discounts as $discount)
                     <option value="{{ $discount->id }}">{{ $discount->amount }}</option>
                  @endforeach
               @endif
         </select>
      </div>

      <input type="hidden" name="classroom_id" value="{{ $classroom->id }}">

      <button type="submit" class="btn btn-primary mt-3">اضافة</button>

   </form>
   
</div>
@endsection
