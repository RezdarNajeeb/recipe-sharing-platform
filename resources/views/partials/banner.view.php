<header class="bg-white shadow-sm">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900"><?= $heading ?></h1>
            <?php if (isset($btn)): ?>
                <a href="/books/create" class="text-gray-200 bg-green-800 py-1 px-3 rounded-sm hover:bg-green-700"><?= $btn ?></a>
            <?php endif; ?>
        </div>
    </div>
</header>