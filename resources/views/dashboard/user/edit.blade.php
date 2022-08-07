@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="h4 mb-4">تعديل مستخدم</h1>

        <form action="{{ route('user.update', $user->id) }}" method="POST" class="card p-4">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">الاسم</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" required>
                @error('name')                
                   <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">اسم المستخدم</label>
                <input type="text" name="username" class="form-control" id="username" value="{{ $user->username }}" required>
                @error('username')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>

            <button class="btn btn-primary w-100">تعديل</button>
        </form>
    </div>
@endsection