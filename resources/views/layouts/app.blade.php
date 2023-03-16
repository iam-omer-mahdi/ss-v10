<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} @yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap-rtl.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datatables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- Custom css --}}
    @yield('css')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm no-print">
            <div class="container">
                <a class="navbar-brand @guest mx-auto @endguest" href="{{ url('/') }}">
                    مدارس مدينتي
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                @auth
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a href="{{ route('year.index') }}" class="nav-link">السنوات الدراسية</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('school.index') }}" class="nav-link">المدارس</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('grade.index') }}" class="nav-link">الصفوف</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('registration.index') }}" class="nav-link">تسجيل الطلاب</a>
                            </li>

                            @can(['read_discount'])
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        الرسوم
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('discount.index') }}">التخفيضات</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('report.index') }}" class="nav-link">التقارير</a>
                                </li>
                            @endcan
                            @can('read_result')
                                <li class="nav-item">
                                    <a href="{{ route('result.index') }}" class="nav-link">النتائج</a>
                                </li>
                            @endcan
                            @can('read_transportation')
                                <li class="nav-item">
                                    <a href="{{ route('transportation.index') }}" class="nav-link">التراحيل</a>
                                </li>
                            @endcan
                        </ul>

                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item"
                                        href="{{ route('user.change_password', auth()->user()->id) }}">
                                        تغيير كلمة المرور
                                    </a>
                                    @can('create_user')
                                        <a class="dropdown-item" href="{{ route('user.index') }}">
                                            المستخدمين
                                        </a>
                                    @endcan
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        تسجيل الخروج
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </nav>
        @auth
            <nav class="navbar navbar-expand-md shadow-sm no-print">
                <div class="container d-flex">
                    <form action="{{ route('student.search') }}" method="POST" class="flex-grow-1">
                        @csrf
                        <div class="input-group">
                            <input type="search" name="search" placeholder="البحث عن طالب ..."
                                class="form-control form-control-sm" required>
                            <button class="btn btn-sm btn-primary" title="ابحث">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1rem" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </nav>
        @endauth
        <main class="py-4 w-100 min-vh-100" style="background: #eee">
            {{-- Notifications --}}
            @if (Session()->has('success'))
                <div class="container">
                    <div class="alert alert-success" style="cursor: pointer" onclick="this.style.display = 'none'">
                        {{ Session()->get('success') }}
                    </div>
                </div>
            @endif
            @if (Session()->has('error'))
                <div class="container">
                    <div class="alert alert-danger" style="cursor: pointer" onclick="this.style.display = 'none'">
                        {{ Session()->get('error') }}
                    </div>
                </div>
            @endif

            {{-- Main Content --}}
            @yield('content')
        </main>
    </div>
    {{-- custom js --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
</body>

</html>
