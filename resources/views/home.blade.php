@extends('layouts.app')

@section('content')
<div class="container">
   <form action="{{ route('student.search') }}" method="POST">
      @csrf
      <div class="input-group mb-3 shadow-sm">
         <input type="text" name="search" placeholder="البحث عن طالب ..." class="form-control">
         <button class="btn btn-primary" title="ابحث">
            <svg xmlns="http://www.w3.org/2000/svg" width="1rem" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
               <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
         </button>
      </div>
   </form>

   <div class="row mt-4">
      <div class="col-md-3 card bg-primary text-white border-0 rounded-0 p-4">
         <article class="flex flex-column text-center gap-2">
            <aside>المدارس</aside>
            <aside class="fw-bold pt-2 fs-4">{{ $schools }}</aside>
         </article>
      </div>
      <div class="col-md-3 card bg-primary text-white border-0 rounded-0 p-4 border-start">
         <article class="flex flex-column text-center gap-2">
            <aside>الصفوف</aside>
            <aside class="fw-bold pt-2 fs-4">{{ $grades }}</aside>
         </article>
      </div>
      <div class="col-md-3 card bg-primary text-white border-0 rounded-0 p-4 border-start border-end">
         <article class="flex flex-column text-center gap-2">
            <aside>الفصول</aside>
            <aside class="fw-bold pt-2 fs-4">{{ $classrooms }}</aside>
         </article>
      </div>
      <div class="col-md-3 card bg-primary text-white border-0 rounded-0 p-4">
         <article class="flex flex-column text-center gap-2">
            <aside>الطلاب</aside>
            <aside class="fw-bold pt-2 fs-4">{{ $students }}</aside>
         </article>
      </div>
   </div>
</div>
@endsection
