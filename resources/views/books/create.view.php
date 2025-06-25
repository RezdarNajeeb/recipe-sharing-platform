<?php
    require basePath('resources/views/partials/header.view.php');
    require basePath('resources/views/partials/nav.view.php');
    require basePath('resources/views/partials/banner.view.php');
?>

<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <form action="/books" method="POST" enctype="multipart/form-data">
            <div class="space-y-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="title_en" class="block text-sm/6 font-medium text-gray-900">Title (EN)</label>
                        <div class="my-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <input type="text" name="title_en" id="title_en" class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" placeholder="Birds" />
                            </div>
                            <?php if (errors('title_en')) : ?>
                                <p class="text-red-500 text-xs mt-2">
                                    <?= errors('title_en') ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <label for="title_ckb" class="block text-sm/6 font-medium text-gray-900">Title (CKB)</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <input type="text" name="title_ckb" id="title_ckb" class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" placeholder="چۆلەکەکان" />
                            </div>
                            <?php if (errors('title_ckb')) : ?>
                                <p class="text-red-500 text-xs mt-2">
                                    <?= errors('title_ckb') ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="description_en" class="block text-sm/6 font-medium text-gray-900">Description (EN)</label>
                        <div class="my-2">
                            <textarea name="description_en" id="description_en" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
                            <?php if (errors('description_en')) : ?>
                                <p class="text-red-500 text-xs mt-2">
                                    <?= errors('description_en') ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <label for="description_ckb" class="block text-sm/6 font-medium text-gray-900">Description (CKB)</label>
                        <div class="my-2">
                            <textarea name="description_ckb" id="description_ckb" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
                            <?php if (errors('description_ckb')) : ?>
                                <p class="text-red-500 text-xs mt-2">
                                    <?= errors('description_ckb') ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="language" class="block text-sm/6 font-medium text-gray-900">Language</label>
                        <div class="my-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <select name="language" id="language">
                                    <option value="en">EN</option>
                                    <option value="ku">KU</option>
                                    <option value="ar">AR</option>
                                </select>
                            </div>
                            <?php if (errors('language')) : ?>
                                <p class="text-red-500 text-xs mt-2">
                                    <?= errors('language') ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="image" class="block text-sm/6 font-medium text-gray-900">Image</label>
                        <div class="my-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <input type="file" name="image" id="image" accept="image/*" class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"/>
                            </div>
                            <?php if (errors('image')) : ?>
                                <p class="text-red-500 text-xs mt-2">
                                    <?= errors('image') ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <label for="file" class="block text-sm/6 font-medium text-gray-900">PDF File</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <input type="file" name="file" id="file" accept="application/pdf" class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" />
                            </div>
                            <?php if (errors('file')) : ?>
                                <p class="text-red-500 text-xs mt-2">
                                    <?= errors('file') ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="category" class="block text-sm/6 font-medium text-gray-900">Category</label>
                        <div class="my-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <select name="category" id="category">
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?= $category['id'] ?>">
                                            <?= ucfirst($category['name_en']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?php if (errors('category')) : ?>
                                <p class="text-red-500 text-xs mt-2">
                                    <?= errors('category') ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="author" class="block text-sm/6 font-medium text-gray-900">Author</label>
                        <div class="my-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <select name="author" id="author">
                                    <?php foreach ($authors as $author) : ?>
                                        <option value="<?= $author['id'] ?>">
                                            <?= ucfirst($author['name_en']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?php if (errors('author')) : ?>
                                <p class="text-red-500 text-xs mt-2">
                                    <?= errors('author') ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add</button>
            </div>
        </form>
    </div>
</main>

<?php
    require basePath('resources/views/partials/footer.view.php');
?>
