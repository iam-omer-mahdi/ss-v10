<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap-rtl.css') }}" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'Cairo';
            src: url({{ asset('fonts/Cairo.ttf') }});
        }
        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
    {{-- Custom css --}}
    @yield('css')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    مدارس مدينتي
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    @auth
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a href="{{ route('school.index') }}" class="nav-link">المدارس</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('grade.index') }}" class="nav-link">الصفوف</a>
                            </li>

                            @role(['super_admin','finance_manager','accountant','requireAll'])
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
                            @endrole
                            @role(['super_admin','finance_manager','results_manager','results_reader','requireAll'])
                                <li class="nav-item">
                                    <a href="{{ route('result.index') }}" class="nav-link">النتائج</a>
                                </li>
                            @endrole
                        </ul>

                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.change_password', auth()->user()->id) }}">
                                        تغيير كلمة المرور
                                    </a>
                                    @permission('User-create')
                                    <a class="dropdown-item" href="{{ route('user.index') }}">
                                        المستخدمين
                                    </a>
                                    @endpermission
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
                    @endauth
                </div>
            </div>
        </nav>

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
    @yield('js')
</body>

</html>
