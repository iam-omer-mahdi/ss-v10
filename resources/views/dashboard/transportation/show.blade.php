@extends('layouts.app')

@section('js')
<script>
    $(document).ready(function() {
        $('table').DataTable({
            paging: false,
            scrollY: 450,
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

@section('content')
<div class="container">
    <header class="d-flex justify-content-between align-items-center mb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('transportation.index') }}" class="text-decoration-none">التراحيل</a></li>
            <li class="breadcrumb-item active text-black" aria-current="page">{{ $transportation->name }}</li>
            </ol>
        </nav>
      
        
        <a href="{{ route('transportation.add_students', $transportation->id) }}" class="btn btn-sm btn-primary">اضافة الطلاب</a>
    </header>
    
    <div class="table-responsive bg-white p-4">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th class="text-start">اسم الطالب</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($studentTransportation as $data)
                    <tr>
                        <td>{{ $data->student->name }}</td>
                        <td class="d-flex justify-content-center gap-1">
                            <a href="{{ route('transportation_part.index', ['id' => $data->student->id]) }}" class="btn btn-sm btn-success">دفع</a>
                            <form action="{{ route('transportation.destroy_students', $data->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل انت متاكد')">حذف من الترحيل</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">لايوجد طلاب</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection