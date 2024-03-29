@extends('layouts.app')

@section('content')
    <style>
        @media print {
            .table-responsive {
                display: none !important;       
            }
        }
    </style>

    <div class="container-fluid">
        <h1 class="h4 mb-4">سداد الطلاب</h1>
		<p class="d-flex gap-2">
			<span>{{ $school->name ?? 'كل المدارس' }}</span>
            -
			<span>{{ $grade->name ?? 'كل الصفوف' }}</span>
            -
			<span>{{ $classroom->name ?? 'كل الفصول' }}</span>
		</p>
        
		@if($fees[0] > 0 && $fees[1] > 0 && $fees[2] > 0)
        <table class="table table-bordered bg-white shadow-sm mt-4">
            <thead>
                <tr>
                    <th>الرسوم الكلية</th>
                    <th>المتحصل</th>
                    <th>باقي التحصيل</th>
                    <th>نسبة التحصيل</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ number_format(floor($fees[0])) }}</td>
                    <td>{{ number_format(floor($fees[1])) }}</td>
                    <td>{{ number_format(floor($fees[2])) }}</td>
                    <td>{{ number_format(floor($fees[1]) / floor($fees[0]) * 100) }} %</td>
                </tr>
            </tbody>
        </table>
        @endif
        
        <div class="table-responsive bg-white shadow-sm px-2 py-4">
            <table class="table table-default shadow-none border-bottom-0 mb-0" id="data-table">
                <thead>
                    <tr>
                        <th class="text-start">المدرسة</th>
                        <th class="text-start">الصف</th>
                        <th class="text-start">الفصل</th>
                        <th class="text-start">الطالب</th>
                        <th class="text-start">الهاتف</th>
                        <th class="text-start">اجمالي المبلغ المطلوب</th>
                        <th class="text-start">المدفوع</th>
                        <th class="text-start">المتبقي</th>
                        <th class="text-start">التخفيض</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        <tr>
                            <td>{{ $student->grade->school->name }}</td>
                            <td>{{ $student->grade->name }}</td>
                            <td>{{ $student->classroom->name }}</td>
                            <td>{{ $student->name }}</td>
                            @if($student->guardian_f_phone || $student->guardian_s_phone || $student->mother_f_phone)
                                <td class="d-flex gap-2">
                                    
                                    @if($student->guardian_f_phone)<span title="هاتف ولي الامر 1" class="p-1 bg-light"> {{ $student->guardian_f_phone }}</span>@endif
                                    @if($student->guardian_s_phone)<span title="هاتف ولي الامر 2" class="p-1 bg-light"> {{ $student->guardian_s_phone }}</span>@endif
                                    @if($student->mother_f_phone)<span title="هاتف الوالدة" class="p-1 bg-light"> {{ $student->mother_f_phone }}</span>@endif
                                </td>
                            @else
                                <td>-</td>
                            @endif
                            <td>
                                @php 
                                    $total_payment = 0; 
                                    foreach($student->student_part as $part) {
                                        $total_payment += $part->amount;
                                    }
                                @endphp
                                {{ number_format(floor($total_payment)) }}
                            </td>
                            <td>
                                @php 
                                    $total_paid = 0; 
                                    foreach($student->student_part as $part) {
                                        if ($part->paid == 1) {
                                            $total_paid += $part->amount;
                                        }
                                    }
                                @endphp
                                {{ number_format(floor($total_paid)) }}
                            </td>
                            <td>
                                @php 
                                    $total_not_paid = 0; 
                                    foreach($student->student_part as $part) {
                                        if ($part->paid == 0) {
                                            $total_not_paid += $part->amount;
                                        }
                                    }
                                @endphp
                                {{ number_format(floor($total_not_paid)) }}
                            </td>
                            <td>
                                {{ $student->discount->amount }} %
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">-</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            let table = $('#data-table').DataTable({
				dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                    },
					{
                        extend: 'print',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 5 , 6 ,7, 8 ]
                        },
					customize: function(win) {
						$(win.document.body).css('direction','rtl')
						$(win.document.body).find( 'h1' ).css( {'font-size': '2rem','text-align': 'center','margin-bottom': '1.75rem' });
                        $(win.document.body).find( 'table' ).css({'text-align': 'right'});
                        $(win.document.body).find( 'table th' ).css({'text-align': 'right'});
                        $(win.document.body).find( 'table td' ).css({'text-align': 'right'});
					}}
                ],
                language: {
                    "loadingRecords": "جارٍ التحميل...",
                    "lengthMenu": "أظهر _MENU_ مدخلات",
                    "zeroRecords": "لم يعثر على أية سجلات",
                    "info": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                    "search": "ابحث:",
                    "paginate": {
                        "first": "الأول",
                        "previous": "السابق",
                        "next": "التالي",
                        "last": "الأخير"
                    },
                    "aria": {
                        "sortAscending": ": تفعيل لترتيب العمود تصاعدياً",
                        "sortDescending": ": تفعيل لترتيب العمود تنازلياً"
                    },
                    "select": {
                        "rows": {
                            "_": "%d قيمة محددة",
                            "1": "1 قيمة محددة"
                        },
                        "cells": {
                            "1": "1 خلية محددة",
                            "_": "%d خلايا محددة"
                        },
                        "columns": {
                            "1": "1 عمود محدد",
                            "_": "%d أعمدة محددة"
                        }
                    },
                    "buttons": {
                        "print": "طباعة",
                        "copyKeys": "زر <i>ctrl<\/i> أو <i>⌘<\/i> + <i>C<\/i> من الجدول<br>ليتم نسخها إلى الحافظة<br><br>للإلغاء اضغط على الرسالة أو اضغط على زر الخروج.",
                        "pageLength": {
                            "-1": "اظهار الكل",
                            "_": "إظهار %d أسطر"
                        },
                        "collection": "مجموعة",
                        "copy": "نسخ",
                        "copyTitle": "نسخ إلى الحافظة",
                        "csv": "CSV",
                        "excel": "Excel",
                        "pdf": "PDF",
                        "colvis": "إظهار الأعمدة",
                        "colvisRestore": "إستعادة العرض",
                        "copySuccess": {
                            "1": "تم نسخ سطر واحد الى الحافظة",
                            "_": "تم نسخ %ds أسطر الى الحافظة"
                        }
                    },
                    "searchBuilder": {
                        "add": "اضافة شرط",
                        "clearAll": "ازالة الكل",
                        "condition": "الشرط",
                        "data": "المعلومة",
                        "logicAnd": "و",
                        "logicOr": "أو",
                        "title": [
                            "منشئ البحث"
                        ],
                        "value": "القيمة",
                        "conditions": {
                            "date": {
                                "after": "بعد",
                                "before": "قبل",
                                "between": "بين",
                                "empty": "فارغ",
                                "equals": "تساوي",
                                "notBetween": "ليست بين",
                                "notEmpty": "ليست فارغة",
                                "not": "ليست "
                            },
                            "number": {
                                "between": "بين",
                                "empty": "فارغة",
                                "equals": "تساوي",
                                "gt": "أكبر من",
                                "lt": "أقل من",
                                "not": "ليست",
                                "notBetween": "ليست بين",
                                "notEmpty": "ليست فارغة",
                                "gte": "أكبر أو تساوي",
                                "lte": "أقل أو تساوي"
                            },
                            "string": {
                                "not": "ليست",
                                "notEmpty": "ليست فارغة",
                                "startsWith": " تبدأ بـ ",
                                "contains": "تحتوي",
                                "empty": "فارغة",
                                "endsWith": "تنتهي ب",
                                "equals": "تساوي",
                                "notContains": "لا تحتوي",
                                "notStarts": "لا تبدأ بـ",
                                "notEnds": "لا تنتهي بـ"
                            },
                            "array": {
                                "equals": "تساوي",
                                "empty": "فارغة",
                                "contains": "تحتوي",
                                "not": "ليست",
                                "notEmpty": "ليست فارغة",
                                "without": "بدون"
                            }
                        },
                        "button": {
                            "0": "فلاتر البحث",
                            "_": "فلاتر البحث (%d)"
                        },
                        "deleteTitle": "حذف فلاتر"
                    },
                    "searchPanes": {
                        "clearMessage": "ازالة الكل",
                        "collapse": {
                            "0": "بحث",
                            "_": "بحث (%d)"
                        },
                        "count": "عدد",
                        "countFiltered": "عدد المفلتر",
                        "loadMessage": "جارِ التحميل ...",
                        "title": "الفلاتر النشطة",
                        "showMessage": "إظهار الجميع",
                        "collapseMessage": "إخفاء الجميع"
                    },
                    "infoThousands": ",",
                    "datetime": {
                        "previous": "السابق",
                        "next": "التالي",
                        "hours": "الساعة",
                        "minutes": "الدقيقة",
                        "seconds": "الثانية",
                        "unknown": "-",
                        "amPm": [
                            "صباحا",
                            "مساءا"
                        ],
                        "weekdays": [
                            "الأحد",
                            "الإثنين",
                            "الثلاثاء",
                            "الأربعاء",
                            "الخميس",
                            "الجمعة",
                            "السبت"
                        ],
                        "months": [
                            "يناير",
                            "فبراير",
                            "مارس",
                            "أبريل",
                            "مايو",
                            "يونيو",
                            "يوليو",
                            "أغسطس",
                            "سبتمبر",
                            "أكتوبر",
                            "نوفمبر",
                            "ديسمبر"
                        ]
                    },
                    "editor": {
                        "close": "إغلاق",
                        "create": {
                            "button": "إضافة",
                            "title": "إضافة جديدة",
                            "submit": "إرسال"
                        },
                        "edit": {
                            "button": "تعديل",
                            "title": "تعديل السجل",
                            "submit": "تحديث"
                        },
                        "remove": {
                            "button": "حذف",
                            "title": "حذف",
                            "submit": "حذف",
                            "confirm": {
                                "_": "هل أنت متأكد من رغبتك في حذف السجلات %d المحددة؟",
                                "1": "هل أنت متأكد من رغبتك في حذف السجل؟"
                            }
                        },
                        "error": {
                            "system": "حدث خطأ ما"
                        },
                        "multi": {
                            "title": "قيم متعدية",
                            "restore": "تراجع"
                        }
                    },
                    "processing": "جارٍ المعالجة...",
                    "emptyTable": "لا يوجد بيانات متاحة في الجدول",
                    "infoEmpty": "يعرض 0 إلى 0 من أصل 0 مُدخل",
                    "thousands": ".",
                    "stateRestore": {
                        "creationModal": {
                            "columns": {
                                "search": "إمكانية البحث للعمود",
                                "visible": "إظهار العمود"
                            },
                            "toggleLabel": "تتضمن"
                        }
                    },
                    "autoFill": {
                        "cancel": "إلغاء الامر",
                        "fill": "املأ كل الخلايا بـ <i>%d<\/i>",
                        "fillHorizontal": "تعبئة الخلايا أفقيًا",
                        "fillVertical": "تعبئة الخلايا عموديا"
                    },
                    "decimal": ",",
                    "infoFiltered": "(مرشحة من مجموع _MAX_ مُدخل)"
                }
                
            });

        });
    </script>
@endsection