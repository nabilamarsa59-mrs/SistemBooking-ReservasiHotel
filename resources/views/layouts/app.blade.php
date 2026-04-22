<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pulas')</title>
    <style>
        :root {
            --bg-color: #F2EDE4;
            --card-bg: #EBE4D8;
            --text-primary: #1A2A40;
            --accent-blue: #8E9AAF;
            --border-color: #D1CCC0;
            --white: #FFFFFF;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-primary);
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
        }

        .logo {
            font-weight: bold;
            font-size: 24px;
        }

        nav a {
            margin: 0 15px;
            text-decoration: none;
            color: var(--text-primary);
            font-weight: 500;
        }

        .btn-auth {
            border: 1px solid var(--border-color);
            padding: 8px 20px;
            border-radius: 50px;
            background: transparent;
            cursor: pointer;
        }

        main {
            padding: 20px 50px;
        }

        .content-card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 60px;
            text-align: center;
            min-height: 400px;
        }

        .btn-primary {
            border: 2px solid #333;
            color: black;
            padding: 10px 25px;
            border-radius: 50px;
            cursor: pointer;
            background-color: transparent;
        }

        .btn-primary:hover {
            background-color: var(--accent-blue);
            color: white;
            border: 2px solid var(--accent-blue);
        }

        .input-rounded {
            border: 1px solid var(--border-color);
            padding: 10px 20px;
            border-radius: 50px;
            outline: none;
        }
    </style>
</head>
<body>

    <main>
        <div class="content-card">
            @yield('content')
        </div>
    </main>

</body>
</html>