@extends('layouts.app')

@section('content')
    <div class="container">
        <header class="d-flex justify-content-between">
            <h1 class="h5">المدارس</h1>
            <a href="{{ route('school.create') }}" class="btn btn-primary btn-sm">اضافة</a>
        </header>

        <div class="table-responsive mt-4 shadow-sm bg-white">
            <table class="table table-default middle-align text-center mb-0">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($schools as $school)
                        <tr>
                            <td>{{ $school->name }}</td>
                            <td class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('school.edit', $school->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                                <form action="{{ route('school.destroy', $school->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
