<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-gray-200 p-8 rounded-lg shadow-lg">
        <h1 class="text-center text-xl font-semibold text-gray-700 mb-6">Ecole 221</h1>
        <form action="login" method="post">
        <div class="text-red-500"><?=$error_all ?? ''?></div>
            <div class="mb-4">
                <label for="login" class="block text-gray-700 font-semibold mb-2">Login:</label>
                <input type="text" id="login" name="login" class="w-full p-2 border border-gray-300 rounded" placeholder="entrer le login">
                <div class="text-red-500"><?=$error_email ?? ''?></div>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Password:</label>
                <input type="password" id="password" name="password" class="w-full p-2 border border-gray-300 rounded" placeholder="entrer le login">
                <div class="text-red-500"><?=$error_password ?? ''?></div>
            </div>
            <div class="text-center">
                <button type="submit" class="w-full py-2 bg-gray-500 text-white font-semibold rounded hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">Se Connecter</button>
            </div>
        </form>
    </div>
</body>
</html>