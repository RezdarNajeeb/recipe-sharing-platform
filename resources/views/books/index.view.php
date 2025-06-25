<?php
    require basePath('resources/views/partials/header.view.php');
    require basePath('resources/views/partials/nav.view.php');
    require basePath('resources/views/partials/banner.view.php');
?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

        <a href="/books/create" class="text-green-800 hover:underline">Add</a>

        <div class="bg-white">
            <div class="mx-auto max-w-2xl px-4 py-16 rounded-md sm:px-6 sm:py-10 lg:max-w-7xl lg:px-8">
                <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    <?php foreach($books as $book) : ?>
                        <div class="group relative">
                            <img src="<?= image($book['image']) ?>" alt="<?= $book['title_en'] ?>" class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80" />
                            <div class="mt-4 flex justify-between">
                                <div>
                                    <h3 class="text-sm text-gray-700">
                                        <a href="/book?id=<?= $book['id'] ?>">
                                            <span aria-hidden="true" class="absolute inset-0"></span>
                                            <?= $book['title_en'] ?>
                                        </a>
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500"><?= $book['author']['name_en'] ?></p>
                                </div>
                                <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-gray-500/10 ring-inset"><?= $book['category']['name_en'] ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
    require basePath('resources/views/partials/footer.view.php');
?>
