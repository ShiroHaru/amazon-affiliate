<?php
//admin

// ホーム
Breadcrumbs::for('admin', function ($trail) {
  $trail->push('ダッシュボード', url('admin'));
});

//categories
//----------------------------------------
//admin.categories
Breadcrumbs::for('admin.categories', function ($trail) {
  $trail->parent('admin');
  $trail->push('カテゴリ 一覧', url('admin/categories'));
});

//admin.categories.show
Breadcrumbs::for('admin.categories.show', function ($trail) {
  $trail->parent('admin.categories');
  $trail->push('カテゴリ 詳細', url('admin/categories'));
});

//admin.categories.edit
Breadcrumbs::for('admin.categories.edit', function ($trail) {
  $trail->parent('admin.categories');
  $trail->push('カテゴリ 編集', url('admin/categories'));
});

//origin
//----------------------------------------
//admin.origins
Breadcrumbs::for('admin.origins', function ($trail) {
  $trail->parent('admin');
  $trail->push('オリジン 一覧', url('admin/origins'));
});

//admin.origins.show
Breadcrumbs::for('admin.origins.show', function ($trail) {
  $trail->parent('admin.origins');
  $trail->push('オリジン 詳細', url('admin/origins'));
});

//admin.origins.edit
Breadcrumbs::for('admin.origins.edit', function ($trail) {
  $trail->parent('admin.origins');
  $trail->push('オリジン 編集', url('admin/origins'));
});

//product
//----------------------------------------
//admin.products
Breadcrumbs::for('admin.products', function ($trail) {
  $trail->parent('admin');
  $trail->push('商品 一覧', url('admin/products'));
});

//admin.products.show
Breadcrumbs::for('admin.products.show', function ($trail) {
  $trail->parent('admin.products');
  $trail->push('商品 詳細', url('admin/products'));
});

//admin.products.edit
Breadcrumbs::for('admin.products.edit', function ($trail) {
  $trail->parent('admin.products');
  $trail->push('商品 編集', url('admin/products'));
});

//example
//----------------------------------------
//admin.examples
Breadcrumbs::for('admin.examples', function ($trail) {
  $trail->parent('admin');
  $trail->push('エグザンプル 一覧', url('admin/examples'));
});

//admin.examples.show
Breadcrumbs::for('admin.examples.show', function ($trail) {
  $trail->parent('admin.examples');
  $trail->push('エグザンプル 詳細', url('admin/examples'));
});

//admin.examples.edit
Breadcrumbs::for('admin.examples.edit', function ($trail) {
  $trail->parent('admin.examples');
  $trail->push('エグザンプル 編集', url('admin/examples'));
});
