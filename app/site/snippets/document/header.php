<!DOCTYPE html>
<html class="root" lang="en">
  <head>
    <? snippet('util/document') ?>
    <? snippet('util/meta') ?>

    <?= css([
      Help::versioned_asset_url('css', 'app.css')
    ]) ?>

    <? c::get('env') == 'production' ? snippet('util/analytics') : null ?>
  </head>
  <body class="<?= Help::body_classes() ?>" data-action="<?= isset($page) ? $page->template() : "default" ?>">
    <header class="document__header">
      Header
    </header>

    <main class="document__content">
