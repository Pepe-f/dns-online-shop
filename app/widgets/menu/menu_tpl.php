<li class="header-bottom__catalog-item col-12">
	<a class="header-bottom__catalog-link col-12" href="<?php if (
 	$category["parent_id"] > 0
 ) {
 	echo "catalog/{$category["slug"]}";
 } else {
 	echo "catalog-list/{$category["slug"]}";
 } ?>">
		<strong><?= $category["name"] ?></strong>
	</a>
	<?php if (isset($category["children"])) { ?>
		<ul class="header-bottom__catalog-submenu row">
			<?= $this->getMenuHtml($category["children"]) ?>
		</ul>
	<?php } ?>
</li>