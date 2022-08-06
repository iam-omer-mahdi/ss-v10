@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="h4 mb-4">اضافة مستخدم</h1>

        <form action="{{ route('user.store') }}" method="POST" class="card p-4">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">الاسم</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">اسم المستخدم</label>
                <input type="text" name="username" class="form-control" id="username" value="{{ old('username') }}">
                @error('username')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">كلمة المرور</label>
                <input type="password" name="password" class="form-control" id="password" value="{{ old('password') }}">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">تاكيد كلمة المرور</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" value="{{ old('password_confirmation') }}">
            </div>

            @role('super_admin')
                <label for="" class="form-label">الدور</label>
                <div class="d-flex gap-2 mb-4">
                    @foreach($roles as $role)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role" id="role_{{ $role->id }}" value="{{ $role->name }}">
                        <label class="form-check-label" for="role_{{ $role->id }}">
                                @if ($role->name == 'super_admin')
                                    مشرق رئيسي
                                @elseif ($role->name == 'finance_manager')
                                    مدير مالي
                                @elseif ($role->name == 'accountant')
                                    محاسب
                                @elseif ($role->name == 'results_manager')
                                    مشرف النتائج
                                @elseif ($role->name == 'results_reader')
                                    مطلع علي النتائج
                                @endif
                        </label>
                    </div>
                    @endforeach
                </div>
            @endrole
            <button class="btn btn-primary w-100">اضافة</button>
        </form>
    </div>
@endsection