@extends('layouts.app')

@section('content')
<div class="container">
    <header class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">{{ $transportation->name }}</h1>
        <a href="{{ route('transportation.add_students', $transportation->id) }}" class="btn btn-sm btn-primary">اضافة الطلاب</a>
    </header>
    
    <div class="table-responsive">
        <table class="table table-bordered bg-white">
            <thead>
                <tr>
                    <th>اسم الطالب</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr>
                        <td>{{ $student->student->name }}</td>
                        <td class="text-center">
                            <form action="{{ route('transportation.destroy_students', $student->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">حذف من الترحيل</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection