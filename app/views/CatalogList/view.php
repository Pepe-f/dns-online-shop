<section class="breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul>
                    <li>
                        <a href="/" itemprop="item">Главная</a>
                    </li>
                    <li>
                        <a href="catalog-list/<?= $category["slug"] ?>"><?= $category["name"] ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="catalog-list col-12">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section__title catalog-list__title">Каталог</h2>
            </div>
            <div class="catalog-list__wrapper col-12">
                <div class="row justify-content-between">
                    <?php foreach ($subcategories as $subcategory) { ?>
                        <a class="catalog-list__item col-lg-4 col-sm-6 col-12"
                           href="catalog/<?= $subcategory["slug"] ?>">
                            <div class="catalog-list__body">
                                <h2 class="catalog-list__name"><?= $subcategory["name"] ?></h2>
                            </div>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
</section>