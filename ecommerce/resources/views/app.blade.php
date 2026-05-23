<!-- LAYOUT INDUK -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Project</title>
    @vite(['resources/css/style.css'])
</head>
<body style="margin: 0; font-family: Arial, sans-serif; background: #f4f4f4;">

    @include('components.navbar')

    <div style="padding: 20px; min-height: 400px;">
        @yield('content')
    </div>

    @include('components.footer')

</body>
</html>