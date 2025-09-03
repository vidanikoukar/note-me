<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>دسترسی غیرمجاز</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            direction: rtl;
        }
        h1 {
            color: #e3342f;
        }
        a {
            color: #3490dc;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>دسترسی غیرمجاز</h1>
    <p>{{ $exception->getMessage() }}</p>
    <p><a href="{{ route('home') }}">بازگشت به صفحه اصلی</a></p>
</body>
</html>