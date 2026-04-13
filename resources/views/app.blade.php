<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MPGames - Unique multiplayer games that bring people together. Strategic, social, and unforgettable.">
    <meta name="theme-color" content="#030712">
    <title>MPGames - Unique Multiplayer Games</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script>
        window.OAUTH_REDIRECT_URI={{ Js::from(config('services.auth_provider.redirect_uri')) }}
        window.OAUTH_CLIENT_ID={{ Js::form(config('services.auth_provider.client_id')) }}
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface text-white min-h-screen font-sans antialiased">
    <div id="app"></div>
</body>
</html>
