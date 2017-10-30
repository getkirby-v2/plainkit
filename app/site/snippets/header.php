<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <title><?= $site->title()->html() ?> | <?= $page->title()->html() ?></title>

  <?= css([
    Help::versioned_asset_url('css', 'app.css')
  ]) ?>
</head>
<body class="<?= Help::body_classes() ?>">
  <header>
    Header
  </header>
  <main>
