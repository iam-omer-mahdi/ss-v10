@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('table').DataTable({
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
        <header class="d-flex justify-content-between">
            <h1 class="h5">نتيجة البحث</h1>
        </header>

        <div class="table-responsive mt-4 shadow-sm bg-white p-4 rounded">
            <table class="table table-default middle-align text-start mb-0">
                <thead>
                    <tr>
                        <th class="text-start">الاسم</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td class="d-flex gap-2 justify-content-center">
                                <a title="عرض" href="{{ route('student.show', $student->id) }}" class="btn btn-sm btn-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1rem" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                @permission('Student-delete')
                                <form action="{{ route('student.destroy', $student->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button title="حذف" type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل انت متاكد؟')" >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1rem" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                                @endpermission
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
