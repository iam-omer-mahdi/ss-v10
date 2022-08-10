@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="h4 mb-4">{{ $student->name }}</h1>
        
        <div class="table-responsive bg-white shadow-sm">
            <table class="table table-default mb-0">
                <thead>
                    <tr>
                        @foreach($subjects as $subject)
                            <th> {{ $subject->name }} </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach($subjects as $subject)
                            <td>
                                <input type="number" name="mark[]" class="form-control">
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection