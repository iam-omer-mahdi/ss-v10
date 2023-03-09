@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-4">
                <a href="{{ route('exam.index', ['id' => $exam->grade_id]) }}" class="text-primary text-decoration-none">الامتحانات</a>
                / {{ $exam->name }} / المواد الدراسية 
                </h1>
            @permission('Subject-create')
                <a class="btn btn-primary btn-sm" href="{{ route('subject.create', ['id' => $exam->id]) }}">اضافة مادة</a>
            @endpermission
        </div>

        <div class="table-responsive shadow-sm bg-white">
            <table class="table table-default shadow-none border-bottom-0 mb-0">
                <thead>
                    <tr>
                        <td>اسم المادة</td>
                        <td>الدرجة الكاملة</td>
                        <td>درجة النجاح</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subjects as $subject)
                    <tr>
                        <td>{{ $subject->name }}</td>
                        <td>{{ $subject->full_mark }}</td>
                        <td>{{ $subject->success_mark }}</td>

                        <td class="d-flex gap-2 ">
                            @permission('Subject-update')
                                <a title="تعديل" href="{{ route('subject.edit', $subject->id) }}" class="btn btn-sm btn-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1rem" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                            @endpermission

                            @permission('Subject-delete')
                                <form action="{{ route('subject.destroy', $subject->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button title="حذف" type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل انت متاكد؟')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1rem" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            @endpermission
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
