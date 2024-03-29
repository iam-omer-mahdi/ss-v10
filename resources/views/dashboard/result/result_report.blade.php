@extends('layouts.app')

@section('title')
    - {{ $exam->grade->school->name ?? '' }} / {{ $exam->grade->name ?? '' }} / {{ $classroom->name ?? 'كل الفصول'}} / {{ $exam->name }}
@endsection

@section('content')
    <div class="container-fluid px-4">  
        <h1 class="h4 mb-4 no-print">{{ $exam->grade->school->name ?? '' }} / {{ $exam->grade->name ?? '' }} / {{ $classroom->name ?? 'كل الفصول'}} / {{ $exam->name }}  </h1>
        
        <div class="d-flex gap-4 no-print">
            <label for="scoring">التقدير</label>
            <select name="scoring" id="scoring" class="form-select form-select-sm rounded-0 mb-4">
                <option @if(Request::query('scoring') == 0) selected @endif value="0">الكل</option>
                <option @if(Request::query('scoring') == 1) selected @endif value="1">ممتاز</option>
                <option @if(Request::query('scoring') == 2) selected @endif value="2">جيد جدا</option>
                <option @if(Request::query('scoring') == 3) selected @endif value="3">جيد</option>
                <option @if(Request::query('scoring') == 4) selected @endif value="4">وسط</option>
                <option @if(Request::query('scoring') == 5) selected @endif value="5">مقبول</option>
                <option @if(Request::query('scoring') == 6) selected @endif value="6">يحتاج مساعدة</option>
            </select>
            <select name="success" id="success" class="form-select form-select-sm rounded-0 mb-4">
                <option @if(Request::query('success') == 0) selected @endif value="0">الكل</option>
                <option @if(Request::query('success') == 1) selected @endif value="1">الطلاب الناجحين</option>
                <option @if(Request::query('success') == 2) selected @endif value="2">الطلاب الراسبين</option>
            </select>
        </div>
          

        <div class="table-responsive bg-white shadow-sm px-2 py-4">
            <table class="table table-default shadow-none border-bottom-0 mb-0" >
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
                            <td>{{ $result->student->name ?? '' }}</td>
                            @foreach($result->exam->subject as $index => $subject)
                                {{-- Subject Mark --}}
                                <td class="text-center">{{ $result->mark[$index]->mark }}</td>
                            @endforeach
                            {{-- Total And Precentage --}}
                            <td class="text-center">{{ $result['total_marks'] }}</td>
                            @if($exam->subject->count() > 0)
                                <td class="text-center">{{ round(($result['total_marks'] / $exam->subject->sum('full_mark')) * 100, 1) }} %</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="text-center">
                    <tr>
                        <td class="text-start">نسبة النجاح</td>
                        @forelse ($rates as $index => $rate)
                            <td>{{ $rate['percentage'] }}%</td>
                        @empty
                            <td>-</td>
                        @endforelse
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="text-start">عائد التحصيل</td>
                        @forelse ($rates as $index => $rate)
                            <td>{{ $rate['degrees'] }}</td>
                        @empty
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        @endforelse
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>      
        </div>
    </div>
    
   
@endsection

@section('css')
    
@endsection

@section('js')
    
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

<script>
    let scoring = document.querySelector('#scoring');
    let success = document.querySelector('#success');
    
    scoring.addEventListener('change', function () {
        let url = new URL(window.location.href);
        let search_params = url.searchParams;

        search_params.delete('scoring');
        search_params.append('scoring', +scoring.value);

        let new_url = url.toString();

        window.location.assign(new_url);
    })

    success.addEventListener('change', function () { 
        let url = new URL(window.location.href);
        let search_params = url.searchParams;

        search_params.delete('success');
        search_params.append('success', +success.value);

        let new_url = url.toString();

        window.location.assign(new_url);
    });

</script>
@endsection