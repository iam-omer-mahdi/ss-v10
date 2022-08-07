@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h4">دفع الرسوم</h1>
            <span class="d-block mb-4">{{ $student->name }}</span>
        </div>

        <a class="btn btn-sm btn-secondary px-4" href="{{ route('student.show', $student->id) }}">رجوع</a>
    </div>   

        <header>
            <div class="row">
                @foreach($student->grade->grade_fee as $student_fee)
                    <div class="col-6">
                        <ul class="list-group list-group-horizontal border-0 w-100 rounded-0">
                            <li class="list-group-item border-0 border-bottom bg-primary col-6 col-md-4 rounded-0 text-white">{{ $student_fee->fee->name }}</li>
                            @if($student_fee->fee->type == 2)
                            <li class="list-group-item border-0 border-bottom col-6 col-md-8"> {{ number_format($student_fee->amount - ($student->discount->amount / 100) * $student_fee->amount) }} </li>
                            @else
                            <li class="list-group-item border-0 border-bottom col-6 col-md-8"> {{ number_format($student_fee->amount) }} </li>
                            @endif
                        </ul>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-6">
                    <ul class="list-group list-group-horizontal border-0 w-100 rounded-0">
                        <li class="list-group-item border-0 border-bottom bg-primary col-6 col-md-4 rounded-0 text-white">الرسوم المتبقية</li>
                        <li class="list-group-item border-0 border-bottom col-6 col-md-8">
                            {{ number_format($total_remaining_amount) }}
                        </li>
                    </ul>
                </div>                
                <div class="col-6">
                    <ul class="list-group list-group-horizontal border-0 w-100 rounded-0">
                        <li class="list-group-item border-0 border-bottom bg-primary col-6 col-md-4 rounded-0 text-white">الرسوم المدفوعة</li>
                        <li class="list-group-item border-0 border-bottom col-6 col-md-8">
                            {{ number_format($total_paid_amount) }}
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <section class="mt-4">
            @foreach($student->student_part as $part)
                @if ($part->paid == 0)
            
                <ul class="list-group list-group-horizontal border-0 w-100 rounded-0">
                    <li class="list-group-item border-0 border-bottom bg-primary col-3 rounded-0 text-white d-flex align-items-center">
                        @if($part->type == 1)
                        دفع رسوم التسجيل
                        @else
                        دفع القسط {{ $part->part_number }} 
                        @endif
                    </li>
                    <li class="list-group-item border-0 border-bottom col-9 d-flex align-items-center justify-content-between">
                        <span class="d-flex align-items-center">{{ number_format($part->amount) }}</span>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentModal_{{ $part->id }}">دفع</button>
                    </li>
                </ul>
                
                <!-- Modal -->
                <div class="modal fade" id="paymentModal_{{ $part->id }}" tabindex="-1" aria-labelledby="paymentModal_{{ $part->id }}Label" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body" x-data="{ payment_type: 0 }">
                        <form action="{{ route('part.pay', $part->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <select name="payment_type" id="payment_type" class="form-select mb-3" x-model="payment_type" required>
                                <option selected disabled value="0">- نوع الدفع-</option>
                                <option value="1">نقدا</option>
                                <option value="2">تحويل بنكي</option>
                                <option value="3">شيك</option>
                            </select>
                            
                            <template x-if="payment_type == 2">
                                <div class="mb-3">
                                    <label for="payment_image" class="form-label">الاشعار</label>
                                    <input type="file" name="payment_image" id="payment_image" class="form-control" required>
                                </div>
                            </template>
                
                            <template x-if="payment_type == 3">
                                <div class="mb-3">
                                    <label for="check_number" class="form-label">رقم الشيك</label>
                                    <input type="number" name="check_number" id="check_number" class="form-control" required>
                                </div>
                            </template>
                
                            <template x-if="payment_type == 3">
                                <div class="mb-3">
                                    <label for="check_owner" class="form-label">صاحب الشيك</label>
                                    <input type="text" id="check_owner" id="check_owner" name="check_owner" class="form-control">
                                </div>
                            </template>
                
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
                                <button type="submit" class="btn btn-primary">حفظ</button>
                        </form>
                      </div>
                      
                    </div>
                  </div>
                </div>
                @endif
            @endforeach
        </section>


        <section class="mt-4">
            <h2 class="h5 mb-4">الرسوم المدفوعة</h2>

            @foreach($student->student_part as $part)
                @if ($part->paid == 1)
                    
                
                <ul class="list-group list-group-horizontal border-0 w-100 rounded-0">
                    <li class="list-group-item border-0 border-bottom bg-primary col-3 rounded-0 text-white d-flex align-items-center">
                        @if($part->type == 1)
                         رسوم التسجيل
                        @else
                         القسط {{ $part->part_number }} 
                        @endif
                    </li>
                    <li class="list-group-item border-0 border-bottom col-9 d-flex justify-content-between align-items-center bg-success text-white">
                        <strong class="d-lfex">{{ number_format($part->amount) }}</strong>                        
                        <aside>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#receiptModal_{{ $part->id }}">عرض</button>
                            <a href="{{ route('part.receipt', $part->id) }}" target="_blank" class="btn btn-primary" >الايصال</a>
                        </aside>
                    </li>
                </ul>
                
                <!-- Modal -->
                <div class="modal fade" id="receiptModal_{{ $part->id }}" tabindex="-1" aria-labelledby="receiptModal_{{ $part->id }}Label" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        @if($part->payment_type == 1)
                            <p> <strong>طريقة الدفع :</strong>  نقدا</p>
                        @endif
                        @if($part->payment_type == 2)
                            <p class="mb-3"> <strong>طريقة الدفع :</strong>  تحويل بنكي</p>
                            <span class="d-block mb-3">الاشعار :</span>
                            <img src="{{ asset('images/payment/' . $part->payment_image) }}" alt="" width="100%" height="auto">
                        @endif
                        @if($part->payment_type == 3)
                            <p> <strong>طريقة الدفع :</strong>  شيك</p>
                            <p>رقم الشيك : {{ $part->check_number }}</p>
                            <p>صاحب الشيك : {{ $part->check_owner }}</p>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                @endif
            @endforeach
        </section>
    </div>   
@endsection