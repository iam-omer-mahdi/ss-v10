@extends('layouts.app')

@section('title')
    - {{ $exam->grade->school->name ?? '' }} / {{ $exam->grade->name ?? '' }} / {{ $classroom->name ?? 'كل الفصول'}} / {{ $exam->name }}
@endsection

@section('content')
    <div class="container-fluid px-4">  
        <h1 class="h4 mb-4">{{ $exam->grade->school->name ?? '' }} / {{ $exam->grade->name ?? '' }} / {{ $classroom->name ?? 'كل الفصول'}} / {{ $exam->name }}  </h1>
        <div class="table-responsive bg-white shadow-sm px-2 py-4">
            <table class="table table-default mb-0" id="data-table">
                <thead>
                    <tr>
                        <th class="text-start">الاسم</th>
                        @foreach($exam->subject as $index => $subject)
                        <th class="text-center">{{ $subject->name }}</th>
                        @endforeach
                        <th class="text-center">المجموع</th>
                        <th class="text-center">النسبة المئوية</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($results as $result)
                        <tr>
                            <td>{{ $result->student->name }}</td>
                            @foreach($result->exam->subject as $index => $subject)
                                {{-- Subject Mark --}}
                                <td class="text-center">{{ $result->mark[$index]->mark }}</td>
                            @endforeach
                            {{-- Total And Precentage --}}
                            <td class="text-center">{{ $result['total_marks'] }}</td>
                            @if($exam->subject->count() > 0)
                                <td class="text-center">{{ round($result['total_marks'] / $exam->subject->count(), 1) }} %</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>      
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            
            let table = $('#data-table').DataTable({
				dom: 'Bfrtip',
                buttons: [
                    'excel', 
					{
					extend: 'print',
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
                    "decimal": ".",
                    "infoFiltered": "(مرشحة من مجموع _MAX_ مُدخل)"
                }
                
            });

        });
    </script>
@endsection