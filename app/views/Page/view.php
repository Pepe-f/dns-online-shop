<?php
/** @var $page array */
?>
<section class="breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul>
                    <li>
                        <a href="<?= PATH ?>" itemprop="item">Главная</a>
                    </li>
                    <li>
                        <a href="#"><?= $page["title"] ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="default-content">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="section__title"><?= $page["title"] ?></h1>
            </div>
            <div class="col-12">
                <?= $page["content"] ?>
            </div>
        </div>
    </div>
</section>