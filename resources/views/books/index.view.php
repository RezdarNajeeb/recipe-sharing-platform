<?php
    require basePath('resources/views/partials/header.view.php');
    require basePath('resources/views/partials/nav.view.php');
    require basePath('resources/views/partials/banner.view.php');
?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <ul class="mb-10">
            <?php foreach($books as $book) : ?>
                <li class="list-disc">
                    <a href="/book?id=<?=$book['id']?>" class="hover:text-blue-500 hover:underline">
                        <?= $book['title_en'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <a href="/books/create" class="text-green-800 hover:underline">Add</a>
    </div>
</main>

<?php
    require basePath('resources/views/partials/footer.view.php');
?>
