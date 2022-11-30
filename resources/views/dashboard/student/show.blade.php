@extends('layouts.app')

@section('content')
    <div class="container">
        <span class="d-flex align-items-center gap-2 mb-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="1rem" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
            </svg>
            {{ $student->grade->school->name }} / <a class="text-primary text-decoration-none"
                href="{{ route('class.index', ['id' => $student->classroom->grade_id]) }}"> {{ $student->grade->name }} </a>
            / <a class="text-primary text-decoration-none"
                href="{{ route('student.index', ['id' => $student->classroom_id]) }}"> {{ $student->classroom->name }} </a>
        </span>
        <h1 class="h5 mb-4 text-primary fw-bold d-flex justify-content-between">
            <span class="d-flex gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="1rem" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path
                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                </svg>
                {{ $student->name }}
            </span>
            <div class="d-flex gap-2">
                @role('super_admin|accountant|finance_manager')
                    <a title="تعديل" href="{{ route('student.edit', $student->id) }}" class="btn btn-sm btn-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1rem" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a>
                @endrole

                @permission('Student-delete')
                    <form action="{{ route('student.destroy', $student->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button title="حذف" type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('هل انت متاكد؟')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1rem" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </form>
                @endpermission
            </div>
        </h1>

        <div class="card border-0 shadow-sm">
            <ul class="list-group list-group-horizontal border-0 w-100 rounded-0">
                <li class="list-group-item border-0 border-bottom bg-primary col-3 rounded-0 text-white">الجنسية</li>
                <li class="list-group-item border-0 border-bottom col-9">{{ $student->nationality->country }}</li>
            </ul>

            <ul class="list-group list-group-horizontal border-0 w-100 rounded-0">
                <li class="list-group-item border-0 border-bottom bg-primary col-3 rounded-0 text-white">العنوان</li>
                <li class="list-group-item border-0 border-bottom col-9">{{ $student->address }}</li>
            </ul>

            <ul class="list-group list-group-horizontal border-0 w-100 rounded-0">
                <li class="list-group-item border-0 border-bottom bg-primary col-3 rounded-0 text-white">ولي الامر</li>
                <li class="list-group-item border-0 border-bottom col-9">{{ $student->guardian }}</li>
            </ul>

            <ul class="list-group list-group-horizontal border-0 w-100 rounded-0">
                <li class="list-group-item border-0 border-bottom bg-primary col-3 rounded-0 text-white">صلة القرابة</li>
                <li class="list-group-item border-0 border-bottom col-9">{{ $student->guardian_relation->relation }}</li>
            </ul>

            <ul class="list-group list-group-horizontal border-0 w-100 rounded-0">
                <li class="list-group-item border-0 border-bottom bg-primary col-3 rounded-0 text-white">مكان العمل</li>
                <li class="list-group-item border-0 border-bottom col-9">{{ $student->guardian_workplace }}</li>
            </ul>

            <ul class="list-group list-group-horizontal border-0 w-100 rounded-0">
                <li class="list-group-item border-0 border-bottom bg-primary col-3 rounded-0 text-white">رقم ولي الامر الاول
                </li>
                <li class="list-group-item border-0 border-bottom col-9">{{ $student->guardian_f_phone }}</li>
            </ul>

            <ul class="list-group list-group-horizontal border-0 w-100 rounded-0">
                <li class="list-group-item border-0 border-bottom bg-primary col-3 rounded-0 text-white">رقم ولي الامر
                    الثاني</li>
                <li class="list-group-item border-0 border-bottom col-9">{{ $student->guardian_s_phone }}</li>
            </ul>


            <ul class="list-group list-group-horizontal border-0 w-100 rounded-0">
                <li class="list-group-item border-0 border-bottom bg-primary col-3 rounded-0 text-white">الوالدة</li>
                <li class="list-group-item border-0 border-bottom col-9">{{ $student->mother_name }}</li>
            </ul>

            <ul class="list-group list-group-horizontal border-0 w-100 rounded-0">
                <li class="list-group-item border-0 border-bottom bg-primary col-3 rounded-0 text-white">رقم الوالدة الاول
                </li>
                <li class="list-group-item border-0 border-bottom col-9">{{ $student->mother_f_phone }}</li>
            </ul>

            <ul class="list-group list-group-horizontal border-0 w-100 rounded-0">
                <li class="list-group-item border-0 border-bottom bg-primary col-3 rounded-0 text-white">رقم الوالدة الثاني
                </li>
                <li class="list-group-item border-0 border-bottom col-9">{{ $student->mother_s_phone }}</li>
            </ul>
            @role('super_admin|accountant|finance_manager')
                <ul class="list-group list-group-horizontal border-0 w-100 rounded-0">
                    <li class="list-group-item border-0 border-bottom bg-primary col-3 rounded-0 text-white">التخفيض</li>
                    <li class="list-group-item border-0 border-bottom col-9">
                        @if (!empty($student->discount->name))
                            {{ $student->discount->name }} - {{ $student->discount->amount }}%
                        @endif
                    </li>
                </ul>

                @foreach ($student->grade->grade_fee as $student_fee)
                    <ul class="list-group list-group-horizontal border-0 w-100 rounded-0">
                        <li class="list-group-item border-0 border-bottom bg-primary col-3 rounded-0 text-white">
                            {{ $student_fee->fee->name }}</li>
                        @if ($student_fee->fee->type == 2)
                            <li class="list-group-item border-0 border-bottom col-9">
                                @if ($student->no_payment == 0)
                                    {{ number_format(floor($student_fee->amount - ($student->discount->amount / 100) * $student_fee->amount)) }}
                                @endif
                            </li>
                        @else
                            <li class="list-group-item border-0 border-bottom col-9">
                                @if ($student->no_payment == 0)
                                    {{ number_format($student_fee->amount) }}
                                @endif
                            </li>
                        @endif
                    </ul>
                @endforeach

                <ul class="list-group list-group-horizontal border-0 w-100 rounded-0">
                    <li class="list-group-item border-0 border-bottom bg-primary col-3 rounded-0 text-white">الرسوم المدفوعة
                    </li>
                    <li class="list-group-item border-0 border-bottom col-9">
                        @if ($student->no_payment == 0)
                            {{ number_format($total_paid_amount) }}
                        @endif
                    </li>
                </ul>

                <ul class="list-group list-group-horizontal border-0 w-100 rounded-0">
                    <li class="list-group-item border-0 border-bottom bg-primary col-3 rounded-0 text-white">الرسوم المتبقية
                    </li>
                    <li class="list-group-item border-0 border-bottom col-9">
                        @if ($student->no_payment == 0)
                            {{ number_format($total_remaining_amount) }}
                        @endif
                    </li>
                </ul>

            </div>
            @if ($student->no_payment == 0)
                <div class="d-flex gap-4 mt-4">
                    <a href="{{ route('part.paymentPage', $student->id) }}" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1rem" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        دفع
                    </a>
                    <a href="{{ route('part.index', ['id' => $student->id]) }}" class="btn btn-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1rem" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        تعديل الاقساط
                    </a>
                </div>
            @endif
        @endrole
    </div>
@endsection
