@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="h4 mb-4">انواع الرسوم</h1>

        <div class="table-responsive shadow-sm bg-white">
            <table class="table table-default mb-0">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if($fees->count() > 0)
                        @foreach($fees as $fee)
                            <tr>
                                <td>{{ $fee->name }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection