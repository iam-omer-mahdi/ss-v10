@extends('layouts.app')

@section('content')
    <div class="container">
      <h1 class="h4 mb-4">تسجيل طالب</h1>
        
            <form action="{{ route('registration.store') }}" method="POST" class="card p-4 shadow-sm">
                @csrf

                <div class="mb-3">
                    <label for="student" class="form-label">الطالب</label>
                    <select name="student_id" id="student" class="form-select" required>
                        <option value="" selected disabled>اختر الطالب</option>
                        @foreach($students as $student)
                            <option value="{{$student->id}}">{{ $student->name }}</option>
                        @endforeach
                    </select>                    
                    @error('student')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="year" class="form-label">السنة الدراسية</label>
                    <select name="year_id" id="year" class="form-select" required>
                        <option value="" selected disabled>اختر السنة الدراسية</option>
                        @foreach($years as $year)
                            <option value="{{$year->id}}">{{ $year->date }}</option>
                        @endforeach
                    </select>                    
                    @error('year')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="school" class="form-label">المدرسة</label>
                    <select name="school_id" id="school" class="form-select" onchange="change()" required>
                        <option value="" selected disabled>اختر المدرسة</option>
                        @foreach($schools as $school)
                            <option value="{{$school->id}}">{{ $school->name }}</option>
                        @endforeach
                    </select>                    
                    @error('school')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="grade" class="form-label">الصفوف</label>
                    <select name="grade_id" id="grade" class="form-select" onchange="change()" required>
                        <option value="" selected disabled>اختر الصف</option>
                        @foreach($grades as $grade)
                            <option value="{{$grade->id}}">{{ $grade->name }}</option>
                        @endforeach
                    </select>                    
                    @error('grade')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="classroom" class="form-label">الفصل</label>
                    <select name="classroom_id" id="classroom" class="form-select" onchange="change()" required>
                        <option value="" selected disabled>اختر الفصل</option>
                        @foreach($classrooms as $classroom)
                            <option value="{{$classroom->id}}">{{ $classroom->name }}</option>
                        @endforeach
                    </select>                    
                    @error('classroom')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">اضافة</button>
            </form>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/choices.min.css') }}">
@endsection

@section('js')
<script>
    let elements = [];
    elements.push(document.querySelector('#student'));
    elements.push(document.querySelector('#year'));
    elements.push(document.querySelector('#school'));
    elements.push(document.querySelector('#grade'));
    elements.push(document.querySelector('#classroom'));

    elements.forEach(element => {
        let choices = new Choices(element, {
            allowHTML: true,
            searchEnabled: true,
            searchChoices: true,
            placeholder: true,
            placeholderValue: "اختر الطالب",
            loadingText: 'جاري التحميل ...',
            noResultsText: 'لاتوجد نتائج',
            noChoicesText: 'لاتوجد خيارات للاختيار منها',
        });
    });

    function change(value) {
        window.location.assign('/registration/create?school=' + document.querySelector('#school').value + '&grade=' + document.querySelector('#grade').value + '&classroom=' + document.querySelector('#classroom').value);
    }
</script>
@endsection
