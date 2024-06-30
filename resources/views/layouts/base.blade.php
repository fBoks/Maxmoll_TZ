<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('page.title', config('app.name'))</title>

    {{-- Bootstrap 5 --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap_5.3.2/bootstrap.css') }}">

    @stack('css')

    <style>
        .container { max-width: 720px; }
        .required::after { content: '*'; color: red; }
        .hover-overlay:hover { background-color: hsla(216, 93%, 84%, 0.2); }
        .th-hover-overlay:hover { background-color: hsla(216, 93%, 84%, 0.2); cursor: pointer; }
    </style>
</head>
<body>
    <div class="d-flex flex-column justify-space-between min-vh-100">
        @include('includes.alert')
        @include('includes.header')

        <main class="flex-grow-1 py-3">
            @yield('content')
        </main>

        @include('includes.footer')
    </div>

    <script src="{{ asset('js/bootstrap_5.3.2/bootstrap.bundle.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script>
        // Инициализация всех тултипов на странице
        $(document).ready(function () {
            $('[data-bs-toggle="tooltip"]').tooltip();
        });

        // Обновление капчи
        $('#reload').click(function () {
            $.ajax({
                type: 'GET',
                url: 'reload-captcha',
                success: function (data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script>

    @stack('js')

</body>
</html>
