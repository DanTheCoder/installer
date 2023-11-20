<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <title>Application Installer</title>
</head>

<body class="bg-gray-50">

    <div class="flex min-h-full flex-col justify-center px-4 py-6">
        <div class="mx-auto mt-6 w-full sm:max-w-xl">

            <div class="text-center">
                @yield('header')
            </div>

            @if ($errors->any())
                <div class="mt-5 rounded-md bg-red-50 p-4 text-sm text-red-700 ring-1 ring-red-100" role="alert">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="mt-6 rounded-lg bg-white px-6 py-4 shadow ring-1 ring-gray-200">
                @yield('content')
            </div>

        </div>
    </div>

</body>

</html>
