@extends('layouts.app')

@section('content')
    <div class="container">
        <header class="d-flex justify-content-between">
            <h1 class="h5">المستخدمين</h1>

            @can('create_user')
                <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">اضافة</a>
            @endcan
        </header>

        <div class="table-responsive mt-4 shadow-sm bg-white">
            <table class="table table-default shadow-none border-bottom-0 middle-align text-center mb-0">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>اسم المستخدم</th>
                        <th>الدور</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            @if (count($user->roles) > 0)
                                <td>
                                    {{ __('roles.' . $user->roles[0]->name) }}
                                </td>
                            @endif

                            <td class="d-flex gap-2 justify-content-center">
                                @can('update_user')
                                    <a title="تعديل" href="{{ route('user.edit', $user->id) }}"
                                        class="btn btn-sm btn-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1rem" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                @endcan


                                @can('delete_user')
                                    @if ($user->id != auth()->user()->id && !$user->hasRole('super_admin'))
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button title="حذف" type="submit" class="btn btn-sm btn-danger"
                                                onclick="
                                    return confirm('هل انت متاكد؟')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1rem" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
