<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ايصال</title>
    <style>
        @font-face {
            font-family: 'Cairo';
            src: url({{ asset('fonts/Cairo.ttf') }})
        }
        body {
            font-family: 'Cairo',sans-serif;
            direction: rtl;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: start;
            overflow: hidden;
        }

        .container {
            width: 700px;
            margin: 0 auto;
        }

        .text-center {
            text-align: center
        }

        .col-6 {
            width: 50%
        }
        .col-12 {
            width: 100%;
        }
        .row {
            display: flex;
            flex-wrap: wrap
        }

        .mt-2 {
            display: block;
            margin-top: 2rem;
        }
    </style>
</head>

<body>

    <main class="container" style="border: 1px solid #232323; padding: 4rem">
        <section class="col-8 offset-2">
            <h1 class="text-center">
                مدارس مدينتي
            </h1>
            <h2 class="text-center">ايصال استلام مبلغ مالي</h2>

            <div class="row mt-5 text-right w-100">
                <div class="col-6">
                    <p>
                        <strong>تم استلام مبلغ :</strong>
                        {{ number_format($part->amount) }}
                    </p>
                </div>

                <div class="col-6">
                    <p>
                        <strong>عبارة عن :</strong>
                        @if ($part->part_number == 4)
                            رسوم التسجيل
                        @endif
                        @if ($part->part_number == 1)
                            القسط الاول
                        @endif
                        @if ($part->part_number == 2)
                            القسط الثاني
                        @endif
                        @if ($part->part_number == 3)
                            القسط الثالث
                        @endif

                        للطالب 
                        {{ $part->student->name }}
                    </p>
                </div>

                <div class="col-12">
                    <p>
                        <strong>بتاريخ :</strong>
                        {{ $part->payment_time }}
                    </p>
                </div>
                <div class="col-12 mt-2">
                    <p><strong>المدير المالي :</strong>..........................</p>
                </div>
            </div>
        </section>
    </main>

</body>

</html>
