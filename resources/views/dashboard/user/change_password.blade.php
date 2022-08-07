@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="h4 mb-4">
            تغيير كلمة المرور
        </h1>

        <form action="{{ route('user.update_password', $user->id) }}" method="post" class="card shadow-sm p-4">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="old_password" class="form-label">كلمة المرور الحالية</label>
                <input type="password" name="old_password" id="old_password" class="form-control" required>
                @error('old_password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">كلمة المرور الجديدة</label>
                <input type="password" name="password" id="password" class="form-control" required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">تأكيد كلمة المرور </label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">تغيير</button>
        </form>
    </div>
@endsection