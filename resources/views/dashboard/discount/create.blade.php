@extends('layouts.app')

@section('content')
    <div class="container">
      <h1 class="h4 mb-4">اضافة تخفيض</h1>
        
            <form action="{{ route('discount.store') }}" method="POST" class="card p-4 shadow-sm">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">الاسم</label>
                    <input name="name" id="name" class="form-control" required />
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="amount" class="form-label">القيمة</label>
                    <input type="number" step="0.0001" min="0.0000" max="100.0000" name="amount" id="amount" class="form-control" value="{{ old('amount') }}" required>
                    @error('amount')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button class="btn btn-primary w-100">اضافة</button>
            </form>
    </div>
@endsection
