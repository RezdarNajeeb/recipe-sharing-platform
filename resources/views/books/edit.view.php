<?php
require basePath('resources/views/partials/header.view.php');
require basePath('resources/views/partials/nav.view.php');
require basePath('resources/views/partials/banner.view.php');
?>

<main>
    <div class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
        <form action="/books<?= isset($book) ? '' : '' ?>" method="POST" enctype="multipart/form-data">
            <?php if (isset($book)) : ?>
                <input type="hidden" name="id" value="<?= $book['id'] ?>">
                <input type="hidden" name="_method" value="PUT">
            <?php endif; ?>

            <div class="space-y-10">
                <!-- Title Section -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Titles</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="title_en" class="block text-sm font-medium text-gray-900">Title (EN)</label>
                            <input type="text" name="title_en" id="title_en" value="<?= old('title_en', $book['title_en'] ?? '') ?>" placeholder="Birds"
                                   class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                            <?php if (errors('title_en')) : ?><p class="text-red-500 text-xs mt-1"><?= errors('title_en') ?></p><?php endif; ?>
                        </div>

                        <div>
                            <label for="title_ckb" class="block text-sm font-medium text-gray-900">Title (CKB)</label>
                            <input type="text" name="title_ckb" id="title_ckb" value="<?= old('title_ckb', $book['title_ckb'] ?? '') ?>" placeholder="چۆلەکەکان"
                                   class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                            <?php if (errors('title_ckb')) : ?><p class="text-red-500 text-xs mt-1"><?= errors('title_ckb') ?></p><?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Description Section -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Descriptions</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="description_en" class="block text-sm font-medium text-gray-900">Description (EN)</label>
                            <textarea name="description_en" id="description_en" rows="3"
                                      class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><?= old('description_en', $book['description_en'] ?? '') ?></textarea>
                            <?php if (errors('description_en')) : ?><p class="text-red-500 text-xs mt-1"><?= errors('description_en') ?></p><?php endif; ?>
                        </div>

                        <div>
                            <label for="description_ckb" class="block text-sm font-medium text-gray-900">Description (CKB)</label>
                            <textarea name="description_ckb" id="description_ckb" rows="3"
                                      class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><?= old('description_ckb', $book['description_ckb'] ?? '') ?></textarea>
                            <?php if (errors('description_ckb')) : ?><p class="text-red-500 text-xs mt-1"><?= errors('description_ckb') ?></p><?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Select & File Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="language" class="block text-sm font-medium text-gray-900">Language</label>
                        <select name="language" id="language"
                                class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="en" <?= (isset($book) && $book['language'] === 'en') ? 'selected' : '' ?>>EN</option>
                            <option value="ku" <?= (isset($book) && $book['language'] === 'ku') ? 'selected' : '' ?>>KU</option>
                            <option value="ar" <?= (isset($book) && $book['language'] === 'ar') ? 'selected' : '' ?>>AR</option>
                        </select>
                        <?php if (errors('language')) : ?><p class="text-red-500 text-xs mt-1"><?= errors('language') ?></p><?php endif; ?>
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-900">Image</label>
                        <input type="file" name="image" id="image" accept="image/*"
                               class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer bg-white focus:outline-none" />
                        <?php if (errors('image')) : ?><p class="text-red-500 text-xs mt-1"><?= errors('image') ?></p><?php endif; ?>
                    </div>

                    <div>
                        <label for="file" class="block text-sm font-medium text-gray-900">PDF File</label>
                        <input type="file" name="file" id="file" accept="application/pdf"
                               class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer bg-white focus:outline-none" />
                        <?php if (errors('file')) : ?><p class="text-red-500 text-xs mt-1"><?= errors('file') ?></p><?php endif; ?>
                    </div>
                </div>

                <!-- Category and Author -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-900">Category</label>
                        <select name="category" id="category"
                                class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category['id'] ?>" <?= (isset($book) && $book['category_id'] === $category['id']) ? 'selected' : '' ?>>
                                    <?= ucfirst($category['name_en']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (errors('category')) : ?><p class="text-red-500 text-xs mt-1"><?= errors('category') ?></p><?php endif; ?>
                    </div>

                    <div>
                        <label for="author" class="block text-sm font-medium text-gray-900">Author</label>
                        <select name="author" id="author"
                                class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <?php foreach ($authors as $author) : ?>
                                <option value="<?= $author['id'] ?>" <?= (isset($book) && $book['author_id'] === $author['id']) ? 'selected' : '' ?>>
                                    <?= ucfirst($author['name_en']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (errors('author')) : ?><p class="text-red-500 text-xs mt-1"><?= errors('author') ?></p><?php endif; ?>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="mt-10 flex items-center justify-end gap-x-6">
                    <a href="/books" class="text-sm font-semibold text-gray-700 hover:underline">Cancel</a>
                    <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500">
                        <?= isset($book) ? 'Update' : 'Add' ?>
                    </button>
                </div>
            </div>
        </form>
    </div>
</main>

<?php
require basePath('resources/views/partials/footer.view.php');
?>
