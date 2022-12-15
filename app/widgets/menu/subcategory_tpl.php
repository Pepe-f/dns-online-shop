<?php if (!isset($category["children"])) { ?>
<li class="catalog-menu__catalog-item">
	<a class="catalog-menu__catalog-link" href="catalog/<?= $category["slug"] ?>">
		<?= $category["name"] ?>
	</a>
</li>
<?php } ?>
<?php if (isset($category["children"])) { ?>
	<?= $this->getMenuHtml($category["children"]) ?>
<?php } ?>
