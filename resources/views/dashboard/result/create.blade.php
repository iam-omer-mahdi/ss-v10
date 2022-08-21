@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('result.store') }}" method="POST" class="card shadow-sm p-4">
            @csrf
            {{-- Exams --}}
            <div class="mb-3">
                <label for="exam_id" class="form-label">الامتحان</label>
                <select name="exam_id" id="exam_id" class="form-select" required onchange="getSubjects(this.value)">
                    <option value="" selected disabled>- اختر الامتحان -</option>

                    @foreach ($exams as $exam)
                        <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                    @endforeach
                </select>
                @error('exam_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            {{-- Subjects --}}
            <div class="mb-3 d-flex gap-2" id="subjects"></div>

            {{-- Student  --}}
            <input type="hidden" name="student_id" value="{{ $student->id }}">

            {{-- Submit --}}
            <button class="btn btn-primary w-100">حفظ</button>

        </form>
    </div>


    <script>
        function getSubjects(id) {
            let subject_container = document.querySelector('#subjects');

            axios.post('{{ route("result.get_subjects") }}', 
                {
                    exam_id: id
                }
            ).then(function (response) {
                let subjects = response.data;
                
                subject_container.innerHTML = '';

                subjects.forEach(subject => {
                    subject_container.innerHTML += `
                        <div>
                            <label for="mark_${subject.id}" class="form-label">${subject.name}</label>
                            <input type="number" id="mark_${subject.id}" min="0" max="${subject.full_mark}" step="any" class="form-control form-control-sm" name="mark[]" required>
                        </div>
                    `;
                });

            })
            .catch(function (error) {
                console.log(error);
            });
        }
    </script>
@endsection