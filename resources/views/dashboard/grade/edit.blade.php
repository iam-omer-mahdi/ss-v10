@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="h4 mb-4">تعديل صف</h1>
        @if (isset($schools))
            <form action="{{ route('grade.update', $grade->id) }}" method="POST" class="card p-4 shadow-sm">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">المدرسة</label>
                    <select name="school_id" id="school" class="form-select" required>
                        @foreach ($schools as $school)
                            @if ($school->id == $grade->school_id)
                                <option selected value="{{ $school->id }}">{{ $school->name }}</option>
                            @else
                                <option value="{{ $school->id }}">{{ $school->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('school_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">اسم الصف</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $grade->name }}" required>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                @foreach($grade->grade_fee as $fee)
                    <div class="mb-3">
                        <label for="amount_{{ $fee->fee->type }}" class="form-label">{{ $fee->fee->name }}</label>
                        <input type="number" min="0" name="amount_{{ $fee->fee->type }}" id="amount_{{ $fee->fee->type }}" class="form-control" value="{{ $fee->amount }}" required>
                        <input type="hidden" name="fee_{{ $fee->fee->type }}_id" value="{{ $fee->id }}" />
                    </div>
                @endforeach

                <button class="btn btn-primary w-100">تعديل</button>
            </form>
        @else
            <div class="alert alert-warning">قم باضافة المدارس اولا</div>
        @endif
    </div>
@endsection
