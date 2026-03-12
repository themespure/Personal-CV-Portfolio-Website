<!DOCTYPE html>
<html>
<head>
    <title>Page Not Found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body{
            font-family: Arial, sans-serif;
            text-align:center;
            padding:100px;
            background:#f9fafb;
        }
        h1{
            font-size:80px;
            margin-bottom:10px;
        }
        p{
            font-size:20px;
            color:#666;
        }
        a{
            display:inline-block;
            margin-top:20px;
            padding:10px 20px;
            background:#2563eb;
            color:white;
            text-decoration:none;
            border-radius:5px;
        }
    </style>
</head>
<body>

    <h1>404</h1>
    <p>Oops! The page you are looking for does not exist.</p>

    <a href="{{ url('/') }}">Go Home</a>

</body>
</html>