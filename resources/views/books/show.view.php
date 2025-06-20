<?php
    require basePath('resources/views/partials/header.view.php');
    require basePath('resources/views/partials/nav.view.php');
    require basePath('resources/views/partials/banner.view.php');

    $id = $book['id'];
?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <p class="mb-6">
            <?= $book['description_en'] ?>
        </p>

        <a href="/books/edit?id=<?= $id ?>" class="text-gray-800 hover:underline">Edit</a>
        <form action="/books" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="id" value="<?= $id ?>">
            <button type="submit" class="text-red-700 hover:underline cursor-pointer">Delete</button>
        </form>
    </div>
</main>

<?php
    require basePath('resources/views/partials/footer.view.php');
?>
