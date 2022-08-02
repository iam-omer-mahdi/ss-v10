@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('report.report') }}" method="POST" x-data="{ type: 0 }" class="card p-4">
            @csrf
            <div class="mb-3">
                <label for="report_type" class="form-label">نوع التقرير</label>
                <select name="report_type" id="report_type" class="form-select" x-model="type">
                    <option selected disabled value="0">- التقارير -</option>
                    <option value="1">احصائيات المدارس</option>
                    <option value="2">احصائيات الطلاب</option>
                    <option value="3">سداد الطلاب</option>
                    <option value="4">التخفيضات</option>
                </select>
            </div>

            <template x-if="type == 3">
                <div>
                    <label for="report_type" class="form-label">المدرسة</label>
                    <select name="school" class="form-select mb-2">
                        <option value="0">- كل المدارس -</option>
                        @foreach($schools as $school)
                            <option value="{{ $school->id }}">{{ $school->name }}</option>
                        @endforeach
                    </select>
                    <label for="report_type" class="form-label">الصف</label>
                    <select name="grade" class="form-select mb-2">
                        <option value="0">- كل الصفوف -</option>
                    </select>
                    <label for="report_type" class="form-label">الفصل</label>
                    <select name="classroom" class="form-select mb-2">
                        <option value="0">- كل الفصول -</option>
                    </select>
                </div>
            </template>

            <button type="submit" class="btn btn-primary mt-4">عرض</button>
        </form>
    </div>
@endsection