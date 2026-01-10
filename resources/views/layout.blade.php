<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shipments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #000; /* pure black */
            color: #f8f9fa;
        }

        h2 {
            background: linear-gradient(90deg, #d4af37, #c0c0c0); /* gold to silver gradient */
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .btn-primary {
            background: linear-gradient(90deg, #d4af37, #c0c0c0); /* gold-silver blend */
            color: #000;
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #c0c0c0, #d4af37); /* reverse gradient on hover */
        }

        .card {
            background-color: #1c1c1c;
            color: #f8f9fa;
            border: 1px solid #bfa76f; /* subtle silvery-gold border */
        }
        </style>

    @livewireStyles
</head>
<body>
@yield('content')

    @livewireScripts
</body>
</html>
