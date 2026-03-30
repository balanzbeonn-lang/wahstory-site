<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WAHClub - Oops</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            padding: 50px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        h1 {
            font-size: 100px;
            margin: 0;
            color: #e74c3c;
        }
        h2 {
            font-size: 24px;
            margin: 20px 0;
        }
        p {
            font-size: 18px;
        }
        a {
            color: #3498db;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>500</h1>
        <h2>Oops! Something went wrong on our end.</h2>
        <p>We’re working to fix this issue. Please try again later.</p>
        <p>
            <a href="{{ url('/wahclub/') }}">Go Back to Homepage</a> |
            <a href="javascript:history.back()">Go Back</a>
        </p>
    </div>
</body>
</html>
