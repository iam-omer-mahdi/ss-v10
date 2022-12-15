@extends('layouts.app')

@section('content')
<div class="container">
    <header class="d-flex justify-content-between">
        <h1 class="h5">التراحيل</h1>
        <a href="{{ route('transportation.create') }}" class="btn btn-primary btn-sm">اضافة</a>
    </header>

    {{-- DataTable --}}
    <div class="table-responsive mt-4 shadow-sm bg-white">
        <table class="table table-default middle-align mb-0">
            <thead>
                <tr>
                    <th>الخط</th>
                    <th>المشرفة</th>
                    <th>هاتف المشرفة</th>
                    <th>رقم اللوحة</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transportations as $transportation)    
                    <tr>
                        <td>{{ $transportation->name }}</td>
                        <td>{{ $transportation->supervisor_name }}</td>
                        <td>{{ $transportation->supervisor_phone }}</td>
                        <td>{{ $transportation->car_plate }}</td>
                        <td class="d-flex gap-2">
                            <a href="{{ route('transportation.show', $transportation->id) }}" class="btn btn-sm btn-success">عرض</a>
                            <a href="{{ route('transportation.edit', $transportation->id) }}" class="btn btn-sm btn-warning">تعديل</a>
                            <form action="{{ route('transportation.destroy', $transportation->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('هل انت متأكد ؟')">حذف</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="">
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection