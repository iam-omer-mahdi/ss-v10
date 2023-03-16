@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
    <div class="container">
      <h1 class="h4 mb-4">اضافة سنة دراسية</h1>
        
            <form action="{{ route('year.store') }}" method="POST" class="card p-4 shadow-sm">
                @csrf

                <div class="mb-3">
                    <label for="date" class="form-label">التاريخ</label>
                    <input name="date" id="date" class="form-control" required />
                    @error('date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button class="btn btn-primary w-100">اضافة</button>
            </form>
    </div>
@endsection

@section('js')    
    <script>
        flatpickr("#date", {        
            "locale": "ar",
            mode: "range",
            dateFormat: "Y-m-d",
        });
    </script>
@endsection