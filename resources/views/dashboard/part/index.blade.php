@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-4">الاقساط</h1>
            
            <a class="btn btn-sm btn-secondary px-4" href="{{ route('student.show', $student->id) }}">رجوع</a>
        </div>   

        
        <div class="d-flex flex-wrap gap-2 mb-4">
            <form action="{{ route('part.store') }}" method="POST" class="d-flex">
                @csrf
                <input type="hidden" name="student_id" value="{{ $student->id }}">
                <button class="btn btn-sm btn-primary">اضافة قسط</button>
            </form>
            <button class="btn btn-danger btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#deletePart" aria-expanded="false" aria-controls="deletePart">
                حذف قسط
            </button>            
            <div class="collapse w-100 shadow-sm" id="deletePart">
                <div class="row bg-white p-2">
                    @foreach($parts as $part)
                        <form action="{{ route('part.destroy', $part->id) }}" method="POST" class="col-4 mb-2">
                            @csrf
                            @method('DELETE')
                            <div class="border p-2 d-flex justify-content-between align-items-center">
                                <p class="mb-0"> {{ number_format($part->amount) }} </p>
                                <button class="btn btn-sm btn-danger">حذف</button>
                                @error('part_amount')
                                    <small class="d-flex w-100 text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </form>
                    @endforeach
                </div>
              </div>
        </div>     
        
        <form action="{{ route('part.update', $student->id) }}" method="POST" class="card p-4 shadow-sm">
            @csrf
            @method('PUT')
            <div class="row">
                @foreach($parts as $part)
                <div class="col-4 mb-2">
                    <input class="form-control" type="number" name="part_number[]" value="{{ $part->amount }}" @if($part->paid == 1) readonly style="cursor: not-allowed" @endif>
                    <input type="hidden" name="part_id[]" value="{{ $part->id }}">
                </div>
                @endforeach
                
                <input type="hidden" name="student_id" value="{{ $student->id }}">
            </div>
            
            @error('part_number')
                <small class="text-danger mt-2">
                    يجب ان يكون المجموع = {{ $parts_total }}
                </small>
            @enderror

            <button class="btn btn-primary mt-4">حفظ</button>
        </form>
    </div>

   
@endsection