@extends('layouts.app')

@section('content')
<div class="container">
        <header class="d-flex justify-content-between">
            <h1 class="h5">تسجيل الطلاب</h1>
            <a href="{{ route('registration.create') }}" class="btn btn-primary btn-sm">اضافة</a>
        </header>

        {{-- DataTable --}}
        <div class="table-responsive mt-4 shadow-sm p-3 bg-white">
            <table class="table table-default shadow-none border-bottom-0 middle-align mb-0 shadow-none">
                <thead>
                    <tr>
                        <th style="text-align: right"> السنة</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($registrations)
                        @foreach ($registrations as $registration)
                            <tr>
                                <td>{{ $registration->date }}</td>

                                <td class="d-flex gap-2 justify-content-center">
                                    <form action="{{ route('registration.destroy', $registration->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button title="حذف" type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('هل انت متاكد؟ ')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1rem" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
