<?php
    require basePath('resources/views/partials/header.view.php');
    require basePath('resources/views/partials/nav.view.php');
    require basePath('resources/views/partials/banner.view.php');
?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <ul>
            <?php foreach($books as $book) : ?>
                <li class="list-disc">
                    <?= $book['title_en'] ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</main>

<?php
    require basePath('resources/views/partials/footer.view.php');
?>
