<div class="catalog-menu__container">
	<a class="catalog-menu__subtitle" href="catalog-list/<?= $category[
 	"slug"
 ] ?>"><?= $category["name"] ?></a>
	<?php if (isset($category["children"])) { ?>
		<?php new \app\widgets\menu\Menu([
  	"tpl" => "subcategory_tpl.php",
  	"class" => "catalog-menu__catalog-list",
  	"cache" => 0
  ]); ?>
	<?php } ?>
</div>