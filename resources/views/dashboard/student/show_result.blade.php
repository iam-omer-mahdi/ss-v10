@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="h4 mb-4">{{ $student->name }}</h1>

        <h2 class="h5">{{ $student->result }}</h2>

        <table class="table table-default mb-0">
            <thead>
                <tr>
                    @foreach($student->grade->subject as $subject)
                        <th> {{ $subject->name }} </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach($student->result as $mark)
                        <td>
                            <input type="number" step="any" min="00.00" max="" name="mark[]" class="form-control" value="{{ $mark}}" readonly>
                        </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
                
    </div>
@endsection