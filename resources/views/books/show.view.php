<?php
require basePath('resources/views/partials/header.view.php');
require basePath('resources/views/partials/nav.view.php');
require basePath('resources/views/partials/banner.view.php');

$id = $book['id'];
?>

<main>
    <div class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="bg-white shadow-lg rounded-2xl p-6 flex flex-col md:flex-row gap-8">
            <div class="w-full md:w-1/3 flex justify-center items-start">
                <div class="w-64 h-96 bg-gray-100 rounded overflow-hidden flex items-center justify-center">
                    <img src="<?= image($book['image']) ?>" alt="Book Cover" class="object-contain w-full h-full">
                </div>
            </div>

            <div class="w-full md:w-2/3 flex flex-col justify-between space-y-4">
                <div class="flex flex-col">
                    <div class="self-end w-fit">
                        <a href="/books" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 hover:underline">
                            ← Back to Books
                        </a>
                    </div>
                    <h1 class="w-fit text-2xl font-bold text-gray-800 mb-4 -mt-6"><?= $book['title_en'] ?></h1>
                    <ul class="text-gray-700 space-y-1">
                        <li><span class="font-semibold">Author:</span> <?= $book['author']['name_en'] ?></li>
                        <li><span class="font-semibold">Category:</span> <?= $book['category']['name_en'] ?></li>
                        <li><span class="font-semibold">Language:</span> <?= $book['language'] ?></li>
                        <li><span class="font-semibold">Downloads:</span> <?= $book['downloads'] ?></li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-2">Description</h2>
                    <p class="text-gray-600 leading-relaxed"><?= $book['description_en'] ?></p>
                </div>

                <div class="flex flex-wrap justify-between items-center gap-4 pt-4">
                    <a href="<?= pdf($book['file']) ?>" download class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Download PDF</a>

                    <div class="flex gap-x-5 items-baseline">
                        <a href="/books/edit?id=<?= $id ?>" class="text-sm text-gray-800 hover:underline">Edit</a>

                        <form action="/books" method="POST" class="inline">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <button type="submit" class="text-sm text-red-600 hover:underline cursor-pointer">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
require basePath('resources/views/partials/footer.view.php');
?>
