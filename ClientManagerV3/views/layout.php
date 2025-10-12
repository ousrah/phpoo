<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? $_ENV['APP_NAME'] ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

<div class="flex h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white p-4 flex flex-col">
        <h2 class="text-2xl font-bold mb-6"><?= $_ENV['APP_NAME'] ?></h2>
        <nav class="flex-1">
            <ul>
                <li class="mb-2"><a href="<?= $_ENV['APP_BASEPATH'] ?>/" class="block p-2 rounded hover:bg-gray-700">Contacts</a></li>
                <li class="mb-2"><a href="<?= $_ENV['APP_BASEPATH'] ?>/clients" class="block p-2 rounded hover:bg-gray-700">Clients</a></li>
                <li class="mb-2"><a href="<?= $_ENV['APP_BASEPATH'] ?>/fournisseurs" class="block p-2 rounded hover:bg-gray-700">Fournisseurs</a></li>
            </ul>
        </nav>
        <footer class="text-center text-xs text-gray-400">
            &copy; <?= date('Y') ?> - Projet POO
        </footer>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <header class="bg-white shadow p-4">
            <h1 class="text-xl font-semibold"><?= $title ?? 'Tableau de bord' ?></h1>
        </header>

        <main class="flex-1 p-6 overflow-y-auto">
             <!-- Le contenu ($content) sera injecté ici par BaseController -->
            <?= $content ?>
        </main>
    </div>
</div>

<!-- Modale générique (cachée par défaut) -->
<div id="form-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-lg shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3">
            <h3 class="text-lg font-bold" id="modal-title"></h3>
            <button id="close-modal-btn" class="cursor-pointer z-50">
                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"><path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path></svg>
            </button>
        </div>
        <div id="modal-body">
            <!-- Le formulaire sera injecté ici par JavaScript -->
        </div>
    </div>
</div>

<script src="<?= $_ENV['APP_BASEPATH'] ?>/js/app.js"></script>
</body>
</html>