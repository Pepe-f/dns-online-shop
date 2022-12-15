<?php

use dns\Router;

Router::add('^admin/?$', [
	"controller" => "Main",
	"action" => "index",
	"admin_prefix" => "admin"
]);
Router::add('^admin/(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', [
	"admin_prefix" => "admin"
]);

Router::add('product/(?P<slug>[a-z0-9-]+)/?$', [
	"controller" => "Product",
	"action" => "view"
]);

Router::add('catalog-list/(?P<slug>[a-z0-9-]+)/?$', [
	"controller" => "CatalogList",
	"action" => "view"
]);

Router::add('catalog/(?P<slug>[a-z0-9-]+)/?$', [
	"controller" => "Catalog",
	"action" => "view"
]);

Router::add('cart/?$', [
	"controller" => "Cart",
	"action" => "view"
]);

Router::add('^$', ["controller" => "Main", "action" => "index"]);
Router::add('^(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?$');
